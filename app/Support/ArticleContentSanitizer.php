<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;
use RuntimeException;

class ArticleContentSanitizer
{
    private const ALLOWED_TAGS = [
        'a', 'b', 'blockquote', 'br', 'em', 'h2', 'h3', 'i', 'li', 'ol', 'p', 's', 'span', 'strong', 'u', 'ul',
    ];

    private const DROP_CONTENT_TAGS = [
        'embed', 'iframe', 'math', 'object', 'script', 'style', 'svg', 'template',
    ];

    public function sanitize(string $html): string
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $previousErrorState = libxml_use_internal_errors(true);

        try {
            $loaded = $document->loadHTML(
                '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body><div id="article-content">'.$html.'</div></body></html>',
                LIBXML_NONET,
            );
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previousErrorState);
        }

        if (! $loaded) {
            throw new RuntimeException('Unable to parse article content for sanitization.');
        }

        $root = $document->getElementById('article-content');

        if (! $root) {
            throw new RuntimeException('Unable to locate article content for sanitization.');
        }

        $this->sanitizeChildren($root);

        $sanitized = '';

        foreach ($root->childNodes as $child) {
            $sanitized .= $document->saveHTML($child);
        }

        return $sanitized;
    }

    private function sanitizeChildren(DOMNode $parent): void
    {
        foreach (iterator_to_array($parent->childNodes) as $child) {
            if (! $child instanceof DOMElement) {
                if ($child->nodeType === XML_COMMENT_NODE) {
                    $parent->removeChild($child);
                }

                continue;
            }

            $tag = strtolower($child->tagName);

            if (in_array($tag, self::DROP_CONTENT_TAGS, true)) {
                $parent->removeChild($child);

                continue;
            }

            $this->sanitizeChildren($child);

            if (! in_array($tag, self::ALLOWED_TAGS, true)) {
                while ($child->firstChild) {
                    $parent->insertBefore($child->firstChild, $child);
                }

                $parent->removeChild($child);

                continue;
            }

            $this->sanitizeAttributes($child, $tag);
        }
    }

    private function sanitizeAttributes(DOMElement $element, string $tag): void
    {
        $href = $tag === 'a' ? $element->getAttribute('href') : null;
        $style = $tag === 'span' ? $element->getAttribute('style') : null;

        while ($element->attributes->length > 0) {
            $element->removeAttributeNode($element->attributes->item(0));
        }

        if ($href !== null && $this->isSafeHref($href)) {
            $element->setAttribute('href', $href);
        }

        if ($style !== null && preg_match(
            '/^background-color:\s*(#[0-9a-f]{3}(?:[0-9a-f]{3})?|rgba?\(\s*\d{1,3}\s*,\s*\d{1,3}\s*,\s*\d{1,3}(?:\s*,\s*(?:0|1|0?\.\d+))?\s*\))\s*;?$/i',
            trim($style),
        )) {
            $element->setAttribute('style', trim($style));
        }
    }

    private function isSafeHref(string $href): bool
    {
        $href = trim($href);

        if (preg_match('/[\x00-\x20\x7f\\\\]/', $href)) {
            return false;
        }

        $scheme = parse_url($href, PHP_URL_SCHEME);

        if ($scheme !== null) {
            return in_array(strtolower($scheme), ['http', 'https', 'mailto'], true);
        }

        return $href !== '' && ! str_starts_with($href, '//');
    }
}

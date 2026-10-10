<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Review Album: Burgerkill - Adamantine',
                'slug' => Str::slug('Review Album: Burgerkill - Adamantine'),
                'category' => 'review',
                'excerpt' => 'Eksplorasi sound metal pekat dengan agresi tanpa kompromi.',
                'content' => '<p class="mb-4">Adamantine membuktikan dominasi musik keras lokal belum habis. Riff gitar cepat dipadu beat drum konstan membuat setiap trek terasa menghantam dada.</p>',
                'cover_image' => 'posts/burgerkill.jpg', // dummy path
                'audio_embed_url' => 'https://open.spotify.com/embed/album/3R1u5A2pX7H5vL9kQ3X8uK',
            ],
            [
                'title' => 'Demo Review: Rotten Corpse - Raw Grindcore 2026',
                'slug' => Str::slug('Demo Review: Rotten Corpse - Raw Grindcore 2026'),
                'category' => 'review',
                'excerpt' => 'Serangan noise grindcore mentah berkecepatan tinggi langsung dari underground.',
                'content' => '<p class="mb-4">Tanpa banyak basa-basi, demo ini berisi 6 trek singkat yang rata-rata berdurasi di bawah satu menit.</p>',
                'cover_image' => 'posts/rotten.jpg', // dummy path
                'audio_embed_url' => 'https://bandcamp.com/EmbeddedPlayer/album=1234567890/size=large/bgcol=333333/linkcol=e98080/tracklist=false/artwork=small/transparent=true/',
            ],
        ];

        foreach ($posts as $data) {
            Post::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
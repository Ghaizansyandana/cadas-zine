<?php

namespace Database\Seeders;

use App\Models\Zine;
use Illuminate\Database\Seeder;

class ZineSeeder extends Seeder
{
    public function run(): void
    {
        $zines = [
            [
                'title' => 'Manifesto Noise Zine',
                'issue_number' => 'Issue #01',
                'author' => 'Bandung Hardcore Collective',
                'description' => 'Membahas etika DIY, arsip foto gig era 2010-an, dan esai pergerakan underground lokal.',
                'cover_image' => 'zines/covers/manifesto-01.jpg',
                'pdf_file' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', // URL PDF Dummy buat tes
            ],
            [
                'title' => 'Cadas Subculture Digest',
                'issue_number' => 'Issue #04',
                'author' => 'Infomusikcadas Redaksi',
                'description' => 'Kompilasi ulasan album grindcore lokal dan panduan membikin rilisan fisik kaset secara independen.',
                'cover_image' => 'zines/covers/digest-04.jpg',
                'pdf_file' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            ],
        ];

        foreach ($zines as $data) {
            Zine::updateOrCreate(['title' => $data['title']], $data);
        }
    }
}

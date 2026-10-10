<?php
namespace Database\Seeders;

use App\Models\PhysicalRelease;
use Illuminate\Database\Seeder;

class PhysicalReleaseSeeder extends Seeder
{
    public function run(): void
    {
        PhysicalRelease::create([
            'title' => 'Adamantine (Cassette Edition)',
            'band_name' => 'Burgerkill',
            'format' => 'kaset',
            'price' => '75K',
            'buy_link' => 'https://bandcamp.com',
        ]);

        PhysicalRelease::create([
            'title' => 'Manifesto Noise Zine Issue #02',
            'band_name' => 'Kolektif Cadas',
            'format' => 'zine',
            'price' => '25K',
            'buy_link' => 'https://instagram.com',
        ]);

        PhysicalRelease::create([
            'title' => 'Grindcore Assault EP (10" Vinyl)',
            'band_name' => 'Siksa Kubur',
            'format' => 'vinyl',
            'price' => '350K',
            'buy_link' => 'https://tokopedia.com',
        ]);

        PhysicalRelease::create([
            'title' => 'Demo 2026 (CD Digi-pak)',
            'band_name' => 'Rotten Corpse',
            'format' => 'cd',
            'price' => '50K',
            'buy_link' => 'https://shopee.co.id',
        ]);
    }
}
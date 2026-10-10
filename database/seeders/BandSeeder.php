<?php

namespace Database\Seeders;

use App\Models\Band;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BandSeeder extends Seeder
{
    public function run(): void
    {
        $bands = [
            [
                'name' => 'Burgerkill',
                'slug' => Str::slug('Burgerkill'),
                'city' => 'Bandung',
                'genre' => 'Metal',
                'bio' => 'Unit metalcore / groove metal legendaris asal Ujungberung, Bandung.',
                'instagram_url' => 'https://instagram.com/burgerkillofficial',
                'bandcamp_url' => 'https://burgerkill.bandcamp.com',
                'spotify_url' => 'https://open.spotify.com/artist/burgerkill',
                'discography' => 'Dua Sisi (2000), Berkarat (2003), Beyond Coma and Despair (2006), Venomous (2011), Adamantine (2018)',
            ],
            [
                'name' => 'Rotten Corpse',
                'slug' => Str::slug('Rotten Corpse'),
                'city' => 'Bandung',
                'genre' => 'Grindcore',
                'bio' => 'Grindcore mentah berkecepatan tinggi dengan hentakan blastbeat tanpa ampun.',
                'instagram_url' => 'https://instagram.com',
                'bandcamp_url' => 'https://bandcamp.com',
                'spotify_url' => null,
                'discography' => 'Demo 2026 (2026), Split w/ Noise Assault (2026)',
            ],
            [
                'name' => 'Sludge Machine',
                'slug' => Str::slug('Sludge Machine'),
                'city' => 'Jakarta',
                'genre' => 'Sludge',
                'bio' => 'Sound berat, tempo lambat, riff penuh distorsi pekat.',
                'instagram_url' => 'https://instagram.com',
                'bandcamp_url' => 'https://bandcamp.com',
                'spotify_url' => 'https://open.spotify.com',
                'discography' => 'Heavy Dues EP (2025)',
            ],
            [
                'name' => 'Siksa Kubur',
                'slug' => Str::slug('Siksa Kubur'),
                'city' => 'Jakarta',
                'genre' => 'Death Metal',
                'bio' => 'Vektor death metal gaek asal Jakarta yang konsisten menebar agresi.',
                'instagram_url' => 'https://instagram.com',
                'bandcamp_url' => null,
                'spotify_url' => 'https://open.spotify.com',
                'discography' => 'The Restless Hit (2001), Eye for an Eye (2002), Podium (2007)',
            ],
        ];

        foreach ($bands as $data) {
            Band::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
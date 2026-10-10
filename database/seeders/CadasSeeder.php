<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Gig;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CadasSeeder extends Seeder
{
    public function run(): void
    {
        // Posts Dummy
        Post::create([
            'title' => 'Review Album: Burgerkill - Adamantine',
            'slug' => Str::slug('Review Album: Burgerkill - Adamantine'),
            'category' => 'review',
            'excerpt' => 'Eksplorasi sound metal pekat dengan agresi tanpa kompromi.',
            'content' => '<p>Album ini membuktikan bahwasanya dominasi musik keras lokal belum habis. Riff gitar cepat dipadu beat drum konstan membuat setiap trek terasa menghantam dada.</p>',
            'audio_embed_url' => 'https://open.spotify.com/embed/album/1X2y3z4w5v',
        ]);

        Post::create([
            'title' => 'Wawancara Eksklusif: Sisi Gelap Underground Bandung',
            'slug' => Str::slug('Wawancara Eksklusif: Sisi Gelap Underground Bandung'),
            'category' => 'interview',
            'excerpt' => 'Obrolan santai bareng kolektif lokal mengenai etika DIY dan skena hari ini.',
            'content' => '<p>Pergerakan independen tidak pernah mati, mereka hanya berganti bentuk dan ruang gerak.</p>',
        ]);

        // Gigs Dummy
        Gig::create([
            'title' => 'Bandung Noise Fest Vol. 1',
            'city' => 'Bandung',
            'venue' => 'Kolektif Space Ciumbuleuit',
            'event_date' => now()->addDays(5),
            'ticket_price' => '50K',
        ]);

        Gig::create([
            'title' => 'Moshpit Madness: Grindcore Assault',
            'city' => 'Jakarta',
            'venue' => 'Gudang Sarinah',
            'event_date' => now()->addDays(12),
            'ticket_price' => 'Free',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Gig;
use Illuminate\Database\Seeder;

class GigSeeder extends Seeder
{
    public function run(): void
    {
        $gigs = [
            [
                'title' => 'Bandung Noise Fest Vol. 1',
                'city' => 'Bandung',
                'venue' => 'Grounded Space',
                'event_date' => now()->addDays(7),
                'ticket_price' => 'Rp 50.000',
                'flyer_image' => 'gigs/flyer1.jpg',
                'is_approved' => true,
            ],
            [
                'title' => 'Moshpit Madness: Grindcore Assault',
                'city' => 'Jakarta',
                'venue' => 'Kopi Panas Stage',
                'event_date' => now()->addDays(14),
                'ticket_price' => 'FREE ENTRY',
                'flyer_image' => 'gigs/flyer2.jpg',
                'is_approved' => true,
            ],
        ];

        foreach ($gigs as $gig) {
            Gig::updateOrCreate(['title' => $gig['title']], $gig);
        }
    }
}
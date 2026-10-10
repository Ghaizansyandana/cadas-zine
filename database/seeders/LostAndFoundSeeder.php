<?php

namespace Database\Seeders;

use App\Models\LostAndFound;
use Illuminate\Database\Seeder;

class LostAndFoundSeeder extends Seeder
{
    public function run(): void
    {
        LostAndFound::updateOrCreate(
            ['item_name' => 'Kacamata Frame Hitam Min 2.5'],
            [
                'type' => 'lost',
                'gig_name' => 'Bandung Noise Fest Vol. 1',
                'city' => 'Bandung',
                'description' => 'Copot pas moshpit di set Rotten Corpse. Buat yang nemu tolong dikabarin, gak bisa liat jalan pulang.',
                'contact_person' => '@ghaizan_arsya (IG)',
                'is_approved' => true,
            ]
        );

        LostAndFound::updateOrCreate(
            ['item_name' => 'Sabuk Spike Metal / Studded Belt'],
            [
                'type' => 'found',
                'gig_name' => 'Moshpit Madness: Grindcore Assault',
                'city' => 'Jakarta',
                'description' => 'Nemu di dekat barikade panggung utama sesudah acara kelar. Kondisi duri masih lengkap.',
                'contact_person' => '081234567890 (WA)',
                'is_approved' => true,
            ]
        );
    }
}

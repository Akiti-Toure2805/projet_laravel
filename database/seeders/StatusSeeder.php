<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('statuses')->insert([
            [
                'name' => 'en attente',
                'color' => '#fbbf24', // jaune
                'created_at' => now(),
            ],
            [
                'name' => 'en cours ',
                'color' => '#3b82f6', // bleu
                'created_at' => now(),
            ],
            [
                'name' => 'terminée',
                'color' => '#10b981', // vert
                'created_at' => now(),
            ],
            [
                'name' => 'supprimée',
                'color' => '#ef4444', // rouge
                'created_at' => now(),
            ],
        ]);
    }
}

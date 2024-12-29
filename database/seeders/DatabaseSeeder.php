<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\news_cat;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'share@example.com',
        // ]);


        // \App\Models\news::factory()->create([
            // 'catid' => news_cat::first() ?? news_cat::factory()
        // ]);
    }
}

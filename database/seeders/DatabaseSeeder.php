<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\admin;
use App\Models\contactmap;
use App\Models\news_cat;
use App\Models\role;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        admin::create([
            'fullname' => 'فاطمه مهدوی',
            'username'=>'admin',
            'password'=>'$2y$10$aXtp0kJ5cJtA5D7khJ0T8uEC66sgb50sbb3pOvHpR9S93uDVr7Oby',
            'mobile'=>'09331875795',
            'email'=>'fateme.mahdavi.it@gmail.com',
            'province'=>1,
            'city'=>1,
            'is_main'=>1,
            'role_id'=>1,
            'pic'=>''
        ]);

        role::create([
            'title' => 'مدیر اصلی',
            'is_main' => 1,
            'admin_id' => 1,
        ]);

        contactmap::create([
            'lang'=>1,
            'admin_id'=>1,
            'lgmap'=>'51.422050867276866',
            'qgmap'=>'35.767638247435',
            'zgmap'=>'16',
            'cgmap'=>''
        ]);

        // run
        // php artisan migrate:fresh --seed
        // php artisan make:permission     
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        // header
        for ($i = 1; $i <= 9; $i++)
        {
            Banner::create([
                'filter' => '',
                'banner_type' => 'header',
                'position' => $i,
            ]);

        }

        //middle
        for ($i = 1; $i <= 3; $i++) {
             Banner::create([
                'filter' => '',
                'banner_type' => 'middle',
                'position' => $i,
            ]);
        }

        // bottom
        for ($i = 1; $i <= 4; $i++) {
            Banner::create([
                'filter' => '',
                'banner_type' => 'bottom',
                'position' => $i,
            ]);
        }
    }
}

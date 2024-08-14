<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // header
        for ($i = 1; $i <= 9; $i++) {
            $banner = Banner::create([
                'filter' => '' . $i,
                'banner_type' => 'header',
                'position' => $i,
            ]);

        }

        //middle
        for ($i = 1; $i <= 3; $i++) {
            $banner = Banner::create([
                'filter' => '' . $i,
                'banner_type' => 'middle',
                'position' => $i,
            ]);
        }

        // bottom
        for ($i = 1; $i <= 4; $i++) {
            $banner = Banner::create([
                'filter' => '' . $i,
                'banner_type' => 'bottom',
                'position' => $i,
            ]);
        }
    }
}

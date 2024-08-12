<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            "title" => 'محبوب',
            "description" => ''
        ]);
        Category::create([
            "title" => 'تخفیف ویژه',
            "description" => ''
        ]);
        Category::create([
            "title" => 'جنگلی',
            "description" => ''
        ]);
        Category::create([
            "title" => 'ساحلی',
            "description" => ''
        ]);
        Category::create([
            "title" => 'زیارتی',
            "description" => ''
        ]);
        Category::create([
            "title" => 'بومگردی',
            "description" => ''
        ]);
        Category::create([
            "title" => 'تاریخی',
            "description" => ''
        ]);
        Category::create([
            "title" => 'خارجی',
            "description" => ''
        ]);
        Category::create([
            "title" => 'کویر گردی',
            "description" => 'شبای کویر دیدن داره'
        ]);
        Category::create([
            "title" => 'شمال گردی',
            "description" => 'هوای شمال همیشه میچسبه'
        ]);
        Category::create([
            "title" => 'تهران گردی',
            "description" => 'تهرانو دست کم نگیر'
        ]);
        Category::create([
            "title" => 'جنوب گردی',
            "description" => 'شور و حال جنوب محاله یادت بره'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['لوازم آرایشی', 'مراقبت پوست', 'مراقبت و زیبایی مو', 'عطر و ادکلن'];
        foreach ($categories as $category) {
            Category::create([
                "title" => $category,
                "category_id" => 0
            ]);
    }
}
}

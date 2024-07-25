<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'contact_address', 'value' => 'آدرس', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_phone', 'value' => 'شماره تماس', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'contact_email', 'value' => 'ایمیل', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'customer_faq', 'value' => 'سوالات متداول', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'customer_support', 'value' => 'مرکز پشتیبانی', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'customer_about', 'value' => 'درباره ما', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'popular_north_tours', 'value' => 'تورهای شمال', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'popular_international_tours', 'value' => 'تورهای خارجی', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'popular_desert_tours', 'value' => 'تورهای کویر', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'logo', 'value' => '', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_instagram', 'value' => 'Instagram', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_twitter', 'value' => 'Twitter', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_youtube', 'value' => 'YouTube', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'social_linkedin', 'value' => 'LinkedIn', 'created_at' => now(), 'updated_at' => now()],
        ];

        Setting::insert($settings);
    }
}

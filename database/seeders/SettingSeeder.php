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
            ['key' => 'logo', 'value' => ''],
            ['key' => 'contact_address', 'value' => 'Your default address'],
            ['key' => 'contact_phone', 'value' => 'Your default phone number'],
            ['key' => 'contact_email', 'value' => 'contact@example.com'],
            ['key' => 'customer_faq', 'value' => 'Default FAQ content'],
            ['key' => 'customer_support', 'value' => 'Your customer support information'],
            ['key' => 'about_us', 'value' => 'About us default content'],
            ['key' => 'popular_destinations', 'value' => json_encode(['تورهای شمال', 'تورهای خارجی', 'تورهای کویر'])],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/yourprofile'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/yourprofile'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/yourprofile'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/in/yourprofile'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'address', 'value' => 'تهران . خیابان نلسون ماندلا ساختمان اداری سفرجو . پلاک 12 '],
            ['key' => 'phone', 'value' => '(021) 468 - 686888'],
            ['key' => 'email', 'value' => 'Safarjo1403@gmail.com'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/yourprofile'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/yourprofile'],
            ['key' => 'youtube', 'value' => 'https://youtube.com/yourprofile'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/in/yourprofile'],
            ['key' => 'logo', 'value' => ''],
        ];

        foreach ($settings as $setting) {
            Setting::Create([
                'key' => $setting['key'],
                'value' => $setting['value']
            ]);
        }
    }
}

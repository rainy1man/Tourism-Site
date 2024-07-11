<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create 5 brands
         $provinces = ['تهران', 'اصفهان', 'خراسان رضوی', 'مازندران', 'یزد', 'فارس', 'البرز'];
         foreach ($provinces as $province) {
             Province::create(["province_name" => $province]);
         }

         // Create 5 brands
         $cities = ['تهران', 'ری', 'شهریار', 'اسلامشهر', 'پاکدشت', 'ورامین'];
         foreach ($cities as $city) {
             City::create([
                 "city_name" => $city,
                 "province_id" => 1
             ]);
         }

         // Create 5 brands
         $cities = ['اصفهان', 'کاشان', 'آران و بیدگل', 'شاهین شهر', 'گلپایگان', 'مبارکه', 'شهررضا'];
         foreach ($cities as $city) {
             City::create([
                 "city_name" => $city,
                 "province_id" => 2
             ]);
         }

         // Create 5 brands
         $cities = ['مشهد', 'نیشابور', 'سبزوار', 'تربت حیدریه', 'طرقبه', 'سرخس', 'کاشمر'];
         foreach ($cities as $city) {
             City::create([
                 "city_name" => $city,
                 "province_id" => 3
             ]);
         }

         // Create 5 brands
         $cities = ['ساری', 'آمل', 'بابل', 'نور', 'قائم شهر', 'نکا', 'رامسر'];
         foreach ($cities as $city) {
             City::create([
                 "city_name" => $city,
                 "province_id" => 4
             ]);
         }

         // Create 5 brands
         $cities = ['یزد', 'میبد', 'بافق', 'اردکان', 'ابرکوه', 'مهریز', 'مهردشت'];
         foreach ($cities as $city) {
             City::create([
                 "city_name" => $city,
                 "province_id" => 5
             ]);
         }

         // Create 5 brands
         $cities = ['شیراز', 'مرودشت', 'جهرم', 'فسا', 'کازرون', 'لار', 'استهبار'];
         foreach ($cities as $city) {
             City::create([
                 "city_name" => $city,
                 "province_id" => 6
             ]);
         }

         // Create 5 brands
         $cities = ['کرج', 'فردس', 'ماهدشت', 'گلسار', 'فردیس', 'طالقان', 'گرمدره'];
         foreach ($cities as $city) {
             City::create([
                 "city_name" => $city,
                 "province_id" => 7
             ]);
         }

     }
}

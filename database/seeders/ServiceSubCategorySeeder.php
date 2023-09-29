<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ServiceSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['sub_category_name' => 'Electrician','service_category_id' => '1'],
            ['sub_category_name' => 'Plumber','service_category_id' => '1'],
            ['sub_category_name' => 'Doctor','service_category_id' => '1'],
            ['sub_category_name' => 'Advocate','service_category_id' => '1'],
            ['sub_category_name' => 'Saloons','service_category_id' => '2'],
            ['sub_category_name' => 'Tattoos','service_category_id' => '2'],
            ['sub_category_name' => 'DTS','service_category_id' => '2'],
            ['sub_category_name' => 'Advocate','service_category_id' => '2'],
            ['sub_category_name' => 'Educational Consultancies','service_category_id' => '3'],
            ['sub_category_name' => 'Legal Consultancies','service_category_id' => '3'],

        ];
        foreach ($data as $item){
            DB::table('service_sub_categories')->insert(['sub_category_name' => $item['sub_category_name'], 'service_category_id' => $item['service_category_id']],$item);
        }
    }
}

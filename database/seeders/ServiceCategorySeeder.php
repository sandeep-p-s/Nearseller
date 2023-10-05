<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['service_category_name' => 'Individual','business_type_id' => '2'],
            ['service_category_name' => 'Shop','business_type_id' => '2'],
            ['service_category_name' => 'Companies & Organisations','business_type_id' => '2'],

        ];
        foreach ($data as $item){
            DB::table('service_categories')->insert(['service_category_name' => $item['service_category_name'], 'business_type_id' => $item['business_type_id']],$item);
        }
    }
}

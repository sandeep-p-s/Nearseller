<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['business_name' => 'Sales'],
            ['business_name' => 'Services'],
        ];
        foreach ($data as $item){
            DB::table('business_type')->insert(['business_name' => $item['business_name']],$item);
        }    }
}

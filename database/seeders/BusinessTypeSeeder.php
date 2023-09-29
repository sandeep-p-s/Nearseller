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
        $now = now();

        $data = [
            ['business_name' => 'Sales','created_at' => $now, 'updated_at' => $now],
            ['business_name' => 'Services','created_at' => $now, 'updated_at' => $now],
        ];
        foreach ($data as $item){
            DB::table('business_type')->insert(['business_name' => $item['business_name'],'created_at' => $item['created_at'],'updated_at' => $item['updated_at']],$item);
        }
    }
}

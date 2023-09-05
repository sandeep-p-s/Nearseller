<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaritalstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['mr_name' => 'Single'],
            ['mr_name' => 'Married'],
            ['mr_name' => 'Widowed'],
            ['mr_name' => 'Divorced'],

        ];
        foreach ($data as $item){
            DB::table('marital_statuses')->insert(['mr_name' => $item['mr_name']], $item);
        }
    }
}

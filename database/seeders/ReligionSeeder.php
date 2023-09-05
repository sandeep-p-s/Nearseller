<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['religion_name' => 'Christian'],
            ['religion_name' => 'Hindu'],
            ['religion_name' => 'Muslim'],

        ];
        foreach ($data as $item){
            DB::table('religions')->insert(['religion_name' => $item['religion_name']], $item);
        }
    }
}

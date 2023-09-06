<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['profession_name' => 'Doctor'],
            ['profession_name' => 'Engineer'],
            ['profession_name' => 'Others'],

        ];
        foreach ($data as $item){
            DB::table('professions')->insert(['profession_name' => $item['profession_name']], $item);
        }
    }
}

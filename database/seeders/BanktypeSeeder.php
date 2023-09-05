<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BanktypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['bank_name' => 'STATE BANK OF INDIA'],
        ];
        foreach ($data as $item){
            DB::table('bank_types')->insert(['bank_name' => $item['bank_name']], $item);
        }
    }
}

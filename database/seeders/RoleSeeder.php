<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['role_name' => 'Super_admin'],
            ['role_name' => 'Seller'],
            ['role_name' => 'Affiliate'],
            ['role_name' => 'Customer'],
            ['role_name' => 'Affiliate_coordinator'],
            ['role_name' => 'Product_adding_executive'],
            ['role_name' => 'HR'],
            ['role_name' => 'Shop_coordinator'],
        ];
        foreach ($data as $item){
            DB::table('roles')->insert(['role_name' => $item['role_name']], $item);
        }
    }
}

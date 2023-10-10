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
            ['role_name' => 'Super_admin','is_active' => '1'],
            ['role_name' => 'Seller','is_active' => '1'],
            ['role_name' => 'Affiliate','is_active' => '0'],
            ['role_name' => 'Customer','is_active' => '1'],
            ['role_name' => 'Affiliate_coordinator','is_active' => '0'],
            ['role_name' => 'Product_adding_executive','is_active' => '0'],
            ['role_name' => 'HR','is_active' => '0'],
            ['role_name' => 'Shop_coordinator','is_active' => '0'],
            ['role_name' => 'Services','is_active' => '1'],

        ];
        foreach ($data as $item){
            DB::table('roles')->insert(['role_name' => $item['role_name'],'is_active' => $item['is_active']], $item);
        }
    }
}

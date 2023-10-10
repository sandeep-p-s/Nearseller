<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $data = [
            ['menu_id' => 'Super_admin','user_id' => '1','user_role' => 'Super_admin','privilage' => '1','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => 'Seller','user_id' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => 'Affiliate','user_id' => '0','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => 'Customer','user_id' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => 'Affiliate_coordinator','user_id' => '0','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => 'Product_adding_executive','user_id' => '0','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => 'HR','user_id' => '0','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => 'Shop_coordinator','user_id' => '0','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => 'Services','user_id' => '1','created_at' => $now, 'updated_at' => $now],

        ];
        foreach ($data as $item){
            DB::table('roles')->insert(['userpages' => $item['role_name'],'is_active' => $item['is_active']], $item);
        }
    }
}

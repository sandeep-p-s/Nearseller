<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'c_v_admin', 'description' => 'Can View admin user'],
            ['name' => 'c_a_admin', 'description' => 'Can Add admin user'],
            ['name' => 'c_e_admin', 'description' => 'Can Edit admin user'],
            ['name' => 'c_d_admin', 'description' => 'Can Delete admin user'],

            ['name' => 'c_v_seller', 'description' => 'Can View seller user'],
            ['name' => 'c_a_seller', 'description' => 'Can Add seller user'],
            ['name' => 'c_e_seller', 'description' => 'Can Edit seller user'],
            ['name' => 'c_d_seller', 'description' => 'Can Delete seller user'],

            ['name' => 'c_v_affiliate', 'description' => 'Can View affiliate user'],
            ['name' => 'c_a_affiliate', 'description' => 'Can Add affiliate user'],
            ['name' => 'c_e_affiliate', 'description' => 'Can Edit affiliate user'],
            ['name' => 'c_d_affiliate', 'description' => 'Can Delete affiliate user'],

            ['name' => 'c_v_affiliate_coordinator', 'description' => 'Can View affiliate_coordinator user'],
            ['name' => 'c_a_affiliate_coordinator', 'description' => 'Can Add affiliate_coordinator user'],
            ['name' => 'c_e_affiliate_coordinator', 'description' => 'Can Edit affiliate_coordinator user'],
            ['name' => 'c_d_affiliate_coordinator', 'description' => 'Can Delete affiliate_coordinator user'],

            ['name' => 'c_v_product_adding_executive', 'description' => 'Can View product_adding_executive user'],
            ['name' => 'c_a_product_adding_executive', 'description' => 'Can Add product_adding_executive user'],
            ['name' => 'c_e_product_adding_executive', 'description' => 'Can Edit product_adding_executive user'],
            ['name' => 'c_d_product_adding_executive', 'description' => 'Can Delete product_adding_executive user'],

            ['name' => 'c_v_hr', 'description' => 'Can View hr user'],
            ['name' => 'c_a_hr', 'description' => 'Can Add hr user'],
            ['name' => 'c_e_hr', 'description' => 'Can Edit hr user'],
            ['name' => 'c_d_hr', 'description' => 'Can Delete hr user'],

            ['name' => 'c_v_shop_coordinator', 'description' => 'Can View shop_coordinator user'],
            ['name' => 'c_a_shop_coordinator', 'description' => 'Can Add shop_coordinator user'],
            ['name' => 'c_e_shop_coordinator', 'description' => 'Can Edit shop_coordinator user'],
            ['name' => 'c_d_shop_coordinator', 'description' => 'Can Delete shop_coordinator user'],

        ];
        foreach ($data as $item) {
            DB::table('permissions')->insert(['name' => $item['name'], 'description' => $item['description']], $item);
        }
    }
}

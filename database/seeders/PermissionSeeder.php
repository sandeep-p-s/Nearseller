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
            ['name' => 'c_v_admin', 'description' => 'Can View admin user', 'module' => '1','is_disabled' => '0'],
            ['name' => 'c_a_admin', 'description' => 'Can Add admin user', 'module' => '1','is_disabled' => '0'],
            ['name' => 'c_e_admin', 'description' => 'Can Edit admin user', 'module' => '1','is_disabled' => '0'],
            ['name' => 'c_d_admin', 'description' => 'Can Delete admin user', 'module' => '1','is_disabled' => '1'],


            ['name' => 'c_v_role', 'description' => 'Can View Role', 'module' => '2','is_disabled' => '0'],
            ['name' => 'c_a_role', 'description' => 'Can Add Role', 'module' => '2','is_disabled' => '0'],
            ['name' => 'c_e_role', 'description' => 'Can Edit Role', 'module' => '2','is_disabled' => '0'],
            ['name' => 'c_d_role', 'description' => 'Can Delete Role', 'module' => '2','is_disabled' => '1'],

            ['name' => 'c_v_seller', 'description' => 'Can View seller user', 'module' => '3','is_disabled' => '0'],
            ['name' => 'c_a_seller', 'description' => 'Can Add seller user', 'module' => '3','is_disabled' => '0'],
            ['name' => 'c_e_seller', 'description' => 'Can Edit seller user', 'module' => '3','is_disabled' => '0'],
            ['name' => 'c_d_seller', 'description' => 'Can Delete seller user', 'module' => '3','is_disabled' => '1'],

            ['name' => 'c_v_affiliate', 'description' => 'Can View affiliate user', 'module' => '4','is_disabled' => '0'],
            ['name' => 'c_a_affiliate', 'description' => 'Can Add affiliate user', 'module' => '4','is_disabled' => '0'],
            ['name' => 'c_e_affiliate', 'description' => 'Can Edit affiliate user', 'module' => '4','is_disabled' => '0'],
            ['name' => 'c_d_affiliate', 'description' => 'Can Delete affiliate user', 'module' => '4','is_disabled' => '1'],

            ['name' => 'c_v_affiliate_coordinator', 'description' => 'Can View affiliate_coordinator user', 'module' => '5','is_disabled' => '0'],
            ['name' => 'c_a_affiliate_coordinator', 'description' => 'Can Add affiliate_coordinator user', 'module' => '5','is_disabled' => '0'],
            ['name' => 'c_e_affiliate_coordinator', 'description' => 'Can Edit affiliate_coordinator user', 'module' => '5','is_disabled' => '0'],
            ['name' => 'c_d_affiliate_coordinator', 'description' => 'Can Delete affiliate_coordinator user', 'module' => '5','is_disabled' => '1'],

            ['name' => 'c_v_hr', 'description' => 'Can View hr user', 'module' => '6','is_disabled' => '0'],
            ['name' => 'c_a_hr', 'description' => 'Can Add hr user', 'module' => '6','is_disabled' => '0'],
            ['name' => 'c_e_hr', 'description' => 'Can Edit hr user', 'module' => '6','is_disabled' => '0'],
            ['name' => 'c_d_hr', 'description' => 'Can Delete hr user', 'module' => '6','is_disabled' => '1'],

            ['name' => 'c_v_product_adding_executive', 'description' => 'Can View product_adding_executive user', 'module' => '7' ,'is_disabled' => '0'],
            ['name' => 'c_a_product_adding_executive', 'description' => 'Can Add product_adding_executive user', 'module' => '7','is_disabled' => '0'],
            ['name' => 'c_e_product_adding_executive', 'description' => 'Can Edit product_adding_executive user', 'module' => '7','is_disabled' => '0'],
            ['name' => 'c_d_product_adding_executive', 'description' => 'Can Delete product_adding_executive user', 'module' => '7','is_disabled' => '1'],

            ['name' => 'c_v_shop_coordinator', 'description' => 'Can View shop_coordinator user', 'module' => '8','is_disabled' => '0'],
            ['name' => 'c_a_shop_coordinator', 'description' => 'Can Add shop_coordinator user', 'module' => '8','is_disabled' => '0'],
            ['name' => 'c_e_shop_coordinator', 'description' => 'Can Edit shop_coordinator user', 'module' => '8','is_disabled' => '0'],
            ['name' => 'c_d_shop_coordinator', 'description' => 'Can Delete shop_coordinator user', 'module' => '8','is_disabled' => '1'],

        ];
        foreach ($data as $item) {
            DB::table('permissions')->insert(['name' => $item['name'], 'description' => $item['description'], 'module_id' => $item['module'], 'is_disabled' => $item['is_disabled']],$item);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class SiteModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['title' => 'all_admin_user', 'desc' => 'Admin User'],
            ['title' => 'all_roles_perm', 'desc' => 'Roles & Permissions'],
            ['title' => 'seller', 'desc' => 'Seller'],
            ['title' => 'affiliate', 'desc' => 'Affiliate'],
            ['title' => 'affiliate_coordinator', 'desc' => 'Affiliate Co-ordinator'],
            ['title' => 'hr', 'desc' => 'HR'],
            ['title' => 'product_adding_executive', 'desc' => 'Product adding executive'],
            ['title' => 'shop coordinator', 'desc' => 'Shop Co-ordinator'],

        ];

        $num = 1;

        foreach ($data as $item) {
            DB::table('site_modules')->insert(
                ['module_title' => $item['title'],
             'module_description' => $item['desc'],
             'module_order' => $num,
            ], $item);
            $num += 100;
        }
    }

}


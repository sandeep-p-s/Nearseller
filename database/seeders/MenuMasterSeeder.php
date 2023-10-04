<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class MenuMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['menu_desc' => 'Approvals', 'menu_level_1' => '1', 'menu_level_2' => '0','menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'Affiliate Approval', 'menu_level_1' => '1','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'affiliateapprovals'],
            ['menu_desc' => 'Shop Approval', 'menu_level_1' => '1','menu_level_2' => '2', 'menu_level_3' => '0','url' => 'shopapprovals/1'],
            ['menu_desc' => 'Service Approval', 'menu_level_1' => '1','menu_level_2' => '3', 'menu_level_3' => '0','url' => 'shopapprovals/2'],
            ['menu_desc' => 'Category Approval', 'menu_level_1' => '1','menu_level_2' => '4', 'menu_level_3' => '0','url' => 'shopapprovals'],

            ['menu_desc' => 'User Details', 'menu_level_1' => '2', 'menu_level_2' => '0','menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'Add Role', 'menu_level_1' => '2','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'addrole'],
            ['menu_desc' => 'Manage Roles', 'menu_level_1' => '2','menu_level_2' => '2', 'menu_level_3' => '0','url' => 'listrole'],
            ['menu_desc' => 'User Creation', 'menu_level_1' => '2','menu_level_2' => '3', 'menu_level_3' => '0','url' => 'newuser'],
            ['menu_desc' => 'User Menu Mapping', 'menu_level_1' => '2','menu_level_2' => '4', 'menu_level_3' => '0','url' => 'usermenu'],
            ['menu_desc' => 'Role Menu Mapping', 'menu_level_1' => '2','menu_level_2' => '5', 'menu_level_3' => '0','url' => 'rolemenu'],
            ['menu_desc' => 'Role User Mapping', 'menu_level_1' => '2','menu_level_2' => '6', 'menu_level_3' => '0','url' => 'userrole'],

            ['menu_desc' => 'Masters', 'menu_level_1' => '3', 'menu_level_2' => '0','menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'Business Type', 'menu_level_1' => '3','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'listbusinesstype'],
            ['menu_desc' => 'Shop Type', 'menu_level_1' => '3','menu_level_2' => '2', 'menu_level_3' => '0','url' => 'shoptype'],
            ['menu_desc' => 'Service Type', 'menu_level_1' => '3','menu_level_2' => '3', 'menu_level_3' => '0','url' => 'servicetype'],
            ['menu_desc' => 'Executives', 'menu_level_1' => '3','menu_level_2' => '4', 'menu_level_3' => '0','url' => 'listexecutive'],
            ['menu_desc' => 'Country', 'menu_level_1' => '3','menu_level_2' => '5', 'menu_level_3' => '0','url' => 'listcountry'],
            ['menu_desc' => 'State', 'menu_level_1' => '3','menu_level_2' => '6', 'menu_level_3' => '0','url' => 'liststate'],
            ['menu_desc' => 'District', 'menu_level_1' => '3', 'menu_level_2' => '7','menu_level_3' => '0','url' => 'listdistrict'],
            ['menu_desc' => 'Profession', 'menu_level_1' => '3','menu_level_2' => '8', 'menu_level_3' => '0','url' => 'listprofession'],
            ['menu_desc' => 'Religion', 'menu_level_1' => '3','menu_level_2' => '9', 'menu_level_3' => '0','url' => 'listreligion'],
            ['menu_desc' => 'Bank Type', 'menu_level_1' => '3','menu_level_2' => '10', 'menu_level_3' => '0','url' => 'listbank'],
            ['menu_desc' => 'Bank Branch', 'menu_level_1' => '3','menu_level_2' => '11', 'menu_level_3' => '0','url' => 'listbank_branch'],
            ['menu_desc' => 'Category', 'menu_level_1' => '3','menu_level_2' => '12', 'menu_level_3' => '0','url' => 'listcategory'],

            ['menu_desc' => 'Affiliate List', 'menu_level_1' => '4', 'menu_level_2' => '0','menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'Affiliate User List', 'menu_level_1' => '4','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'affiliatelist'],

            ['menu_desc' => 'Affiliate Shops', 'menu_level_1' => '5', 'menu_level_2' => '0','menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'Affiliate User Shops', 'menu_level_1' => '5','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'affililateshops'],

            ['menu_desc' => 'Services', 'menu_level_1' => '6', 'menu_level_2' => '0','menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'Add Services', 'menu_level_1' => '6','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'listservice'],
            ['menu_desc' => 'Employees', 'menu_level_1' => '6','menu_level_2' => '2', 'menu_level_3' => '0','url' => 'listserviceemp'],
            ['menu_desc' => 'Offers', 'menu_level_1' => '6','menu_level_2' => '3', 'menu_level_3' => '0','url' => 'listserviceoffer'],
        ];
        foreach ($data as $item) {
            DB::table('menu_masters')->insert(['menu_desc' => $item['menu_desc'], 'menu_level_1' => $item['menu_level_1'], 'menu_level_2' => $item['menu_level_2'],'menu_level_3' => $item['menu_level_3'],'url' => $item['url']] ,$item);
        }
    }
}

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
            ['menu_desc' => 'Seller Approval', 'menu_level_1' => '1','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'shopapprovals/1'],
            ['menu_desc' => 'Service Approval', 'menu_level_1' => '1','menu_level_2' => '2', 'menu_level_3' => '0','url' => 'shopapprovals/2'],
            ['menu_desc' => 'Category Approval', 'menu_level_1' => '1','menu_level_2' => '3', 'menu_level_3' => '0','url' => 'listcategory'],
            ['menu_desc' => 'Product Approval', 'menu_level_1' => '1','menu_level_2' => '4', 'menu_level_3' => '0','url' => 'listshopproduct'],
            ['menu_desc' => 'Services Product Approval', 'menu_level_1' => '1','menu_level_2' => '5', 'menu_level_3' => '0','url' => 'listallserviceapp'],
            ['menu_desc' => 'Customer Approval', 'menu_level_1' => '1','menu_level_2' => '6', 'menu_level_3' => '0','url' => 'customerapproval/1'],
            ['menu_desc' => 'Offer Approval', 'menu_level_1' => '1','menu_level_2' => '7', 'menu_level_3' => '0','url' => 'addlistoffer'],
            ['menu_desc' => 'Seller Provider Type Approval', 'menu_level_1' => '1','menu_level_2' => '8', 'menu_level_3' => '0','url' => 'sellerprovidertype/1'],
            ['menu_desc' => 'Service Provider Type Approval', 'menu_level_1' => '1','menu_level_2' => '9', 'menu_level_3' => '0','url' => 'sellerprovidertype/2'],

            ['menu_desc' => 'User Details', 'menu_level_1' => '2', 'menu_level_2' => '0','menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'Role Creation', 'menu_level_1' => '2','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'listroles'],
            ['menu_desc' => 'User Creation', 'menu_level_1' => '2','menu_level_2' => '2', 'menu_level_3' => '0','url' => 'newuser'],
            ['menu_desc' => 'User Menu Mapping', 'menu_level_1' => '2','menu_level_2' => '3', 'menu_level_3' => '0','url' => 'usermenu'],
            ['menu_desc' => 'Role User Mapping', 'menu_level_1' => '2','menu_level_2' => '4', 'menu_level_3' => '0','url' => 'userrole'],

            ['menu_desc' => 'Masters', 'menu_level_1' => '3', 'menu_level_2' => '0','menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'Business Type', 'menu_level_1' => '3','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'listbusinesstype'],
            ['menu_desc' => 'Business Category', 'menu_level_1' => '3','menu_level_2' => '2', 'menu_level_3' => '0','url' => 'listservicecategory'],
            ['menu_desc' => 'Seller/Service Provider Type', 'menu_level_1' => '3','menu_level_2' => '4', 'menu_level_3' => '0','url' => 'listservicetype'],
            ['menu_desc' => 'Country', 'menu_level_1' => '3','menu_level_2' => '4', 'menu_level_3' => '0','url' => 'listcountry'],
            ['menu_desc' => 'State', 'menu_level_1' => '3','menu_level_2' => '5', 'menu_level_3' => '0','url' => 'liststate'],
            ['menu_desc' => 'District', 'menu_level_1' => '3', 'menu_level_2' => '6','menu_level_3' => '0','url' => 'listdistrict'],
            ['menu_desc' => 'Category', 'menu_level_1' => '3','menu_level_2' => '7', 'menu_level_3' => '0','url' => 'addlistcategory'],

            ['menu_desc' => 'Seller Details', 'menu_level_1' => '4', 'menu_level_2' => '0','menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'View/Edit Sellers', 'menu_level_1' => '4','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'shopapprovalsadd/1'],
            ['menu_desc' => 'Add Seller Product', 'menu_level_1' => '4','menu_level_2' => '2', 'menu_level_3' => '0','url' => 'listshopproductadd'],
            ['menu_desc' => 'My Seller Products', 'menu_level_1' => '4','menu_level_2' => '3', 'menu_level_3' => '0','url' => 'parentcategorys'],

            ['menu_desc' => 'Services', 'menu_level_1' => '5', 'menu_level_2' => '0','menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'View/Edit Details', 'menu_level_1' => '5','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'shopapprovalsadd/2'],

            ['menu_desc' => 'Offers', 'menu_level_1' => '6','menu_level_2' => '0', 'menu_level_3' => '0','url' => '#'],
            ['menu_desc' => 'Seller Product Offers', 'menu_level_1' => '6','menu_level_2' => '1', 'menu_level_3' => '0','url' => 'listshopoffer'],
            ['menu_desc' => 'Service Product Offers', 'menu_level_1' => '6','menu_level_2' => '2', 'menu_level_3' => '0','url' => 'listserviceoffer'],

        ];
        foreach ($data as $item) {
            DB::table('menu_masters')->insert(['menu_desc' => $item['menu_desc'], 'menu_level_1' => $item['menu_level_1'], 'menu_level_2' => $item['menu_level_2'],'menu_level_3' => $item['menu_level_3'],'url' => $item['url']] ,$item);
        }
    }
}

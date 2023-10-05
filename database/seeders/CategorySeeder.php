<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('category_name' => 'Fashion', 'parent_id' => '0', 'category_level' => '0', 'category_type' => '1' , 'status' => 'Y', 'category_slug' => 'fashion-22', 'approval_status' => 'Y'),
            array('category_name' => 'Electronics', 'parent_id' => '0', 'category_level' => '0', 'category_type' => '1' , 'status' => 'Y', 'category_slug' => 'electronics-22', 'approval_status' => 'Y'),
            array('category_name' => 'Home Appliances', 'parent_id' => '0', 'category_level' => '0', 'category_type' => '1' , 'status' => 'Y', 'category_slug' => 'home-appliances-22', 'approval_status' => 'Y'),

        );
        foreach ($data as $item) {
            DB::table('categories')->insert([
                'category_name'     => $item['category_name'],
                'parent_id'         => $item['parent_id'],
                'category_level'    => $item['category_level'],
                'category_type'    => $item['category_type'],
                'status'            => $item['status'],
                'category_slug'     => $item['category_slug'],
                'approval_status'   => $item['approval_status'],
            ]);
        }
    }
}

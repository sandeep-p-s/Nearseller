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
            ['menu_id' => '1','user_id' => '2','user_role' => '2','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '3','user_id' => '2','user_role' => '2','privilage' => '','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '6','user_id' => '2','user_role' => '2','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '7','user_id' => '2','user_role' => '2','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '8','user_id' => '2','user_role' => '2','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '15','user_id' => '2','user_role' => '2','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '38','user_id' => '2','user_role' => '2','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '39','user_id' => '2','user_role' => '2','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],

            ['menu_id' => '1','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '2','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '3','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '4','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '5','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '6','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '7','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '8','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '9','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '10','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '11','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '12','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '13','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '14','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '15','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '16','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '17','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '18','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '19','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '20','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '21','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '22','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '23','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '24','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '25','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '26','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '27','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '28','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '29','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '30','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '31','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '32','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '33','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '34','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '35','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '36','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '37','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '38','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '39','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '40','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '41','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '42','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '43','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '44','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '45','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],
            ['menu_id' => '46','user_id' => '1','user_role' => '1','privilage' => 'A','updated_by' => '1','created_at' => $now, 'updated_at' => $now],

        ];
        foreach ($data as $item){
            DB::table('roles')->insert(['userpages' => $item['role_name'],'is_active' => $item['is_active']], $item);
        }
    }
}

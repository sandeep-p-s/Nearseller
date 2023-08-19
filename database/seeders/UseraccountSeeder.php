<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;

class UseraccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pass = Hash::make('123456@admin');
      for($j=1; $j <= 1; $j++)
      {
          $data = [];

          for($i=1; $i <= 100; $i++)
          {

            if($j==1 && $i ==1){
                $data[0] = [
                    'name' => 'admin',
                    'email' => 'hyzadmin@gmail.com',
                    'mobno' => '9656912880',
                    'password' => $pass ,
                    'user_status' => 'Y',
                    'forgot_pass' => $pass ,
                    'role_id' => 1,
                    'approved' => 'Y',
                    'email_verify' => 'Y',
                    'mobile_verify' => 'Y',
                    'active_date' => Carbon::now(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
          }
          DB::table('user_account')->insert($data);
        }
    }
}

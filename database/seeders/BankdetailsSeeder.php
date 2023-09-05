<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class BankdetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('country_code'=>'1','state_code' => '1','district_code' => '1', 'bank_code' => '1', 'branch_name' => 'PORT BLAIR', 'branch_address' => 'PORTBLAIR, ANDAMAN AND NICOBAR ISLANDS', 'ifsc_code' =>'SBIN0000156'),

          );
        foreach ($data as $item){
            DB::table('bank_details')->insert([
                'country_code' => $item['country_code'],
                'state_code' => $item['state_code'],
                'district_code' => $item['district_code'],
                'bank_code' => $item['bank_code'],
                'branch_name' => $item['branch_name'],
                'branch_address' => $item['branch_address'],
                'ifsc_code' => $item['ifsc_code'],
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = array(
            array('country_id'=>'1','state_id' => '1','state_title' => 'Andaman & Nicobar Islands'),
            array('country_id'=>'1','state_id' => '2','state_title' => 'Andhra Pradesh'),
            array('country_id'=>'1','state_id' => '3','state_title' => 'Arunachal Pradesh'),
            array('country_id'=>'1','state_id' => '4','state_title' => 'Assam'),
            array('country_id'=>'1','state_id' => '5','state_title' => 'Bihar'),
            array('country_id'=>'1','state_id' => '6','state_title' => 'Chandigarh'),
            array('country_id'=>'1','state_id' => '7','state_title' => 'Chhattisgarh'),
            array('country_id'=>'1','state_id' => '8','state_title' => 'Dadra & Nagar Haveli'),
            array('country_id'=>'1','state_id' => '9','state_title' => 'Daman & Diu'),
            array('country_id'=>'1','state_id' => '10','state_title' => 'Delhi'),
            array('country_id'=>'1','state_id' => '11','state_title' => 'Goa'),
            array('country_id'=>'1','state_id' => '12','state_title' => 'Gujarat'),
            array('country_id'=>'1','state_id' => '13','state_title' => 'Haryana'),
            array('country_id'=>'1','state_id' => '14','state_title' => 'Himachal Pradesh'),
            array('country_id'=>'1','state_id' => '15','state_title' => 'Jammu & Kashmir'),
            array('country_id'=>'1','state_id' => '16','state_title' => 'Jharkhand'),
            array('country_id'=>'1','state_id' => '17','state_title' => 'Karnataka'),
            array('country_id'=>'1','state_id' => '18','state_title' => 'Kerala'),
            array('country_id'=>'1','state_id' => '19','state_title' => 'Lakshadweep'),
            array('country_id'=>'1','state_id' => '20','state_title' => 'Madhya Pradesh'),
            array('country_id'=>'1','state_id' => '21','state_title' => 'Maharashtra'),
            array('country_id'=>'1','state_id' => '22','state_title' => 'Manipur'),
            array('country_id'=>'1','state_id' => '23','state_title' => 'Meghalaya'),
            array('country_id'=>'1','state_id' => '24','state_title' => 'Mizoram'),
            array('country_id'=>'1','state_id' => '25','state_title' => 'Nagaland'),
            array('country_id'=>'1','state_id' => '26','state_title' => 'Odisha'),
            array('country_id'=>'1','state_id' => '27','state_title' => 'Puducherry'),
            array('country_id'=>'1','state_id' => '28','state_title' => 'Punjab'),
            array('country_id'=>'1','state_id' => '29','state_title' => 'Rajasthan'),
            array('country_id'=>'1','state_id' => '30','state_title' => 'Sikkim'),
            array('country_id'=>'1','state_id' => '31','state_title' => 'Tamil Nadu'),
            array('country_id'=>'1','state_id' => '32','state_title' => 'Tripura'),
            array('country_id'=>'1','state_id' => '33','state_title' => 'Uttar Pradesh'),
            array('country_id'=>'1','state_id' => '34','state_title' => 'Uttarakhand'),
            array('country_id'=>'1','state_id' => '35','state_title' => 'West Bengal')
          );
                foreach ($state as $v) {
                    DB::table('state')->insert(['state_name' => $v['state_title'],'country_id'=>$v['country_id']]);
                    }
        //
    }
}

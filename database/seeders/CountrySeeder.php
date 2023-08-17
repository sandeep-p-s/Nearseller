<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $state = array(

            array('country_id' => '1','country_title' => 'India'),
            array('country_id' => '2','country_title' => 'United Arab Emirates'),
            array('country_id' => '3','country_title' => 'Afghanistan'),
            array('country_id' => '4','country_title' => 'Antigua and Barbuda'),
            array('country_id' => '5','country_title' => 'Anguilla'),
            array('country_id' => '6','country_title' => 'Albania'),
            array('country_id' => '7','country_title' => 'Armenia'),
            array('country_id' => '8','country_title' => 'Netherlands Antilles'),
            array('country_id' => '9','country_title' => 'Angola'),
            array('country_id' => '10','country_title' => 'Antarctica'),

            array('country_id' => '11','country_title' => 'Argentina'),
            array('country_id' => '12','country_title' => 'Austria'),
            array('country_id' => '13','country_title' => 'Australia'),
            array('country_id' => '14','country_title' => 'Azerbaijan'),
            array('country_id' => '15','country_title' => 'Bosnia and Herzegovina'),
            array('country_id' => '16','country_title' => 'Barbados'),
            array('country_id' => '17','country_title' => 'Bangladesh'),
            array('country_id' => '18','country_title' => 'Belgium'),
            array('country_id' => '19','country_title' => 'Bulgaria'),
            array('country_id' => '20','country_title' => 'Bahrain'),

            array('country_id' => '21','country_title' => 'Bermuda'),
            array('country_id' => '22','country_title' => 'Burundi'),
            array('country_id' => '23','country_title' => 'Brunei'),
            array('country_id' => '24','country_title' => 'Bolivia'),
            array('country_id' => '25','country_title' => 'Brazil'),
            array('country_id' => '26','country_title' => 'Bahamas'),
            array('country_id' => '27','country_title' => 'Bhutan'),
            array('country_id' => '28','country_title' => 'Canada'),
            array('country_id' => '29','country_title' => 'Congo [DRC]'),
            array('country_id' => '30','country_title' => 'Switzerland'),

            array('country_id' => '31','country_title' => 'Chile'),
            array('country_id' => '32','country_title' => 'Bhutan'),
            array('country_id' => '33','country_title' => 'China'),
            array('country_id' => '34','country_title' => 'Colombia'),
            array('country_id' => '35','country_title' => 'Cuba'),
            array('country_id' => '36','country_title' => 'Cyprus'),
            array('country_id' => '37','country_title' => 'Czech Republic'),
            array('country_id' => '38','country_title' => 'Germany'),
            array('country_id' => '39','country_title' => 'Denmark'),
            array('country_id' => '40','country_title' => 'Ecuador'),

            array('country_id' => '41','country_title' => 'Egypt'),
            array('country_id' => '42','country_title' => 'Spain'),
            array('country_id' => '43','country_title' => 'Ethiopia'),
            array('country_id' => '44','country_title' => 'Finland'),
            array('country_id' => '45','country_title' => 'Fiji'),
            array('country_id' => '46','country_title' => 'France'),
            array('country_id' => '47','country_title' => 'United Kingdom'),
            array('country_id' => '48','country_title' => 'Georgia'),
            array('country_id' => '49','country_title' => 'French Guiana'),
            array('country_id' => '50','country_title' => 'Ghana'),

            array('country_id' => '51','country_title' => 'Greenland'),
            array('country_id' => '52','country_title' => 'Gambia'),
            array('country_id' => '53','country_title' => 'Greece'),
            array('country_id' => '54','country_title' => 'Hong Kong'),
            array('country_id' => '55','country_title' => 'Croatia'),
            array('country_id' => '56','country_title' => 'Haiti'),
            array('country_id' => '57','country_title' => 'Hungary'),
            array('country_id' => '58','country_title' => 'Indonesia'),
            array('country_id' => '59','country_title' => 'Ireland'),
            array('country_id' => '60','country_title' => 'Israel'),
            array('country_id' => '61','country_title' => 'Andorra'),

            array('country_id' => '62','country_title' => 'Iraq'),
            array('country_id' => '63','country_title' => 'Iran'),
            array('country_id' => '64','country_title' => 'Iceland'),
            array('country_id' => '65','country_title' => 'Italy'),
            array('country_id' => '66','country_title' => 'Jamaica'),
            array('country_id' => '67','country_title' => 'Jordan'),
            array('country_id' => '68','country_title' => 'Japan'),
            array('country_id' => '69','country_title' => 'Kenya'),
            array('country_id' => '70','country_title' => 'Kyrgyzstan'),

            array('country_id' => '71','country_title' => 'Cambodia'),
            array('country_id' => '72','country_title' => 'North Korea'),
            array('country_id' => '73','country_title' => 'South Korea'),
            array('country_id' => '74','country_title' => 'Kuwait'),
            array('country_id' => '75','country_title' => 'Kazakhstan'),
            array('country_id' => '76','country_title' => 'Laos'),
            array('country_id' => '77','country_title' => 'Lebanon'),
            array('country_id' => '78','country_title' => 'Sri Lanka'),
            array('country_id' => '79','country_title' => 'Liberia'),
            array('country_id' => '80','country_title' => 'Lithuania'),

            array('country_id' => '81','country_title' => 'Luxembourg'),
            array('country_id' => '82','country_title' => 'Latvia'),
            array('country_id' => '83','country_title' => 'Libya'),
            array('country_id' => '84','country_title' => 'Morocco'),
            array('country_id' => '85','country_title' => 'Monaco'),
            array('country_id' => '86','country_title' => 'Montenegro'),
            array('country_id' => '87','country_title' => 'Madagascar'),
            array('country_id' => '88','country_title' => 'Macedonia [FYROM]'),
            array('country_id' => '89','country_title' => 'Mali'),
            array('country_id' => '90','country_title' => 'Myanmar [Burma]'),

            array('country_id' => '91','country_title' => 'Mongolia'),
            array('country_id' => '92','country_title' => 'Malta'),
            array('country_id' => '93','country_title' => 'Mauritius'),
            array('country_id' => '94','country_title' => 'Maldives'),
            array('country_id' => '95','country_title' => 'Mexico'),
            array('country_id' => '96','country_title' => 'Malaysia'),
            array('country_id' => '97','country_title' => 'Mozambique'),
            array('country_id' => '98','country_title' => 'Namibia'),
            array('country_id' => '99','country_title' => 'Niger'),
            array('country_id' => '100','country_title' => 'Nigeria'),

            array('country_id' => '101','country_title' => 'Netherlands'),
            array('country_id' => '102','country_title' => 'Norway'),
            array('country_id' => '103','country_title' => 'Nepal'),
            array('country_id' => '104','country_title' => 'Nauru'),
            array('country_id' => '105','country_title' => 'New Zealand'),
            array('country_id' => '106','country_title' => 'Oman'),
            array('country_id' => '107','country_title' => 'Panama'),
            array('country_id' => '108','country_title' => 'Peru'),
            array('country_id' => '109','country_title' => 'Papua New Guinea'),
            array('country_id' => '110','country_title' => 'Philippines'),

            array('country_id' => '111','country_title' => 'Pakistan'),
            array('country_id' => '112','country_title' => 'Poland'),
            array('country_id' => '113','country_title' => 'Puerto Rico'),
            array('country_id' => '114','country_title' => 'Palestinian Territories'),
            array('country_id' => '115','country_title' => 'Portugal'),
            array('country_id' => '116','country_title' => 'Palau'),
            array('country_id' => '117','country_title' => 'Paraguay'),
            array('country_id' => '118','country_title' => 'Qatar'),
            array('country_id' => '119','country_title' => 'Romania'),
            array('country_id' => '120','country_title' => 'Serbia'),

            array('country_id' => '121','country_title' => 'Russia'),
            array('country_id' => '122','country_title' => 'Rwanda'),
            array('country_id' => '123','country_title' => 'Saudi Arabia'),
            array('country_id' => '124','country_title' => 'Seychelles'),
            array('country_id' => '125','country_title' => 'Sudan'),
            array('country_id' => '126','country_title' => 'Sweden'),
            array('country_id' => '127','country_title' => 'Singapore'),
            array('country_id' => '128','country_title' => 'Saint Helena'),
            array('country_id' => '129','country_title' => 'Slovenia'),
            array('country_id' => '130','country_title' => 'Svalbard and Jan Mayen'),

            array('country_id' => '131','country_title' => 'Slovakia'),
            array('country_id' => '132','country_title' => 'San Marino'),
            array('country_id' => '133','country_title' => 'Senegal'),
            array('country_id' => '134','country_title' => 'Somalia'),
            array('country_id' => '135','country_title' => 'Suriname'),
            array('country_id' => '136','country_title' => 'El Salvador'),
            array('country_id' => '137','country_title' => 'Syria'),
            array('country_id' => '138','country_title' => 'Swaziland'),
            array('country_id' => '139','country_title' => 'Chad'),
            array('country_id' => '140','country_title' => 'Turkmenistan'),

            array('country_id' => '141','country_title' => 'French Southern Territories'),
            array('country_id' => '142','country_title' => 'Thailand'),
            array('country_id' => '143','country_title' => 'Tajikistan'),
            array('country_id' => '144','country_title' => 'Tunisia'),
            array('country_id' => '145','country_title' => 'Turkey'),
            array('country_id' => '146','country_title' => 'Taiwan'),
            array('country_id' => '147','country_title' => 'Tanzania'),
            array('country_id' => '148','country_title' => 'Ukraine'),
            array('country_id' => '149','country_title' => 'Uganda'),
            array('country_id' => '150','country_title' => 'United States'),

            array('country_id' => '151','country_title' => 'Uruguay'),
            array('country_id' => '152','country_title' => 'Uzbekistan'),
            array('country_id' => '153','country_title' => 'Vatican City'),
            array('country_id' => '154','country_title' => 'Venezuela'),
            array('country_id' => '155','country_title' => 'Vietnam'),
            array('country_id' => '156','country_title' => 'Samoa'),
            array('country_id' => '157','country_title' => 'Kosovo'),
            array('country_id' => '158','country_title' => 'Yemen'),
            array('country_id' => '159','country_title' => 'South Africa'),
            array('country_id' => '160','country_title' => 'Zambia'),

            array('country_id' => '161','country_title' => 'Zimbabwe'),

          );
                foreach ($state as $v) {
                    DB::table('country')->insert(['country_name' => $v['country_title']]);
                    }
    }

}

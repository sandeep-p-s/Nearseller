<?php

namespace App\Models\masters;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country';

    public static function allCountries()
    {
        $countries = DB::table('country')->get();

        return $countries;
    }

    public static function countriesCount()
    {
        $total_countries = DB::table('country')->count();

        return $total_countries;
    }

    public static function inactiveCountries()
    {
        $inactive_countries = DB::table('country as c')->where('c.status','N')->count();

        return $inactive_countries;
    }

}

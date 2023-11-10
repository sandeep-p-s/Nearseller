<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\MenuMaster;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use App\Models\masters\Country;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCountryRequest;

class CountryController extends Controller
{
    public function list_country()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $total_countries = Country::countriesCount();
        $inactive_countries = Country::inactiveCountries();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $countries = DB::table('country as ct')
            ->orderByRaw('ct.id = ? desc', [1])
            ->orderBy('ct.country_name', 'asc')
            ->get();
        // $countries = DB::table('country')->get();
        // $total_countries = DB::table('country')->count();
        // $inactive_countries = DB::table('country as c')->where('c.status','N')->count();
        return view('admin.masters.country.listCountry', compact('loggeduser', 'userdetails', 'countries', 'total_countries', 'inactive_countries', 'structuredMenu'));
    }
    public function add_country()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.country.addCountry', compact('loggeduser', 'userdetails', 'structuredMenu'));
    }
    public function store_country(Request $request)
    {
        $request->validate(
            [
                'country_name' => 'required|unique:country,country_name|regex:/^[a-zA-Z &]+$/|max:59|min:4',
            ],
            [
                'country_name.required' => 'The country name field is missing.',
                'country_name.regex' => 'Invalid format for the country name.',
                'country_name.unique' => 'The country name must be unique.',
                'country_name.min' => 'The country name must be at least 4 characters.',
                'country_name.max' => 'The country name cannot exceed 59 characters.',
            ]
        );

        $newcountry = new Country;

        // Explode the string into an array of words
        $words = explode(" ", $request->country_name);

        // Capitalize the first letter of each word
        $capitalizedWords = array_map('ucfirst', $words);

        // Implode the array back into a string
        $capitalizedName = implode(" ", $capitalizedWords);

        $newcountry->country_name = $capitalizedName;
        $newcountry->save();

        return redirect()->route('list.country')->with('success', 'Country added successfully.');
    }


    public function edit_country($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $country = Country::find($id);

        if (!$country) {
            return redirect()->route('list.shoptype')->with('error', 'Country not found.');
        }

        return view('admin.masters.country.editCountry', compact('country', 'userdetails', 'loggeduser', 'structuredMenu'));
    }
    public function update_country(Request $request, $id)
    {
        $country = Country::find($id);
        if (!$country) {
            return redirect()->route('list.country')->with('error', 'Country not found.');
        }

        $request->validate(
            [
                'country_name' => ['required', Rule::unique('country')->ignore($id), 'regex:/^[a-zA-Z &]+$/', 'max:255', 'min:4'],
                'status' => 'in:Y,N',
            ],
            [
                'country_name.required' => 'The country name field is missing.',
                'country_name.alpha' => 'The country name must be a alphabets.',
                'country_name.unique' => 'The country name must be unique.',
                'country_name.min' => 'The country name must be at least 4 characters.',
                'country_name.max' => 'The country name cannot exceed 255 characters.',
                'status.in' => 'Invalid status value.',
            ]
        );
        $country->country_name = ucfirst(strtolower($request->country_name));
        $country->status = $request->status;
        $country->save();

        return redirect()->route('list.country')->with('success', 'Country updated successfully.');
    }
    public function delete_country($id)
    {
        $country = Country::find($id);

        if (!$country) {
            return redirect()->route('list.country')->with('error', 'Country not found.');
        }

        $country->delete();

        return redirect()->route('list.country')->with('success', 'Country deleted successfully.');
    }
}

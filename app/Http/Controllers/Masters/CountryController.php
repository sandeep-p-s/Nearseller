<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\masters\Country;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function list_country()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countries = DB::table('country')->get();
        return view('admin.masters.country.listCountry',compact('loggeduser','userdetails','countries'));

    }
    public function add_country()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.masters.country.addCountry',compact('loggeduser','userdetails'));
    }
    public function store_country(Request $request)
    {
        $request->validate([
            'country_name' => 'required|unique:country,country_name|string|max:255|min:4',
        ],
        [
            'country_name.required' => 'The country name field is missing.',
            'country_name.string' => 'The country name must be a string.',
            'country_name.unique' => 'The country name must be unique.',
            'country_name.min' => 'The country name must be at least 4 characters.',
            'country_name.max' => 'The country name cannot exceed 255 characters.',
        ]);

        $newcountry = new Country;
        $newcountry->country_name = ucfirst(strtolower($request->country_name));
        $newcountry->save();

        return redirect()->route('list.country')->with('success', 'Profession added successfully.');
    }
     public function edit_country($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $country = Country::find($id);

        if (!$country) {
            return redirect()->route('list.shoptype')->with('error', 'Shop Type not found.');
        }

        return view('admin.masters.country.editCountry', compact('country','userdetails','loggeduser'));
    }
    public function update_country(Request $request,$id)
    {
        $country = Country::find($id);
        if (!$country) {
            return redirect()->route('list.country')->with('error', 'Shop Type not found.');
        }

        $request->validate([
            'country_name' => 'required|unique:country,country_name|string|max:255|min:4',
            'status' => 'in:Y,N',
        ],
        [
            'country_name.required' => 'The country name field is missing.',
            'country_name.string' => 'The country name must be a string.',
            'country_name.unique' => 'The country name must be unique.',
            'country_name.min' => 'The country name must be at least 4 characters.',
            'country_name.max' => 'The country name cannot exceed 255 characters.',
            'status.in' => 'Invalid status value.',
        ]);
        $country->country_name = ucfirst(strtolower($request->country_name));
        $country->status = $request->status;
        $country->save();

        return redirect()->route('list.country')->with('success', 'Country updated successfully.');
    }
    public function delete_country($id)
    {
        $country = Country::find($id);

        if (!$country) {
            return redirect()->route('list.country')->with('error', 'Shop Type not found.');
        }

        $country->delete();

        return redirect()->route('list.country')->with('success', 'Country deleted successfully.');
    }
}

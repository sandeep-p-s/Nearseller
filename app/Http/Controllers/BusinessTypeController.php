<?php

namespace App\Http\Controllers;

use App\Models\BusinessType;
use Illuminate\Http\Request;
use DB;

class BusinessTypeController extends Controller
{
    public function list_business_type()
    {
        $businesstype = DB::table('business_type')->get();
        return view('admin.business_type.list', compact('businesstype'));
    }

    public function add_business_type()
    {
        return view('admin.business_type.add');
    }

    public function store_business_type(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
        ]);

        $businesstype = new BusinessType;
        $businesstype->business_name = $request->business_name;
        $businesstype->save();

        return response()->json(['success' => true, 'message' => 'Business Type added successfully.']);
        //return redirect()->route('list.businesstype')->with('success', 'Business Type added successfully.');
    }

    public function edit_business_type($id)
    {
        $businesstype = BusinessType::find($id);

        if (!$businesstype) {
            return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
        }

        return view('admin.business_type.edit', compact('businesstype'));
    }

    public function update_business_type(Request $request, $id)
    {
        $businesstype = BusinessType::find($id);
        if (!$businesstype) {
            return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
        }

        $request->validate([
            'business_name' => 'required|string|max:255',
        ]);

        $businesstype->business_name = $request->business_name;
        $businesstype->save();

        return redirect()->route('list.businesstype')->with('success', 'Business Type updated successfully.');
    }

    public function delete_business_type($id)
    {
        $businesstype = BusinessType::find($id);

        if (!$businesstype) {
            return redirect()->route('list.businesstype')->with('error', 'Business Type not found.');
        }

        $businesstype->delete();

        return redirect()->route('list.businesstype')->with('success', 'Business Type deleted successfully.');
    }
}

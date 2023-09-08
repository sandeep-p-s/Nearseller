<?php

namespace App\Http\Controllers;

use DB;
use App\Models\ServiceType;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function list_service_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $servicetype = DB::table('service_types')->get();
        return view('admin.service_type.list', compact('servicetype','userdetails','loggeduser'));
    }

    public function add_service_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.service_type.add',compact('loggeduser','userdetails'));
    }

    public function store_service_type(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
        ]);

        $servicetype = new ServiceType;
        $servicetype->service_name = $request->service_name;
        $servicetype->save();

        return redirect()->route('list.servicetype')->with('success', 'Service Type added successfully.');
    }

    public function edit_service_type($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $servicetype = ServiceType::find($id);

        if (!$servicetype) {
            return redirect()->route('list.servicetype')->with('error', 'Service Type not found.');
        }

        return view('admin.service_type.edit', compact('servicetype','loggeduser','userdetails'));
    }

    public function update_service_type(Request $request, $id)
    {
        $servicetype = ServiceType::find($id);
        if (!$servicetype) {
            return redirect()->route('list.servicetype')->with('error', 'Service Type not found.');
        }

        $request->validate([
            'service_name' => 'required|string|max:255',
        ]);

        $servicetype->service_name = $request->service_name;
        if ($request->status === 'Active')
        {
            $servicetype->status = 'Y';
        } else {
            $servicetype->status = 'N';
        }
        $servicetype->save();

        return redirect()->route('list.servicetype')->with('success', 'Service Type added successfully.');
    }

    public function delete_service_type($id)
    {
        $servicetype = ServiceType::find($id);

        if (!$servicetype) {
            return redirect()->route('list.servicetype')->with('error', 'Service Type not found.');
        }

        $servicetype->delete();

        return redirect()->route('list.servicetype')->with('success', 'Service Type deleted successfully.');
    }
}

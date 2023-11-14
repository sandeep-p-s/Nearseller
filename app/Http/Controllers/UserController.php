<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\SellerDetails;
use Exception;
use DB;

class UserController extends Controller
{
    public function productPage()
    {
        $userId = session('user_id');
        if($userId=='')
        {
            $userdetails = '';
            $category = DB::table('categories')->select('category_name')->get();
            $districts = DB::table('district')->select('id','district_name','state_id')->where('state_id','18')->get();
        }
        else{
            $roleid = session('roleid');
            $roleIdsArray = explode(',', $roleid);
            if ($userId == '') {
                return redirect()->route('logout');
            }
            $loggeduser = UserAccount::sessionValuereturn_s($roleid);
            $userdetails = DB::table('user_account')
                ->where('id', $userId)
                ->get();
            $category = DB::table('categories')->select('category_name')->get();
            $districts = DB::table('district')->select('id','district_name','state_id')->where('state_id','18')->get();
        }
        return view('user.products', compact('category','districts','userdetails'));
    }

    public function servicePage()
    {
        $userId = session('user_id');
        if($userId=='')
        {
            $userdetails = '';
            $services = DB::table('service_details')->where('is_approved', 'Y')->get();
            $districts = DB::table('district')->select('id','district_name','state_id')->where('state_id','18')->get();

        }
        else{
            $roleid = session('roleid');
            $roleIdsArray = explode(',', $roleid);
            if ($userId == '') {
                return redirect()->route('logout');
            }
            $loggeduser = UserAccount::sessionValuereturn_s($roleid);
            $userdetails = DB::table('user_account')
                ->where('id', $userId)
                ->get();

            $services = DB::table('service_details')->where('is_approved', 'Y')->get();
            $districts = DB::table('district')->select('id','district_name','state_id')->where('state_id','18')->get();
        }
        return view('user.services', compact('services','districts','userdetails'));
    }
    // public function serviceMenus($id)
    // {
    //     $service = DB::table('service_details')->where('id', $id)->first();
    //     return view('services.show', compact('service'));
    // }
}

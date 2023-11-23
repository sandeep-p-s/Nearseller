<?php

namespace App\Http\Controllers;

use DB;
use App\Models\ShopType;
use App\Models\MenuMaster;
use App\Models\User;
use Illuminate\Http\Request;
class ShopTypeController extends Controller
{
    public function list_shop_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $shoptype = DB::table('shop_type')->get();
        $total_shoptypes = DB::table('shop_type')->count();
        $inactive_shoptypes = DB::table('shop_type as st')->where('st.status','N')->count();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray)))
        {
            $selrdetails = DB::table('seller_details')->select('busnes_type','term_condition')
            ->where('user_id', $userId)
            ->first();
        }
        else{
            $selrdetails='';
        }
        return view('admin.shop_type.list', compact('shoptype','loggeduser','userdetails','total_shoptypes','inactive_shoptypes','structuredMenu','selrdetails'));
    }

    public function add_shop_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray)))
        {
            $selrdetails = DB::table('seller_details')->select('busnes_type','term_condition')
            ->where('user_id', $userId)
            ->first();
        }
        else{
            $selrdetails='';
        }
        return view('admin.shop_type.add',compact('loggeduser','userdetails','structuredMenu','selrdetails'));
    }

    public function store_shop_type(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
        ]);

        $shopstype = new ShopType;
        $shopstype->shop_name = $request->shop_name;
        $shopstype->save();

        return redirect()->route('list.shoptype')->with('success', 'Shop Type added successfully.');
    }

    public function edit_shop_type($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $shoptype = ShopType::find($id);

        if (!$shoptype) {
            return redirect()->route('list.shoptype')->with('error', 'Shop Type not found.');
        }
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray)))
        {
            $selrdetails = DB::table('seller_details')->select('busnes_type','term_condition')
            ->where('user_id', $userId)
            ->first();
        }
        else{
            $selrdetails='';
        }

        return view('admin.shop_type.edit', compact('shoptype','loggeduser','userdetails','structuredMenu','selrdetails'));
    }

    public function update_shop_type(Request $request, $id)
    {
        $shoptype = ShopType::find($id);
        if (!$shoptype) {
            return redirect()->route('list.shoptype')->with('error', 'Shop Type not found.');
        }

        $request->validate([
            'shop_name' => 'required|string|min:5|max:255',
        ]);

        $shoptype->shop_name = $request->shop_name;
        if ($request->status === 'Active')
        {
            $shoptype->status = 'Y';
        } else {
            $shoptype->status = 'N';
        }
        $shoptype->save();

        return redirect()->route('list.shoptype')->with('success', 'Shop Type updated successfully.');
    }

    public function delete_shop_type($id)
    {
        $shoptype = ShopType::find($id);

        if (!$shoptype) {
            return redirect()->route('list.shoptype')->with('error', 'Shop Type not found.');
        }

        $shoptype->delete();

        return redirect()->route('list.shoptype')->with('success', 'Shop Type deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use DB;
use App\Models\ShopType;
use App\Models\UserAccount;
use Illuminate\Http\Request;
class ShopTypeController extends Controller
{
    public function list_shop_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $shoptype = DB::table('shop_type')->get();
        return view('admin.shop_type.list', compact('shoptype','loggeduser','userdetails'));
    }

    public function add_shop_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.shop_type.add',compact('loggeduser','userdetails'));
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
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $shoptype = ShopType::find($id);

        if (!$shoptype) {
            return redirect()->route('list.shoptype')->with('error', 'Shop Type not found.');
        }

        return view('admin.shop_type.edit', compact('shoptype','loggeduser','userdetails'));
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
        $shoptype->save();

        return redirect()->route('list.shoptype')->with('success', 'Shop Type added successfully.');
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

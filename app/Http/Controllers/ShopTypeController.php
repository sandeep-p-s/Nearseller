<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\ShopType;
class ShopTypeController extends Controller
{
    public function list_shop_type()
    {
        $shoptype = DB::table('shop_type')->get();
        return view('admin.shop_type.list', compact('shoptype'));
    }

    public function add_shop_type()
    {
        return view('admin.shop_type.add');
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
        $shoptype = ShopType::find($id);

        if (!$shoptype) {
            return redirect()->route('list.shoptype')->with('error', 'Shop Type not found.');
        }

        return view('admin.shop_type.edit', compact('shoptype'));
    }

    public function update_shop_type(Request $request, $id)
    {
        $shoptype = ShopType::find($id);
        if (!$shoptype) {
            return redirect()->route('list.shoptype')->with('error', 'Shop Type not found.');
        }

        $request->validate([
            'shop_name' => 'required|string|max:255',
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class RoleController extends Controller
{
    function get_roles()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userRole === 'Super_admin') {
            $loggeduser='Super Admin';
        } elseif ($userRole === 'Seller') {
            $loggeduser='Seller';
        } elseif ($userRole === 'Affiliate') {
            $loggeduser='Affiliate';
        } elseif ($userRole === 'Customer') {
            $loggeduser='Customer';
        } elseif ($userRole === 'Affiliate_coordinator') {
            $loggeduser='Affiliate Co-ordinator';
        } elseif ($userRole === 'Product_adding_executive') {
            $loggeduser='Product Adding Executive';
        } elseif ($userRole === 'HR') {
            $loggeduser='HR';
        } elseif ($userRole === 'Shop_coordinator') {
            $loggeduser='Shop Co-ordinator';
        }
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.role.add',compact('userdetails'));
    }
    function add_roles()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userRole === 'Super_admin') {
            $loggeduser='Super Admin';
        } elseif ($userRole === 'Seller') {
            $loggeduser='Seller';
        } elseif ($userRole === 'Affiliate') {
            $loggeduser='Affiliate';
        } elseif ($userRole === 'Customer') {
            $loggeduser='Customer';
        } elseif ($userRole === 'Affiliate_coordinator') {
            $loggeduser='Affiliate Co-ordinator';
        } elseif ($userRole === 'Product_adding_executive') {
            $loggeduser='Product Adding Executive';
        } elseif ($userRole === 'HR') {
            $loggeduser='HR';
        } elseif ($userRole === 'Shop_coordinator') {
            $loggeduser='Shop Co-ordinator';
        }
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $site_module = DB::table('site_modules')->select('*')->orderby('module_order','asc')->get();
        $sm = [];
        foreach ($site_module as $mv) {

            $mv->sub = DB::table('permissions')->select('id', 'description', 'is_disabled')->orderby('id', 'asc')->where('module_id', $mv->id)->get();
        }

        return view('admin.role.add',compact('userdetails','loggeduser','site_module'));
    }
    function store_role()
    {

    }
}

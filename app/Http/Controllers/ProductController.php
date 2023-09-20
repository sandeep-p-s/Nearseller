<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\SellerDetails;
use App\Models\Affiliate;
use App\Models\ServiceType;
use App\Models\MenuMaster;
use App\Models\ProductDetails;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;

class ProductController extends Controller
{
    function ProductListView()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if($userId==''){return redirect()->route('logout');}
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('product.productlist',compact('userdetails','userRole','loggeduser','structuredMenu'));
    }
    function AllProductList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if($userId==''){
            return redirect()->route('logout');
        }
        $prodname   = $request->input('prodname');

        $query = ProductDetails::select('product_details.*');

        if ($afflitename) {
            $query->where('product_details.name', 'LIKE', '%' . $prodname . '%');
        }
        if($roleid==1)
        {

        }
        else{
            $query->where('product_details.created_by', $userId);
        }

        $ProductDetails = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $ProductCount    = $ProductDetails->count();
        //$professions    = DB::table('category')->where('status','Y')->get();
        return view('admin.product_dets', compact('ProductDetails', 'ProductCount'));
    }
}

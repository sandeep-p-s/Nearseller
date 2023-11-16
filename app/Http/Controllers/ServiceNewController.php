<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\SellerDetails;
use App\Models\Affiliate;
use App\Models\ServiceType;
use App\Models\MenuMaster;
use App\Models\ServiceDetails;
use App\Models\AddServiceAttribute;
use App\Models\admin\Category;
use Image;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;

class ServiceNewController extends Controller
{
    function ServiceProductListView()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails = DB::table('user_account')
            ->where('id', $userId)
            ->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $usershopdets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 2)
            ->get();
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
        return view('serviceproduct.productlist', compact('userdetails', 'userRole', 'loggeduser', 'structuredMenu','selrdetails'));
    }

    function AdmShopNameSearch(Request $request)
    {
        $shopname = $request->input('shopname');
        // $UserAccount = ProductDetails::select('user_account.id', 'user_account.name as shopname')
        //     ->leftJoin('user_account', 'user_account.id', 'product_details.shop_id')
        //     ->where('user_account.name', 'LIKE', $shopname . '%')->distinct()
        //     ->get();
        $UserAccount = UserAccount::select('id', 'name as shopname')
            ->where('name', 'LIKE', $shopname . '%')
            ->distinct()
            ->get();
        //echo $lastRegId = $UserAccount->toSql();exit;
        header('Content-Type: application/json');
        echo json_encode($UserAccount);
    }


    function ExistproductviewPage(Request $request)
    {
        $existprodid = $request->input('existprodid');
        $ProductDetails = ProductDetails::find($existprodid);
        //echo $lastRegId = $UserAccount->toSql();exit;
        return response()->json(['result' => 3, 'mesge' => 'Total stock and attribute stock must be equal.']);
    }

    // function AllServiceProductList(Request $request)
    // {
    //     $userRole = session('user_role');
    //     $roleid = session('roleid');
    //     $userId = session('user_id');
    //     if ($userId == '') {
    //         return redirect()->route('logout');
    //     }
    //     $query = ServiceDetails::select('service_details.*', 'seller_details.shop_name as shopname', 'seller_details.owner_name', 'service_categories.service_category_name')
    //     ->leftJoin('seller_details', 'seller_details.user_id', 'service_details.service_id')
    //     ->leftJoin('service_categories', 'service_categories.id', 'seller_details.shop_service_type');

    //     if ($roleid == 1  || $roleid == 11) {
    //     } else {
    //         $query->where('seller_details.user_id', $userId);
    //     }
    //     $query->orderBy('service_details.service_name');
    //     $ServiceDetails = $query->get();
    //     //echo $lastRegId = $query->toSql();exit;
    //     $ProductCount = $ServiceDetails->count();
    //     $userservicedets = DB::select("SELECT id,name FROM user_account WHERE FIND_IN_SET('9', role_id)");
    //     // $userservicedets = DB::table('user_account')
    //     //     ->select('id', 'name')
    //     //     ->whereIn('role_id', ['9']);
    //         //echo $lastRegId = $userservicedets->toSql();exit;
    //         //->get();

    //     $queryapprovedcounts = ServiceDetails::select([

    //         DB::raw('SUM(CASE WHEN service_status = "Y" THEN 1 ELSE 0 END) AS prod_status_y_count'),
    //         DB::raw('SUM(CASE WHEN service_status != "Y" THEN 1 ELSE 0 END) AS prod_status_not_y_count'),
    //         DB::raw('SUM(CASE WHEN is_approved = "Y" THEN 1 ELSE 0 END) AS approved_y_count'),
    //         DB::raw('SUM(CASE WHEN is_approved = "N" THEN 1 ELSE 0 END) AS approved_not_y_count'),
    //         DB::raw('SUM(CASE WHEN is_approved = "R" THEN 1 ELSE 0 END) AS approved_reject_y_count'),
    //     ]);

    //     if ($roleid != 1 && $roleid != 11) {
    //         $queryapprovedcounts->where('shop_id', $userId);
    //     }
    //     $approvedproductcounts = $queryapprovedcounts->first();
    //     return view('serviceproduct.product_dets', compact('ServiceDetails', 'ProductCount', 'userservicedets','approvedproductcounts'));
    // }



    function AllServiceProductList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $query = ServiceDetails::select('service_details.*', 'user_account.name as shopname')
        ->leftJoin('user_account', 'user_account.id', 'service_details.service_id');

        if ($roleid == 1  || $roleid == 11) {
        } else {
            $query->where('user_account.id', $userId);
        }
        $query->orderBy('service_details.service_name');
        $ServiceDetails = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $ProductCount = $ServiceDetails->count();
        $userservicedets = DB::select("SELECT id,name FROM user_account WHERE FIND_IN_SET('9', role_id)");
        // $userservicedets = DB::table('user_account')
        //     ->select('id', 'name')
        //     ->whereIn('role_id', ['9']);
            //echo $lastRegId = $userservicedets->toSql();exit;
            //->get();

        $queryapprovedcounts = ServiceDetails::select([

            DB::raw('SUM(CASE WHEN service_status = "Y" THEN 1 ELSE 0 END) AS prod_status_y_count'),
            DB::raw('SUM(CASE WHEN service_status != "Y" THEN 1 ELSE 0 END) AS prod_status_not_y_count'),
            DB::raw('SUM(CASE WHEN is_approved = "Y" THEN 1 ELSE 0 END) AS approved_y_count'),
            DB::raw('SUM(CASE WHEN is_approved = "N" THEN 1 ELSE 0 END) AS approved_not_y_count'),
            DB::raw('SUM(CASE WHEN is_approved = "R" THEN 1 ELSE 0 END) AS approved_reject_y_count'),
        ]);

        if ($roleid != 1 && $roleid != 11) {
            $queryapprovedcounts->where('service_id', $userId);
        }
        $approvedproductcounts = $queryapprovedcounts->first();
        return view('serviceproduct.product_dets', compact('ServiceDetails', 'ProductCount', 'userservicedets','approvedproductcounts'));
    }




    function AdmNewServiceAdd(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');

        $validatedData = $request->validate([
            'shop_name' => 'required',
            'prod_name' => 'required',
            'prod_description' => 'required',
            'customRadio' => 'required|in:Y,N',
        ]);


        $ServiceDetails = new ServiceDetails();
        $ServiceDetails->fill($validatedData);
        $ServiceDetails->service_id = $request->input('shop_name');
        $ServiceDetails->service_name = $request->input('prod_name');
        $ServiceDetails->service_description = $request->input('prod_description');
        $ServiceDetails->created_by = $userId;
        $ServiceDetails->created_time = $time;
        $ServiceDetails->service_status = 'Y';
        if ($roleid == 1  || $roleid == 11) {
            $ServiceDetails->is_approved = 'Y';
            $ServiceDetails->approved_by = $userId;
            $ServiceDetails->approved_time = $time;
        }

        if ($request->hasFile('s_photo')) {
            $upload_imgpath = 'uploads/ser_provdr_images/';
            if (!is_dir($upload_imgpath)) {
                mkdir($upload_imgpath, 0777, true);
            }
            foreach ($request->file('s_photo') as $fimg) {
                if ($fimg->isValid()) {
                    $imgfile_name = time() . '_' . $fimg->getClientOriginalName();
                    $fimg->move($upload_imgpath, $imgfile_name);
                    $imgfilename = $upload_imgpath . $imgfile_name;
                    $ServiceDetails->service_images = $imgfilename;
                }
            }
        }


        $ServiceDetails->is_attribute = $request->input('customRadio');
        $newproductreg = $ServiceDetails->save();
        $service_id = $ServiceDetails->id;
        if ($request->input('customRadio') === 'Y') {
            $attributes = $request->input('attributedata');
            //echo "<pre>";print_r($attributes);exit;
            try {
                foreach ($attributes as $attribute) {
                    if ($attribute['attatibute1'] == '' && $attribute['attatibute2'] == '' && $attribute['attatibute3'] == '' && $attribute['attatibute4'] == '' && $attribute['offerprice1'] == '' && $attribute['mrprice1'] == '' && $attribute['attr_calshop1'] == '') {
                    } else {
                        $productAttribute = new AddServiceAttribute();
                        $productAttribute->service_id = $service_id;
                        $productAttribute->attribute_1 = $attribute['attatibute1'];
                        $productAttribute->attribute_2 = $attribute['attatibute2'];
                        $productAttribute->attribute_3 = $attribute['attatibute3'];
                        $productAttribute->attribute_4 = $attribute['attatibute4'];
                        $productAttribute->offer_price = $attribute['offerprice1'];
                        $productAttribute->mrp_price = $attribute['mrprice1'];
                        $productAttribute->call_shop = $attribute['attr_calshop1'];
                        $stockStatus = isset($attribute['stockstatus1']) ? 1 : 0;
                        $productAttribute->show_status = $stockStatus;
                        $newattribute = $productAttribute->save();
                    }
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        $msg = 'New Services Successfully added. Service ID is :  ' . $service_id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($newproductreg > 0) {
            return response()->json(['result' => 1, 'mesge' => '( ' . $request->input('prod_name') . ') Services Successfully Added']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }




    public function AdmServiceApprovedAll(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $productid = $request->input('productid');
        $product_id = explode('#', $productid);
        //echo "<pre>";print_r($product_id);exit;
        $toregIDCount = count($product_id);
        $flg = 0;
        for ($i = 1; $i < $toregIDCount; $i++) {
            $prod_id = $product_id[$i];
            $ServiceDetails = ServiceDetails::find($prod_id);
            if (!empty($ServiceDetails)) {
                if ($ServiceDetails->is_approved == 'N') {
                    $ServiceDetails->is_approved = 'Y';
                } elseif ($ServiceDetails->is_approved == 'R') {
                }
                $ServiceDetails->approved_by = $userId;
                $ServiceDetails->approved_time = $time;
                $ServiceDetails->save();
                $flg = 1;
            }
        }

        $msg = 'Successfully Approved! Approved id : ' . $productid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();

        if ($flg == 1) {
            return response()->json(['result' => 1, 'mesge' => 'Services Successfully Approved']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'No Services Approved']);
        }
    }





    function AdmServiceViewEdit(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $productid = $request->input('productid');
        $ServiceDetails = ServiceDetails::select('service_details.*')
            ->where('service_details.id', $productid)
            ->first();
        //echo $lastRegId = $ServiceDetails->toSql();exit;
        $productAttibutes = DB::table('add_service_attributes')
            ->where('service_id', $ServiceDetails->id)
            ->get();
        // $userservicede = DB::table('user_account')
        //     ->select('id', 'name')
        //     ->where('role_id', 9)
        //     ->get();
        $userservicede = DB::select("SELECT id,name FROM user_account WHERE FIND_IN_SET('9', role_id)");
        //dd($userservicedets);
        return view('serviceproduct.product_viewedit_dets', compact('ServiceDetails', 'productAttibutes', 'userservicede'));
    }


    function AdmNewServiceEdit(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');

        $validatedData = $request->validate([
            'shop_names' => 'required',
            'prod_names' => 'required',
            'prod_descriptions' => 'required',
            'customRadios' => 'required|in:Y,N',
        ]);

        $service_id = $request->serprod_id;
        $ServiceDetails = ServiceDetails::find($service_id);
        $ServiceDetails->fill($validatedData);
        $ServiceDetails->service_id = $request->input('shop_names');
        $ServiceDetails->service_name = $request->input('prod_names');
        $ServiceDetails->service_status = $request->input('productstatus');
        $ServiceDetails->service_description = $request->input('prod_descriptions');
        $ProductImag = DB::table('service_details')
            ->select('service_images')
            ->where('id', $service_id)
            ->get();
        foreach ($ProductImag as $gala) {
            $existproduct_images = $gala->service_images;
        }
        if ($request->hasFile('s_photos')) {
            unlink($existproduct_images);
            $upload_imgpath = 'uploads/ser_provdr_images/';
            if (!is_dir($upload_imgpath)) {
                mkdir($upload_imgpath, 0777, true);
            }
            foreach ($request->file('s_photos') as $fimg) {
                if ($fimg->isValid()) {
                    $imgfile_name = time() . '_' . $fimg->getClientOriginalName();
                    $fimg->move($upload_imgpath, $imgfile_name);
                    $imgfilename = $upload_imgpath . $imgfile_name;
                    $ServiceDetails->service_images = $imgfilename;
                }
            }
        }



        $ServiceDetails->is_attribute = $request->input('customRadios');
        $updteproductreg = $ServiceDetails->save();

        //delete product attributes
        $delteProductAttributesDetail = AddServiceAttribute::where('service_id', $service_id)->delete();
        //end delete attributes

        if ($request->input('customRadios') === 'N') {
            $delteProductAttributesDetail = AddServiceAttribute::where('service_id', $service_id)->delete();
        }

        if ($request->input('customRadios') === 'Y') {
            $attributes = $request->input('attributedatas');
            //echo "<pre>";print_r($attributes);exit;
            try {
                foreach ($attributes as $attribute) {
                    if ($attribute['attatibutes1'] == '' && $attribute['attatibutes2'] == '' && $attribute['attatibutes3'] == '' && $attribute['attatibutes4'] == '' && $attribute['offerprices1'] == '' && $attribute['mrprices1'] == '' && $attribute['attr_calshops1'] == '') {
                    } else {
                        $productAttribute = new AddServiceAttribute();
                        $productAttribute->service_id = $service_id;
                        $productAttribute->attribute_1 = $attribute['attatibutes1'];
                        $productAttribute->attribute_2 = $attribute['attatibutes2'];
                        $productAttribute->attribute_3 = $attribute['attatibutes3'];
                        $productAttribute->attribute_4 = $attribute['attatibutes4'];
                        $productAttribute->offer_price = $attribute['offerprices1'];
                        $productAttribute->mrp_price = $attribute['mrprices1'];
                        $productAttribute->call_shop = $attribute['attr_calshops1'];
                        $stockStatus = isset($attribute['stockstatuss1']) ? 1 : 0;
                        $productAttribute->show_status = $stockStatus;
                        $newattribute = $productAttribute->save();
                    }
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        $msg = 'Service Successfully Updated. Updated service ID is :  ' . $service_id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($updteproductreg > 0) {
            return response()->json(['result' => 1, 'mesge' => '( ' . $request->input('prod_names') . ') Services Successfully Updated']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function AdmserviceApproved(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $serviceid = $request->input('serviceid');
        $ServiceDetails = ServiceDetails::select('service_details.*')
            ->where('service_details.id', $serviceid)
            ->first();
        //echo $lastRegId = $ServiceDetails->toSql();exit;
        $productAttibutes = DB::table('add_service_attributes')
            ->where('service_id', $ServiceDetails->id)
            ->get();
        // $userservicede = DB::table('user_account')
        //     ->select('id', 'name')
        //     ->where('role_id', 9)
        //     ->get();
        $userservicede = DB::select("SELECT id,name FROM user_account WHERE FIND_IN_SET('9', role_id)");
        //dd($userservicedets);
        return view('serviceproduct.product_approved_dets', compact('ServiceDetails', 'productAttibutes', 'userservicede'));
    }

    function AdmapprovedService(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $validatedData = $request->validate([
            'productapproval' => 'required|max:1',
        ]);
        $serprod_ids = $request->serprod_ids;

        $ServiceDetails = ServiceDetails::find($serprod_ids);
        $ServiceDetails->fill($validatedData);
        $ServiceDetails->service_status = $request->productstatus;
        $ServiceDetails->is_approved = $request->productapproval;
        $ServiceDetails->approved_by = $userId;
        $ServiceDetails->approved_time = $time;
        $submt = $ServiceDetails->save();

        $msg = 'Service Aprroved Status =  ' . $request->productapproval . ' service approved id : ' . $serprod_ids;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($submt > 0) {
            return response()->json(['result' => 1, 'mesge' => ' Service Successfully Approved']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function AdmServiceDelete(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $serviceid = $request->input('serviceid');
        $ProductDetails = ServiceDetails::find($serviceid);
        $deltesellerDetail = $ProductDetails->delete();
        $delteProductAttributesDetail = AddServiceAttribute::where('service_id', $serviceid)->delete();
        $msg = 'Service Deleted.  service id : ' . $serviceid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($deltesellerDetail > 0 && $delteProductAttributesDetail > 0) {
            return response()->json(['result' => 1, 'mesge' => 'Service Deleted Successfully']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }



}

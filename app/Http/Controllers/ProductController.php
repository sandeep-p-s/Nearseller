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
use App\Models\AddProductAttribute;
use App\Models\admin\Category;
use Image;
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
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser = UserAccount::sessionValuereturn($userRole);
        $userdetails = DB::table('user_account')
            ->where('id', $userId)
            ->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $usershopdets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 2)
            ->get();
        return view('product.productlist', compact('userdetails', 'userRole', 'loggeduser', 'structuredMenu'));
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

    function ProductNameSearch(Request $request)
    {
        $prodname = $request->input('prodname');
        $ProductDetails = ProductDetails::select('id', 'product_name')
            ->where('product_name', 'LIKE', $prodname . '%')
            ->distinct()
            ->get();
        //echo $lastRegId = $UserAccount->toSql();exit;
        header('Content-Type: application/json');
        echo json_encode($ProductDetails);
    }

    function ExistproductviewPage(Request $request)
    {
        $existprodid = $request->input('existprodid');
        $ProductDetails = ProductDetails::find($existprodid);
        //echo $lastRegId = $UserAccount->toSql();exit;
        return response()->json(['result' => 3, 'mesge' => 'Total stock and attribute stock must be equal.']);
    }

    function AllProductList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $prodname = $request->input('prodname');
        $atribute = $request->input('atribute');
        $shopid = $request->input('shopid');
        $shop_id = explode('-', $shopid);
        $shopval = $shop_id[0];

        // $query = ProductDetails::select('product_details.*','add_product_attributes.slug_description')
        //         ->leftJoin('add_product_attributes', 'product_details.id', 'add_product_attributes.product_id')
        //         ->leftJoin('categories', 'categories.id', 'product_details.category_id');

        // if ($prodname) {
        //     $query->where('product_details.name', 'LIKE', '%' . $prodname . '%');
        // }
        // if ($atribute) {
        //     $query->where('product_details.attribute_1', 'LIKE', '%' . $atribute . '%')
        //                 ->orWhere('product_details.attribute_2', 'LIKE', '%' . $atribute . '%')
        //                 ->orWhere('product_details.attribute_3', 'LIKE', '%' . $atribute . '%')
        //                 ->orWhere('product_details.attribute_4', 'LIKE', '%' . $atribute . '%');
        // }

        $query = ProductDetails::select('product_details.*', 'user_account.name as shopname')->leftJoin('user_account', 'user_account.id', 'product_details.shop_id');
        if ($prodname) {
            $query->where('product_details.product_name', 'LIKE', '%' . $prodname . '%');
        }
        if ($shopid) {
            $query->where('product_details.shop_id', $shopval);
        }

        if ($roleid == 1) {
        } else {
            $query->where('user_account.id', $userId);
        }
        $query->orderBy('product_details.product_name');
        $ProductDetails = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $ProductCount = $ProductDetails->count();
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
        });
        $usershopdets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 2)
            ->get();
        return view('product.product_dets', compact('ProductDetails', 'ProductCount', 'filteredCategories', 'usershopdets'));
    }

    public function AdmProductApprovedAll(Request $request)
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
            $productDetails = ProductDetails::find($prod_id);
            if (!empty($productDetails)) {
                if ($productDetails->is_approved == 'N') {
                    $productDetails->is_approved = 'Y';
                } elseif ($productDetails->is_approved == 'R') {
                }
                $productDetails->approved_by = $userId;
                $productDetails->approved_time = $time;
                $productDetails->save();
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
            return response()->json(['result' => 1, 'mesge' => 'Product Successfully Approved']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'No Products Approved']);
        }
    }

    function AdmNewPrdoductAdd(Request $request)
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
            'prod_name' => 'required|regex:/^[A-Za-z\s\.]+$/',
            'prod_specification' => 'nullable|max:250',
            'parent_category' => 'required',
            'prod_description' => 'required|max:7000',
            'totstock' => 'required|numeric',
            'customRadio' => 'required|in:Y,N',
            'paymode' => 'required|in:cod,shop,calshop',
            'prod_manufacture' => 'nullable|max:250',
            'brand_name' => 'nullable|max:120',
            'videofile' => 'nullable|mimes:mp4|max:102400', // Max 100MB video file
            'prod_doc' => 'nullable|mimes:pdf|max:1024', // Max 1MB PDF file
            //'s_photo'             => 'nullable|image|mimes:jpeg,png|max:2048', // Max 2MB per image
        ]);

        if ($request->input('customRadio') === 'Y') {
            $totalStock = (int) $request->input('totstock', 0);
            $attributeStock = 0;
            if ($request->has('attributedata')) {
                foreach ($request->input('attributedata') as $attributeData) {
                    $attributeStock += (int) ($attributeData['attr_stock1'] ?? 0);
                }
            }
            if ($totalStock !== $attributeStock) {
                return response()->json(['result' => 3, 'mesge' => 'Total stock and attribute stock must be equal.']);
            }
        }
        $ProductDetails = new ProductDetails();
        $ProductDetails->fill($validatedData);
        $ProductDetails->shop_id = $request->input('shop_name');
        $ProductDetails->product_name = $request->input('prod_name');
        $ProductDetails->product_specification = $request->input('prod_specification');
        $ProductDetails->category_id = $request->input('parent_category');
        $ProductDetails->product_description = $request->input('prod_description');
        $ProductDetails->manufacture_details = $request->input('prod_manufacture');
        $ProductDetails->brand_name = $request->input('brand_name');
        $ProductDetails->paying_mode = $request->input('paymode');
        $ProductDetails->product_stock = $request->input('totstock');
        $ProductDetails->created_by = $userId;
        $ProductDetails->created_time = $time;
        $ProductDetails->product_status = 'Y';
        if ($roleid == 1) {
            $ProductDetails->is_approved = 'Y';
            $ProductDetails->approved_by = $userId;
            $ProductDetails->approved_time = $time;
        }

        if ($request->hasFile('prod_doc')) {
            $file = $request->file('prod_doc');
            $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
            $upload_doc = 'uploads/product_document/';
            if (!is_dir($upload_doc)) {
                mkdir($upload_doc, 0777, true);
            }
            $file->move(public_path($upload_doc), $fileName);
            $document = $upload_doc . $fileName;
            $ProductDetails->product_document = $document;
        }

        if ($request->hasFile('videofile')) {
            $file = $request->file('videofile');
            $filevideo = rand() . time() . '.' . $file->getClientOriginalExtension();
            $upload_video = 'uploads/product_video/';
            if (!is_dir($upload_video)) {
                mkdir($upload_video, 0777, true);
            }
            $file->move(public_path($upload_video), $filevideo);
            $prod_video = $upload_video . $filevideo;
            $ProductDetails->product_videos = $prod_video;
        }

        if ($request->hasFile('s_photo')) {
            $upload_path = 'uploads/product_images/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $input_datas = [];
            foreach ($request->file('s_photo') as $file) {
                if ($file->isValid()) {
                    $new_name = rand() . time() . '_' . $file->getClientOriginalExtension();
                    $file->move($upload_path, $new_name);
                    $filename = $upload_path . $new_name;
                    array_push($input_datas, $filename);
                }
            }
            $input_vals = ['fileval' => $input_datas];
            $jsonimages = json_encode($input_vals);
            $ProductDetails->product_images = $jsonimages;
        }
        $ProductDetails->is_attribute = $request->input('customRadio');
        $newproductreg = $ProductDetails->save();
        $product_id = $ProductDetails->id;
        if ($request->input('customRadio') === 'Y') {
            $attributes = $request->input('attributedata');
            //echo "<pre>";print_r($attributes);exit;
            try {
                foreach ($attributes as $attribute) {
                    if ($attribute['attatibute1'] == '' && $attribute['attatibute2'] == '' && $attribute['attatibute3'] == '' && $attribute['attatibute4'] == '' && $attribute['offerprice1'] == '' && $attribute['mrprice1'] == '' && $attribute['attr_stock1'] == '') {
                    } else {
                        $productAttribute = new AddProductAttribute();
                        $productAttribute->product_id = $product_id;
                        $productAttribute->attribute_1 = $attribute['attatibute1'];
                        $productAttribute->attribute_2 = $attribute['attatibute2'];
                        $productAttribute->attribute_3 = $attribute['attatibute3'];
                        $productAttribute->attribute_4 = $attribute['attatibute4'];
                        $productAttribute->offer_price = $attribute['offerprice1'];
                        $productAttribute->mrp_price = $attribute['mrprice1'];
                        $productAttribute->attribute_stock = $attribute['attr_stock1'];
                        $stockStatus = isset($attribute['stockstatus1']) ? 1 : 0;
                        $productAttribute->stock_status = $stockStatus;
                        $newattribute = $productAttribute->save();
                    }
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        $msg = 'New Product Successfully added. product ID is :  ' . $product_id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($newproductreg > 0) {
            return response()->json(['result' => 1, 'mesge' => '( ' . $request->input('prod_name') . ') Product Successfully Added']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function AdmPrdoductExist(Request $request)
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
            'shop_namesx' => 'required',
            'prod_namesx' => 'required|regex:/^[A-Za-z\s\.]+$/',
            'prod_specificationsx' => 'nullable|max:250',
            'parent_categorysx' => 'required',
            'prod_descriptionsx' => 'required|max:7000',
            'totstocksx' => 'required|numeric',
            'customRadiosx' => 'required|in:Y,N',
            'paymodesx' => 'required|in:cod,shop,calshop',
            'prod_manufacturesx' => 'nullable|max:250',
            'brand_namesx' => 'nullable|max:120',
            'videofilesx' => 'nullable|mimes:mp4|max:102400', // Max 100MB video file
            'prod_docsx' => 'nullable|mimes:pdf|max:1024', // Max 1MB PDF file
            //'s_photo'             => 'nullable|image|mimes:jpeg,png|max:2048', // Max 2MB per image
        ]);

        if ($request->input('customRadiosx') === 'Y') {
            $totalStock = (int) $request->input('totstocksx', 0);
            $attributeStock = 0;
            if ($request->has('attributedatasx')) {
                foreach ($request->input('attributedatasx') as $attributeData) {
                    $attributeStock += (int) ($attributeData['attr_stocksx1'] ?? 0);
                }
            }
            if ($totalStock !== $attributeStock) {
                return response()->json(['result' => 3, 'mesge' => 'Total stock and attribute stock must be equal.']);
            }
        }
        $ProductDetails = new ProductDetails();
        $ProductDetails->fill($validatedData);
        $ProductDetails->shop_id = $request->input('shop_namesx');
        $ProductDetails->product_name = $request->input('prod_namesx');
        $ProductDetails->product_specification = $request->input('prod_specificationsx');
        $ProductDetails->category_id = $request->input('parent_categorysx');
        $ProductDetails->product_description = $request->input('prod_descriptionsx');
        $ProductDetails->manufacture_details = $request->input('prod_manufacturesx');
        $ProductDetails->brand_name = $request->input('brand_namesx');
        $ProductDetails->paying_mode = $request->input('paymodesx');
        $ProductDetails->product_stock = $request->input('totstocksx');
        $ProductDetails->created_by = $userId;
        $ProductDetails->created_time = $time;
        $ProductDetails->product_status = 'Y';
        if ($roleid == 1) {
            $ProductDetails->is_approved = 'Y';
            $ProductDetails->approved_by = $userId;
            $ProductDetails->approved_time = $time;
        }

        if ($request->hasFile('prod_docsx')) {
            $file = $request->file('prod_docsx');
            $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
            $upload_doc = 'uploads/product_document/';
            if (!is_dir($upload_doc)) {
                mkdir($upload_doc, 0777, true);
            }
            $file->move(public_path($upload_doc), $fileName);
            $document = $upload_doc . $fileName;
            $ProductDetails->product_document = $document;
        }

        if ($request->hasFile('videofilesx')) {
            $file = $request->file('videofilesx');
            $filevideo = rand() . time() . '.' . $file->getClientOriginalExtension();
            $upload_video = 'uploads/product_video/';
            if (!is_dir($upload_video)) {
                mkdir($upload_video, 0777, true);
            }
            $file->move(public_path($upload_video), $filevideo);
            $prod_video = $upload_video . $filevideo;
            $ProductDetails->product_videos = $prod_video;
        }

        if ($request->hasFile('s_photosx')) {
            $upload_path = 'uploads/product_images/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $input_datas = [];
            foreach ($request->file('s_photosx') as $file) {
                if ($file->isValid()) {
                    $new_name = rand() . time() . '_' . $file->getClientOriginalExtension();
                    $file->move($upload_path, $new_name);
                    $filename = $upload_path . $new_name;
                    array_push($input_datas, $filename);
                }
            }
            $input_vals = ['fileval' => $input_datas];
            $jsonimages = json_encode($input_vals);
            $ProductDetails->product_images = $jsonimages;
        }
        $ProductDetails->is_attribute = $request->input('customRadiosx');
        $newproductreg = $ProductDetails->save();
        $product_id = $ProductDetails->id;
        if ($request->input('customRadiosx') === 'Y') {
            $attributes = $request->input('attributedatasx');
            //echo "<pre>";print_r($attributes);exit;
            try {
                foreach ($attributes as $attribute) {
                    if ($attribute['attatibutesx1'] == '' && $attribute['attatibutesx2'] == '' && $attribute['attatibutesx3'] == '' && $attribute['attatibutesx4'] == '' && $attribute['offerpricesx1'] == '' && $attribute['mrpricesx1'] == '' && $attribute['attr_stocksx1'] == '') {
                    } else {
                        $productAttribute = new AddProductAttribute();
                        $productAttribute->product_id = $product_id;
                        $productAttribute->attribute_1 = $attribute['attatibutesx1'];
                        $productAttribute->attribute_2 = $attribute['attatibutesx2'];
                        $productAttribute->attribute_3 = $attribute['attatibutesx3'];
                        $productAttribute->attribute_4 = $attribute['attatibutesx4'];
                        $productAttribute->offer_price = $attribute['offerpricesx1'];
                        $productAttribute->mrp_price = $attribute['mrpricesx1'];
                        $productAttribute->attribute_stock = $attribute['attr_stocksx1'];
                        $stockStatus = isset($attribute['stockstatussx1']) ? 1 : 0;
                        $productAttribute->stock_status = $stockStatus;
                        $newattribute = $productAttribute->save();
                    }
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        $msg = 'New Product Successfully added. product ID is :  ' . $product_id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($newproductreg > 0) {
            return response()->json(['result' => 1, 'mesge' => '( ' . $request->input('prod_name') . ') Product Successfully Added']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function AdmProductViewEdit(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $productid = $request->input('productid');
        $ProductDetails = ProductDetails::select('product_details.*')
            ->leftJoin('categories', 'categories.id', 'product_details.category_id')
            ->where('product_details.id', $productid)
            ->first();

        $productAttibutes = DB::table('add_product_attributes')
            ->where('product_id', $ProductDetails->id)
            ->get();
        //echo $lastRegId = $Affiliate->toSql();exit;
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
        });
        $usershopdets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 2)
            ->get();
        return view('product.product_viewedit_dets', compact('ProductDetails', 'filteredCategories', 'productAttibutes', 'usershopdets'));
    }

    function AdmproductValDelte(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $imgval = $request->input('imgval');
        $typevals = urldecode($imgval);
        $typevalm = base64_decode($typevals);
        $exlodval = explode('#', $typevalm);
        //echo "<pre>";print_r($exlodval);exit;
        $imgremove = $exlodval[0];
        $productid = $exlodval[1];
        $ProductDetails = ProductDetails::find($productid);
        $ProductImg = DB::table('product_details')
            ->where('id', $productid)
            ->get();
        //echo $lastRegId = $sellerDetail->toSql();exit;
        foreach ($ProductImg as $gal) {
            $json_data = $gal->product_images;
        }
        $data = json_decode($json_data, true);
        $delete_item = $imgremove;
        $index = array_search($delete_item, $data['fileval']);
        //echo "<pre>";print_r($index);exit;
        if ($index !== false) {
            $file_path = $imgremove;
            unlink($file_path);
            unset($data['fileval'][$index]);
            $data['fileval'] = array_values($data['fileval']);
            $updated_json_data = json_encode($data);
            $ProductDetails->product_images = $updated_json_data;
            $result = $ProductDetails->save();
            //echo $lastRegId = $sellerDetail->toSql();exit;
            $loggedUserIp = $_SERVER['REMOTE_ADDR'];
            $time = date('Y-m-d H:i:s');
            $msg = 'Deleted Image ' . $imgremove;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $userId;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
            if ($result > 0) {
                return response()->json(['result' => 1, 'mesge' => 'Deleted Successfully']);
            } else {
                return response()->json(['result' => 2, 'mesge' => 'Failed']);
            }
        }
    }

    function AdmNewPrdoductEdit(Request $request)
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
            'prod_names' => 'required|regex:/^[A-Za-z\s\.]+$/',
            'prod_specifications' => 'nullable|max:250',
            'parent_categorys' => 'required',
            'prod_descriptions' => 'required|max:7000',
            'totstocks' => 'required|numeric',
            'customRadios' => 'required|in:Y,N',
            'paymodes' => 'required|in:cod,shop,calshop',
            'prod_manufactures' => 'nullable|max:250',
            'productstatus' => 'required',
            'brand_names' => 'nullable|max:120',
            'videofiles' => 'nullable|mimes:mp4|max:102400', // Max 100MB video file
            'prod_docs' => 'nullable|mimes:pdf|max:1024', // Max 1MB PDF file
            //'s_photo'             => 'nullable|image|mimes:jpeg,png|max:2048', // Max 2MB per image
        ]);

        if ($request->input('customRadio') === 'Y') {
            $totalStock = (int) $request->input('totstock', 0);
            $attributeStock = 0;
            if ($request->has('attributedata')) {
                foreach ($request->input('attributedata') as $attributeData) {
                    $attributeStock += (int) ($attributeData['attr_stock1'] ?? 0);
                }
            }
            if ($totalStock !== $attributeStock) {
                return response()->json(['result' => 3, 'mesge' => 'Total stock and attribute stock must be equal.']);
            }
        }
        $product_id = $request->prod_id;
        $ProductDetails = ProductDetails::find($product_id);
        $ProductDetails->fill($validatedData);
        $ProductDetails->shop_id = $request->input('shop_names');
        $ProductDetails->product_name = $request->input('prod_names');
        $ProductDetails->product_specification = $request->input('prod_specifications');
        $ProductDetails->category_id = $request->input('parent_categorys');
        $ProductDetails->product_description = $request->input('prod_descriptions');
        $ProductDetails->manufacture_details = $request->input('prod_manufactures');
        $ProductDetails->brand_name = $request->input('brand_names');
        $ProductDetails->paying_mode = $request->input('paymodes');
        $ProductDetails->product_stock = $request->input('totstocks');
        $ProductDetails->product_status = $request->input('productstatus');
        // if($roleid==1)
        // {
        //     $ProductDetails->is_approved = 'Y';
        //     $ProductDetails->approved_by = $userId;
        //     $ProductDetails->approved_time = $time;
        // }
        $ProductImag = DB::table('product_details')
            ->select('product_images', 'product_videos', 'product_document')
            ->where('id', $product_id)
            ->get();
        foreach ($ProductImag as $gala) {
            $existproduct_images = $gala->product_images;
            $existproduct_videos = $gala->product_videos;
            $existproduct_document = $gala->product_document;
        }

        if ($request->hasFile('prod_docs')) {
            unlink($existproduct_document);
            $file = $request->file('prod_docs');
            $fileName = rand() . time() . '.' . $file->getClientOriginalExtension();
            $upload_doc = 'uploads/product_document/';
            if (!is_dir($upload_doc)) {
                mkdir($upload_doc, 0777, true);
            }
            $file->move(public_path($upload_doc), $fileName);
            $document = $upload_doc . $fileName;
            $ProductDetails->product_document = $document;
        }

        if ($request->hasFile('videofiles')) {
            unlink($existproduct_videos);
            $file = $request->file('videofiles');
            $filevideo = rand() . time() . '.' . $file->getClientOriginalExtension();
            $upload_video = 'uploads/product_video/';
            if (!is_dir($upload_video)) {
                mkdir($upload_video, 0777, true);
            }
            $file->move(public_path($upload_video), $filevideo);
            $prod_video = $upload_video . $filevideo;
            $ProductDetails->product_videos = $prod_video;
        }

        $input_datas = [];
        $input_vals = [];
        $existing_array = json_decode($existproduct_images, true);
        $existing_images = isset($existing_array['fileval']) ? $existing_array['fileval'] : [];
        $input_datas = $existing_images;
        if ($request->hasFile('s_photos')) {
            $upload_path = 'uploads/product_images/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }
            foreach ($request->file('s_photos') as $file) {
                if ($file->isValid()) {
                    $new_name = time() . '_' . $file->getClientOriginalExtension();
                    $file->move($upload_path, $new_name);
                    $filename = $upload_path . $new_name;
                    array_push($input_datas, $filename);
                }
            }
            $input_vals = ['fileval' => $input_datas];
            $jsonimages = json_encode($input_vals);
            $ProductDetails->product_images = $jsonimages;
        }
        $ProductDetails->is_attribute = $request->input('customRadios');
        $updteproductreg = $ProductDetails->save();

        //delete product attributes
        $delteProductAttributesDetail = AddProductAttribute::where('product_id', $product_id)->delete();
        //end delete attributes

        if ($request->input('customRadios') === 'N') {
            $delteProductAttributesDetail = AddProductAttribute::where('product_id', $product_id)->delete();
        }

        if ($request->input('customRadios') === 'Y') {
            $attributes = $request->input('attributedatas');
            //echo "<pre>";print_r($attributes);exit;
            try {
                foreach ($attributes as $attribute) {
                    if ($attribute['attatibutes1'] == '' && $attribute['attatibutes2'] == '' && $attribute['attatibutes3'] == '' && $attribute['attatibutes4'] == '' && $attribute['offerprices1'] == '' && $attribute['mrprices1'] == '' && $attribute['attr_stocks1'] == '') {
                    } else {
                        $productAttribute = new AddProductAttribute();
                        $productAttribute->product_id = $product_id;
                        $productAttribute->attribute_1 = $attribute['attatibutes1'];
                        $productAttribute->attribute_2 = $attribute['attatibutes2'];
                        $productAttribute->attribute_3 = $attribute['attatibutes3'];
                        $productAttribute->attribute_4 = $attribute['attatibutes4'];
                        $productAttribute->offer_price = $attribute['offerprices1'];
                        $productAttribute->mrp_price = $attribute['mrprices1'];
                        $productAttribute->attribute_stock = $attribute['attr_stocks1'];
                        $stockStatus = isset($attribute['stockstatuss1']) ? 1 : 0;
                        $productAttribute->stock_status = $stockStatus;
                        $newproductreg = $productAttribute->save();
                    }
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        }
        $msg = 'Product Successfully Updated. Updated product ID is :  ' . $product_id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($newproductreg > 0) {
            return response()->json(['result' => 1, 'mesge' => '( ' . $request->input('prod_name') . ') Product Successfully Updated']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function AdmproductApproved(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $productid = $request->input('productid');
        $ProductDetails = ProductDetails::select('product_details.*')
            ->leftJoin('categories', 'categories.id', 'product_details.category_id')
            ->where('product_details.id', $productid)
            ->first();

        $productAttibutes = DB::table('add_product_attributes')
            ->where('product_id', $ProductDetails->id)
            ->get();
        //echo $lastRegId = $Affiliate->toSql();exit;
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
        });
        $usershopdets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 2)
            ->get();
        return view('product.product_approved_dets', compact('ProductDetails', 'filteredCategories', 'productAttibutes', 'usershopdets'));
    }

    function AdmapprovedPrdoduct(Request $request)
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
        $prod_id = $request->prod_ids;

        $ProductDetails = ProductDetails::find($prod_id);

        $ProductDetails->is_approved = $request->productapproval;
        $ProductDetails->approved_by = $userId;
        $ProductDetails->approved_time = $time;
        $submt = $ProductDetails->save();

        $msg = 'Aprroved Status =  ' . $request->productapproval . ' product approved id : ' . $prod_id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($submt > 0) {
            return response()->json(['result' => 1, 'mesge' => ' Product Successfully Approved']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function AdmProductsDelete(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $productid = $request->input('productid');
        $ProductDetails = ProductDetails::find($productid);
        $deltesellerDetail = $ProductDetails->delete();
        $delteProductAttributesDetail = AddProductAttribute::where('product_id', $productid)->delete();
        $msg = 'Product Deleted  product id : ' . $productid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($deltesellerDetail > 0 && $delteProductAttributesDetail > 0) {
            return response()->json(['result' => 1, 'mesge' => 'Product Deleted Successfully']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function productCategorySearch(Request $request)
    {
        $categoryname = $request->input('categoryname');
        $categories = Category::treeWithautocomplete($categoryname);
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
        });
        header('Content-Type: application/json');
        echo json_encode($filteredCategories);
    }

    function AdmproductExistEdit(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $productid = $request->input('productid');
        $ProductDetails = ProductDetails::select('product_details.*')
            ->leftJoin('categories', 'categories.id', 'product_details.category_id')
            ->where('product_details.id', $productid)
            ->first();

        $productAttibutes = DB::table('add_product_attributes')
            ->where('product_id', $ProductDetails->id)
            ->get();
        //echo $lastRegId = $Affiliate->toSql();exit;
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
        });
        $usershopdets = DB::table('user_account')
            ->select('id', 'name')
            ->where('role_id', 2)
            ->get();
        return view('product.product_exists_dets', compact('ProductDetails', 'filteredCategories', 'productAttibutes', 'usershopdets'));
    }
}

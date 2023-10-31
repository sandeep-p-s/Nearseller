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

class CategoryProductListController extends Controller
{
    function ParentProductListView()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $roleIdsArray = explode(',', $roleid);
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
            ->whereIn('role_id', $roleIdsArray)
            ->get();
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
        });

        return view('categoryproduct.productlist', compact('userdetails', 'userRole', 'loggeduser', 'structuredMenu', 'filteredCategories'));
    }




    function ListParentCategory(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $flag = $request->input('flag');
        $categoryid = $request->input('categoryid');
        $parentNames = [];

        $categories = DB::table('categories as c1')
            ->select('c1.id','c1.category_image', 'c1.category_name', 'c1.parent_id', 'c2.category_name as parent_name')
            ->leftJoin('categories as c2', 'c1.parent_id', '=', 'c2.id')
            ->leftJoin('product_details', 'product_details.category_id', '=', 'c1.id')
            ->leftJoin('user_account', 'user_account.id', '=', 'product_details.shop_id');
        if ($categoryid) {
            $category = DB::table('categories')
                ->select('id', 'category_name', 'parent_id')
                ->where('id', $categoryid)
                ->first();
            while ($category) {
                array_unshift($parentNames, $category->category_name);
                $category = DB::table('categories')
                    ->select('id', 'category_name', 'parent_id')
                    ->where('id', $category->parent_id)
                    ->first();
            }
            $categoryid = $categoryid;
            $categories->where('c1.parent_id', $categoryid);
        } else {
            $categories->where('c1.parent_id', 0);
        }
        $categories->where('c1.approval_status', 'Y');
        if ($roleid != 1) {
            $categories->where('user_account.id', $userId);
        }
        $categories->groupBy('c1.id','c1.category_image', 'c1.category_name', 'c1.parent_id', 'c2.category_name');
        //echo $lastRegId = $categories->toSql();
        $categories = $categories->get();
        // foreach ($categories as $product) {
        //     $productAttributesDet = DB::table('add_product_attributes')
        //         ->where('product_id', $product->id)
        //         ->get();
        //     $product->attributes = $productAttributesDet;
        // }
        $categoriesCount = $categories->count();

        return view('categoryproduct.product_dets', compact('categories', 'categoriesCount', 'flag', 'parentNames'));
    }








    function AdmProductView(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $productAttibutes='';
        $categoryid = $request->input('categoryid');
        $ProductDetails = ProductDetails::select('product_details.*','categories.category_name')
            ->leftJoin('categories', 'categories.id', 'product_details.category_id')
            ->where('product_details.category_id', $categoryid)
            ->where('product_details.is_approved', 'Y')
            ->get();

        $ProductCount = $ProductDetails->count();
        if($ProductCount==0)
        {
            echo "<div class='col text-center'><h4><font color='red'>Products Not Found</font></h4></div>";exit;
        }

        foreach ($ProductDetails as $product) {
        $productAttibutes = DB::table('add_product_attributes')
            ->where('product_id', $product->id)
            ->get();
            $product->attributes = $productAttibutes;
            $usershopdets = DB::table('user_account')
            ->select('name')
            ->where('id', $product->shop_id)
            ->first();
        }
        //echo $lastRegId = $ProductDetails->toSql();exit;

        //echo $lastRegId = $usershopdets->toSql();exit;
        return view('categoryproduct.product_viewedit_dets', compact('ProductDetails', 'productAttibutes', 'usershopdets'));
    }






















    function CategoryProductListView()
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
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
        });

        return view('categoryproduct_test.productlist', compact('userdetails', 'userRole', 'loggeduser', 'structuredMenu', 'filteredCategories'));
    }

    private function getAllSubcategoryIds($parentCategory, &$categoryIds)
    {
        $subcategories = Category::where('parent_id', $parentCategory->id)
            ->pluck('id')
            ->toArray();
        $categoryIds = array_merge($categoryIds, $subcategories);
        foreach ($subcategories as $subcategory) {
            $this->getAllSubcategoryIds(Category::find($subcategory), $categoryIds);
        }
    }

    function AllCategoryProductList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }

        $categoryid = $request->input('categoryid');
        $flag = $request->input('flag');
        $categoryIds = [];

        if ($categoryid) {
            $categoryIds = [$categoryid];
            $this->getAllSubcategoryIds(Category::find($categoryid), $categoryIds);
        } else {
            $categoryIds[] = 0;
        }

        //echo "<pre>";print_r($categoryIds);

        $query = ProductDetails::select('product_details.*', 'categories.id as categoryid', 'categories.category_name', 'categories.parent_id', 'categories.category_image', 'user_account.name as shopname')
            ->leftJoin('categories', 'categories.id', 'product_details.category_id')
            ->leftJoin('user_account', 'user_account.id', 'product_details.shop_id');

        if ($categoryid) {
            $query->whereIn('product_details.category_id', $categoryIds);
        } else {
            $query->where('categories.parent_id', '0');
        }

        if ($roleid != 1) {
            $query->where('user_account.id', $userId);
        }
        $query->distinct();
        $ProductDetails = $query->get();
        $productAttributesDet='';

        foreach ($ProductDetails as $product) {
            $productAttributesDet = DB::table('add_product_attributes')
                ->where('product_id', $product->id)
                ->get();
            $product->attributes = $productAttributesDet;
        }

        $ProductCount = $ProductDetails->count();
        //echo $lastRegId = $productAttributesDet->toSql();
        return view('categoryproduct_test.product_dets', compact('ProductDetails', 'ProductCount', 'flag', 'productAttributesDet'));
    }












    function AllCategoryProductList_(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }

        $categoryid = $request->input('categoryid');
        $query = ProductDetails::select('product_details.*', 'categories.id as categoryid', 'categories.category_name', 'categories.parent_id', 'categories.category_image', 'user_account.name as shopname')
            ->leftJoin('categories', 'categories.id', 'product_details.category_id')
            ->leftJoin('user_account', 'user_account.id', 'product_details.shop_id');

        // $query = ProductDetails::select(
        //     'product_details.*',
        //     DB::raw("GROUP_CONCAT(CONCAT_WS(' - ',
        //     add_product_attributes.attribute_1,
        //     add_product_attributes.attribute_2,
        //     add_product_attributes.attribute_3,
        //     add_product_attributes.attribute_4,
        //     add_product_attributes.stock_status,
        //     add_product_attributes.offer_price,
        //     add_product_attributes.mrp_price,
        //     add_product_attributes.attribute_stock,
        //     add_product_attributes.stock_status
        //     )) as concatenated_attributes"),
        //     'categories.id as categoryid',
        //     'categories.category_name',
        //     'categories.parent_id',
        //     'categories.category_image',
        //     'user_account.name as shopname',
        // )
        //     ->leftJoin('add_product_attributes', 'product_details.id', 'add_product_attributes.product_id')
        //     ->leftJoin('categories', 'categories.id', 'product_details.category_id')
        //     ->leftJoin('user_account', 'user_account.id', 'product_details.shop_id')
        //     ->groupBy('product_details.id');

        if ($categoryid) {
            $categoryIds = [$categoryid];
            $getSubcategories = function ($parentCategory) use (&$getSubcategories, &$categoryIds) {
                $subcategories = Category::where('parent_id', $parentCategory->id)
                    ->pluck('id')
                    ->toArray();
                $categoryIds = array_merge($categoryIds, $subcategories);
                foreach ($subcategories as $subcategory) {
                    $getSubcategories(Category::find($subcategory));
                } //echo "<pre>";print_r($categoryIds);
            };

            $getSubcategories(Category::find($categoryid));
            $query->whereIn('product_details.category_id', $categoryIds);
        } else {
            $query->where('categories.parent_id', '0');
        }
        if ($roleid != 1) {
            $query->where('user_account.id', $userId);
        }

        $query->distinct();
        $ProductDetails = $query->get();
        foreach ($ProductDetails as $product) {
            $productAttributesDet = DB::table('add_product_attributes')
                ->where('product_id', $product->id)
                ->get();
            //echo "<pre>";print_r($productAttributesDet);
            $product->attributes = $productAttributesDet;
        }

        //echo $lastRegId = $query->toSql();
        $ProductCount = $ProductDetails->count();
        return view('categoryproduct.product_dets', compact('ProductDetails', 'ProductCount'));
    }









    function categoryproductlist_(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }

        $categoryid = $request->input('categoryid');
        $query = ProductDetails::select('product_details.*', 'categories.id as categoryid', 'categories.category_name', 'categories.parent_id', 'categories.category_image', 'user_account.name as shopname')
            ->leftJoin('categories', 'categories.id', 'product_details.category_id')
            ->leftJoin('user_account', 'user_account.id', 'product_details.shop_id');

        $categoryIds = [$categoryid];
        $getSubcategories = function ($parentCategory) use (&$getSubcategories, &$categoryIds) {
            $subcategories = Category::where('parent_id', $parentCategory->id)
                ->pluck('id')
                ->toArray();
            $categoryIds = array_merge($categoryIds, $subcategories);
            foreach ($subcategories as $subcategory) {
                $getSubcategories(Category::find($subcategory));
            } //echo "<pre>";print_r($categoryIds);
        };

        $getSubcategories(Category::find($categoryid));
        $query->whereIn('product_details.category_id', $categoryIds);

        if ($roleid != 1) {
            $query->where('user_account.id', $userId);
        }
        $query->distinct();
        $ProductDetails = $query->get();
        foreach ($ProductDetails as $product) {
            $productAttributesDet = DB::table('add_product_attributes')
                ->where('product_id', $product->id)
                ->get();
            //echo "<pre>";print_r($productAttributesDet);
            $product->attributes = $productAttributesDet;
        }

        //echo $lastRegId = $query->toSql();
        $ProductCount = $ProductDetails->count();
        return view('categoryproduct.product_dets', compact('ProductDetails', 'ProductCount'));
    }
}

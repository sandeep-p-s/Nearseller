<?php

namespace App\Http\Controllers\Admin;

use DB;
use File;
use App\Models\UserAccount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
//use Image;
use App\Models\admin\Category;
use App\Models\MenuMaster;
use App\Models\LogDetails;
use App\Http\Controllers\Controller;
use Storage;
use Illuminate\Validation\Rule;
use App\Rules\CategoryLevelRule;
use Carbon\Carbon;
class CategoryController extends Controller
{
    public function list_category()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $categories = Category::tree();
        $total_categories = DB::table('categories')->count();
        $inactive_categories = DB::table('categories as c')->where('c.status', 'N')->count();
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
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.category.listCategory', compact('loggeduser', 'userdetails', 'categories', 'total_categories', 'inactive_categories', 'structuredMenu','selrdetails'));
    }
    public function add_category()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
        });
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
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.category.addCategory', compact('loggeduser', 'userdetails', 'filteredCategories', 'structuredMenu','selrdetails'));
    }

    public function parent_category($typeValue)
    {
        $categories = Category::treeWithStatusOnchange($typeValue);
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
        });

        return response()->json($filteredCategories);
    }

    public function parent_category_edit($typeValue,$category_slug)
    {
        $categories = Category::treeWithStatusOnchange($typeValue);
        $current_category = $categories->where('category_slug', $category_slug);
        $filteredCategories = $categories->filter(function ($category) use ($category_slug , $current_category) {
            return $category->category_level < $current_category->category_level && $category->category_slug != $category_slug;
        });

        return response()->json($filteredCategories);
    }

    public function store_category(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }



        $request->validate(
            [
                'category_name' => 'required|unique:categories,category_name|string|max:40|min:3',
                'slug_name' => 'required|unique:categories,category_slug',
                'category_level' => ['required', new CategoryLevelRule],
                //'category_image' => 'required|max:4096|mimes:jpeg,png,jpg',
            ],
            [
                'category_name.required' => 'The category name field is missing.',
                'category_name.string' => 'The category name must be a string.',
                'category_name.unique' => 'The category name must be unique.',
                'category_name.min' => 'The category name must be at least 3 characters.',
                'category_name.max' => 'The category name cannot exceed 40 characters.',
                'slug_name.required' => 'Slug name is missing.',
                'slug_name.unique' => 'Slug name should unique.',
                // 'category_image.required' => 'Category image required.',
                // 'category_level.required' => 'Category level required.',
                // 'category_image.mimes' => 'Image must be in the format jpeg,png,jpg.',
                // 'category_image.max' => 'File not larger than 4mb.',
             ]
        );

            $newcategory = new Category;
            $newcategory->category_name = ucfirst(strtolower($request->category_name));
            $newcategory->parent_id = $request->parent_category;
            $newcategory->category_slug = trim($request->slug_name);
            $newcategory->category_level = $request->category_level;
            if($roleid==1){
            $newcategory->approval_status = 'Y';
            $newcategory->approved_by = $userId;
            $newcategory->approved_time = Carbon::now();
            }

            if ($request->hasFile('category_image')) {
                $upload_imgpath = 'uploads/categoryimages/';
                if (!is_dir($upload_imgpath)) {
                    mkdir($upload_imgpath, 0777, true);
                }
                foreach ($request->file('category_image') as $fimg) {
                    if ($fimg->isValid()) {
                        $imgfile_name = time() . '_' . $fimg->getClientOriginalName();
                        $fimg->move($upload_imgpath, $imgfile_name);
                        $imgfilename = $upload_imgpath . $imgfile_name;
                        $newcategory->category_image = $imgfilename;
                    }
                }
            }

            // $newcategory->category_image = '';
            // if (!empty($request->category_image)) {
            //     $fileName = time() . '_' . Str::random(8) . '.' . $request->category_image->extension();
            //     $img = Image::make($request->category_image->path());
            //     $img->fit(config('imageupload.category.thumb_width'), config('imageupload.category.thumb_height'), function ($constraint) {
            //         //$constraint->upsize();
            //     });
            //     $img->save(Storage::disk('public')->path(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') . $fileName), 100);
            //     Storage::disk('public')->put(config('imageupload.categorydir') . "/" . config('imageupload.category.image') . $fileName, File::get($request->category_image));
            //     $newcategory->category_image = $fileName;
            // }
            //$newcategory->category_type = $request->select_type;
            $newcategory->created_by = $userId;
            $newcategory->save();
            $loggedUserIp = $_SERVER['REMOTE_ADDR'];
            $time = date('Y-m-d H:i:s');
            $msg = 'Category Successfully Added. New Category Id is ' . $newcategory->id;

            $LogDetails = new LogDetails();
            $LogDetails->user_id = $request->es_email;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();



            return redirect()->route('list.category')->with('success', 'Category successfully added');
    }
    public function edit_category($category_slug)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $current_category = Category::where('category_slug', $category_slug)->first();
        // $categories = Category::treeWithStatusYandTypeSort($current_category->category_type);
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) use ($category_slug , $current_category) {
            return $category->category_level < $current_category->category_level && $category->category_slug != $category_slug;
        });
        if (!$current_category) {
            return redirect()->route('list.category')->with('error', 'Category not found.');
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

        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.category.editCategory', compact('userdetails', 'loggeduser','current_category','filteredCategories','structuredMenu','selrdetails'));
    }

    public function update_category(Request $request,$id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $current_category = Category::find($id);
        if (!$current_category) {
            return redirect()->route('list.category')->with('error', 'Category not found.');
        }

        $request->validate(
            [
                'category_name' => ['required',Rule::unique('categories')->ignore($id),'string','max:40','min:3'],
                'category_slug' => ['required',Rule::unique('categories')->ignore($id)],
                'category_level' => ['required', new CategoryLevelRule],
                //'category_image' => 'required|max:4096|mimes:jpeg,png,jpg',
                'status' => 'in:Y,N',
            ],
            [
                'category_name.required' => 'The category name field is missing.',
                'category_name.string' => 'The category name must be a string.',
                'category_name.unique' => 'The category name must be unique.',
                'category_name.min' => 'The category name must be at least 3 characters.',
                'category_name.max' => 'The category name cannot exceed 40 characters.',
                'category_slug.required' => 'Slug name is missing.',
                'category_slug.unique' => 'Slug name should unique.',
                'category_level.required' => 'Category level required.',
                // 'category_image.required' => 'Category image required.',
                // 'category_image.mimes' => 'Image must be in the format jpeg,png,jpg.',
                // 'category_image.max' => 'File not larger than 4mb.',
                'status.in' => 'Invalid status value.',
            ]
        );


            $current_category->category_name = ucfirst(strtolower($request->category_name));
            $current_category->parent_id = $request->parent_category;
            $current_category->category_slug = trim($request->category_slug);
            $current_category->category_level = $request->category_level;

            // if (!empty($request->category_image)) {
            //     if ($current_category->category_image != null) {
            //         if (Storage::disk('public')->exists(config('imageupload.categorydir') . "/" . config('imageupload.category.image') .$current_category->category_image)) {
            //             Storage::disk('public')->delete(config('imageupload.categorydir') . "/" . config('imageupload.category.image') . $current_category->category_image);
            //         }
            //         if (Storage::disk('public')->exists(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') .$current_category->category_image)) {
            //             Storage::disk('public')->delete(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') . $current_category->category_image);
            //         }
            //     }
            //     $fileName = time() . '_' . Str::random(8) . '.' . $request->category_image->extension();
            //     $img = Image::make($request->category_image->path());
            //     $img->fit(config('imageupload.category.thumb_width'), config('imageupload.category.thumb_height'), function ($constraint) {
            //         //$constraint->upsize();
            //     });
            //     $img->save(Storage::disk('public')->path(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') . $fileName), 100);
            //     Storage::disk('public')->put(config('imageupload.categorydir') . "/" . config('imageupload.category.image') . $fileName, File::get($request->category_image));
            //     $current_category->category_image = $fileName;
            // }


            if ($request->hasFile('category_image')) {
                $upload_imgpath = 'uploads/categoryimages/';
                if (!is_dir($upload_imgpath)) {
                    mkdir($upload_imgpath, 0777, true);
                }
                foreach ($request->file('category_image') as $fimg) {
                    if ($fimg->isValid()) {
                        $imgfile_name = time() . '_' . $fimg->getClientOriginalName();
                        $fimg->move($upload_imgpath, $imgfile_name);
                        $imgfilename = $upload_imgpath . $imgfile_name;
                        $current_category->category_image = $imgfilename;
                    }
                }
            }
            if($roleid==1 || $roleid==11)
            {$current_category->status = $request->status;}
            //$current_category->category_type = $request->select_type;
            $current_category->save();
            $loggedUserIp = $_SERVER['REMOTE_ADDR'];
            $time = date('Y-m-d H:i:s');
            $msg = 'Category Successfully Updated. Updated Category Id is ' . $id;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $request->es_email;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();

            return redirect()->route('list.category')->with('success', 'Category successfully updated');
    }

    public function delete_category($category_slug)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $delete_category = Category::where('category_slug', $category_slug)->first();

        if (!$delete_category) {
            return redirect()->route('list.category')->with('error', 'Category not found.');
        }

        $delete_category->delete();
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $msg = 'Category Successfully Deleted. Deleted Category slug is ' . $category_slug;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $request->es_email;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();

        return redirect()->route('list.category')->with('success', 'Category deleted successfully.');
    }

    public function approved_category($category_slug)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $current_category = Category::where('category_slug', $category_slug)->first();
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) use ($category_slug , $current_category) {
            return $category->category_level < $current_category->category_level && $category->category_slug != $category_slug;
        });

        if (!$current_category) {
            return redirect()->route('list.category')->with('error', 'Category not found.');
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
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.category.approvedCategory', compact('userdetails', 'loggeduser','current_category','filteredCategories','structuredMenu','selrdetails'));
    }

    public function approvedstatus_category(Request $request,$id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $time = date('Y-m-d H:i:s');
        $current_category = Category::find($id);
        if (!$current_category) {
            return redirect()->route('list.category')->with('error', 'Category not found.');
        }

        $request->validate(
            [
                'category_name' => ['required',Rule::unique('categories')->ignore($id),'string','max:255','min:4'],
                'category_slug' => ['required',Rule::unique('categories')->ignore($id)],
                'category_level' => ['required', new CategoryLevelRule],
                'category_image' => 'nullable|max:4096',
                'status' => 'in:Y,N',
                'categoryapproved' => 'in:Y,N',

            ],
            [
                'category_name.required' => 'The category name field is missing.',
                'category_name.string' => 'The category name must be a string.',
                'category_name.unique' => 'The category name must be unique.',
                'category_name.min' => 'The category name must be at least 4 characters.',
                'category_name.max' => 'The category name cannot exceed 255 characters.',
                'category_slug.required' => 'Slug name is missing.',
                'category_slug.unique' => 'Slug name should unique.',
                'category_level.required' => 'Category level required.',
                // 'category_image.mimes' => 'Image must be in the format jpeg,png,jpg.',
                // 'category_image.max' => 'File not larger than 4mb.',
                'status.in' => 'Invalid status value.',
                'categoryapproved.in' => 'Invalid approved status value.',
            ]
        );
            $current_category->approval_status = $request->categoryapproved;
            $current_category->approved_by = $userId;
            $current_category->approved_time = $time;
            $current_category->save();

            if($request->categoryapproved=='Y')
            {
                $appstatus='Category Successfully Approved';
            }
            else
            {
                $appstatus='Category Not Approved';
            }


            $loggedUserIp = $_SERVER['REMOTE_ADDR'];
            $time = date('Y-m-d H:i:s');
            $msg = 'Category Successfully Approved. Approved Category id is ' . $id;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $request->es_email;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
            return redirect()->route('list.category')->with('success', $appstatus);
    }

    public function AdmCategoryApprovedAll(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $categoryid = $request->input('categoryid');
        $categoryid_id = explode('#', $categoryid);
        //echo "<pre>";print_r($categoryid_id);exit;
        $toregIDCount = count($categoryid_id);
        $flg = 0;
        for ($i = 1; $i < $toregIDCount; $i++) {
                $categoryidexplode = $categoryid_id[$i];
                $categoryuser=explode('*',$categoryidexplode);
                $categoryuserid=$categoryuser[0];
                $Category = Category::find($categoryuserid);
                if($Category->approval_status == 'R') {
                }
                else{
                    $Category->approval_status = 'Y';
                    $Category->approved_by = $userId;
                    $Category->approved_time = $time;
                    $Category->save();
                    $flg = 1;
                }
            }

        $msg = 'Category Successfully Approved';
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();

        if ($flg == 1) {
            return response()->json(['result' => 1, 'mesge' => 'Category Successfully Approved']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Not Approved']);
        }
    }

}

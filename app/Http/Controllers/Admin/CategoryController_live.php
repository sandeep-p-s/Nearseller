<?php

namespace App\Http\Controllers\Admin;

use DB;
use File;
use Image;
use Storage;
use Carbon\Carbon;
use App\Models\LogDetails;
use App\Models\MenuMaster;
use App\Models\UserAccount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\admin\Category;
use Illuminate\Validation\Rule;
use App\Rules\CategoryLevelRule;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function list_category()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $categories = Category::tree();
        $total_categories = DB::table('categories')->count();
        $inactive_categories = DB::table('categories as c')->where('c.status', 'N')->count();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.category.listCategory', compact('loggeduser', 'userdetails', 'categories', 'total_categories', 'inactive_categories', 'structuredMenu'));
    }
    public function add_category()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
        });
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.category.addCategory', compact('loggeduser', 'userdetails', 'filteredCategories', 'structuredMenu'));
    }

    public function parent_category($typeValue)
    {
        $categories = Category::treeWithStatusOnchange($typeValue);
        $filteredCategories = $categories->filter(function ($category) {
            return $category->category_level != 5;
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
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $request->validate(
            [
                'select_type' => 'required|in:1,2',
                'category_name' => 'required|unique:categories,category_name|string|max:255|min:4',
                'slug_name' => 'required|unique:categories,category_slug',
                'category_level' => ['required', new CategoryLevelRule],
                'category_image' => 'nullable|max:4096',
            ],
            [
                'select_type.required' => 'Please select type of category.',
                'select_type.in' => 'Please select type of category.',
                'category_name.required' => 'The category name field is missing.',
                'category_name.string' => 'The category name must be a string.',
                'category_name.unique' => 'The category name must be unique.',
                'category_name.min' => 'The category name must be at least 4 characters.',
                'category_name.max' => 'The category name cannot exceed 255 characters.',
                'slug_name.required' => 'Slug name is missing.',
                'slug_name.unique' => 'Slug name should unique.',
                'category_level.required' => 'Category level required.',
                'category_image.mimes' => 'Image must be in the format jpeg,png,jpg.',
                'category_image.max' => 'File not larger than 4mb.',
            ]
        );

        $newcategory = new Category;
        $newcategory->category_name = ucfirst(strtolower($request->category_name));
        $newcategory->parent_id = $request->parent_category;
        $newcategory->category_slug = trim($request->slug_name);
        $newcategory->category_level = $request->category_level;
        if ($roleid == 1) {
            $newcategory->approval_status = 'Y';
            $newcategory->approved_by = $userId;
            $newcategory->approved_time = Carbon::now();
        }
        $newcategory->category_image = '';

        if (!empty($request->category_image)) {

            $fileName = time() . '_' . Str::random(8) . '.' . $request->category_image->extension();

            $img = Image::make($request->category_image->path());
            $img->fit(config('imageupload.category.thumb_width'), config('imageupload.category.thumb_height'), function ($constraint) {
                //$constraint->upsize();
            });
            $img->save(Storage::disk('public')->path(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') . $fileName), 100);

            Storage::disk('public')->put(config('imageupload.categorydir') . "/" . config('imageupload.category.image') . $fileName, File::get($request->category_image));

            $newcategory->category_image = $fileName;
        }
        $newcategory->category_type = $request->select_type;
        $newcategory->created_by = $userId;
        $newcategory->save();
        $lastid = $newcategory->id;

        $msg = 'New Category created. Created ID is ' . $lastid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
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
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $current_category = Category::where('category_slug', $category_slug)->first();
        $categories = Category::treeWithStatusYandTypeSort($current_category->category_type);
        $filteredCategories = $categories->filter(function ($category) use ($category_slug, $current_category) {
            return $category->category_level < $current_category->category_level && $category->category_slug != $category_slug;
        });

        if (!$current_category) {
            return redirect()->route('list.category')->with('error', 'Category not found.');
        }
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.category.editCategory', compact('userdetails', 'loggeduser', 'current_category', 'filteredCategories', 'structuredMenu'));
    }

    public function update_category(Request $request, $id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $current_category = Category::find($id);
        if (!$current_category) {
            return redirect()->route('list.category')->with('error', 'Category not found.');
        }

        $request->validate(
            [
                'category_name' => ['required', Rule::unique('categories')->ignore($id), 'string', 'max:255', 'min:4'],
                'category_slug' => ['required', Rule::unique('categories')->ignore($id)],
                'category_level' => ['required', new CategoryLevelRule],
                'category_image' => 'nullable|max:4096',
                'status' => 'in:Y,N',
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
                'category_image.mimes' => 'Image must be in the format jpeg,png,jpg.',
                'category_image.max' => 'File not larger than 4mb.',
                'status.in' => 'Invalid status value.',
            ]
        );

        $current_category->category_name = ucfirst(strtolower($request->category_name));
        $current_category->parent_id = $request->parent_category;
        $current_category->category_slug = trim($request->category_slug);
        $current_category->category_level = $request->category_level;

        if (!empty($request->category_image)) {

            if ($current_category->category_image != null) {
                if (Storage::disk('public')->exists(config('imageupload.categorydir') . "/" . config('imageupload.category.image') . $current_category->category_image)) {
                    Storage::disk('public')->delete(config('imageupload.categorydir') . "/" . config('imageupload.category.image') . $current_category->category_image);
                }
                if (Storage::disk('public')->exists(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') . $current_category->category_image)) {
                    Storage::disk('public')->delete(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') . $current_category->category_image);
                }
            }

            $fileName = time() . '_' . Str::random(8) . '.' . $request->category_image->extension();

            $img = Image::make($request->category_image->path());
            $img->fit(config('imageupload.category.thumb_width'), config('imageupload.category.thumb_height'), function ($constraint) {
                //$constraint->upsize();
            });
            $img->save(Storage::disk('public')->path(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') . $fileName), 100);

            Storage::disk('public')->put(config('imageupload.categorydir') . "/" . config('imageupload.category.image') . $fileName, File::get($request->category_image));

            $current_category->category_image = $fileName;
        }

        $current_category->status = $request->status;

        $current_category->save();
        $lastid = $current_category->id;

        $msg = 'Category Updated. Updated ID is ' . $lastid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
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

        return redirect()->route('list.category')->with('success', 'Category deleted successfully.');
    }

    public function approved_category($category_slug)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $current_category = Category::where('category_slug', $category_slug)->first();
        $categories = Category::treeWithStatusY();
        $filteredCategories = $categories->filter(function ($category) use ($category_slug, $current_category) {
            return $category->category_level < $current_category->category_level && $category->category_slug != $category_slug;
        });

        if (!$current_category) {
            return redirect()->route('list.category')->with('error', 'Category not found.');
        }
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.category.approvedCategory', compact('userdetails', 'loggeduser', 'current_category', 'filteredCategories', 'structuredMenu'));
    }

    public function approvedstatus_category(Request $request, $id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $current_category = Category::find($id);
        if (!$current_category) {
            return redirect()->route('list.category')->with('error', 'Category not found.');
        }

        $request->validate(
            [
                'category_name' => ['required', Rule::unique('categories')->ignore($id), 'string', 'max:255', 'min:4'],
                'category_slug' => ['required', Rule::unique('categories')->ignore($id)],
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
                'category_image.mimes' => 'Image must be in the format jpeg,png,jpg.',
                'category_image.max' => 'File not larger than 4mb.',
                'status.in' => 'Invalid status value.',
                'categoryapproved.in' => 'Invalid approved status value.',
            ]
        );

        $current_category->category_name = ucfirst(strtolower($request->category_name));
        $current_category->parent_id = $request->parent_category;
        $current_category->category_slug = trim($request->category_slug);
        $current_category->category_level = $request->category_level;

        if (!empty($request->category_image)) {

            if ($current_category->category_image != null) {
                if (Storage::disk('public')->exists(config('imageupload.categorydir') . "/" . config('imageupload.category.image') . $current_category->category_image)) {
                    Storage::disk('public')->delete(config('imageupload.categorydir') . "/" . config('imageupload.category.image') . $current_category->category_image);
                }
                if (Storage::disk('public')->exists(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') . $current_category->category_image)) {
                    Storage::disk('public')->delete(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') . $current_category->category_image);
                }
            }

            $fileName = time() . '_' . Str::random(8) . '.' . $request->category_image->extension();

            $img = Image::make($request->category_image->path());
            $img->fit(config('imageupload.category.thumb_width'), config('imageupload.category.thumb_height'), function ($constraint) {
                //$constraint->upsize();
            });
            $img->save(Storage::disk('public')->path(config('imageupload.categorydir') . "/" . config('imageupload.category.imagethumb') . $fileName), 100);

            Storage::disk('public')->put(config('imageupload.categorydir') . "/" . config('imageupload.category.image') . $fileName, File::get($request->category_image));

            $current_category->category_image = $fileName;
        }

        $current_category->status = $request->status;
        $current_category->approval_status = $request->categoryapproved;
        $current_category->approved_by = $userId;
        $current_category->approved_time = $time;
        $current_category->save();

        $lastid = $current_category->id;
        if ($current_category->approval_status == 'Y') {
            $msg = 'Category Aproved. Aproved ID is ' . $lastid;
        } else {
            $msg = 'Category Not Aproved. Not Aproved ID is ' . $lastid;
        }
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();

        return redirect()->route('list.category')->with('success', 'Category successfully Approved');
    }
}
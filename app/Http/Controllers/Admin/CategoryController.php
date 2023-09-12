<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\admin\Category;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function list_category()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $categories = DB::select("
    WITH RECURSIVE category_tree AS (
        SELECT
            id,
            name,
            parent_id,
            status,
            name AS category_path,
            0 AS level
        FROM
            categories
        WHERE
            parent_id = 0

        UNION ALL

        SELECT
            c.id,
            c.name,
            c.parent_id,
            c.status,  -- Add the 'status' column here
            CONCAT(ct.category_path, ' > ', c.name) AS category_path,
            ct.level + 1 AS level
        FROM
            categories AS c
        JOIN
            category_tree AS ct ON c.parent_id = ct.id
    )

    SELECT
        id AS child_id,
        name AS child_name,
        parent_id AS child_parent_id,
        status AS child_status,
        category_path AS parent_name,
        level
    FROM
        category_tree
    ORDER BY
        category_path;
");

        $total_categories = DB::table('categories')->count();
        $inactive_categories = DB::table('categories as c')->where('c.status', 'N')->count();
        return view('admin.category.listCategory', compact('loggeduser', 'userdetails', 'categories', 'total_categories', 'inactive_categories'));
    }
    public function add_category()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        // $categories = DB::table('categories as child_c','categories as parent_c')
        //     ->select(
        //         'child_c.id as child_id',
        //         'child_c.name as child_name',
        //         'child_c.parent_id as child_parent_id',
        //         'child_c.status as child_status',
        //         'parent_c.id as parent_id',
        //         'parent_c.name as parent_name',
        //         'parent_c.parent_id as parent_parent_id',
        //         'parent_c.status as parent_status'
        //     )
        //     ->where('parent_c.status', 'Y');
        //     // ->get();
        // $sql = $categories->toSql();
        // dd($sql);
        $categories = DB::select("
    WITH RECURSIVE category_tree AS (
      SELECT
        id,
        name,
        parent_id,
        name AS category_path,
        0 AS level -- Initialize the level as 0 for root categories
      FROM
        categories
      WHERE
      parent_id = 0
      AND status = 'Y'

      UNION ALL

      SELECT
        c.id,
        c.name,
        c.parent_id,
        CONCAT(ct.category_path, ' > ', c.name) AS category_path,
        ct.level + 1 AS level -- Increment the level for child categories
      FROM
        categories AS c
      JOIN
        category_tree AS ct ON c.parent_id = ct.id
        WHERE
        c.status = 'Y'
    )
    SELECT
      id AS child_id,
      name AS child_name,
      parent_id AS child_parent_id,
      status AS child_status,
      category_path AS parent_name,
      level -- Include the level column
    FROM
      category_tree
    ORDER BY
      category_path;
    ");

        return view('admin.category.addCategory', compact('loggeduser', 'userdetails', 'categories'));
    }
    public function store_category(Request $request)
    {
        // $request->validate(
        //     [
        //         'category_name' => 'required|unique:categories,name|string|max:255|min:4',
        //         'slug_name' => 'required|unique:categories,slug',
        //     ],
        //     [
        //         'category_name.required' => 'The category name field is missing.',
        //         'category_name.string' => 'The category name must be a string.',
        //         'category_name.unique' => 'The category name must be unique.',
        //         'category_name.min' => 'The category name must be at least 4 characters.',
        //         'category_name.max' => 'The category name cannot exceed 255 characters.',
        //     ]
        // );

        $maxdepth = 5;
        $check = 0;

        $request->validate([
            'category_name' => 'required|string|max:255|min:4',
            'slug_name' => 'required|unique:categories,slug',
            'parent_category' => [
                'required',
                function ($attribute, $value) use ($maxdepth) {
                    if ($value != 0) {
                        $parentCategory = Category::find($value);
                        if (!$parentCategory) {
                            //$fail = 'Invalid parent category selected.';
                            return redirect()->route('list.category')->with('error', "Invalid parent category selected.");
                            exit;
                        } else {
                            // Calculate the depth of the parent category's hierarchy
                            $depth = 1;
                            $currentParent = $parentCategory;
                            while ($currentParent->parent_id !== 0) {
                                $currentParent = Category::find($currentParent->parent_id);
                                $depth++;
                            }

                            if ($depth > 5) {
                                return redirect()->route('list.category')->with('error', "You can't add subcategories beyond 5 levels.");
                                $check = 1;
                                exit;
                                //$fail = "You can't add subcategories beyond 5 levels.";
                            }
                        }
                    }
                },
            ],
        ], [
            'category_name.required' => 'The category name field is missing.',
            'category_name.string' => 'The category name must be a string.',
            'category_name.min' => 'The category name must be at least 4 characters.',
            'category_name.max' => 'The category name cannot exceed 255 characters.',
            'slug_name.required' => 'The slug field is missing.',
            'slug_name.unique' => 'The slug must be unique.',
            'parent_category.required' => 'Please select a parent category.',
        ]);

        if ($check = 1) {
            $newcategory = new Category;
            $newcategory->name = ucfirst(strtolower($request->category_name));
            $newcategory->parent_id = $request->parent_category;
            $newcategory->slug = $request->slug_name;
            $newcategory->save();
            return redirect()->route('list.category')->with('success', 'Category successfully added');
        } else {
            return redirect()->route('list.category')->with('error', 'Error in Data');
        }
    }
    public function edit_category($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countries = DB::table('country as ct')
        ->where('ct.status','Y')
        ->get();
        $category = category::find($id);

        if (!$category) {
            return redirect()->route('list.category')->with('error', 'category not found.');
        }

        return view('admin.masters.category.editcategory', compact('userdetails', 'loggeduser','countries', 'category'));
    }
}

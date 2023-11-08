<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    use HasFactory;

    public static function countStatusY()
    {
        $allCategories = DB::table('categories as c')->where('c.status', 'Y')->count();

        return $allCategories;
    }


    public static function tree()
    {
        $allCategories = DB::table('categories')->get();  // Get all categories

        $rootCategories = $allCategories->where('parent_id', '0');

        // Create a new collection to store the modified categories
        $formattedCategories = collect();

        self::formatTree($rootCategories, $allCategories, '', $formattedCategories, 0); // Start at level 0

        $sortedCategories = $formattedCategories->sortBy('parent_id');

        return $sortedCategories;
    }

    public static function treeWithStatusY()
    {
        $allCategories = DB::table('categories')->where('status', 'Y')->where('approval_status', 'Y')->get(); // Get active categories
        $rootCategories = $allCategories->where('parent_id', '0');

        // Create a new collection to store the modified categories
        $formattedCategories = collect();

        self::formatTree($rootCategories, $allCategories, '', $formattedCategories, 0); // Start at level 0

        $sortedCategories = $formattedCategories->sortBy('parent_id');

        return $sortedCategories;
    }

    public static function treeWithStatusYandTypeSort($category_type)
    {
        $allCategories = DB::table('categories')->where('status', 'Y')->where('approval_status', 'Y')->where('category_type', $category_type)->get(); // Get active categories
        $rootCategories = $allCategories->where('parent_id', '0');

        // Create a new collection to store the modified categories
        $formattedCategories = collect();

        self::formatTree($rootCategories, $allCategories, '', $formattedCategories, 0); // Start at level 0

        $sortedCategories = $formattedCategories->sortBy('parent_id');

        return $sortedCategories;
    }

    public static function treeWithStatusOnchange($typeValue)
    {
        $allCategories = DB::table('categories')->where('status', 'Y')->where('approval_status', 'Y')->get(); // Get active categories
        $rootCategories = $allCategories->where('parent_id', '0')->where('category_type',$typeValue);

        // Create a new collection to store the modified categories
        $formattedCategories = collect();

        self::formatTree($rootCategories, $allCategories, '', $formattedCategories, 0); // Start at level 0

        $sortedCategories = $formattedCategories->sortBy('parent_id');

        return $sortedCategories;
    }

    public static function treeWithautocomplete($searchTerm)
    {
        $allCategories = DB::table('categories')->select('categories.*')->where('category_name', 'like', '%' . $searchTerm.'%')->get();
        foreach($allCategories as $parent)
            {
                $parent_id=$parent->parent_id;
                $rootCategories = $allCategories->where('parent_id', $parent_id);
            }
        //echo "<pre>";print_r($allCategories);exit;
        $formattedCategories = collect();
        self::formatTree($rootCategories, $allCategories, '', $formattedCategories, 0);
        $sortedCategories = $formattedCategories->sortBy('parent_id');
        return $sortedCategories;
    }

    private static function formatTree($categories, $allCategories, $prefix, $formattedCategories, $category_level)
    {
        foreach ($categories as $category) {
            $categoryPath = $prefix . $category->category_name;
            // Add the formatted category to the collection, including the "level"
            $formattedCategories->push((object)[
                'category_name' => $categoryPath,
                'status' => $category->status,
                'id' => $category->id,
                'category_slug' => $category->category_slug,
                'parent_id' => $category->parent_id,
                'category_level' => $category_level,
                'approval_status' => $category->approval_status,
                'created_by' => $category->created_by,
                // 'category_type' => $category->category_type
            ]);
            $category->children = $allCategories->where('parent_id', $category->id)->values();
            if ($category->children->isNotEmpty() && $category->status == 'Y' && $category->approval_status == 'Y') {
                self::formatTree($category->children, $allCategories, $categoryPath . ' ➤ ', $formattedCategories, $category_level + 1); // Increment the level
            }
        }

    }
}

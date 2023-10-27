<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\MenuMaster;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Illuminate\Validation\Rule;
use App\Models\ServiceSubCategory;
use App\Http\Controllers\Controller;

class ServiceCategoryController extends Controller
{
    public function list_service_category()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $servicecategory = DB::table('service_categories as sc')
        ->join('business_type as bt', 'sc.business_type_id', '=', 'bt.id')
        ->select('sc.*', 'bt.business_name')
        ->orderBy('sc.service_category_name', 'asc')
        ->get();
        $total_servicecategories = DB::table('service_categories')->count();
        $inactive_servicecategories = DB::table('service_categories as sc')->where('sc.status','N')->count();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.service_category.list', compact('servicecategory','loggeduser','userdetails','total_servicecategories','inactive_servicecategories','structuredMenu'));
    }

    public function add_service_category()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $businesstype = DB::table('business_type as bt')
        ->where('bt.status','Y')
        ->get();
        return view('admin.masters.service_category.add',compact('loggeduser','userdetails','structuredMenu','businesstype'));
    }

    public function store_service_category(Request $request)
    {
        $request->validate([
            'service_category_name' => 'required|string|min:5|max:50',
            'business_name' => 'required|not_in:0',
        ],
        [
            'service_category_name.required' => 'The service category name field is required.',
            'service_category_name.min' => 'The service category name must be at least 5 characters.',
            'service_category_name.max' => 'The service category name cannot exceed 50 characters.',
            'service_category_name.unique' => 'This service category name is already in use.',
            'business_name.not_in' => 'Please select a Business Type in the list.',

        ]);

        $servicecategory = new ServiceCategory;
        $servicecategory->service_category_name = ucfirst($request->service_category_name);
        $servicecategory->business_type_id = $request->business_name;
        $servicecategory->save();

        return redirect()->route('list.servicecategory')->with('success', 'Service Category added successfully.');
    }

    public function edit_service_category($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $servicecategory = ServiceCategory::find($id);
        $businesstype = DB::table('business_type as bt')
        ->where('bt.status','Y')
        ->get();
        if (!$servicecategory) {
            return redirect()->route('list.servicecategory')->with('error', 'Service Category not found.');
        }

        return view('admin.masters.service_category.edit', compact('servicecategory','loggeduser','userdetails','structuredMenu','businesstype'));
    }

    public function update_service_category(Request $request, $id)
    {
        $servicecategory = ServiceCategory::find($id);
        if (!$servicecategory) {
            return redirect()->route('list.servicecategory')->with('error', 'Service Category not found.');
        }

        $request->validate([
            'service_category_name' => ['required','regex:/^[A-Za-z\s]+$/','min:5','max:50',Rule::unique('service_categories')->ignore($id)],
            'business_name' => 'required|not_in:0',
        ],
        [
            'service_category_name.required' => 'The service category name field is required.',
            'service_category_name.min' => 'The service category name must be at least 5 characters.',
            'service_category_name.max' => 'The service category name cannot exceed 50 characters.',
            'service_category_name.unique' => 'This service category name is already in use.',
            'business_name.not_in' => 'Please select a Business Type in the list.',

        ]);

        $servicecategory->service_category_name = ucfirst($request->service_category_name);
        $servicecategory->business_type_id = $request->business_name;
        if ($request->status === 'Active')
        {
            $servicecategory->status = 'Y';
        } else {
            $servicecategory->status = 'N';
        }
        $servicecategory->save();

        return redirect()->route('list.servicecategory')->with('success', 'Service Category updated successfully.');
    }

    public function delete_service_category($id)
    {
        $servicecategory = ServiceCategory::find($id);

        if (!$servicecategory) {
            return redirect()->route('list.servicecategory')->with('error', 'Service Category not found.');
        }

        $servicecategory->delete();

        return redirect()->route('list.servicecategory')->with('success', 'Service Category deleted successfully.');
    }

    public function list_service_subcategory()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $servicesubcategory = DB::table('service_sub_categories as ssc')
        ->join('service_categories as sc', 'ssc.service_category_id', '=', 'sc.id')
        ->select('ssc.*', 'sc.service_category_name')
        ->get();
        $total_servicesubcategories = DB::table('service_sub_categories')->count();
        $inactive_servicesubcategories = DB::table('service_sub_categories as ssc')->where('ssc.status','N')->count();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.service_subcategory.list', compact('servicesubcategory','loggeduser','userdetails','total_servicesubcategories','inactive_servicesubcategories','structuredMenu'));
    }

    public function add_service_subcategory()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $servicecategory = DB::table('service_categories as sc')
        ->where('sc.status','Y')
        ->get();
        return view('admin.service_subcategory.add',compact('loggeduser','userdetails','structuredMenu','servicecategory'));
    }

    public function store_service_subcategory(Request $request)
    {
        $request->validate([
            'service_subcategory_name' => 'required|string|max:255',
        ]);

        $servicecategory = new ServiceSubCategory;
        $servicecategory->sub_category_name = $request->service_subcategory_name;
        $servicecategory->service_category_id = $request->service_category_name;
        $servicecategory->save();

        return redirect()->route('list.servicesubcategory')->with('success', 'Service Sub Category added successfully.');
    }

    public function edit_service_subcategory($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $servicesubcategory = ServiceSubCategory::find($id);
        $servicecategory = DB::table('service_categories as sc')
        ->where('sc.status','Y')
        ->get();
        if (!$servicecategory) {
            return redirect()->route('list.servicesubcategory')->with('error', 'Service Sub Category not found.');
        }

        return view('admin.service_subcategory.edit', compact('servicesubcategory','loggeduser','userdetails','structuredMenu','servicecategory'));
    }

    public function update_service_subcategory(Request $request, $id)
    {
        $servicesubcategory = ServiceSubCategory::find($id);
        if (!$servicesubcategory) {
            return redirect()->route('list.servicesubcategory')->with('error', 'Service Sub Category not found.');
        }

        $request->validate([
            'service_subcategory_name' => 'required|string|min:5|max:255',
        ]);

        $servicesubcategory->sub_category_name = $request->service_subcategory_name;
        $servicesubcategory->service_category_id = $request->service_category_name;
        if ($request->status === 'Active')
        {
            $servicesubcategory->status = 'Y';
        } else {
            $servicesubcategory->status = 'N';
        }
        $servicesubcategory->save();

        return redirect()->route('list.servicesubcategory')->with('success', 'Service Sub Category updated successfully.');
    }

    public function delete_service_subcategory($id)
    {
        $servicesubcategory = ServiceSubCategory::find($id);

        if (!$servicesubcategory) {
            return redirect()->route('list.servicesubcategory')->with('error', 'Service Sub Category not found.');
        }

        $servicesubcategory->delete();

        return redirect()->route('list.servicesubcategory')->with('success', 'Service Sub Category deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\Masters;

use DB;
use App\Models\MenuMaster;
use App\Models\ServiceType;
use App\Models\User;
use App\Models\LogDetails;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ServiceTypeController extends Controller
{
    public function list_service_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $servicetype = DB::table('service_types as srt')
        ->join('business_type as bt', 'srt.business_type_id', '=', 'bt.id')
        ->select('srt.*', 'bt.business_name')
        ->orderBy('srt.service_name', 'asc')
        ->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        return view('admin.masters.service_type.list', compact('servicetype','userdetails','loggeduser','structuredMenu'));
    }

    public function add_service_type()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $businesstype = DB::table('business_type as bt')
        ->where('bt.status','Y')
        ->get();
        return view('admin.masters.service_type.add',compact('loggeduser','userdetails','structuredMenu','businesstype'));
    }

    public function store_service_type(Request $request)
    {
        $request->validate(
        [
            'service_name' => 'required|regex:/^[A-Za-z\s]+$/|min:3|max:60|unique:service_types',
            'business_name' => 'required|not_in:0',
        ],
        [
            'service_name.required' => 'The service name field is required.',
            'service_name.regex' => 'The service name must contain only letters and spaces.',
            'service_name.min' => 'The service name must be at least 3 characters.',
            'service_name.max' => 'The service name cannot exceed 60 characters.',
            'service_name.unique' => 'This service name is already in use.',
            'business_name.not_in' => 'Please select a Business Type in the list.',

        ]);

        $servicetype = new ServiceType;
        $servicetype->service_name = ucwords($request->service_name);
        $servicetype->business_type_id = $request->business_name;
        $servicetype->save();

        return redirect()->route('list.servicetype')->with('success', 'Service Type added successfully.');
    }

    public function edit_service_type($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $businesstype = DB::table('business_type as bt')
        ->where('bt.status','Y')
        ->get();
        $servicetype = ServiceType::find($id);

        if (!$servicetype) {
            return redirect()->route('list.servicetype')->with('error', 'Service Type not found.');
        }

        return view('admin.masters.service_type.edit', compact('servicetype','loggeduser','userdetails','structuredMenu','businesstype'));
    }

    public function update_service_type(Request $request, $id)
    {
        $servicetype = ServiceType::find($id);
        if (!$servicetype) {
            return redirect()->route('list.servicetype')->with('error', 'Service Type not found.');
        }

        $request->validate(
            [
                'service_name' => ['required','regex:/^[A-Za-z\s]+$/','min:3','max:60',Rule::unique('service_types')->ignore($id)],
                'business_name' => 'required|not_in:0',
            ],
            [
                'service_name.required' => 'The service name field is required.',
                'service_name.regex' => 'The service name must contain only letters and spaces.',
                'service_name.min' => 'The service name must be at least 3 characters.',
                'service_name.max' => 'The service name cannot exceed 60 characters.',
                'business_name.not_in' => 'Please select a Business Type in the list.',
                'service_name.unique' => 'This service name is already in use.',

            ]);

        $servicetype->service_name = ucfirst($request->service_name);
        $servicetype->business_type_id = $request->business_name;
        if ($request->status === 'Active')
        {
            $servicetype->status = 'Y';
        } else {
            $servicetype->status = 'N';
        }
        $servicetype->save();

        return redirect()->route('list.servicetype')->with('success', 'Service Type updated successfully.');
    }

    public function delete_service_type($id)
    {
        $servicetype = ServiceType::find($id);

        if (!$servicetype) {
            return redirect()->route('list.servicetype')->with('error', 'Service Type not found.');
        }

        $servicetype->delete();

        return redirect()->route('list.servicetype')->with('success', 'Service Type deleted successfully.');
    }



    function ServiceProviderApproval($typeid)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails = DB::table('users')
            ->where('id', $userId)
            ->get();
        if ($typeid == 1) {
            $shoporservice = 'Seller';
        } elseif ($typeid == 2) {
            $shoporservice = 'Services';
        } else {
            return redirect()->route('logout');
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
        $allsectdetails = MenuMaster::AllSecrtorDetails($userId, $roleid);
        return view('admin.sellerproviderapproval', compact('userdetails', 'userRole', 'loggeduser', 'shoporservice', 'typeid', 'structuredMenu', 'allsectdetails','selrdetails'));
    }


    function AllSellerProviderList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $typeid = $request->input('typeid');
        $query = ServiceType::select('service_types.*');
        $roleIdsArray = explode(',', $roleid);
        $checkcountusers=count($roleIdsArray);
        if($checkcountusers==1)
        {
        if ($typeid == 1) {
            $query->where('service_types.business_type_id', $typeid);
        }
        if ($typeid == 2) {
            $query->where('service_types.business_type_id', $typeid);
        }
        }
        else{

        }
        //$perPage = 5; // Number of records per page
        //$ServiceType = $query->paginate($perPage);

        $ServiceType = $query->get();
        //echo $lastRegId = $query->toSql();
        $sellerCount = $ServiceType->count();
        if ($typeid == 1) {
            $shoporservice = 'Seller';
        } elseif ($typeid == 2) {
            $shoporservice = 'Services';
        }
        $queryactivecounts = ServiceType::select([
            DB::raw('SUM(CASE WHEN status = "Y" THEN 1 ELSE 0 END) AS user_status_y_count'),
            DB::raw('SUM(CASE WHEN status != "Y" THEN 1 ELSE 0 END) AS user_status_not_y_count'),
        ])->where('business_type_id', $typeid);
        $activecounts = $queryactivecounts->first();
        //echo $lastRegId = $queryactivecounts->toSql();
        return view('admin.sellerprovider_dets', compact('ServiceType', 'sellerCount', 'shoporservice', 'typeid','activecounts'));
    }


    public function SellerServiceProviderApprovedAll(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $shopid = $request->input('shopid');
        $shopid_userid = explode('#', $shopid);
        $toregIDCount = count($shopid_userid);
        $flg = 0;
        for ($i = 1; $i < $toregIDCount; $i++) {
                $shopidexplode = $shopid_userid[$i];
                $shops_user=explode('*',$shopidexplode);
                $shopserviceid=$shops_user[0];
                $ServiceType = ServiceType::find($shopserviceid);
                if($ServiceType->status == 'R') {
                }
                else{
                    $ServiceType->status = 'Y';
                    $ServiceType->save();
                    $flg = 1;
                }
            }

        $msg = 'Shop and Service Successfully Approved!';
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();

        if ($flg == 1) {
            return response()->json(['result' => 1, 'mesge' => 'Successfully Approved']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Not Approved']);
        }
    }
    function AdmsellerserviceApproved(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $id = $request->input('shopid');
        $typeid = $request->input('typeid');
        $query = ServiceType::select('service_types.*');
        $query->where('service_types.id', $id);
        $roleIdsArray = explode(',', $roleid);
        $checkcountusers=count($roleIdsArray);
        if($checkcountusers==1)
        {
        if ($typeid == 1) {
            $query->where('service_types.business_type_id', $typeid);
        }
        if ($typeid == 2) {
            $query->where('service_types.business_type_id', $typeid);
        }
        }
        else{

        }
        $ServiceType = $query->first();
        //echo $lastRegId = $query->toSql();
        if ($typeid == 1) {
            $shoporservice = 'Seller';
        } elseif ($typeid == 2) {
            $shoporservice = 'Services';
        }

        return view('admin.sellerservice_approved_dets', compact('ServiceType', 'shoporservice', 'typeid'));
    }

    function AdmsellerProviderApprovedPage(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $validatedData = $request->validate([
            'serviceprovider_name' => 'required|max:50',
            'approvedstatus' => 'required|max:1',
        ]);
        $shopid = $request->shopidhidapp;
        $Sellercheck = ServiceType::find($shopid);
        if($Sellercheck->business_type_id=='1')
            {
                $shoporservice='Seller';
            }
            else if($Sellercheck->business_type_id=='2')
            {
                $shoporservice='Service';
            }
            else{
                $shoporservice='';
            }
            $Sellercheck->service_name = $request->serviceprovider_name;
            $Sellercheck->status = $request->approvedstatus;
            $Sellercheck->updated_at = $time;
            $submt = $Sellercheck->save();
            $msg = 'Aprroved Status =  ' . $request->approvedstatus . ' ' .$shoporservice.' provider type updated id : ' . $shopid.' Provider Name '.$request->serviceprovider_name;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $userId;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
    }






}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
use App\Models\User;
use App\Models\LogDetails;
use App\Models\SellerDetails;
use App\Models\Affiliate;
use App\Models\ServiceType;
use App\Models\MenuMaster;
use App\Models\ServiceDetails;
use App\Models\ServiceAppointment;
use App\Models\NotAvailableDate;
use App\Models\AppointmentAvailableDayTime;
use App\Models\SetQuestion;
use App\Models\AddServiceAttribute;
use App\Models\admin\Category;
use Image;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;

class ServiceNewController extends Controller
{
    function ServiceProductListView($serviceid)
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
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray)))
        {
            $selrdetails = DB::table('seller_details')->select('busnes_type','term_condition')
            ->where('user_id', $userId)
            ->where('id', $serviceid)
            ->first();
        }
        else{
            $selrdetails = DB::table('seller_details')->select('busnes_type','term_condition')
            ->where('id', $serviceid)
            ->first();
        }
        return view('serviceproduct.productlist', compact('userdetails', 'userRole', 'loggeduser', 'structuredMenu','selrdetails','serviceid'));
    }

    function ServiceProductListViewApp()
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
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $roleIdsArray = explode(',', $roleid);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray)))
        {
            $selrdetails = DB::table('seller_details')->select('busnes_type','term_condition')
            ->where('user_id', $userId)
            ->where('id', $serviceid)
            ->first();
        }
        else{
            $selrdetails = '';
        }
        $serviceid='';
        return view('serviceproduct.productlist', compact('userdetails', 'userRole', 'loggeduser', 'structuredMenu','selrdetails','serviceid'));
    }


    function AdmShopNameSearch(Request $request)
    {
        $shopname = $request->input('shopname');
        // $User = ProductDetails::select('users.id', 'users.name as shopname')
        //     ->leftJoin('users', 'users.id', 'product_details.shop_id')
        //     ->where('users.name', 'LIKE', $shopname . '%')->distinct()
        //     ->get();
        $User = User::select('id', 'name as shopname')
            ->where('name', 'LIKE', $shopname . '%')
            ->distinct()
            ->get();
        //echo $lastRegId = $User->toSql();exit;
        header('Content-Type: application/json');
        echo json_encode($User);
    }


    function ExistproductviewPage(Request $request)
    {
        $existprodid = $request->input('existprodid');
        $ProductDetails = ProductDetails::find($existprodid);
        //echo $lastRegId = $User->toSql();exit;
        return response()->json(['result' => 3, 'mesge' => 'Total stock and attribute stock must be equal.']);
    }

    function AllServiceProductList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $servcid = $request->input('servcid');
        $query = ServiceDetails::select('service_details.*', 'seller_details.shop_name as shopname')
        ->leftJoin('seller_details', 'seller_details.id', 'service_details.service_provider_id');

        if ($roleid == 1  || $roleid == 11) {
        } else {
            $query->where('seller_details.user_id', $userId);
        }
        if($servcid!=''){
        $query->where('service_details.service_provider_id', $servcid);}
        $query->orderBy('service_details.service_name');
        $ServiceDetails = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $ProductCount = $ServiceDetails->count();
        //$userservicedets = DB::select("SELECT id,name FROM users WHERE FIND_IN_SET('9', role_id)");

        $userservicedets=$servcid;
        $queryapprovedcounts = ServiceDetails::select([

            DB::raw('SUM(CASE WHEN service_status = "Y" THEN 1 ELSE 0 END) AS prod_status_y_count'),
            DB::raw('SUM(CASE WHEN service_status != "Y" THEN 1 ELSE 0 END) AS prod_status_not_y_count'),
            DB::raw('SUM(CASE WHEN is_approved = "Y" THEN 1 ELSE 0 END) AS approved_y_count'),
            DB::raw('SUM(CASE WHEN is_approved = "N" THEN 1 ELSE 0 END) AS approved_not_y_count'),
            DB::raw('SUM(CASE WHEN is_approved = "R" THEN 1 ELSE 0 END) AS approved_reject_y_count'),
        ]);

        if ($roleid != 1 && $roleid != 11) {
            $queryapprovedcounts->where('service_provider_id', $servcid);
        }
        $serviceemployees = DB::table('service_employees')->select('id','employee_name')->where('user_id', $servcid)->get();
        $approvedproductcounts = $queryapprovedcounts->first();
        return view('serviceproduct.product_dets', compact('ServiceDetails', 'ProductCount', 'userservicedets','approvedproductcounts','serviceemployees'));
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
        $ServiceDetails->service_provider_id = $request->input('shop_name');
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

        $validatedDataApp = $request->validate([
            'setavailbledate' => 'required',
            'setavailblefromdate' => ['required_if:setavailbledate,1', 'date'],
            'setavailbletodate' => ['required_if:setavailbledate,1', 'date'],
        ]);

        $appointmentDetail = new ServiceAppointment();
        $appointmentDetail->fill($validatedDataApp);
        $servicepoint1=$request->has('servicepoint1') ? 1 : 0;
        $servicepoint2=$request->has('servicepoint2') ? 1 : 0;
        $servicepoint=$servicepoint1.','.$servicepoint2;
        $isnotappointment = $request->has('isnotavailable') ? 1 : 0;
        $appointmentDetail->is_setdates = $request->input('setavailbledate');
        $appointmentDetail->available_from_date = $request->input('setavailblefromdate');
        $appointmentDetail->available_to_date = $request->input('setavailbletodate');
        $appointmentDetail->is_not_available = $request->has('isnotavailable') ? 1 : 0;
        $appointmentDetail->service_id = $service_id;
        $appointmentDetail->suggestion = $request->input('sugection');
        $appointmentDetail->service_point = $servicepoint;
        $newappointmentreg = $appointmentDetail->save();
        $appointment_id = $appointmentDetail->id;
        if ($isnotappointment == '1') {
            $notavailabledate_data = $request->input('notavailabledate_data');
            //echo "<pre>";print_r($notavailabledate_data);
            try {
                foreach ($notavailabledate_data as $notavailabledate) {
                    if ($notavailabledate['setavailblesingledate'] == '') {
                    } else {
                        $NotAvailableDate = new NotAvailableDate();
                        $NotAvailableDate->service_id = $service_id;
                        $NotAvailableDate->appointment_id = $appointment_id;
                        $NotAvailableDate->not_available_date = $notavailabledate['setavailblesingledate'];
                        $notavailedate = $NotAvailableDate->save();
                    }
                }
            } catch (\Exception $e) {
                return response()->json(['result' => 3, 'mesge' => $e->getMessage()]); //dd($e->getMessage());
            }
        }

        $availabletime_data = $request->input('availabletime_data');
        //echo "<pre>";print_r($availabletime_data);
        try {
            foreach ($availabletime_data as $availabledaytime) {
                if ($availabledaytime['setdays'] == '' && $availabledaytime['setfrom_time'] == '' && $availabledaytime['setto_time'] == ''  && $availabledaytime['service_employe_id'] == '' && $availabledaytime['gracetime'] == '') {
                } else {
                    $ApptAvailableDayTime = new AppointmentAvailableDayTime();
                    $ApptAvailableDayTime->service_id = $service_id;
                    $ApptAvailableDayTime->appointment_id = $appointment_id;
                    $ApptAvailableDayTime->employee_id = $availabledaytime['service_employe_id'];
                    $settimestatus = isset($availabledaytime['settimestatus']) ? 1 : 0;
                    $ApptAvailableDayTime->is_set_time = $settimestatus;
                    $ApptAvailableDayTime->appt_days = $availabledaytime['setdays'];
                    $ApptAvailableDayTime->from_time = $availabledaytime['setfrom_time'];
                    $ApptAvailableDayTime->to_time = $availabledaytime['setto_time'];
                    $ApptAvailableDayTime->grace_time = $availabledaytime['gracetime'];
                    $availedaytime = $ApptAvailableDayTime->save();
                }
            }
        } catch (\Exception $e) {
            return response()->json(['result' => 3, 'mesge' => $e->getMessage()]); //dd($e->getMessage());
        }

        $setquestion_data = $request->input('setquestion_data');
        try {
            foreach ($setquestion_data as $setquestion) {
                if ($setquestion['setquestion'] == '') {
                } else {
                    $SetQuestion = new SetQuestion();
                    $SetQuestion->service_id = $service_id;
                    $SetQuestion->appointment_id = $appointment_id;
                    $SetQuestion->questions = $setquestion['setquestion'];
                    $setquestions = $SetQuestion->save();
                }
            }
        } catch (\Exception $e) {
            return response()->json(['result' => 3, 'mesge' => $e->getMessage()]); //dd($e->getMessage());
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
        $ServiceAppointment = DB::table('service_appointments')
            ->where('service_id', $ServiceDetails->id)
            ->first();
        $appointmentavailable = DB::table('appointment_available_day_times')
            ->where('service_id', $ServiceDetails->id)
            ->get();
        $notavailabledates = DB::table('not_available_dates')
            ->where('service_id', $ServiceDetails->id)
            ->get();

        $productAttibutes = DB::table('add_service_attributes')
            ->where('service_id', $ServiceDetails->id)
            ->get();
        $setquestions = DB::table('set_questions')
            ->where('service_id', $ServiceDetails->id)
            ->get();
        //$userservicede = DB::select("SELECT id,name FROM users WHERE FIND_IN_SET('9', role_id)");
        $serviceemployees = DB::table('service_employees')->select('id','employee_name')->where('user_id', $ServiceDetails->service_provider_id)->get();
        //dd($userservicedets);
        return view('serviceproduct.product_viewedit_dets', compact('ServiceDetails', 'productAttibutes','ServiceAppointment','appointmentavailable','notavailabledates','setquestions','serviceemployees'));
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
            'serviceprovider' => 'required',
            'prod_names' => 'required',
            'prod_descriptions' => 'required',
            'customRadios' => 'required|in:Y,N',
        ]);

        $service_id = $request->serprod_id;
        $ServiceDetails = ServiceDetails::find($service_id);
        $ServiceDetails->fill($validatedData);
        $ServiceDetails->service_provider_id = $request->input('serviceprovider');
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

        $validatedData = $request->validate([
            'setavailbledates' => 'required',
            'setavailblefromdates' => ['required_if:setavailbledates,1', 'date'],
            'setavailbletodates' => ['required_if:setavailbledates,1', 'date'],
        ]);
        $appointmentDetail = ServiceAppointment::find($service_id);
        $appointmentDetail->fill($validatedData);
        $servicepointa=$request->has('servicepointa') ? 1 : 0;
        $servicepointb=$request->has('servicepointb') ? 1 : 0;
        $servicepoint=$servicepointa.','.$servicepointb;
        $isnotappointment = $request->has('isnotavailables') ? 1 : 0;
        $appointmentDetail->is_setdates = $request->input('setavailbledates');
        $appointmentDetail->available_from_date = $request->input('setavailblefromdates');
        $appointmentDetail->available_to_date = $request->input('setavailbletodates');
        $appointmentDetail->is_not_available = $request->has('isnotavailables') ? 1 : 0;
        $appointmentDetail->service_id = $service_id;
        $appointmentDetail->suggestion = $request->input('sugections');
        $appointmentDetail->service_point = $servicepoint;
        $newappointmentreg = $appointmentDetail->save();
        //delete product attributes
        $notavailabledateDetail = NotAvailableDate::where('service_id', $service_id)->delete();
        $AppointmentAvailableDayTime = AppointmentAvailableDayTime::where('service_id', $service_id)->delete();
        $AppointmentSetQuestion = SetQuestion::where('service_id', $service_id)->delete();
        //end delete attributes
        if ($isnotappointment == '0') {
            $deltenotavailabledateDetail = NotAvailableDate::where('service_id', $service_id)->delete();
        }
        if ($isnotappointment == '1') {
            $notavailabledate_data = $request->input('notavailabledate_datas');
            try {
                foreach ($notavailabledate_data as $notavailabledate) {
                    if ($notavailabledate['setavailblesingledates'] == '') {
                    } else {
                        $NotAvailableDate = new NotAvailableDate();
                        $NotAvailableDate->appointment_id = $service_id;
                        $NotAvailableDate->not_available_date = $notavailabledate['setavailblesingledates'];
                        $NotAvailableDate->service_id = $service_id;
                        $notavailedate = $NotAvailableDate->save();
                    }
                }
            } catch (\Exception $e) {
                return response()->json(['result' => 3, 'mesge' => $e->getMessage()]); //dd($e->getMessage());
            }
        }
        $availabletime_data = $request->input('availabletime_datas');

        try {
            foreach ($availabletime_data as $availabledaytime) {
                if ($availabledaytime['service_employe_ids'] !== '' && $availabledaytime['setdayss'] !== '0' && $availabledaytime['setfrom_times'] !== '' && $availabledaytime['setto_times'] !== ''  && $availabledaytime['gracetimes'] !== '' ) {
                    $ApptAvailableDayTime = new AppointmentAvailableDayTime();
                    $ApptAvailableDayTime->appointment_id = $service_id;
                    $ApptAvailableDayTime->employee_id = $availabledaytime['service_employe_ids'];
                    $settimestatus = isset($availabledaytime['settimestatuss']) ? 1 : 0;
                    $ApptAvailableDayTime->is_set_time = $settimestatus;
                    $ApptAvailableDayTime->appt_days = $availabledaytime['setdayss'];
                    $ApptAvailableDayTime->from_time = $availabledaytime['setfrom_times'];
                    $ApptAvailableDayTime->to_time = $availabledaytime['setto_times'];
                    $ApptAvailableDayTime->service_id = $service_id;
                    $ApptAvailableDayTime->grace_time = $availabledaytime['gracetimes'];
                    $availedaytime = $ApptAvailableDayTime->save();
                }
            }
        } catch (\Exception $e) {
            return response()->json(['result' => 3, 'mesge' => $e->getMessage()]);
        }

        $setquestion_data = $request->input('setquestion_datas');
        try {
            foreach ($setquestion_data as $setquestion) {
                if ($setquestion['setquestions'] == '') {
                } else {
                    $SetQuestion = new SetQuestion();
                    $SetQuestion->appointment_id = $service_id;
                    $SetQuestion->questions = $setquestion['setquestions'];
                    $SetQuestion->service_id = $service_id;
                    $setquestions = $SetQuestion->save();
                }
            }
        } catch (\Exception $e) {
            return response()->json(['result' => 3, 'mesge' => $e->getMessage()]); //dd($e->getMessage());
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

        $productid = $request->input('serviceid');
        $ServiceDetails = ServiceDetails::select('service_details.*')
            ->where('service_details.id', $productid)
            ->first();
        //echo $lastRegId = $ServiceDetails->toSql();exit;
        $ServiceAppointment = DB::table('service_appointments')
            ->where('service_id', $ServiceDetails->id)
            ->first();
        $appointmentavailable = DB::table('appointment_available_day_times')
            ->where('service_id', $ServiceDetails->id)
            ->get();
        $notavailabledates = DB::table('not_available_dates')
            ->where('service_id', $ServiceDetails->id)
            ->get();

        $productAttibutes = DB::table('add_service_attributes')
            ->where('service_id', $ServiceDetails->id)
            ->get();
        $setquestions = DB::table('set_questions')
            ->where('service_id', $ServiceDetails->id)
            ->get();
        //$userservicede = DB::select("SELECT id,name FROM users WHERE FIND_IN_SET('9', role_id)");
        $serviceemployees = DB::table('service_employees')->select('id','employee_name')->where('user_id', $ServiceDetails->service_provider_id)->get();
        //dd($userservicedets);
        return view('serviceproduct.product_approved_dets', compact('ServiceDetails', 'productAttibutes','ServiceAppointment','appointmentavailable','notavailabledates','setquestions','serviceemployees'));





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
        $delteProductAttributesDetail   = AddServiceAttribute::where('service_id', $serviceid)->delete();
        $appointmentDetail              = ServiceAppointment::where('service_id', $serviceid)->delete();
        $notavailabledateDetail         = NotAvailableDate::where('service_id', $serviceid)->delete();
        $AppointmentAvailableDayTime    = AppointmentAvailableDayTime::where('service_id', $serviceid)->delete();
        $AppointmentSetQuestion         = SetQuestion::where('service_id', $serviceid)->delete();

        $msg = 'Service Deleted.  service id : ' . $serviceid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $userId;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($deltesellerDetail > 0) {
            return response()->json(['result' => 1, 'mesge' => 'Service Deleted Successfully']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }



}

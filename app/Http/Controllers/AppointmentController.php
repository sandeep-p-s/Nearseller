<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAccount;
use App\Models\LogDetails;
use App\Models\SellerDetails;
use App\Models\Affiliate;
use App\Models\MenuMaster;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Models\ServiceType;
use App\Models\ServiceDetails;
use App\Models\ServiceAppointment;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;
class AppointmentController extends Controller
{
    function Apponintmentview()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if($userId==''){return redirect()->route('logout');}
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
        $query = ServiceDetails::select('service_details.id', 'service_details.service_name');
        if ($roleid == 1) {
        } else {
            $query->where('service_details.service_id', $userId);
        }
        $ServiceDetails = $query->get();
        return view('appointment.appointmentlist',compact('userdetails','userRole','loggeduser','structuredMenu','ServiceDetails'));
    }

    function AppointmentListView(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if($userId==''){
            return redirect()->route('logout');
        }
        $service_name   = $request->input('service_name');
        $service_point   = $request->input('service_point');

        $query = ServiceAppointment::select('service_appointments.*','service_details.service_name','service_employees.employee_name')
        ->leftJoin('service_details', 'service_details.id', 'service_appointments.service_id')
        ->leftJoin('service_employees', 'service_employees.id', 'service_appointments.employee_id')
        ;
        if ($service_name) {
            $query->where('service_appointments.service_id',  $service_name);
        }
        if ($service_point) {
            $query->where('service_appointments.service_point', $service_point);
        }
        if ($roleid == 1) {
        } else {
            $query->where('service_details.service_id', $userId);
        }
        $ServiceAppointment = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $serviceCount = $ServiceAppointment->count();
        if ($roleid == 1) {
            $servicedetails     = DB::table('service_details')->get();
            $serviceemployees   = DB::table('service_employees')->get();
        } else {
            $servicedetails     = DB::table('service_details')->where('service_id',$userId)->get();
            $serviceemployees   = DB::table('service_employees')->where('user_id',$userId)->get();
        }

        return view('appointment.appointment_dets', compact('ServiceAppointment', 'serviceCount','servicedetails','serviceemployees'));
    }


    function AdmNewAppointmentAdd(Request $request)
        {
            $userRole = session('user_role');
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }

            $loggedUserIp=$_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');






            $validatedData =$request->validate([
                'setavailbledate' => 'required',
                'setavailblefromdate' => [
                    'required_if:setavailbledate,1',
                    'date',
                ],
                'setavailbletodate' => [
                    'required_if:setavailbledate,1',
                    'date',
                ],

                'notavailabledate_data.*.setavailblesingledate' => [
                    'required_if:isnotavailable,1',
                    'date',
                ],
                'setquestion' => 'required',
                'service_type_id' => 'required',
            ]);

            $appointmentDetail->fill($validatedData);
            $sellerDetail = new SellerDetails();
            $sellerDetail->fill($validatedData);
            $sellerDetail->shop_name = $request->input('s_name');
            $sellerDetail->owner_name = $request->input('s_ownername');


            $sellerDetail->user_id = $last_id;
            //$last_id = $user->id;
            $shopreg=$sellerDetail->save();



        }


    function AdmshopViewEdits(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if($userId==''){
            return redirect()->route('logout');
        }
        $id=$request->input('shopid');
        $typeid=$request->input('typeid');
        $sellerDetails = SellerDetails::select('seller_details.*','business_type.business_name','service_categories.service_category_name','service_sub_categories.sub_category_name','service_types.service_name','executives.executive_name','country.country_name','state.state_name','district.district_name','user_account.user_status')
            ->leftJoin('business_type', 'business_type.id', 'seller_details.busnes_type')
            ->leftJoin('service_categories', 'service_categories.id', 'seller_details.shop_service_type')
            ->leftJoin('service_sub_categories', 'service_sub_categories.id', 'seller_details.service_subcategory_id')
            ->leftJoin('service_types', 'service_types.id', 'seller_details.shop_type')
            ->leftJoin('executives', 'executives.id', 'seller_details.shop_executive')
            ->leftJoin('country', 'country.id', 'seller_details.country')
            ->leftJoin('state', 'state.id', 'seller_details.state')
            ->leftJoin('district', 'district.id', 'seller_details.district')
            ->leftJoin('user_account', 'user_account.id', 'seller_details.user_id')
            ->where('seller_details.id', $id)
            ->where('seller_details.busnes_type',$typeid)
            ->first();
        //echo $lastRegId = $sellerDetails->toSql();exit;
        $countries      = DB::table('country')->get();
        $states         = DB::table('state')->where('country_id', $sellerDetails->country)->get();
        $districts      = DB::table('district')->where('state_id', $sellerDetails->state)->get();
        $business       = DB::table('business_type')->where('id',$sellerDetails->busnes_type)->get();
        $shopservicecategory    = DB::table('service_categories')->where('business_type_id',$sellerDetails->busnes_type)->get();
        $shopservicesubcategory = DB::table('service_sub_categories')->where('service_category_id',$sellerDetails->shop_service_type)->get();
        $shopservice    = DB::table('service_types')->where('business_type_id',$typeid)->get();
        $executives     = DB::table('executives')->where(['executive_type' => $typeid])->get();
        $userstus       = DB::table('user_account')->where('id', $sellerDetails->user_id)->get();
        if($typeid==1){$shoporservice='Shops';
        }
        else  if($typeid==2){$shoporservice='Services';
        }
        return view('admin.shop_viewedit_dets', compact('sellerDetails', 'countries', 'states', 'districts', 'business', 'shopservicecategory','shopservicesubcategory','shopservice', 'executives','userstus','typeid','shoporservice'));

    }

    function AdmshopGalryDelte(Request $request)
        {
            $userRole = session('user_role');
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }
            $imgval=$request->input('imgval');
            $typevals=urldecode($imgval);
			$typevalm=base64_decode($typevals);
			$exlodval=explode('#',$typevalm);
			//echo "<pre>";print_r($exlodval);exit;
			$imgremove=$exlodval[0];
			$shopid=$exlodval[1];
            $sellerDetail   = SellerDetails::find($shopid);
            $sellerImag     = DB::table('seller_details')->where('id', $shopid)->get();
			//echo $lastRegId = $sellerDetail->toSql();exit;
			foreach($sellerImag as $gal)
			{
				$json_data=$gal->shop_photo;

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
                $sellerDetail->shop_photo = $updated_json_data;
				$result = $sellerDetail->save();
                //echo $lastRegId = $sellerDetail->toSql();exit;
                $loggedUserIp=$_SERVER['REMOTE_ADDR'];
                $time=date('Y-m-d H:i:s');
                $msg="Deleted Image ".$imgremove;
                $LogDetails = new LogDetails();
                $LogDetails->user_id = $userId;
                $LogDetails->ip_address = $loggedUserIp;
                $LogDetails->log_time = $time;
                $LogDetails->status = $msg;
                $LogDetails->save();
                if($result>0){
                    return response()->json(['result' => 1,'mesge'=>'Deleted Successfully']);
                }
                else{
                    return response()->json(['result' => 2,'mesge'=>'Failed']);
                }
            }
        }
        function AdmsellerUpdatePage(Request $request)
        {
            $userRole = session('user_role');
            $roleid = session('roleid');
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }
            $loggedUserIp=$_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');


            $validatedData = $request->validate([
                'es_name' => 'required|max:50',
                'es_ownername' => 'max:50',
                'es_mobno' => 'required|max:10',
                'es_email' => 'required|email|max:35',
                'es_refralid' => 'max:50',
                'es_busnestype' => 'required',
                'es_shopservice' => 'required',
                'es_subshopservice' => 'required',
                'es_shopservicetype' => 'required',
                'es_shopexectename' => 'required',
                'es_lisence' => 'required|max:25',
                'es_buldingorhouseno' => 'required|max:100',
                'es_locality' => 'required|max:100',
                'es_villagetown' => 'required|max:100',
                'ecountry' => 'required',
                'estate' => 'required',
                'edistrict' => 'required',
                'es_pincode' => 'required|max:6',
                'es_googlelink' => 'required',
                'emanufactringdets' => 'required',
                'es_gstno' => 'required|max:25',
                'es_panno' => 'required|max:12',
                'es_establishdate' => 'required|date',
                'es_registerdate' => 'required|date',
                'eopentime' => 'required',
                'eclosetime' => 'required',
                'es_termcondtn' => 'accepted',

            ]);
            $shopid=$request->shopidhid;
            //$user   = UserAccount::find($shopid);
            $sellerDetail   = SellerDetails::find($shopid);
            $sellerDetail->fill($validatedData);
            $sellerDetail->shop_name = $request->input('es_name');
            if($request->input('es_shopservice')==1){
            $sellerDetail->owner_name = $request->input('es_ownername');}
            $sellerDetail->shop_email = $request->input('es_email');
            $sellerDetail->shop_mobno = $request->input('es_mobno');
            $sellerDetail->busnes_type = $request->input('es_busnestype');
            $sellerDetail->shop_service_type = $request->input('es_shopservice');
            $sellerDetail->service_subcategory_id = $request->input('es_subshopservice');
            $sellerDetail->shop_type = $request->input('es_shopservicetype');
            $sellerDetail->shop_executive = $request->input('es_shopexectename');
            $sellerDetail->term_condition = $request->has('es_termcondtn') ? 1 : 0;
            $sellerDetail->shop_licence = $request->input('es_lisence');
            $sellerDetail->house_name_no = $request->input('es_buldingorhouseno');
            $sellerDetail->locality = $request->input('es_locality');
            $sellerDetail->village = $request->input('es_villagetown');
            $sellerDetail->country = $request->input('ecountry');
            $sellerDetail->state = $request->input('estate');
            $sellerDetail->district = $request->input('edistrict');
            $sellerDetail->pincode = $request->input('es_pincode');
            $sellerDetail->googlemap = $request->input('es_googlelink');
            $sellerDetail->shop_gstno = $request->input('es_gstno');
            $sellerDetail->shop_panno = $request->input('es_panno');
            $sellerDetail->establish_date = $request->input('es_establishdate');
            $sellerDetail->manufactoring_details = $request->input('emanufactringdets');
            $opentime   =   $request->input('eopentime');
            $closetime  =   $request->input('eclosetime');
            $openclosdsetime=$opentime.'-'.$closetime;
            $sellerDetail->open_close_time = $openclosdsetime;
            $sellerDetail->registration_date = $request->input('es_registerdate');
            $sellerDetail->referal_id = $request->input('es_refralid');
            $sellerDetail->direct_affiliate = $request->input('sdirectafflte');
            $sellerDetail->second_affiliate = $request->input('ssecondafflte');
            $sellerDetail->shop_coordinator = $request->input('scoordinater');
            $sellerImag     = DB::table('seller_details')->select('shop_photo')->where('id', $shopid)->get();
			foreach($sellerImag as $gal)
			{
				$json_data=$gal->shop_photo;
			}
            if ($request->hasFile('es_photo')) {
                $upload_path = 'uploads/shopimages/';
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }
            $input_datas 		= array();
            $input_vals 		= array();

            $existing_array = json_decode($json_data, true);
            $existing_images = isset($existing_array['fileval']) ? $existing_array['fileval'] : array();
            $input_datas = $existing_images;

            foreach ($request->file('es_photo') as $file) {
                if($file->isValid()) {
                    $new_name = time() . '_' . $file->getClientOriginalName();
                    $file->move($upload_path, $new_name);
                    $filename = $upload_path . $new_name;
                    array_push($input_datas, $filename);
                }
            }
            $input_vals = ['fileval' => $input_datas];
            $jsonimages = json_encode($input_vals);
            $sellerDetail->shop_photo = $jsonimages;
            }

            $input_media = [];
            $input_valmedia = [];
            $mediatype = $request->input('mediatype', []);
            $mediaurl = $request->input('mediaurl', []);
            $totvalmedia = count($mediatype);
            if ($totvalmedia > 0) {
                foreach ($mediatype as $keys => $valmm) {
                    $mediaType = $mediatype[$keys];
                    $mediaUrl = $mediaurl[$keys];


                    $input_mediaval = [
                        'mediatype' => $mediaType,
                        'mediaurl' => $mediaUrl,
                    ];

                    $input_media[] = $input_mediaval;
                }

                $input_valmedia['mediadets'] = $input_media;
                $jsonmedia = json_encode($input_valmedia);
                $sellerDetail->socialmedia = $jsonmedia;
            }

            $shopreg=$sellerDetail->save();

            $user = UserAccount::findOrFail($sellerDetail->user_id);
            if ($user->email !== $request->input('es_email') || $user->mobno !== $request->input('es_mobno')) {
                $user->email = $request->es_email;
                $user->mobno = $request->es_mobno;
            }
                $user->name = $request->es_name;
                if($roleid==1)
                    {
                        $user->user_status = $request->userstatus;
                    }
                $user->referal_id = $request->input('es_refralid');
                $user->ip=$loggedUserIp;
                $submt=$user->save();

            $msg="Successfully updated! ".$request->es_email." shop updated id : ".$sellerDetail->user_id;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $request->es_email;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();

        }



        function AdmshopApproved(Request $request)
        {
            $userRole = session('user_role');
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }
            $id=$request->input('shopid');
            $typeid=$request->input('typeid');
            $sellerDetails = SellerDetails::select('seller_details.*','business_type.business_name','service_categories.service_category_name','service_sub_categories.sub_category_name','service_types.service_name','executives.executive_name','country.country_name','state.state_name','district.district_name','user_account.user_status')
                ->leftJoin('business_type', 'business_type.id', 'seller_details.busnes_type')
                ->leftJoin('service_categories', 'service_categories.id', 'seller_details.shop_service_type')
                ->leftJoin('service_sub_categories', 'service_sub_categories.id', 'seller_details.service_subcategory_id')
                ->leftJoin('service_types', 'service_types.id', 'seller_details.shop_type')
                ->leftJoin('executives', 'executives.id', 'seller_details.shop_executive')
                ->leftJoin('country', 'country.id', 'seller_details.country')
                ->leftJoin('state', 'state.id', 'seller_details.state')
                ->leftJoin('district', 'district.id', 'seller_details.district')
                ->leftJoin('user_account', 'user_account.id', 'seller_details.user_id')
                ->where('seller_details.id', $id)
                ->where('seller_details.busnes_type',$typeid)
                ->first();
            //echo $lastRegId = $sellerDetails->toSql();exit;
            $countries      = DB::table('country')->get();
            $states         = DB::table('state')->where('country_id', $sellerDetails->country)->get();
            $districts      = DB::table('district')->where('state_id', $sellerDetails->state)->get();
            $business       = DB::table('business_type')->where('id',$sellerDetails->busnes_type)->get();
            $shopservicecategory    = DB::table('service_categories')->where('business_type_id',$sellerDetails->busnes_type)->get();
            $shopservicesubcategory = DB::table('service_sub_categories')->where('service_category_id',$sellerDetails->shop_service_type)->get();
            $shopservice    = DB::table('service_types')->where('business_type_id',$typeid)->get();
            $executives     = DB::table('executives')->where(['executive_type' => $typeid])->get();
            $userstus       = DB::table('user_account')->where('id', $sellerDetails->user_id)->get();
            if($typeid==1){$shoporservice='Shops';
            }
            else  if($typeid==2){$shoporservice='Services';
            }
            return view('admin.shop_approved_dets', compact('sellerDetails', 'countries', 'states', 'districts', 'business', 'shopservicecategory','shopservicesubcategory','shopservice', 'executives','userstus','typeid','shoporservice'));

        }

        function AdmsellerApprovedPage(Request $request)
        {
            $userRole = session('user_role');
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }
            $loggedUserIp=$_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $validatedData = $request->validate([
                'approvedstatus' => 'required|max:1',
            ]);
            $shopid=$request->shopidhidapp;
            $shopselrid=$request->shopidhidselapp;
            $user = UserAccount::find($shopid);
            $userstatus=$user->user_status;
            if($userstatus=='Y')
            {
            $user->approved = $request->approvedstatus;
            $user->approved_by = $userId;
            $user->approved_at = $time;
            $submt=$user->save();

            $SellerDetails = SellerDetails::find($shopselrid);
            $SellerDetails->seller_approved = $request->approvedstatus;
            $submtapp=$SellerDetails->save();

            $msg="Aprroved Status =  ".$request->approvedstatus." shop updated id : ".$shopid;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $user->email;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
            if($request->approvedstatus=='Y')
            {
                $valencodemm=$shopid."-".$user->email;
                $valsmm=base64_encode($valencodemm);
                $apprveTime = date('d/m/Y H:i:s', strtotime($time));
                $verificationToken = base64_encode($shopid . '-' . $user->email. '-' .$apprveTime.'-'.'');
                $checkval="5";
                $message='Shop Successfully Approved';
                $email = new EmailVerification($verificationToken, $user->name, $user->email, $checkval, $message);
                Mail::to($user->email)->send($email);
            }
        }
        else{

        }

        }

        function AdmshopDeletePage(Request $request)
        {
            $userRole = session('user_role');
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }
            $loggedUserIp=$_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $shopid         = $request->input('userid');
            $sellerDetail   = SellerDetails::find($shopid);
            $user           = UserAccount::find($sellerDetail->user_id);
            $deltesellerDetail=$sellerDetail->delete();
            $delteuser        =$user->delete();
            $msg="Shop Deleted =  ".$user->email." shop updated id : ".$sellerDetail->user_id;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $user->email;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
            if(($deltesellerDetail>0) && ($delteuser>0)){
                return response()->json(['result' => 1,'mesge'=>'Deleted Successfully']);
            }
            else{
                return response()->json(['result' => 2,'mesge'=>'Failed']);
            }

        }






}

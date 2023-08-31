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
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;
class AdminController extends Controller
{
    function admindashboard()
    {
        $userRole   = session('user_role');
        $userId     = session('user_id');
        if($userId==''){return redirect()->route('logout');}
        $loggeduser     = UserAccount::seesionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countUsers     = DB::table('user_account')->where('role_id', 4)->count();
        $countAffiliate = DB::table('user_account')->where('role_id', 3)->count();
        $countShops     = DB::table('user_account')->where('role_id', 2)->count();
        return view('admin.dashboard',compact('userdetails','countUsers','countAffiliate','countShops','userRole','loggeduser'));
    }

    function ShopApproval()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if($userId==''){return redirect()->route('logout');}
        $loggeduser     = UserAccount::seesionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        return view('admin.shop_approval',compact('userdetails','userRole','loggeduser'));
    }

    function AllShopsList(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if($userId==''){
            return redirect()->route('logout');
        }
        $emal_mob   = $request->input('emal_mob');
        $shopname   = $request->input('shopname');
        $ownername  = $request->input('ownername');
        $referalid  = $request->input('referalid');
        $query = SellerDetails::select('seller_details.*','business_type.business_name','service_types.service_name','executives.executive_name','country.country_name','state.state_name','district.district_name')
        ->leftJoin('business_type', 'business_type.id', 'seller_details.busnes_type')
        ->leftJoin('service_types', 'service_types.id', 'seller_details.shop_service_type')
        ->leftJoin('executives', 'executives.id', 'seller_details.shop_executive')
        ->leftJoin('country', 'country.id', 'seller_details.country')
        ->leftJoin('state', 'state.id', 'seller_details.state')
        ->leftJoin('district', 'district.id', 'seller_details.district');
        if ($emal_mob) {
            $query->where('shop_email', 'LIKE', '%' . $emal_mob . '%')
                ->orWhere('shop_mobno', 'LIKE', '%' . $emal_mob . '%');
        }
        if ($shopname) {
            $query->where('seller_details.shop_name', 'LIKE', '%' . $shopname . '%');
        }
        if ($ownername) {
            $query->where('seller_details.owner_name', 'LIKE', '%' . $ownername . '%');
        }
        if ($referalid) {
            $query->where('seller_details.referal_id', $referalid);
        }
        $sellerDetails = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $sellerCount = $sellerDetails->count();
        $countries      = DB::table('country')->get();
        $business       = DB::table('business_type')->where('status','Y')->get();
        $shopservice    = DB::table('service_types')->where('status','active')->get();
        $executives     = DB::table('executives')->where(['executive_type' => 1, 'status' => 'Y'])->get();
        return view('admin.shop_dets', compact('sellerDetails', 'sellerCount','countries','business','shopservice','executives'));
    }


    function AdmsellerRegisterationPage(Request $request)
        {
            $userRole = session('user_role');
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }
            $pass_chars = '';
            $refer_chars = '';
            $loggedUserIp=$_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $validatedData = $request->validate([
                's_name' => 'required|max:50',
                's_ownername' => 'required|max:50',
                's_mobno' => 'required|max:10',
                's_email' => 'required|email|max:35',
                's_refralid' => 'max:50',
                's_busnestype' => 'required',
                's_shopservice' => 'required',
                's_shopexectename' => 'required',
                's_lisence' => 'required|max:25',
                's_buldingorhouseno' => 'required|max:100',
                's_locality' => 'required|max:100',
                's_villagetown' => 'required|max:100',
                'country' => 'required',
                'state' => 'required',
                'district' => 'required',
                's_pincode' => 'required|max:6',
                's_googlelink' => 'required',
                //'s_photo' => 'required|image|mimes:jpeg,png|max:1024',
                's_gstno' => 'required|max:25',
                's_panno' => 'required|max:12',
                's_establishdate' => 'required|date',
                // 's_paswd' => 'required|max:10',
                // 's_rpaswd' => 'required|same:s_paswd',
                's_termcondtn' => 'accepted',
            ]);
            $user = new UserAccount();
            $user->name = $request->s_name;
            $user->email = $request->s_email;
            $user->mobno = $request->s_mobno;
            $pass_characters = array(
                "A","B","C","D","E","F","G","H","M","N","R","S","T","U","V","W","X","Y","@","#","$","%","&","!","a","b","c","d","e","f","g","h","m","n","r","s","t","u","v","w","x","z","2","3","4","5","6","7","8","9"
            );
            $passkeys = array();
            while (count($passkeys) < 6) {
                $x = mt_rand(0, count($pass_characters) - 1);
                if (!in_array($x, $passkeys)) {
                    $passkeys[] = $x;
                }
            }
            foreach ($passkeys as $pkey) {
                $pass_chars.= $pass_characters[$pkey];
            }

            $Ref_characters = array(
                "1","2","3","4","5","6","7","8","9","0","A","B","C","D","E","F","G","H","M","N","R","S","T","U","V","W","X","Y"
            );
            $refkeys = array();
            while (count($refkeys) < 10) {
                $y = mt_rand(0, count($Ref_characters) - 1);
                if (!in_array($y, $refkeys)) {
                    $refkeys[] = $y;
                }
            }
            foreach ($refkeys as $refkey) {
                $refer_chars.= $Ref_characters[$refkey];
            }

            $user->password = Hash::make($pass_chars);
            $user->role_id=2;
            $user->forgot_pass=$pass_chars;
            $user->user_status='N';
            $user->ip=$loggedUserIp;
            $user->parent_id=$userId;
            $user->referal_id=$refer_chars;
            $submt=$user->save();
            $lastRegId = $user->toSql();
            $last_id = $user->id;
            $msg="Registration Success! ".$request->s_email." register id : ".$last_id;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $request->s_email;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
            if($submt>0){
                $sellerDetail = new SellerDetails();
                $sellerDetail->fill($validatedData);
                $sellerDetail->shop_name = $request->input('s_name');
                $sellerDetail->owner_name = $request->input('s_ownername');
                $sellerDetail->shop_email = $request->input('s_email');
                $sellerDetail->shop_mobno = $request->input('s_mobno');
                //$sellerDetail->referal_id = $request->input('s_refralid');
                $sellerDetail->busnes_type = $request->input('s_busnestype');
                $sellerDetail->shop_service_type = $request->input('s_shopservice');
                $sellerDetail->shop_executive = $request->input('s_shopexectename');
                $sellerDetail->term_condition = $request->has('s_termcondtn') ? 1 : 0;
                $sellerDetail->shop_licence = $request->input('s_lisence');
                $sellerDetail->house_name_no = $request->input('s_buldingorhouseno');
                $sellerDetail->locality = $request->input('s_locality');
                $sellerDetail->village = $request->input('s_villagetown');
                $sellerDetail->country = $request->input('country');
                $sellerDetail->state = $request->input('state');
                $sellerDetail->district = $request->input('district');
                $sellerDetail->pincode = $request->input('s_pincode');
                $sellerDetail->googlemap = $request->input('s_googlelink');
                $sellerDetail->shop_gstno = $request->input('s_gstno');
                $sellerDetail->shop_panno = $request->input('s_panno');
                $sellerDetail->establish_date = $request->input('s_establishdate');
                $opentime   =   $request->input('opentime');
                $closetime  =   $request->input('closetime');
                $openclosdsetime=$opentime.'-'.$closetime;
                $sellerDetail->open_close_time = $openclosdsetime;
                $sellerDetail->registration_date = $request->input('s_registerdate');
                $sellerDetail->user_id = $last_id;
                $sellerDetail->referal_id = $refer_chars;
                $maxId = $sellerDetail->max('shop_reg_id');
                if ($maxId) {
                    $nextId = $maxId + 1;
                } else {
                    $nextId = '100';
                }
                $sellerDetail->shop_reg_id = $nextId;
                // if ($request->hasFile('s_photo')) {
                //     $file = $request->file('s_photo');
                //     $fileName = time() . '.' . $file->getClientOriginalExtension();
                //     $file->move(public_path('uploads/shopimages'), $fileName);
                //     $sellerDetail->shop_photo = $fileName;
                // }

                if ($request->hasFile('s_photo')) {
                    $upload_path = 'uploads/shopimages/';
                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }

                    $input_datas = [];
                    foreach ($request->file('s_photo') as $file) {
                        if ($file->isValid()) {
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
                $shopreg=$sellerDetail->save();
                $valencodemm=$lastRegId."-".$request->s_email;
                $valsmm=base64_encode($valencodemm);
                $verificationToken = base64_encode($last_id . '-' . $request->s_email. '-' . $pass_chars. '-' . $refer_chars);
                $checkval="4";
                $message='';
                $email = new EmailVerification($verificationToken, $request->s_name, $request->s_email, $checkval, $message);
                Mail::to($request->s_email)->send($email);

            } else {

            }
        }


        function AdmshopViewEdits(Request $request)
        {
            $userRole = session('user_role');
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }
            $id=$request->input('shopid');
            $sellerDetails = SellerDetails::select('seller_details.*', 'business_type.business_name', 'service_types.service_name', 'executives.executive_name', 'country.country_name', 'state.state_name', 'district.district_name')
                ->leftJoin('business_type', 'business_type.id', 'seller_details.busnes_type')
                ->leftJoin('service_types', 'service_types.id', 'seller_details.shop_service_type')
                ->leftJoin('executives', 'executives.id', 'seller_details.shop_executive')
                ->leftJoin('country', 'country.id', 'seller_details.country')
                ->leftJoin('state', 'state.id', 'seller_details.state')
                ->leftJoin('district', 'district.id', 'seller_details.district')
                ->where('seller_details.id', $id)
                ->first();
            //echo $lastRegId = $sellerDetails->toSql();exit;
            $countries      = DB::table('country')->get();
            $states         = DB::table('state')->where('country_id', $sellerDetails->country)->get();
            $districts      = DB::table('district')->where('state_id', $sellerDetails->state)->get();
            $business       = DB::table('business_type')->where('status','Y')->get();
            $shopservice    = DB::table('service_types')->where('status', 'active')->get();
            $executives     = DB::table('executives')->where(['executive_type' => 1, 'status' => 'Y'])->get();
            return view('admin.shop_viewedit_dets', compact('sellerDetails', 'countries', 'states', 'districts', 'business', 'shopservice', 'executives'));

        }



}

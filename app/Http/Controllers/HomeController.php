<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\LogDetails;
use App\Models\OTPGenerate;
use App\Models\SellerDetails;
use App\Models\Affiliate;
use App\Models\ServiceType;
use App\Models\Executive;
use App\Models\ServiceCategory;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;
use DB;
class HomeController extends Controller
{
    public function index()
    {
        $userId = session('user_id');
        if($userId=='')
        {
            $userdetails = '';
            $product = DB::table('product_details')->select('id','product_name','product_images')->where('is_approved','Y')->get();
            $services = DB::table('service_details')->select('id','service_name','service_images')->where('is_approved','Y')->get();
            $shops = DB::table('seller_details')->select('id','shop_name','shop_photo')->where('seller_approved','Y')->get();
            $districts = DB::table('district')->select('id','district_name','state_id')->where('state_id','18')->get();
        }
        else{
            $roleid = session('roleid');
            $roleIdsArray = explode(',', $roleid);
            if ($userId == '') {
                return redirect()->route('logout');
            }
            $loggeduser = User::sessionValuereturn_s($roleid);
            $userdetails = DB::table('users')
                ->where('id', $userId)
                ->get();
            $product = DB::table('product_details')->select('id','product_name','product_images')->where('is_approved','Y')->get();
            $services = DB::table('service_details')->select('id','service_name','service_images')->where('is_approved','Y')->get();
            $shops = DB::table('seller_details')->select('id','shop_name','shop_photo')->where('seller_approved','Y')->get();
            $districts = DB::table('district')->select('id','district_name','state_id')->where('state_id','18')->get();
        }

        return view('user.main', compact('product','services','shops','districts','userdetails'));
    }
    public function Login()
    {
         $countries      = DB::table('country')->get();
         $business       = DB::table('business_type')->where('status','Y')->get();
        //  $servicecategory = DB::table('service_categories')->where('status','Y')->get();
         $executives     = DB::table('users')->where(['role_id' => 10])->where(['user_status' => 'Y'])->get();

        return view('user.login',compact('countries','business','executives'));
    }
    public function BusinessCategory($catgry)
    {
        $service_categories = DB::table('service_categories')->where('business_type_id', $catgry)->get();
        return response()->json($service_categories);
    }
    public function getsubshopservice($subshopservice)
    {
        $subshopservice = DB::table('service_sub_categories')->where('service_category_id', $subshopservice)->get();
        return response()->json($subshopservice);
    }
    public function shopservicetype($shopservice)
    {
        $shopservice = DB::table('service_types')->where('business_type_id', $shopservice)->get();
        return response()->json($shopservice);
    }

    public function executivename($executive)
    {
        $executive = DB::table('executives')->where('business_type_id', $executive)->get();
        return response()->json($executive);
    }

    public function getStates($country)
    {
        $states = DB::table('state')->where('country_id', $country)->get();
        return response()->json($states);
    }
    public function getDistricts($state)
    {
        $districts = DB::table('district')->where('state_id', $state)->get();
        return response()->json($districts);
    }





    public function getBankBranchesPage(Request $request)
    {
        $query = DB::table('bank_details');
        if ($request->input('bank_name')) {
            $query->where('bank_code', $request->input('bank_name'));
        }
        // if ($request->input('bank_country')) {
        //     $query->where('country_code', $request->input('bank_country'));
        // }
        // if ($request->input('bank_state')) {
        //     $query->where('state_code', $request->input('bank_state'));
        // }
        if ($request->input('bank_dist')) {
            $query->where('district_code', $request->input('bank_dist'));
        }
        $branches = $query->select('id', 'branch_name')->get();
        return response()->json($branches);
    }
    public function getIFSCodePage(Request $request)
    {
        $bank_dets = DB::table('bank_details')->where('id', $request->input('branchId'))->get();
        return response()->json($bank_dets);
    }

    public function RegisterPage(Request $request)
    {

        $request->validate([
            'u_name'    => 'required|min:3|max:50',
            'mobcntrycode'=> 'required',
            'u_emid'    => 'required|email|unique:users,email',
            'u_mobno'   => 'required|numeric|digits:10|unique:users,mobno',
            'u_paswd'   => 'required|min:6',
            'u_rpaswd' => 'required|same:u_paswd',
        ]);

        $emailverifystatus= $request->emailverifystatus;
        $mobnoverifystatus= $request->mobverifystatus;
        if($emailverifystatus!='Y' && $mobnoverifystatus!='Y')
        {
            return response()->json(['message' => 'Email ID / Mobile Number not verified'], 200);
        }

        $user = new User();
        $regval=$request->regval;
        $loggedUserIp=$_SERVER['REMOTE_ADDR'];
        $time=date('Y-m-d H:i:s');
        if($regval==1)
        {
            $user->name = ucfirst($request->u_name);
            $user->email = $request->u_emid;
            $user->mobno = $request->u_mobno;
            $user->mob_countrycode = $request->mobcntrycode;
            $user->password = Hash::make($request->u_paswd);
            $user->role_id=4;
            $user->forgot_pass=$request->u_paswd;
            $user->user_status='Y';
            $user->email_verify='Y';
            $user->mobile_verify='Y';
            $user->approved='Y';
            $submt=$user->save();
            $lastRegId = $user->toSql();
            $last_id = $user->id;
            if ($submt) {
                    $msg="Registration Success! ".$request->u_emid." register id : ".$last_id;
                    $LogDetails = new LogDetails();
                    $LogDetails->user_id = $request->u_emid;
                    $LogDetails->ip_address = $loggedUserIp;
                    $LogDetails->log_time = $time;
                    $LogDetails->status = $msg;
                    $LogDetails->save();
                    // $valencodemm=$lastRegId."-".$request->u_emid;
                    // $valsmm=base64_encode($valencodemm);
                    // $verificationToken = base64_encode($last_id . '-' . $request->u_emid.'-,-');
                    // $checkval="1";
                    // $message='';
                    // $email = new EmailVerification($verificationToken, $request->u_name, $request->u_emid, $checkval, $message);
                    // try {
                    //     Mail::to($request->u_emid)->send($email);
                    // } catch (Exception $e) {
                    //     return response()->json(['message' => 'Registration Failed'], 200);
                    // }


                //return redirect()->route('login')->with('success', 'Registration Success. Please login!');
            } else {
                //return redirect()->route('login')->with('error', 'Registration Failed!');
            }
        }


    }



    public function ExistEmailCheck(Request $request)
    {
        $u_emid = $request->input('u_emid');
        $user = User::where('email', $u_emid)->get();
        $count = $user->count();
        if ($count > 0) {
            return response()->json(['result' => 1]);
        } else {
            return response()->json(['result' => 2]);
        }
    }


    public function ExistMobnoCheck(Request $request)
    {
        $u_mobno = $request->input('u_mobno');
        $user = User::where('mobno', $u_mobno)->get();
        $count = $user->count();
        if ($count > 0) {
            return response()->json(['result' => 1]);
        } else {
            return response()->json(['result' => 2]);
        }
    }

    public function ExistShopNameCheck(Request $request)
    {
        $u_shop = $request->input('u_shop');
        $user = User::where('name', $u_shop)->get();
        $count = $user->count();
        if ($count > 0) {
            return response()->json(['result' => 1]);
        } else {
            return response()->json(['result' => 2]);
        }
    }

    public function ExistnewusercreateCheck(Request $request)
    {
        $u_shop = $request->input('u_shop');
        $roleidcheck = $request->input('roleidcheck');
        $user = User::where('name', $u_shop)->where('role_id', $roleidcheck)->get();
        $count = $user->count();
        if ($count > 0) {
            return response()->json(['result' => 1]);
        } else {
            return response()->json(['result' => 2]);
        }
    }


    public function ExistExecutivenameCheck(Request $request)
    {
        $executename = $request->input('executename');
        $executive = Executive::where('executive_name', $executename)->get();
        $count = $executive->count();
        if ($count > 0) {
            return response()->json(['result' => 1]);
        } else {
            return response()->json(['result' => 2]);
        }
    }

    public function ExistCategoryName(Request $request)
    {
        $category = $request->input('category');
        $servicecategory = ServiceCategory::where('service_category_name', $category)->get();
        $count = $servicecategory->count();
        if ($count > 0) {
            return response()->json(['result' => 1]);
        } else {
            return response()->json(['result' => 2]);
        }
    }
    public function ExistServiceTypeName(Request $request)
    {
        $category = $request->input('category');
        $ServiceType = ServiceType::where('service_name', $category)->get();
        $count = $ServiceType->count();
        if ($count > 0) {
            return response()->json(['result' => 1]);
        } else {
            return response()->json(['result' => 2]);
        }
    }


    public function NotRegMobnoEmail(Request $request)
    {
        $emailmob = $request->input('emailmob');
        if (strpos($emailmob, '@') !== false) {
            $email = $emailmob;
            $mobile = null;
            $userAccuntData = User::where('email', $email)->get();
            $cnt = count($userAccuntData);
        }
        else{
            $email = null;
            $mobile = $emailmob;
            $userAccuntData = User::where('mobno', $mobile)->get();
            $cnt = count($userAccuntData);
        }
        if ($cnt == 0) {
            return response()->json(['result' => 1]);
        } else {
            return response()->json(['result' => 2]);
        }
    }


    public function ShopNotRegRefaralId(Request $request)
    {
        $referalno = $request->input('referalno');
        $numr = $request->input('numr');
        // if($numr==1)
        // {
        //     $userAccuntData = User::where('referal_id', $referalno)->get();
        // }
        // else if($numr==2)
        // {
        //     $userAccuntData = SellerDetails::where('referal_id', $referalno)->get();
        // }
        $userAccuntData = Affiliate::where('referal_id', $referalno)->get();
        $cnt = count($userAccuntData);
        if ($cnt == 0) {
            return response()->json(['result' => 1]);
        } else {
            return response()->json(['result' => 2]);
        }
    }




    public function VerifyMailPage($typevas)
    {
        $typevals = urldecode($typevas);
        $typevals = base64_decode($typevals);
        $exlodval = explode('-', $typevals);
        //echo "<pre>";print_r($exlodval);exit;
        $userregid = $exlodval[0];
        $username = $exlodval[1];
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time=date('Y-m-d H:i:s');
        $userAccuntModel = new User();
        $LogDetails = new LogDetails();
        $userAccuntData = $userAccuntModel->select('id','user_status')->where(['id' => $userregid, 'email' => $username])->get();
        $countm = $userAccuntData->count();
        if ($countm > 0) {
            $userchkid = $userAccuntData[0]->id;
            if ($userAccuntData[0]->user_status == 'Y') {
                return redirect()->route('login')->withErrors(['error' =>  'Already Verified Your Registered Email ID!']);
            }
            $data = [
                'user_status' => 'Y',
                'active_date' => date('Y-m-d'),
                'email_verify' => 'Y',
            ];

            $userAccuntModel->where('id', $userchkid)->update($data);
            $msg = "Email ID Successfully Verified. Verified Email ID : " . $username . " User Reg ID " . $userregid;
            $logdata = [
                'user_id'       => $username,
                'ip_address'    => $loggedUserIp,
                'log_time'      => $time,
                'status'        => $msg
            ];

            $LogDetails->insert($logdata);
            return redirect()->route('login')->with('success', 'Email ID verified. You can now login to your account.');

        } else {
            $msg = "Email ID Verification Failed. verification Failed Email ID : " . $username . " User Reg ID " . $userregid;

            $logdata = [
                'user_id'       => $username,
                'ip_address'    => $loggedUserIp,
                'log_time'      => $time,
                'status'        => $msg
            ];
            $LogDetails->insert($logdata);
            return redirect()->route('login')->withErrors(['error' => 'Email ID Verification Failed. Please check your Details.']);
        }
    }




    public function otpGenrateReset(Request $request)
    {
        $emal_mob = $request->input('emal_mob');
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time=date('Y-m-d H:i:s');
        $User = new User();
        $LogDetails = new LogDetails();
        $OTPGenModel = new OTPGenerate();
        $random_chars = '';
        if (strpos($emal_mob, '@') !== false) {
            $email = $emal_mob;
            $mobile = null;
            $userAccuntData = User::where('email', $email)->get();
            $cnt = count($userAccuntData);
            if($cnt>0)
             {
                foreach ($userAccuntData as $row) {

                    $id = $row->id;
                    $fname = $row->name;
                    $email = $row->email;
                    $mobno = $row->mobno;
                    $role_id = $row->role_id;
                    $approved = $row->approved;
                    $user_status = $row->user_status;
                }

                if($user_status!='Y'){
                        return response()->json(['result' => 5,'mesge'=>'Inactive User. Please verify your register email.','sendto'=>$email]);
                }
                if (($role_id != 4 && $role_id != 1) && $approved !== 'Y') {
                    return response()->json(['result' => 5,'mesge'=>'Not Approved.Please contact adminstrator','sendto'=>$email]);
                }

                $request->session()->put('emailid', $email);
				 $characters = array(
					"1","2","3","4","5","6","7","8","9"
				);
				$keys = array();
				while (count($keys) < 6) {
					$x = mt_rand(0, count($characters) - 1);
					if (!in_array($x, $keys)) {
						$keys[] = $x;
					}
				}
				foreach ($keys as $key) {
					$random_chars.= $characters[$key];
				}
				$message=$random_chars;
                $checkval="2";
                $verificationToken = base64_encode($id . '-' . $email.'-,-');
                $emailid = new EmailVerification($verificationToken, $fname, $email, $checkval, $message);
				$otpMobData = $OTPGenModel->where(['otpmsgtype' => $email])->get();
				if(count($otpMobData)>0)
				{
					foreach($otpMobData as $row)
					{
						$otpid=$row->id;

						$data = [
							'otp' 			=> $random_chars,
							'updated_by' 	=> $id,
							'updated_at' 	=> $time
						];

                        $OTPGenModel->where('id', $otpid)->update($data);
                    }
                        Mail::to($email)->send($emailid);
                        $msg = "Email ID : " . $email . " User Reg ID " . $id. " OTP is " . $message;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);

            }
            else{
                    $data = [
                        'user_id' 	    => $id,
                        'otpmsgtype' 	=> $email,
                        'otp' 			=> $random_chars,
                        'created_time' 	=> $time,
                        'created_at' 	=> $time
                    ];
                    $OTPGenModel->insert($data);
                    Mail::to($email)->send($emailid);
                    $msg = "Email ID : " . $email . " User Reg ID " . $id. " OTP is " . $message;
                    $logdata = [
                        'user_id'       => $email,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
                }

                //echo $email->mailContent;
                return response()->json(['result' => 1,'mesge'=>'The OTP has been send to your registered email id','sendto'=>$email]);
            }
            else{
                return response()->json(['result' => 2]);
            }

        }
        else
        {
            $email = null;
            $mobile = $emal_mob;
            $userAccuntData = User::where('mobno', $mobile)->get();
            $cnt = count($userAccuntData);
            if($cnt>0)
            {
                foreach ($userAccuntData as $row) {

                    $id = $row->id;
                    $fname = $row->name;
                    $email = $row->email;
                    $mobno = $row->mobno;
                    $role_id = $row->role_id;
                    $approved = $row->approved;
                    $user_status = $row->user_status;
                }

                if($user_status!='Y'){
                        return response()->json(['result' => 5,'mesge'=>'Inactive User. Please verify your register email.','sendto'=>$mobno]);
                }
                if (($role_id != 4 && $role_id != 1) && $approved !== 'Y') {
                    return response()->json(['result' => 5,'mesge'=>'Not Approved.Please contact adminstrator','sendto'=>$mobno]);
                }
                $request->session()->put('mobno', $mobno);
                $msg="Your One Time Password is ";
				 $characters = array(
					"1","2","3","4","5","6","7","8","9"
				);
				$keys = array();
				while (count($keys) < 6) {
					$x = mt_rand(0, count($characters) - 1);
					if (!in_array($x, $keys)) {
						$keys[] = $x;
					}
				}
				foreach ($keys as $key) {
					$random_chars.= $characters[$key];
				}
				$message='The OTP has been send to your registered mobile number, '.$msg.' : '.$random_chars;
				$otpMobData = $OTPGenModel->where(['otpmsgtype' => $mobno])->get();
				if(count($otpMobData)>0)
				{
					foreach($otpMobData as $row)
					{
						$otpid=$row->id;

						$data = [
							'otp' 			=> $random_chars,
							'updated_by' 	=> $id,
							'updated_at' 	=> $time
						];
                        $OTPGenModel->where('id', $otpid)->update($data);
                    }
                        //Mail::to($email)->send($emailid);
                        $msg = "Mobile Number : " . $mobno . " User Reg ID " . $id. " OTP is " . $message;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);
                }
                else{
                        $data = [
                            'user_id' 	    => $id,
                            'otpmsgtype' 	=> $mobno,
                            'otp' 			=> $random_chars,
                            'created_time' 	=> $time
                        ];
                        $OTPGenModel->insert($data);
                        //Mail::to($email)->send($emailid);
                        $msg = "Email ID : " . $email . " User Reg ID " . $id. " OTP is " . $message;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);
                    }


                    return response()->json(['result' => 3,'mesge'=>$message,'sendto'=>$mobno]);

            }
            else{
                return response()->json(['result' => 2]);
            }
        }

    }



    public function otpRegenGenrate(Request $request)
    {
        $emal_mob = $request->input('sentoval');
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time=date('Y-m-d H:i:s');
        $User = new User();
        $LogDetails = new LogDetails();
        $OTPGenModel = new OTPGenerate();
        $random_chars = '';
        if (strpos($emal_mob, '@') !== false) {
            $email = $emal_mob;
            $mobile = null;
            $userAccuntData = User::where('email', $email)->get();
            $cnt = count($userAccuntData);
            if($cnt>0)
             {
                foreach ($userAccuntData as $row) {

                    $id = $row->id;
                    $fname = $row->name;
                    $email = $row->email;
                    $mobno = $row->mobno;
                    $role_id = $row->role_id;
                    $approved = $row->approved;
                }

                $OTPGenerate = OTPGenerate::where('otpmsgtype', $email)->get();
                $cntmail = count($OTPGenerate);
                    foreach ($OTPGenerate as $rowgen) {
                        $random_chars = $rowgen->otp;
                    }
				$message=$random_chars;
                $checkval="2";
                $verificationToken = base64_encode($id . '-' . $email.'-,-');
                $emailid = new EmailVerification($verificationToken, $fname, $email, $checkval, $message);
				$otpMobData = $OTPGenModel->where(['otpmsgtype' => $email])->get();
				if(count($otpMobData)>0)
				{
					foreach($otpMobData as $row)
					{
						$otpid=$row->id;
						$data = [
							'otp' 			=> $random_chars,
							'updated_by' 	=> $id,
							'updated_at' 	=> $time
						];

                        $OTPGenModel->where('id', $otpid)->update($data);
                    }
                        Mail::to($email)->send($emailid);
                        $msg = "Email ID : " . $email . " User Reg ID " . $id. " OTP is " . $message;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);

            }
            else{
                    $data = [
                        'user_id' 	    => $id,
                        'otpmsgtype' 	=> $email,
                        'otp' 			=> $random_chars,
                        'created_time' 	=> $time,
                        'created_at' 	=> $time
                    ];
                    $OTPGenModel->insert($data);
                    Mail::to($email)->send($emailid);
                    $msg = "Email ID : " . $email . " User Reg ID " . $id. " OTP is " . $message;
                    $logdata = [
                        'user_id'       => $email,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
                }

                //echo $email->mailContent;
                return response()->json(['result' => 3,'mesge'=>'The OTP has been send to your registered email id','sendto'=>$email]);
            }
            else{
                return response()->json(['result' => 2]);
            }

        }
        else
        {
            $email = null;
            $mobile = $emal_mob;
            $userAccuntData = User::where('mobno', $mobile)->get();
            $cnt = count($userAccuntData);
            if($cnt>0)
            {
                foreach ($userAccuntData as $row) {

                    $id = $row->id;
                    $fname = $row->name;
                    $email = $row->email;
                    $mobno = $row->mobno;
                    $role_id = $row->role_id;
                    $approved = $row->approved;
                }
                $OTPGenerate = OTPGenerate::where('otpmsgtype', $mobno)->get();
                $cntmob = count($OTPGenerate);
                    foreach ($OTPGenerate as $rowgen) {
                        $random_chars = $rowgen->otp;
                    }
                $msg="Your One Time Password is ";
				$message='The OTP has been send to your registered mobile number, '.$msg.' : '.$random_chars;
				$otpMobData = $OTPGenModel->where(['otpmsgtype' => $mobno])->get();
				if(count($otpMobData)>0)
				{
					foreach($otpMobData as $row)
					{
						$otpid=$row->id;

						$data = [
							'otp' 			=> $random_chars,
							'updated_by' 	=> $id,
							'updated_at' 	=> $time
						];
                        $OTPGenModel->where('id', $otpid)->update($data);
                    }
                        //Mail::to($email)->send($emailid);
                        $msg = "Mobile Number : " . $mobno . " User Reg ID " . $id. " OTP is " . $message;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);
                }
                else{
                        $data = [
                            'user_id' 	    => $id,
                            'otpmsgtype' 	=> $mobno,
                            'otp' 			=> $random_chars,
                            'created_time' 	=> $time
                        ];
                        $OTPGenModel->insert($data);
                        //Mail::to($email)->send($emailid);
                        $msg = "Email ID : " . $email . " User Reg ID " . $id. " OTP is " . $message;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);
                    }


                    return response()->json(['result' => 3,'mesge'=>$message,'sendto'=>$mobno]);

            }
            else{
                return response()->json(['result' => 2]);
            }
        }

    }


    public function verifyOTPCheck(Request $request)
    {
        $emal_mob = $request->input('sentoval');
        $otpval = $request->input('otpval');
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time=date('Y-m-d H:i:s');
        $User = new User();
        $LogDetails = new LogDetails();
        $OTPGenModel = new OTPGenerate();
        $random_chars = '';
        if (strpos($emal_mob, '@') !== false) {
            $email = $emal_mob;
            $mobile = null;
            $userAccuntData = User::where('email', $email)->get();
            $cnt = count($userAccuntData);
            if($cnt>0)
             {
                foreach ($userAccuntData as $row) {

                    $id = $row->id;
                    $fname = $row->name;
                    $email = $row->email;
                    $mobno = $row->mobno;
                    $role_id = $row->role_id;
                    $approved = $row->approved;
                }
                //echo $email.'='.$otpval;exit;

                $OTPGenerate = OTPGenerate::where('otpmsgtype', $email)->where('otp', $otpval)->get();
                $cntmail = count($OTPGenerate);
                    if($cntmail>0)
                    {
                        $data = [
                            'email_verify' => 'Y',
                        ];
                        User::where('id', $id)->update($data);
                        $msg = "Email ID : " . $email . " User Reg ID " . $id. " Verify OTP is " . $otpval;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);
                        return response()->json(['result' => 3,'mesge'=>'OTP Successfully Verified','sendto'=>$email]);
                    }
                    else{
                        return response()->json(['result' => 2]);
                    }
            }
            else{
                return response()->json(['result' => 2]);
            }

        }
        else
        {
            $email = null;
            $mobile = $emal_mob;
            $userAccuntData = User::where('mobno', $mobile)->get();
            $cnt = count($userAccuntData);
            if($cnt>0)
            {
                foreach ($userAccuntData as $row) {

                    $id = $row->id;
                    $fname = $row->name;
                    $email = $row->email;
                    $mobno = $row->mobno;
                    $role_id = $row->role_id;
                    $approved = $row->approved;
                }

                $OTPGenerate = OTPGenerate::where('otpmsgtype', $mobno)->where('otp', $otpval)->get();
                $cntmob = count($OTPGenerate);
                if($cntmob>0)
                {
                    $data = [
                        'mobile_verify' => 'Y',
                    ];
                    User::where('id', $id)->update($data);
                    $msg = "Mobile Number : " . $mobno . " User Reg ID " . $id. " Verify OTP is " . $otpval;
                    $logdata = [
                        'user_id'       => $email,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
                    return response()->json(['result' => 3,'mesge'=>'OTP Successfully Verified','sendto'=>$mobno]);

                }
                else{
                    return response()->json(['result' => 2]);
                }
            }
            else{
                return response()->json(['result' => 2]);
            }
        }

    }



    public function ResetNewPaswd(Request $request)
    {
        $request->validate([
            'newpaswd'      => 'required|min:6',
            'confirmpaswd'  => 'required|same:newpaswd',
        ]);
        $emal_mob = $request->input('sentovalhid');
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time=date('Y-m-d H:i:s');
        $User = new User();
        $LogDetails = new LogDetails();
        if (strpos($emal_mob, '@') !== false) {
            $email = $emal_mob;
            $mobile = null;
            $userAccuntData = User::where('email', $email)->get();
            $cnt = count($userAccuntData);
            if($cnt>0)
             {
                foreach ($userAccuntData as $row) {

                    $id     = $row->id;
                    $fname  = $row->name;
                    $email  = $row->email;
                    $mobno  = $row->mobno;
                    $role_id = $row->role_id;
                    $approved = $row->approved;
                }
                $data = [
                    'forgot_pass' => $request->newpaswd,
                    'password' => Hash::make($request->newpaswd),
                ];
                User::where('id', $id)->update($data);
                $checkval="3";
                $verificationToken = base64_encode($id . '-' . $email.'-,-');
                $emailid = new EmailVerification($verificationToken, $fname, $email, $checkval, $request->newpaswd);
                Mail::to($email)->send($emailid);
                $msg = "Email ID : " . $email . " User Reg ID " . $id. " New Password is " . $request->newpaswd;
                $logdata = [
                    'user_id'       => $email,
                    'ip_address'    => $loggedUserIp,
                    'log_time'      => $time,
                    'status'        => $msg
                ];
                $LogDetails->insert($logdata);
                return response()->json(['result' => 1,'mesge'=>'Password Successfully Changed','sendto'=>$email]);
                }
                else{
                    return response()->json(['result' => 2]);
                }
            }

        else
        {
            $email = null;
            $mobile = $emal_mob;
            $userAccuntData = User::where('mobno', $mobile)->get();
            $cnt = count($userAccuntData);
            if($cnt>0)
            {
                foreach ($userAccuntData as $row) {

                    $id     = $row->id;
                    $fname  = $row->name;
                    $email  = $row->email;
                    $mobno  = $row->mobno;
                    $role_id = $row->role_id;
                    $approved = $row->approved;
                }
                $data = [
                    'forgot_pass' => $request->newpaswd,
                    'password' => Hash::make($request->newpaswd),
                ];
                User::where('id', $id)->update($data);
                $checkval="3";
                $verificationToken = base64_encode($id . '-' . $email.'-,-');
                $emailid = new EmailVerification($verificationToken, $fname, $email, $checkval, $request->newpaswd);
                Mail::to($email)->send($emailid);
                $msg = "Email ID : " . $email . " User Reg ID " . $id. " New Password is " . $request->newpaswd;
                $logdata = [
                    'user_id'       => $email,
                    'ip_address'    => $loggedUserIp,
                    'log_time'      => $time,
                    'status'        => $msg
                ];
                $LogDetails->insert($logdata);
                return response()->json(['result' => 1,'mesge'=>'Password Successfully Changed','sendto'=>$mobno]);
            }
            else{
                return response()->json(['result' => 2]);
            }
        }

    }



    public function MobLoginOTPgenrte(Request $request)
    {
        $logn_mob = $request->input('logn_mob');
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time=date('Y-m-d H:i:s');
        $User = new User();
        $LogDetails = new LogDetails();
        $OTPGenModel = new OTPGenerate();
        $random_chars = '';
        $emailmob = $logn_mob;
        if (strpos($emailmob, '@') !== false) {
            $email = $emailmob;
            $mobile = null;
            $userAccuntData = User::where('email', $email)->get();
            $cnt = count($userAccuntData);
            if($cnt>0)
            {
                foreach ($userAccuntData as $row) {

                    $id = $row->id;
                    $fname = $row->name;
                    $email = $row->email;
                    $mobno = $row->mobno;
                    $role_id = $row->role_id;
                    $approved = $row->approved;
                    $user_status = $row->user_status;

                }

                if($user_status!='Y')
                {
                    return response()->json(['result' => 5,'mesge'=>'Inactive User.','sendto'=>$email]);
                }


                // if (($role_id != 4 && $role_id != 1) && $approved !== 'Y') {
                //     return response()->json(['result' => 5,'mesge'=>'Not Approved.Please contact adminstrator','sendto'=>$email]);
                // }

                $roleIdsArray = explode(',', $role_id);
                if ((in_array('1', $roleIdsArray) || in_array('4', $roleIdsArray) || in_array('10', $roleIdsArray) || in_array('11', $roleIdsArray)) && ($approved !== 'Y'))
                {
                    return response()->json(['result' => 5,'mesge'=>'Not Approved.Please contact adminstrator','sendto'=>$emailid]);
                }

                $request->session()->put('mobno', $email);
                $msg="Your One Time Password is ";
                    $characters = array(
                    "1","2","3","4","5","6","7","8","9"
                );
                $keys = array();
                while (count($keys) < 6) {
                    $x = mt_rand(0, count($characters) - 1);
                    if (!in_array($x, $keys)) {
                        $keys[] = $x;
                    }
                }
                foreach ($keys as $key) {
                    $random_chars.= $characters[$key];
                }
                $message='The OTP has been send to your registered email id , '.$msg.' : '.$random_chars;
                $otpMobData = $OTPGenModel->where(['otpmsgtype' => $email])->get();
                if(count($otpMobData)>0)
                {
                    foreach($otpMobData as $row)
                    {
                        $otpid=$row->id;
                        $data = [
                            'otp' 			=> $random_chars,
                            'updated_by' 	=> $id,
                            'updated_at' 	=> $time
                        ];
                        $OTPGenModel->where('id', $otpid)->update($data);
                    }
                        //Mail::to($email)->send($emailid);
                        $msg = "Email ID : " . $email . " User Reg ID " . $id. " OTP is " . $message;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);
                }
                else{
                        $data = [
                            'user_id' 	    => $id,
                            'otpmsgtype' 	=> $email,
                            'otp' 			=> $random_chars,
                            'created_time' 	=> $time
                        ];
                        $OTPGenModel->insert($data);
                        //Mail::to($email)->send($emailid);
                        $msg = "Email ID : " . $email . " User Reg ID " . $id. " OTP is " . $message;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);
                    }

                    $valencodemm = $id . '-' . $email;
                    $valsmm = base64_encode($valencodemm);
                    $refer_chars='';
                    $verificationToken = base64_encode($id . '-' . $email . '-' . $random_chars . '-' . $refer_chars);
                    $checkval = '2';
                    $message = '';
                    $emailsend = new EmailVerification($verificationToken, $fname, $email, $checkval, $random_chars);
                    Mail::to($email)->send($emailsend);
                    return response()->json(['result' => 3,'mesge'=>$message,'sendto'=>$email]);
            }
            else{
                return response()->json(['result' => 2]);
            }
        }
        else{
            $email = null;
            $mobile = $emailmob;
            $userAccuntData = User::where('mobno', $mobile)->get();
            $cnt = count($userAccuntData);
            if($cnt>0)
            {
                foreach ($userAccuntData as $row) {

                    $id = $row->id;
                    $fname = $row->name;
                    $email = $row->email;
                    $mobno = $row->mobno;
                    $role_id = $row->role_id;
                    $approved = $row->approved;
                    $user_status = $row->user_status;

                }

                if($user_status!='Y')
                {
                    return response()->json(['result' => 5,'mesge'=>'Inactive User. Please verify your register email.','sendto'=>$mobno]);
                }


                // if (($role_id != 4 && $role_id != 1) && $approved !== 'Y') {
                //     return response()->json(['result' => 5,'mesge'=>'Not Approved.Please contact adminstrator','sendto'=>$mobno]);
                // }
                $roleIdsArray = explode(',', $role_id);
                if ((in_array('1', $roleIdsArray) || in_array('4', $roleIdsArray) || in_array('10', $roleIdsArray) || in_array('11', $roleIdsArray)) && ($approved !== 'Y'))
                {
                    return response()->json(['result' => 5,'mesge'=>'Not Approved.Please contact adminstrator','sendto'=>$emailid]);
                }


                $request->session()->put('mobno', $mobno);
                $msg="Your One Time Password is ";
                    $characters = array(
                    "1","2","3","4","5","6","7","8","9"
                );
                $keys = array();
                while (count($keys) < 6) {
                    $x = mt_rand(0, count($characters) - 1);
                    if (!in_array($x, $keys)) {
                        $keys[] = $x;
                    }
                }
                foreach ($keys as $key) {
                    $random_chars.= $characters[$key];
                }
                $message='The OTP has been send to your registered mobile number, '.$msg.' : '.$random_chars;
                $otpMobData = $OTPGenModel->where(['otpmsgtype' => $mobno])->get();
                if(count($otpMobData)>0)
                {
                    foreach($otpMobData as $row)
                    {
                        $otpid=$row->id;

                        $data = [
                            'otp' 			=> $random_chars,
                            'updated_by' 	=> $id,
                            'updated_at' 	=> $time
                        ];
                        $OTPGenModel->where('id', $otpid)->update($data);
                    }
                        //Mail::to($email)->send($emailid);
                        $msg = "Mobile Number : " . $mobno . " User Reg ID " . $id. " OTP is " . $message;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);
                }
                else{
                        $data = [
                            'user_id' 	    => $id,
                            'otpmsgtype' 	=> $mobno,
                            'otp' 			=> $random_chars,
                            'created_time' 	=> $time
                        ];
                        $OTPGenModel->insert($data);
                        //Mail::to($email)->send($emailid);
                        $msg = "Email ID : " . $email . " User Reg ID " . $id. " OTP is " . $message;
                        $logdata = [
                            'user_id'       => $email,
                            'ip_address'    => $loggedUserIp,
                            'log_time'      => $time,
                            'status'        => $msg
                        ];
                        $LogDetails->insert($logdata);
                    }


                    return response()->json(['result' => 3,'mesge'=>$message,'sendto'=>$mobno]);

            }
            else{
                return response()->json(['result' => 2]);
            }
        }
        //$userAccuntData = User::where('mobno', $mobile)->get();



    }

        public function EmailLoginPage(Request $request)
        {
            $request->validate([
                'emailid' => 'required',
                'passwd' => 'required|min:6',
            ]);


            $emailmob = $request->input('emailid');
            $password = $request->input('passwd');
            //$user = DB::table('users')->where('email', $email)->first();


            if (strpos($emailmob, '@') !== false) {
                $email = $emailmob;
                $mobile = null;
                $user = DB::table('users')->where('email', $email)->first();
            }
            else{
                $email = null;
                $mobile = $emailmob;
                $user = DB::table('users')->where('mobno', $mobile)->first();
            }

            //echo "<pre>";print_r($user);exit;
            if ($user && Hash::check($password, $user->password)) {
                $role_id = $user->role_id;
                $approved = $user->approved;
                $emailid = $user->email;
                if (!empty($emailid)) {
                    $emailid = $user->email;
                } else {
                    $emailid = $user->mobno;
                }
                $user_status = $user->user_status;
                if($user_status!='Y'){
                        return response()->json(['result' => 5,'mesge'=>'Inactive User. Please verify your register email.','sendto'=>$emailid]);
                }
                // if (($role_id != 4 && $role_id != 1) && $approved !== 'Y') {
                //     return response()->json(['result' => 5,'mesge'=>'Not Approved.Please contact adminstrator','sendto'=>$emailid]);
                // }
                $roleIdsArray = explode(',', $role_id);
                if ((in_array('1', $roleIdsArray) || in_array('4', $roleIdsArray) || in_array('10', $roleIdsArray) || in_array('11', $roleIdsArray)) && ($approved !== 'Y'))
                {
                    return response()->json(['result' => 5,'mesge'=>'Not Approved.Please contact adminstrator','sendto'=>$emailid]);
                }

                return response()->json(['result' => 3,'mesge' => 'Successfully Logged In.','sendto' => $emailid]);
            } else {
                return response()->json(['result' => 2,'mesge' => 'Invalid email or password.']);
            }
        }


        function sellerRegisterationPage(Request $request)
        {
            $loggedUserIp=$_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $validatedData = $request->validate([
                's_name' => 'required|max:50',
                's_ownername' => 'required|max:50',
                's_mobcntrycode' => 'required',
                's_mobno' => 'required|max:10',
                //'s_email' => 'required|email|max:35',
                's_refralid' => 'max:50',
                's_busnestype' => 'required',
                's_shopservice' => 'required',
                //'s_subshopservice' => 'required',
                's_shopservicetype' => 'required',
                //'s_shopexectename' => 'required',
                's_lisence' => 'max:25',
                's_buldingorhouseno' => 'required|max:100',
                's_locality' => 'required|max:100',
                's_villagetown' => 'required|max:100',
                'country' => 'required',
                'state' => 'required',
                'district' => 'required',
                's_pincode' => 'required|max:6',
                's_googlelatitude' => 'required',
                's_googlelongitude' => 'required',
                //'s_photo' => 'required|image|mimes:jpeg,png|max:1024',
                's_gstno' => ['sometimes', 'max:25'],
                's_panno' => ['sometimes', 'max:10'],
                //'s_establishdate' => 'required|date',
                's_paswd' => 'required|max:20',
                's_rpaswd' => 'required|same:s_paswd',
                's_termcondtn' => 'accepted',
            ]);

            $emailverifystatus= $request->s_emailverifystatus;
            $mobnoverifystatus= $request->s_mobverifystatus;
            if($mobnoverifystatus!='Y')
            {
                return response()->json(['message' => 'Mobile number not verified']);
            }
            if($request->s_email!='')
            {
                if($emailverifystatus!='Y')
                {
                    return response()->json(['message' => 'Email ID not verified']);
                }

            }
            $user = new User();
            $user->name = ucfirst($request->s_name);
            $user->mob_countrycode = $request->s_mobcntrycode;
            $user->email = $request->s_email;
            $user->mobno = $request->s_mobno;
            $user->password = Hash::make($request->s_paswd);
            if($request->s_busnestype==1)
            {$user->role_id=2;}
            else if($request->s_busnestype==2)
            {$user->role_id=9;}
            $user->forgot_pass=$request->s_paswd;
            // if (!empty($request->s_email)) {
            //     $user->user_status='N';
            // } else {
            //     $user->user_status='Y';
            // }
            if (!empty($request->s_email)) {
                $user->email_verify='Y';
            } else {
                $user->email_verify='N';
            }
            $user->user_status='Y';
            $user->mobile_verify='Y';
            $user->ip=$loggedUserIp;
            $submt=$user->save();
            $lastRegId = $user->toSql();
            $last_id = $user->id;
            $msg="Registration Success! ".$request->s_mobno." register id : ".$last_id;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $request->s_mobno;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
            if($submt>0){
                $sellerDetail = new SellerDetails();
                $sellerDetail->fill($validatedData);
                $sellerDetail->shop_name = ucfirst($request->input('s_name'));
                $sellerDetail->owner_name = ucfirst($request->input('s_ownername'));
                $sellerDetail->shop_email = $request->input('s_email');
                $sellerDetail->mob_country_code = $request->input('s_mobcntrycode');
                $sellerDetail->shop_mobno = $request->input('s_mobno');
                $sellerDetail->referal_id = $request->input('s_refralid');
                $sellerDetail->busnes_type = $request->input('s_busnestype');
                $sellerDetail->shop_service_type = $request->input('s_shopservice');
                //$sellerDetail->service_subcategory_id = $request->input('s_subshopservice');
                $sellerDetail->shop_type = $request->input('s_shopservicetype');
                $sellerDetail->shop_executive = $request->input('s_shopexectename');
                $sellerDetail->term_condition = $request->has('s_termcondtn') ? 1 : 0;
                $sellerDetail->shop_licence = $request->input('s_lisence');
                $sellerDetail->house_name_no = $request->input('s_buldingorhouseno');
                $sellerDetail->locality = ucfirst($request->input('s_locality'));
                $sellerDetail->village = ucfirst($request->input('s_villagetown'));
                $sellerDetail->country = $request->input('country');
                $sellerDetail->state = $request->input('state');
                $sellerDetail->district = $request->input('district');
                $sellerDetail->pincode = $request->input('s_pincode');
                $sellerDetail->latitude = $request->input('s_googlelatitude');
                $sellerDetail->longitude = $request->input('s_googlelongitude');
                $sellerDetail->shop_gstno = $request->input('s_gstno');
                $sellerDetail->shop_panno = $request->input('s_panno');
                $sellerDetail->establish_date = $request->input('s_establishdate');
                $sellerDetail->user_id = $last_id;
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

                $input_media = [];
                $input_valmedia = [];
                    $input_mediaval = [
                        'mediatype' => '',
                        'mediaurl' => '',
                    ];
                $input_media[] = $input_mediaval;
                $input_valmedia['mediadets'] = $input_media;
                $jsonmedia = json_encode($input_valmedia);
                $sellerDetail->socialmedia = $jsonmedia;
                $shopreg=$sellerDetail->save();

                // if (!empty($request->s_email)) {
                //     $valencodemm=$lastRegId."-".$request->s_email;
                //     $valsmm=base64_encode($valencodemm);
                //     $verificationToken = base64_encode($last_id . '-' . $request->s_email.'-,-');
                //     $checkval="1";
                //     $message='';
                //     $email = new EmailVerification($verificationToken, $request->s_name, $request->s_email, $checkval, $message);
                //     Mail::to($request->s_email)->send($email);
                // }


            } else {

            }
        }

        function affiliatorRegisterationPage(Request $request)
        {
            $loggedUserIp=$_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $validatedData = $request->validate([
                'a_name' => 'required|max:50',
                'a_mobno' => 'required|max:10',
                'a_email' => 'required|email|max:35',
                'a_refralid' => 'max:50',
                'a_locality' => 'required|max:100',
                'a_aadharno' => 'required|max:12',
                'a_country' => 'required',
                'a_state' => 'required',
                'a_district' => 'required',
                // 'uplodadhar' => 'required|image|mimes:jpeg,png|max:1024',
                'a_dob' => 'required|date|before:today|max:10',
                'a_paswd' => 'required|max:20',
                'a_rpaswd' => 'required|same:a_paswd',
                'a_termcondtn' => 'accepted',
            ]);
            $user = new User();
            $user->name = $request->a_name;
            $user->email = $request->a_email;
            $user->mobno = $request->a_mobno;
            $user->password = Hash::make($request->a_paswd);
            $user->role_id=3;
            $user->forgot_pass=$request->a_paswd;
            $user->user_status='N';
            $user->ip=$loggedUserIp;
            $submt=$user->save();
            $lastRegId = $user->toSql();
            $last_id = $user->id;
            $msg="Registration Success! ".$request->a_email." register id : ".$last_id;
            $LogDetails = new LogDetails();
            $LogDetails->user_id = $request->a_email;
            $LogDetails->ip_address = $loggedUserIp;
            $LogDetails->log_time = $time;
            $LogDetails->status = $msg;
            $LogDetails->save();
            if($submt>0){
                $affliteDetail = new Affiliate();
                $affliteDetail->fill($validatedData);
                $affliteDetail->name = $request->input('a_name');
                $affliteDetail->email = $request->input('a_email');
                $affliteDetail->mob_no = $request->input('a_mobno');
                $affliteDetail->dob = $request->input('a_dob');
                $affliteDetail->aadhar_no = $request->input('a_aadharno');
                $affliteDetail->locality = $request->input('a_locality');
                $affliteDetail->country = $request->input('a_country');
                $affliteDetail->state = $request->input('a_state');
                $affliteDetail->district = $request->input('a_district');
                $affliteDetail->aadhar_file = $request->input('s_locality');
                $affliteDetail->terms_condition = $request->has('a_termcondtn') ? 1 : 0;
                $affliteDetail->referal_id = $request->input('a_refralid');
                if ($request->hasFile('uplodadhar')) {
                    $upload_path = 'uploads/affiliateimages/';
                    if (!is_dir($upload_path)) {
                        mkdir($upload_path, 0777, true);
                    }

                    $input_datas = [];
                    foreach ($request->file('uplodadhar') as $file) {
                        if ($file->isValid()) {
                            $new_name = time() . '_' . $file->getClientOriginalName();
                            $file->move($upload_path, $new_name);
                            $filename = $upload_path . $new_name;
                            array_push($input_datas, $filename);
                        }
                    }
                    $input_vals = ['fileval' => $input_datas];
                    $jsonimages = json_encode($input_vals);
                    $affliteDetail->aadhar_file = $jsonimages;
                }

                $input_valsp = ['passbook' => ''];
                $jsonimagesp = json_encode($input_valsp);
                $affliteDetail->passbook_file = $jsonimagesp;

                $input_valsph = ['photos' => ''];
                $jsonimagesph = json_encode($input_valsph);
                $affliteDetail->photo_file = $jsonimagesph;


                $affliteDetail->user_id = $last_id;
                $maxId = $affliteDetail->max('affiliate_reg_id');
                if ($maxId) {
                    $nextId = $maxId + 1;
                } else {
                    $nextId = '500';
                }
                $affliteDetail->affiliate_reg_id = $nextId;
                $afiltereg=$affliteDetail->save();
                $valencodemm=$lastRegId."-".$request->a_email;
                $valsmm=base64_encode($valencodemm);
                $verificationToken = base64_encode($last_id . '-' . $request->a_email.'-,-');
                $checkval="1";
                $message='';
                $email = new EmailVerification($verificationToken, $request->a_name, $request->a_email, $checkval, $message);
                Mail::to($request->a_email)->send($email);

            } else {

            }
        }


        public function MailSendOTPRegistration(Request $request)
        {
            $fname = $request->input('u_name');
            $u_emid = $request->input('u_emid');
            $loggedUserIp = $_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $User = new User();
            $LogDetails = new LogDetails();
            $OTPGenModel = new OTPGenerate();
            $random_chars = '';
            $emailid = $u_emid;
            $otpCount = DB::table('otp_generate')
            ->where('otpmsgtype', $emailid)
            ->max('otp_count');
            if ($otpCount === null || $otpCount === 0) {
                $otpCount = 1;
            } else {
                $otpCount++;
            }

            $msg="Your One Time Password is ";
            $characters = array(
            "1","2","3","4","5","6","7","8","9");
            $keys = array();
            while (count($keys) < 6) {
                $x = mt_rand(0, count($characters) - 1);
                if (!in_array($x, $keys)) {
                    $keys[] = $x;
                }
            }
            foreach ($keys as $key) {
                $random_chars.= $characters[$key];
            }

            if($otpCount>3)
            {
                $otpMobData = $OTPGenModel->where(['otpmsgtype' => $emailid])->get();
                foreach($otpMobData as $row)
                    {
                        $otpid=$row->id;
                        $updatedAt = $row->updated_at;
                        $currentDateTime = Carbon::now();
                        if ($currentDateTime->diffInMinutes($updatedAt) > 1) {

                            $data = [
                                'otp' 			=> $random_chars,
                                'otp_count' 	=> '1',
                                'updated_by' 	=> $emailid,
                                'updated_at' 	=> $time
                            ];
                            $OTPGenModel->where('id', $otpid)->update($data);
                        }
                    }
                    $msg = "Email ID : " . $emailid . " more than 3 time resend otp message ";
                    $logdata = [
                        'user_id'       => $emailid,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
                    return response()->json(['result' => 4]);
            }


            $message='The OTP has been send to your enter email id , '.$msg.' : '.$random_chars;
            $otpMobData = $OTPGenModel->where(['otpmsgtype' => $emailid])->get();
            if(count($otpMobData)>0)
            {
                foreach($otpMobData as $row)
                {
                    $otpid=$row->id;
                    $data = [
                        'otp' 			=> $random_chars,
                        'otp_count' 	=> $otpCount,
                        'updated_by' 	=> $emailid,
                        'updated_at' 	=> $time
                    ];
                    $OTPGenModel->where('id', $otpid)->update($data);
                }
                    //Mail::to($email)->send($emailid);
                    $msg = "Email ID : " . $emailid . " OTP is " . $message;
                    $logdata = [
                        'user_id'       => $emailid,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
            }
            else{
                    $data = [
                        'user_id' 	    => $emailid,
                        'otpmsgtype' 	=> $emailid,
                        'otp' 			=> $random_chars,
                        'otp_count' 	=> $otpCount,
                        'created_time' 	=> $time
                    ];
                    $OTPGenModel->insert($data);
                    //Mail::to($email)->send($emailid);
                    $msg = "Email ID : " . $emailid ." OTP is " . $message;
                    $logdata = [
                        'user_id'       => $emailid,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
                }
                $id=1;
                $valencodemm = $id . '-' . $emailid;
                $valsmm = base64_encode($valencodemm);
                $refer_chars='';
                $verificationToken = base64_encode($id . '-' . $emailid . '-' . $random_chars . '-' . $refer_chars);
                $checkval = '2';
                $message = '';
                $emailsend = new EmailVerification($verificationToken, $fname, $emailid, $checkval, $random_chars);
                Mail::to($emailid)->send($emailsend);
                return response()->json(['result' => 3,'mesge'=>$message,'sendto'=>$emailid]);

        }

        public function verifyEmailOTPCheck(Request $request)
        {
            $email = $request->input('sentoval');
            $otpval = $request->input('otpval');
            $loggedUserIp = $_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $User = new User();
            $LogDetails = new LogDetails();
            $OTPGenModel = new OTPGenerate();
            $random_chars = '';
            $OTPGenerate = OTPGenerate::where('otpmsgtype', $email)->where('otp', $otpval)->get();
            $cntmail = count($OTPGenerate);
                if($cntmail>0)
                {
                    $otpEmailData = $OTPGenModel->where(['otpmsgtype' => $email])->get();
                    foreach($otpEmailData as $row)
                        {
                            $otpid=$row->id;
                            $updatedAt = $row->updated_at;
                            $currentDateTime = Carbon::now();
                            $data = [
                                'otp_count' 	=> '1',
                                'updated_by' 	=> $email,
                                'updated_at' 	=> $time
                            ];
                            $OTPGenModel->where('id', $otpid)->update($data);

                        }
                    $msg = "Email ID : " . $email . " Verify OTP is " . $otpval;
                    $logdata = [
                        'user_id'       => $email,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
                    return response()->json(['result' => 3,'mesge'=>'Y']);
                }
                else{
                    return response()->json(['result' => 2,'mesge'=>'N']);
                }





        }


        public function MobnoSendOTPRegistration(Request $request)
        {
            $u_mobno = $request->input('u_mobno');
            $loggedUserIp = $_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $User = new User();
            $LogDetails = new LogDetails();
            $OTPGenModel = new OTPGenerate();
            $random_chars = '';
            $umobno = $u_mobno;
            $otpCount = DB::table('otp_generate')
            ->where('otpmsgtype', $umobno)
            ->max('otp_count');
            if ($otpCount === null || $otpCount === 0) {
                $otpCount = 1;
            } else {
                $otpCount++;
            }

            $msg="Your One Time Password is ";
            $characters = array(
            "1","2","3","4","5","6","7","8","9");
            $keys = array();
            while (count($keys) < 6) {
                $x = mt_rand(0, count($characters) - 1);
                if (!in_array($x, $keys)) {
                    $keys[] = $x;
                }
            }
            foreach ($keys as $key) {
                $random_chars.= $characters[$key];
            }

            if($otpCount>3)
            {
                $otpMobData = $OTPGenModel->where(['otpmsgtype' => $umobno])->get();
                foreach($otpMobData as $row)
                    {
                        $otpid=$row->id;
                        $updatedAt = $row->updated_at;
                        $currentDateTime = Carbon::now();
                        if ($currentDateTime->diffInMinutes($updatedAt) > 1) {

                            $data = [
                                'otp' 			=> $random_chars,
                                'otp_count' 	=> '1',
                                'updated_by' 	=> $umobno,
                                'updated_at' 	=> $time
                            ];
                            $OTPGenModel->where('id', $otpid)->update($data);
                        }
                    }
                    $msg = "Mobile No : " . $umobno . " more than 3 time resend otp message ";
                    $logdata = [
                        'user_id'       => $umobno,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
                    return response()->json(['result' => 4]);
            }


            $message='The OTP has been send to your enter mobile no  , '.$msg.' : '.$random_chars;
            $otpMobData = $OTPGenModel->where(['otpmsgtype' => $umobno])->get();
            if(count($otpMobData)>0)
            {
                foreach($otpMobData as $row)
                {
                    $otpid=$row->id;
                    $data = [
                        'otp' 			=> $random_chars,
                        'otp_count' 	=> $otpCount,
                        'updated_by' 	=> $umobno,
                        'updated_at' 	=> $time
                    ];
                    $OTPGenModel->where('id', $otpid)->update($data);
                }
                    $msg = "Mobile No : " . $umobno . " OTP is " . $message;
                    $logdata = [
                        'user_id'       => $umobno,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
            }
            else{
                    $data = [
                        'user_id' 	    => $umobno,
                        'otpmsgtype' 	=> $umobno,
                        'otp' 			=> $random_chars,
                        'otp_count' 	=> $otpCount,
                        'created_time' 	=> $time
                    ];
                    $OTPGenModel->insert($data);
                    //Mail::to($email)->send($emailid);
                    $msg = "Mobile No : " . $umobno ." OTP is " . $message;
                    $logdata = [
                        'user_id'       => $umobno,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
                }
                $mobotpmsg=base64_encode($random_chars);
                return response()->json(['result' => 3,'mesge'=>$mobotpmsg,'sendto'=>$umobno]);

        }

        public function verifyMobileNoOTPCheck(Request $request)
        {
            $mobno = $request->input('sentoval');
            $otpval = $request->input('otpval');
            $loggedUserIp = $_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $User = new User();
            $LogDetails = new LogDetails();
            $OTPGenModel = new OTPGenerate();
            $random_chars = '';
            $OTPGenerate = OTPGenerate::where('otpmsgtype', $mobno)->where('otp', $otpval)->get();
            $cntmail = count($OTPGenerate);
                if($cntmail>0)
                {
                    $otpMobData = $OTPGenModel->where(['otpmsgtype' => $mobno])->get();
                    foreach($otpMobData as $row)
                        {
                            $otpid=$row->id;
                            $updatedAt = $row->updated_at;
                            $currentDateTime = Carbon::now();
                            $data = [
                                'otp_count' 	=> '1',
                                'updated_by' 	=> $mobno,
                                'updated_at' 	=> $time
                            ];
                            $OTPGenModel->where('id', $otpid)->update($data);

                        }


                    $msg = "Mobile No : " . $mobno . " Verify OTP is " . $otpval;
                    $logdata = [
                        'user_id'       => $mobno,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
                    return response()->json(['result' => 3,'mesge'=>'Y']);
                }
                else{
                    return response()->json(['result' => 2,'mesge'=>'N']);
                }





        }


        public function verifyMailTermsCOnditions($typevas)
        {
            $typevals = urldecode($typevas);
            $typevals = base64_decode($typevals);
            $exlodval = explode('-', $typevals);
            //echo "<pre>";print_r($exlodval);exit;
            $userregid = $exlodval[0];
            $username = $exlodval[1];
            $loggedUserIp = $_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $userAccuntModel = new User();
            $LogDetails = new LogDetails();
            $userAccuntData = $userAccuntModel->select('id','user_status')->where(['id' => $userregid, 'email' => $username])->get();
            $countm = $userAccuntData->count();
            if ($countm > 0) {
                $userchkid = $userAccuntData[0]->id;
                $data = [
                    'active_date' => date('Y-m-d'),
                    'email_verify' => 'Y',
                    'approved' => 'Y',
                    'approved_by' => '1',
                    'approved_at' => $time,


                ];
                $userAccuntModel->where('id', $userchkid)->update($data);
                $sellerDetail = SellerDetails::where('user_id', $userchkid)->first();
                if ($sellerDetail) {
                    $sellerDetail->update([
                        'term_condition' => 1,
                        'seller_approved' => 'Y'
                    ]);
                }
                $msg = "Accept Terms and Conditions Successfully Approved. Approved Email ID : " . $username . " User Reg ID " . $userregid;
                $logdata = [
                    'user_id'       => $username,
                    'ip_address'    => $loggedUserIp,
                    'log_time'      => $time,
                    'status'        => $msg
                ];

                $LogDetails->insert($logdata);
                return redirect()->route('login')->with('success', 'Accept Terms and Conditions is Approved. You can now login to your account.');

            } else {
                $msg = "Accept Terms & Conditions Approved Failed. Approved Failed Email ID : " . $username . " User Reg ID " . $userregid;

                $logdata = [
                    'user_id'       => $username,
                    'ip_address'    => $loggedUserIp,
                    'log_time'      => $time,
                    'status'        => $msg
                ];
                $LogDetails->insert($logdata);
                return redirect()->route('login')->withErrors(['error' => 'Accept Terms and Conditions Approved Failed. Please check your Details.']);
            }
        }


    function PublicServiceProvider(Request $request)
    {
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $validatedData = $request->validate([
            'hidserviceprovider' => 'required|max:2',
            'serviceprovider_name' => 'required|max:50',
        ]);
        $servicetype = new ServiceType;
        $servicetype->service_name = ucfirst($request->serviceprovider_name);
        $servicetype->business_type_id = $request->hidserviceprovider;
        $servicetype->status = 'Y';
        $servicetype->created_at = $time;
        $submt = $servicetype->save();
        $lastRegId = $servicetype->toSql();
        $last_id = $servicetype->id;
        $msg = 'Seller/service provider successfully added! customer role  4 public.  Seller/service provider id : ' . $last_id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = '4';
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
    }






}

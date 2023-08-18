<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\LogDetails;
use App\Models\OTPGenerate;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.main');
    }
    public function Login()
    {
        $countries      = DB::table('country')->get();
         $business       = DB::table('business_type')->where('status','Y')->get();
        // $shopservice    = DB::table('shopservice')->where('status','Y')->get();
         $executives     = DB::table('executives')->where(['executive_type' => 1, 'status' => 'Y'])->get();

        return view('user.login',compact('countries','business','executives'));
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

    public function RegisterPage(Request $request)
    {

        $request->validate([
            'u_name'    => 'required',
            'u_emid'    => 'required|email|unique:user_account,email',
            'u_mobno'   => 'required|numeric|digits:10|unique:user_account,mobno',
            'u_paswd'   => 'required|min:6',
            'u_rpaswd' => 'required|same:u_paswd',
        ]);

        $user = new UserAccount();
        $regval=$request->regval;
        $loggedUserIp=$_SERVER['REMOTE_ADDR'];
        $time=date('Y-m-d H:i:s');
        if($regval==1)
        {
            $user->name = $request->u_name;
            $user->email = $request->u_emid;
            $user->mobno = $request->u_mobno;
            $user->password = Hash::make($request->u_paswd);
            $user->role_id=4;
            $user->forgot_pass=$request->u_paswd;
            $user->user_status='N';
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
                    $valencodemm=$lastRegId."-".$request->u_emid;
                    $valsmm=base64_encode($valencodemm);
                    $verificationToken = base64_encode($last_id . '-' . $request->u_emid);
                    $checkval="1";
                    $message='';
                    $email = new EmailVerification($verificationToken, $request->u_name, $request->u_emid, $checkval, $message);
                    try {
                        Mail::to($request->u_emid)->send($email);
                        //echo $email->mailContent;

                    } catch (Exception $e) {
                        return response()->json(['message' => 'Registration Failed'], 200);
                    }


                //return redirect()->route('login')->with('success', 'Registration Success. Please login!');
            } else {
                //return redirect()->route('login')->with('error', 'Registration Failed!');
            }
        }


    }



    public function ExistEmailCheck(Request $request)
    {
        $u_emid = $request->input('u_emid');
        $user = UserAccount::where('email', $u_emid)->get();
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
        $user = UserAccount::where('mobno', $u_mobno)->get();
        $count = $user->count();
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
            $userAccuntData = UserAccount::where('email', $email)->get();
            $cnt = count($userAccuntData);
        }
        else{
            $email = null;
            $mobile = $emailmob;
            $userAccuntData = UserAccount::where('mobno', $mobile)->get();
            $cnt = count($userAccuntData);
        }
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
        $userAccuntModel = new UserAccount();
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
        $UserAccount = new UserAccount();
        $LogDetails = new LogDetails();
        $OTPGenModel = new OTPGenerate();
        $random_chars = '';
        if (strpos($emal_mob, '@') !== false) {
            $email = $emal_mob;
            $mobile = null;
            $userAccuntData = UserAccount::where('email', $email)->get();
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
                $verificationToken = base64_encode($id . '-' . $email);
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
            $userAccuntData = UserAccount::where('mobno', $mobile)->get();
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
        $UserAccount = new UserAccount();
        $LogDetails = new LogDetails();
        $OTPGenModel = new OTPGenerate();
        $random_chars = '';
        if (strpos($emal_mob, '@') !== false) {
            $email = $emal_mob;
            $mobile = null;
            $userAccuntData = UserAccount::where('email', $email)->get();
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
                $verificationToken = base64_encode($id . '-' . $email);
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
            $userAccuntData = UserAccount::where('mobno', $mobile)->get();
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
        $UserAccount = new UserAccount();
        $LogDetails = new LogDetails();
        $OTPGenModel = new OTPGenerate();
        $random_chars = '';
        if (strpos($emal_mob, '@') !== false) {
            $email = $emal_mob;
            $mobile = null;
            $userAccuntData = UserAccount::where('email', $email)->get();
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

                $OTPGenerate = OTPGenerate::where('otpmsgtype', $email)->where('otp', $otpval)->get();
                $cntmail = count($OTPGenerate);
                    if($cntmail>0)
                    {
                    $msg = "Email ID : " . $email . " User Reg ID " . $id. " Verify OTP is " . $otpval;
                    $logdata = [
                        'user_id'       => $email,
                        'ip_address'    => $loggedUserIp,
                        'log_time'      => $time,
                        'status'        => $msg
                    ];
                    $LogDetails->insert($logdata);
                    return response()->json(['result' => 1,'mesge'=>'OTP Successfully Verified','sendto'=>$email]);
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
            $userAccuntData = UserAccount::where('mobno', $mobile)->get();
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
        $UserAccount = new UserAccount();
        $LogDetails = new LogDetails();
        if (strpos($emal_mob, '@') !== false) {
            $email = $emal_mob;
            $mobile = null;
            $userAccuntData = UserAccount::where('email', $email)->get();
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
                UserAccount::where('id', $id)->update($data);
                $checkval="3";
                $verificationToken = base64_encode($id . '-' . $email);
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
            $userAccuntData = UserAccount::where('mobno', $mobile)->get();
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
                UserAccount::where('id', $id)->update($data);
                $checkval="3";
                $verificationToken = base64_encode($id . '-' . $email);
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
        $UserAccount = new UserAccount();
        $LogDetails = new LogDetails();
        $OTPGenModel = new OTPGenerate();
        $random_chars = '';
        $mobile = $logn_mob;
        $userAccuntData = UserAccount::where('mobno', $mobile)->get();
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

        public function EmailLoginPage(Request $request)
        {
            $request->validate([
                'emailid' => 'required|email',
                'passwd' => 'required|min:6',
            ]);
            $email = $request->input('emailid');
            $password = $request->input('passwd');
            $user = DB::table('user_account')->where('email', $email)->first();
            if ($user && Hash::check($password, $user->password)) {
                $role_id = $user->role_id;
                $approved = $user->approved;
                $emailid = $user->email;
                if (($role_id != 4 && $role_id != 1) && $approved !== 'Y') {
                    return response()->json(['result' => 5,'mesge'=>'Not Approved.Please contact adminstrator','sendto'=>$email]);
                }

                return response()->json(['result' => 3,'mesge' => 'Successfully Logged In.','sendto' => $email]);
            } else {
                return response()->json(['result' => 2,'mesge' => 'Invalid email or password.']);
            }
        }







}

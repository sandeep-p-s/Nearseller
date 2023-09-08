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
        if($userId=='')
        {
            return redirect()->route('logout');
        }
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $countUsers     = DB::table('user_account')->where('role_id', 4)->count();
        $countAffiliate = DB::table('user_account')->where('role_id', 3)->count();
        $countShops     = DB::table('user_account')->where('role_id', 2)->count();
        return view('admin.dashboard',compact('userdetails','countUsers','countAffiliate','countShops','userRole','loggeduser'));
    }

////////////////////////////Affiliate//////////////////////////////

            function AffiliateApproval()
            {
                $userRole = session('user_role');
                $userId = session('user_id');
                if($userId==''){return redirect()->route('logout');}
                $loggeduser     = UserAccount::sessionValuereturn($userRole);
                $userdetails    = DB::table('user_account')->where('id', $userId)->get();
                return view('admin.affilate_approval',compact('userdetails','userRole','loggeduser'));
            }

            function AllAffiliatesList(Request $request)
            {
                $userRole = session('user_role');
                $roleid = session('roleid');
                $userId = session('user_id');
                if($userId==''){
                    return redirect()->route('logout');
                }
                $emal_mob   = $request->input('emal_mob');
                $afflitename   = $request->input('afflitename');
                //$ownername  = $request->input('ownername');
                $referalid  = $request->input('referalid');
                $query = Affiliate::select('affiliate.*','professions.profession_name','marital_statuses.mr_name','religions.religion_name','country.country_name','state.state_name','district.district_name','bank_types.bank_name')
                ->leftJoin('professions', 'professions.id', 'affiliate.profession')
                ->leftJoin('marital_statuses', 'marital_statuses.id', 'affiliate.marital_status')
                ->leftJoin('religions', 'religions.id', 'affiliate.religion')
                ->leftJoin('country', 'country.id', 'affiliate.country')
                ->leftJoin('state', 'state.id', 'affiliate.state')
                ->leftJoin('district', 'district.id', 'affiliate.district')
                ->leftJoin('bank_types', 'bank_types.id', 'affiliate.bank_type')
                ->leftJoin('bank_details', 'bank_details.id', 'affiliate.branch_code');
                if ($emal_mob) {
                    $query->where('affiliate.email', 'LIKE', '%' . $emal_mob . '%')
                        ->orWhere('affiliate.mob_no', 'LIKE', '%' . $emal_mob . '%');
                }
                if ($afflitename) {
                    $query->where('affiliate.name', 'LIKE', '%' . $afflitename . '%');
                }

                if ($referalid) {
                    $query->where('affiliate.referal_id', $referalid);
                }
                if($roleid==1)
                {

                }
                else{
                    $query->where('affiliate.user_id', $userId);
                }

                $AffiliateDetails = $query->get();
                //echo $lastRegId = $query->toSql();exit;
                $AffiliateCount    = $AffiliateDetails->count();
                $countries      = DB::table('country')->get();
                $professions    = DB::table('professions')->where('status','Y')->get();
                $matstatus      = DB::table('marital_statuses')->where('status','Y')->get();
                $religions      = DB::table('religions')->where(['status' => 'Y'])->get();
                $bank_types     = DB::table('bank_types')->where(['status' => 'Y'])->get();

                return view('admin.affiliate_dets', compact('AffiliateDetails', 'AffiliateCount','countries','professions','matstatus','religions','bank_types'));
            }
            function AdmAffiliateRegisterationPage(Request $request)
            {
                $userRole = session('user_role');
                $roleid = session('roleid');
                $userId = session('user_id');
                if($userId==''){
                    return redirect()->route('logout');
                }
                $pass_chars = '';
                $refer_chars = '';
                $loggedUserIp=$_SERVER['REMOTE_ADDR'];
                $time=date('Y-m-d H:i:s');
                $validatedData = $request->validate([
                    'a_name'        => 'required|max:50',
                    'a_mobno'       => 'required|max:10',
                    'a_email'       => 'required|email|max:35',
                    'a_dob'         => 'required|date',
                    'gender'        => 'required|in:male,female',
                    's_professions' => 'required',
                    'a_marital'     => 'required',
                    'a_religion'    => 'required',
                    'a_aadharno'    => 'required|max:12',
                    'a_locality'    => 'required|max:100',
                    'country'       => 'required',
                    'state'         => 'required',
                    'district'      => 'required',
                    's_panno'       => 'required|max:12',
                    's_registerdate'=> 'required|date',
                    's_termcondtn'  => 'accepted',
                    'a_accname'     => 'required|max:50',
                    'a_accno'       => 'required|max:20',
                    'bank_name'     => 'required',
                    'bank_country'  => 'required',
                    'bank_state'    => 'required',
                    'bank_dist'     => 'required',
                    'branch_name'   => 'required',
                ]);
                $user = new UserAccount();
                $user->name = $request->a_name;
                $user->email = $request->a_email;
                $user->mobno = $request->a_mobno;
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
                $user->role_id=3;
                $user->forgot_pass=$pass_chars;
                $user->user_status='N';
                $user->ip=$loggedUserIp;
                $user->parent_id=$userId;
                if($roleid==3)
                {
                    $Affiliatereferal_id = DB::table('user_account')->select('referal_id')->where('id', $userId)->get();
                    //echo $lastRegId = $sellerDetail->toSql();exit;
                    foreach($Affiliatereferal_id as $refrlid)
                    {
                        $referal_id=$refrlid->referal_id;
                        $user->referal_id=$referal_id;
                    }
                }
                else{
                    $user->referal_id=$refer_chars;
                }
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
                    $Affiliate = new Affiliate();
                    $Affiliate->fill($validatedData);
                    $Affiliate->name = $request->input('a_name');
                    $Affiliate->email = $request->input('a_email');
                    $Affiliate->mob_no = $request->input('a_mobno');
                    $Affiliate->dob = $request->input('a_dob');
                    $Affiliate->gender = $request->input('gender');
                    $Affiliate->profession = $request->input('s_professions');
                    $Affiliate->other_profession = $request->input('a_otherprofesn');
                    $Affiliate->marital_status = $request->input('a_marital');
                    $Affiliate->terms_condition = $request->has('s_termcondtn') ? 1 : 0;
                    $Affiliate->religion = $request->input('a_religion');
                    $Affiliate->aadhar_no = $request->input('a_aadharno');
                    $Affiliate->locality = $request->input('a_locality');
                    $Affiliate->country = $request->input('country');
                    $Affiliate->state = $request->input('state');
                    $Affiliate->district = $request->input('district');
                    $Affiliate->pan_no = $request->input('s_panno');
                    $Affiliate->registration_date = $request->input('s_registerdate');
                    $Affiliate->account_holder_name = $request->input('a_accname');
                    $Affiliate->account_no = $request->input('a_accno');
                    $Affiliate->bank_type = $request->input('bank_name');
                    $Affiliate->bank_country = $request->input('bank_country');
                    $Affiliate->bank_state = $request->input('bank_state');
                    $Affiliate->bank_dist = $request->input('bank_dist');
                    $Affiliate->branch_code = $request->input('branch_name');
                    $Affiliate->direct_affiliate = $request->input('directafflte');
                    $Affiliate->aff_coordinator = $request->input('coordinater');
                    $Affiliate->parent_id=$userId;
                    $Affiliate->user_id = $last_id;
                    if($roleid==3)
                    {
                        $Affiliate->referal_id = $referal_id;
                    }
                    else{
                    $Affiliate->referal_id = $refer_chars;}
                    $maxId = $Affiliate->max('affiliate_reg_id');
                    if ($maxId) {
                        $nextId = $maxId + 1;
                    } else {
                        $nextId = '500';
                    }
                    $Affiliate->affiliate_reg_id = $nextId;
                    if ($request->hasFile('a_aadharphoto')) {
                        $upload_path = 'uploads/affiliate/aadhaar/';
                        if (!is_dir($upload_path)) {
                            mkdir($upload_path, 0777, true);
                        }
                        $input_datas = [];
                        foreach ($request->file('a_aadharphoto') as $file) {
                            if ($file->isValid()) {
                                $new_name = time() . '_' . $file->getClientOriginalName();
                                $file->move($upload_path, $new_name);
                                $filename = $upload_path . $new_name;
                                array_push($input_datas, $filename);
                            }
                        }
                        $input_vals = ['fileval' => $input_datas];
                        $jsonimages = json_encode($input_vals);
                        $Affiliate->aadhar_file = $jsonimages;
                    }

                    if ($request->hasFile('a_passbook')) {
                        $upload_pathp = 'uploads/affiliate/passbook/';
                        if (!is_dir($upload_pathp)) {
                            mkdir($upload_pathp, 0777, true);
                        }
                        $input_datasp = [];
                        foreach ($request->file('a_passbook') as $filep) {
                            if ($filep->isValid()) {
                                $new_namep = time() . '_' . $filep->getClientOriginalName();
                                $filep->move($upload_pathp, $new_namep);
                                $filenamep = $upload_pathp . $new_namep;
                                array_push($input_datasp, $filenamep);
                            }
                        }
                        $input_valsp = ['passbook' => $input_datasp];
                        $jsonimagesp = json_encode($input_valsp);
                        $Affiliate->passbook_file = $jsonimagesp;
                    }

                    if ($request->hasFile('a_uplodphoto')) {
                        $upload_pathph = 'uploads/affiliate/photos/';
                        if (!is_dir($upload_pathph)) {
                            mkdir($upload_pathph, 0777, true);
                        }
                        $input_datasph = [];
                        foreach ($request->file('a_uplodphoto') as $fileph) {
                            if ($fileph->isValid()) {
                                $new_nameph = time() . '_' . $fileph->getClientOriginalName();
                                $fileph->move($upload_pathph, $new_nameph);
                                $filenameph = $upload_pathph . $new_nameph;
                                array_push($input_datasph, $filenameph);
                            }
                        }
                        $input_valsph = ['photos' => $input_datasph];
                        $jsonimagesph = json_encode($input_valsph);
                        $Affiliate->photo_file = $jsonimagesph;
                    }
                    if($roleid==3){$referchars = $referal_id;}else{$referchars = $refer_chars;}

                    $affiliatereg=$Affiliate->save();
                    $valencodemm=$lastRegId."-".$request->a_email;
                    $valsmm=base64_encode($valencodemm);
                    $verificationToken = base64_encode($last_id . '-' . $request->a_email. '-' . $pass_chars. '-' . $referchars);
                    $checkval="6";
                    $message='';
                    $email = new EmailVerification($verificationToken, $request->a_name, $request->a_email, $checkval, $message);
                    Mail::to($request->a_email)->send($email);

                } else {

                }
            }


            function AdmAffiliateViewEdits(Request $request)
            {
                $userRole = session('user_role');
                $userId = session('user_id');
                if($userId==''){
                    return redirect()->route('logout');
                }
                $id=$request->input('affiliateid');
                $Affiliate = Affiliate::select('affiliate.*','professions.profession_name','marital_statuses.mr_name','religions.religion_name','country.country_name','state.state_name','district.district_name','bank_types.bank_name','bank_details.branch_name','bank_details.ifsc_code','bank_details.branch_address')
                ->leftJoin('professions', 'professions.id', 'affiliate.profession')
                ->leftJoin('marital_statuses', 'marital_statuses.id', 'affiliate.marital_status')
                ->leftJoin('religions', 'religions.id', 'affiliate.religion')
                ->leftJoin('country', 'country.id', 'affiliate.country')
                ->leftJoin('state', 'state.id', 'affiliate.state')
                ->leftJoin('district', 'district.id', 'affiliate.district')
                ->leftJoin('bank_types', 'bank_types.id', 'affiliate.bank_type')
                ->leftJoin('bank_details', 'bank_details.id', 'affiliate.branch_code')
                ->where('affiliate.id', $id)
                ->first();
                //echo $lastRegId = $Affiliate->toSql();exit;
                $countries      = DB::table('country')->get();
                $states         = DB::table('state')->where('country_id', $Affiliate->country)->get();
                $districts      = DB::table('district')->where('state_id', $Affiliate->state)->get();
                $professions    = DB::table('professions')->where('status','Y')->get();
                $matstatus      = DB::table('marital_statuses')->where('status','Y')->get();
                $religions      = DB::table('religions')->where(['status' => 'Y'])->get();
                $bank_types     = DB::table('bank_types')->where(['status' => 'Y'])->get();
                $bankstates     = DB::table('state')->where('country_id', $Affiliate->bank_country)->get();
                $bankdistricts  = DB::table('district')->where('state_id', $Affiliate->bank_state)->get();
                $branchdetails  = DB::table('bank_details')->where('id', $Affiliate->branch_code)->get();
                return view('admin.affiliate_viewedit_dets', compact('Affiliate','countries','states','districts','professions','matstatus','religions','bank_types','bankstates','bankdistricts','branchdetails'));
            }

            function AdmAfiliateAdharDelte(Request $request)
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
                $affiliateid=$exlodval[1];
                $Affiliate   = Affiliate::find($affiliateid);
                $AffiliateAdhar     = DB::table('affiliate')->where('id', $affiliateid)->get();
                //echo $lastRegId = $sellerDetail->toSql();exit;
                foreach($AffiliateAdhar as $gal)
                {
                    $json_data=$gal->aadhar_file;

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
                    $Affiliate->aadhar_file = $updated_json_data;
                    $result = $Affiliate->save();
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
            function AdmAfiliatePassDelte(Request $request)
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
                $affiliateid=$exlodval[1];
                $Affiliate   = Affiliate::find($affiliateid);
                $AffiliatePass     = DB::table('affiliate')->where('id', $affiliateid)->get();
                //echo $lastRegId = $sellerDetail->toSql();exit;
                foreach($AffiliatePass as $gal)
                {
                    $json_data=$gal->passbook_file;

                }
                $data = json_decode($json_data, true);
                $delete_item = $imgremove;
                $index = array_search($delete_item, $data['passbook']);
                //echo "<pre>";print_r($index);exit;
                if ($index !== false) {
                    $file_path = $imgremove;
                    unlink($file_path);
                    unset($data['passbook'][$index]);
                    $data['passbook'] = array_values($data['passbook']);
                    $updated_json_data = json_encode($data);
                    $Affiliate->passbook_file = $updated_json_data;
                    $result = $Affiliate->save();
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
            function AdmAfiliatePhotoDelte(Request $request)
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
                $affiliateid=$exlodval[1];
                $Affiliate   = Affiliate::find($affiliateid);
                $AffiliatePass     = DB::table('affiliate')->where('id', $affiliateid)->get();
                //echo $lastRegId = $sellerDetail->toSql();exit;
                foreach($AffiliatePass as $gal)
                {
                    $json_data=$gal->photo_file;

                }
                $data = json_decode($json_data, true);
                $delete_item = $imgremove;
                $index = array_search($delete_item, $data['photos']);
                //echo "<pre>";print_r($index);exit;
                if ($index !== false) {
                    $file_path = $imgremove;
                    unlink($file_path);
                    unset($data['photos'][$index]);
                    $data['photos'] = array_values($data['photos']);
                    $updated_json_data = json_encode($data);
                    $Affiliate->photo_file = $updated_json_data;
                    $result = $Affiliate->save();
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

            function AdmaffiliateUpdatePage(Request $request)
            {
                $userRole = session('user_role');
                $userId = session('user_id');
                if($userId==''){
                    return redirect()->route('logout');
                }
                $loggedUserIp=$_SERVER['REMOTE_ADDR'];
                $time=date('Y-m-d H:i:s');
                $validatedData = $request->validate([
                    'ea_name'        => 'required|max:50',
                    'ea_mobno'       => 'required|max:10',
                    'ea_email'       => 'required|email|max:35',
                    'ea_dob'         => 'required|date',
                    'egender'        => 'required|in:male,female',
                    'es_professions' => 'required',
                    'ea_marital'     => 'required',
                    'ea_religion'    => 'required',
                    'ea_aadharno'    => 'required|max:12',
                    'ea_locality'    => 'required|max:100',
                    'ecountry'       => 'required',
                    'estate'         => 'required',
                    'edistrict'      => 'required',
                    'es_panno'       => 'required|max:12',
                    'es_registerdate'=> 'required|date',
                    'es_termcondtn'  => 'accepted',
                    'ea_accname'     => 'required|max:50',
                    'ea_accno'       => 'required|max:20',
                    'ebank_name'     => 'required',
                    'ebank_country'  => 'required',
                    'ebank_state'    => 'required',
                    'ebank_dist'     => 'required',
                    'ebranch_name'   => 'required',
                ]);
                    $affiliateidhid=$request->affiliateidhid;
                    $affuserhid=$request->affiliateuseridhid;
                    $Affiliate = Affiliate::find($affiliateidhid);
                    $Affiliate->fill($validatedData);
                    $Affiliate->name = $request->input('ea_name');
                    $Affiliate->email = $request->input('ea_email');
                    $Affiliate->mob_no = $request->input('ea_mobno');
                    $Affiliate->dob = $request->input('ea_dob');
                    $Affiliate->gender = $request->input('egender');
                    $Affiliate->profession = $request->input('es_professions');
                    $Affiliate->other_profession = $request->input('ea_otherprofesn');
                    $Affiliate->marital_status = $request->input('ea_marital');
                    $Affiliate->terms_condition = $request->has('es_termcondtn') ? 1 : 0;
                    $Affiliate->religion = $request->input('ea_religion');
                    $Affiliate->aadhar_no = $request->input('ea_aadharno');
                    $Affiliate->locality = $request->input('ea_locality');
                    $Affiliate->country = $request->input('ecountry');
                    $Affiliate->state = $request->input('estate');
                    $Affiliate->district = $request->input('edistrict');
                    $Affiliate->pan_no = $request->input('es_panno');
                    $Affiliate->registration_date = $request->input('es_registerdate');
                    $Affiliate->account_holder_name = $request->input('ea_accname');
                    $Affiliate->account_no = $request->input('ea_accno');
                    $Affiliate->bank_type = $request->input('ebank_name');
                    $Affiliate->bank_country = $request->input('ebank_country');
                    $Affiliate->bank_state = $request->input('ebank_state');
                    $Affiliate->bank_dist = $request->input('ebank_dist');
                    $Affiliate->branch_code = $request->input('ebranch_name');
                    $Affiliate->direct_affiliate = $request->input('edirectafflte');
                    $Affiliate->aff_coordinator = $request->input('ecoordinater');

                    $AdharImag     = DB::table('affiliate')->select('aadhar_file','passbook_file','photo_file')->where('id', $affiliateidhid)->get();
                    foreach($AdharImag as $gala)
                    {
                        $existaadhar=$gala->aadhar_file;
                        $existpassbook=$gala->passbook_file;
                        $existphotofile=$gala->photo_file;

                    }

                    $input_datas = [];
                    $input_vals = [];
                    $existing_array = json_decode($existaadhar, true);
                    $existing_images = isset($existing_array['fileval']) ? $existing_array['fileval'] : array();
                    $input_datas = $existing_images;
                    if ($request->hasFile('ea_aadharphoto')) {
                        $upload_path = 'uploads/affiliate/aadhaar/';
                        if (!is_dir($upload_path)) {
                            mkdir($upload_path, 0777, true);
                        }
                        foreach ($request->file('ea_aadharphoto') as $file) {
                            if ($file->isValid()) {
                                $new_name = time() . '_' . $file->getClientOriginalName();
                                $file->move($upload_path, $new_name);
                                $filename = $upload_path . $new_name;
                                array_push($input_datas, $filename);
                            }
                        }
                        $input_vals = ['fileval' => $input_datas];
                        $jsonimages = json_encode($input_vals);
                        $Affiliate->aadhar_file = $jsonimages;
                    }



                    $input_datasp = [];
                    $input_valsp = [];
                    $existing_array_pass = json_decode($existpassbook, true);
                    $existing_images_pass = isset($existing_array_pass['passbook']) ? $existing_array_pass['passbook'] : array();
                    $input_datasp = $existing_images_pass;

                    if ($request->hasFile('ea_passbook')) {
                        $upload_pathp = 'uploads/affiliate/passbook/';
                        if (!is_dir($upload_pathp)) {
                            mkdir($upload_pathp, 0777, true);
                        }
                        foreach ($request->file('ea_passbook') as $filep) {
                            if ($filep->isValid()) {
                                $new_namep = time() . '_' . $filep->getClientOriginalName();
                                $filep->move($upload_pathp, $new_namep);
                                $filenamep = $upload_pathp . $new_namep;
                                array_push($input_datasp, $filenamep);
                            }
                        }
                        $input_valsp = ['passbook' => $input_datasp];
                        $jsonimagesp = json_encode($input_valsp);
                        $Affiliate->passbook_file = $jsonimagesp;
                    }

                    $input_datasph = [];
                    $input_valsph = [];
                    $existing_array_photo = json_decode($existphotofile, true);
                    $existing_images_photo = isset($existing_array_photo['photos']) ? $existing_array_photo['photos'] : array();
                    $input_datasph = $existing_images_photo;
                    if ($request->hasFile('ea_uplodphoto')) {
                        $upload_pathph = 'uploads/affiliate/photos/';
                        if (!is_dir($upload_pathph)) {
                            mkdir($upload_pathph, 0777, true);
                        }

                        foreach ($request->file('ea_uplodphoto') as $fileph) {
                            if ($fileph->isValid()) {
                                $new_nameph = time() . '_' . $fileph->getClientOriginalName();
                                $fileph->move($upload_pathph, $new_nameph);
                                $filenameph = $upload_pathph . $new_nameph;
                                array_push($input_datasph, $filenameph);
                            }
                        }
                        $input_valsph = ['photos' => $input_datasph];
                        $jsonimagesph = json_encode($input_valsph);
                        $Affiliate->photo_file = $jsonimagesph;
                    }

                    $affiliatereg=$Affiliate->save();
                    $user = UserAccount::findOrFail($affuserhid);
                    if ($user->email !== $request->input('ea_email') || $user->mobno !== $request->input('ea_mobno')) {
                        $user->email = $request->ea_email;
                        $user->mobno = $request->ea_mobno;
                        $user->name = $request->ea_name;
                        $user->ip=$loggedUserIp;
                        $submt=$user->save();
                    }

                    $msg="Successfully updated! ".$request->ea_email." shop updated id : ".$affuserhid;
                    $LogDetails = new LogDetails();
                    $LogDetails->user_id = $request->ea_email;
                    $LogDetails->ip_address = $loggedUserIp;
                    $LogDetails->log_time = $time;
                    $LogDetails->status = $msg;
                    $LogDetails->save();




                    }

                    function AdmaffiliateApproved(Request $request)
                    {
                        $userRole = session('user_role');
                        $userId = session('user_id');
                        if($userId==''){
                            return redirect()->route('logout');
                        }
                        $id=$request->input('affiliateid');
                        $Affiliate = Affiliate::select('affiliate.*','professions.profession_name','marital_statuses.mr_name','religions.religion_name','country.country_name','state.state_name','district.district_name','bank_types.bank_name','bank_details.branch_name','bank_details.ifsc_code','bank_details.branch_address','bank_country.country_name AS bank_country_name',            'bank_state.state_name AS bank_state_name','bank_dist.district_name AS bank_district_name',)
                        ->leftJoin('professions', 'professions.id', 'affiliate.profession')
                        ->leftJoin('marital_statuses', 'marital_statuses.id', 'affiliate.marital_status')
                        ->leftJoin('religions', 'religions.id', 'affiliate.religion')
                        ->leftJoin('country', 'country.id', 'affiliate.country')
                        ->leftJoin('state', 'state.id', 'affiliate.state')
                        ->leftJoin('district', 'district.id', 'affiliate.district')
                        ->leftJoin('bank_types', 'bank_types.id', 'affiliate.bank_type')
                        ->leftJoin('bank_details', 'bank_details.id', 'affiliate.branch_code')
                        ->leftJoin('country AS bank_country', 'bank_country.id', 'affiliate.bank_country')
                        ->leftJoin('state AS bank_state', 'bank_state.id', 'affiliate.bank_state')
                        ->leftJoin('district AS bank_dist', 'bank_dist.id', 'affiliate.bank_dist')
                        ->where('affiliate.id', $id)
                        ->first();
                        //echo $lastRegId = $Affiliate->toSql();exit;
                        $userdets       = DB::table('user_account')->where('id', $Affiliate->user_id)->get();
                        $countries      = DB::table('country')->get();
                        $states         = DB::table('state')->where('country_id', $Affiliate->country)->get();
                        $districts      = DB::table('district')->where('state_id', $Affiliate->state)->get();
                        $professions    = DB::table('professions')->where('status','Y')->get();
                        $matstatus      = DB::table('marital_statuses')->where('status','Y')->get();
                        $religions      = DB::table('religions')->where(['status' => 'Y'])->get();
                        $bank_types     = DB::table('bank_types')->where(['status' => 'Y'])->get();
                        $bankstates     = DB::table('state')->where('country_id', $Affiliate->bank_country)->get();
                        $bankdistricts  = DB::table('district')->where('state_id', $Affiliate->bank_state)->get();
                        $branchdetails  = DB::table('bank_details')->where('id', $Affiliate->branch_code)->get();
                        return view('admin.affiliate_approved_dets', compact('Affiliate','countries','states','districts','professions','matstatus','religions','bank_types','bankstates','bankdistricts','branchdetails','userdets'));
                    }

                    function AdmsAffiliateApprovedPage(Request $request)
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
                        $aaffiliateid=$request->aaffiliateidhid;
                        $aaffiliateuserid=$request->aaffiliateuseridhid;
                        $user = UserAccount::find($aaffiliateuserid);
                        $user->approved = $request->approvedstatus;
                        $user->approved_by = $userId;
                        $user->approved_at = $time;
                        $submt=$user->save();

                        $Affiliate = Affiliate::find($aaffiliateid);
                        $Affiliate->affiliate_approved = $request->approvedstatus;
                        $submtapp=$Affiliate->save();

                        $msg="Aprroved Status =  ".$request->approvedstatus." affiliate updated id : ".$aaffiliateid;
                        $LogDetails = new LogDetails();
                        $LogDetails->user_id = $user->email;
                        $LogDetails->ip_address = $loggedUserIp;
                        $LogDetails->log_time = $time;
                        $LogDetails->status = $msg;
                        $LogDetails->save();
                        if($request->approvedstatus=='Y')
                        {
                            $valencodemm=$aaffiliateuserid."-".$user->email;
                            $valsmm=base64_encode($valencodemm);
                            $apprveTime = date('d/m/Y H:i:s', strtotime($time));
                            $verificationToken = base64_encode($aaffiliateuserid . '-' . $user->email. '-' .$apprveTime.'-'.$user->referal_id);
                            $checkval="7";
                            $message='Affiliate Successfully Approved';
                            $email = new EmailVerification($verificationToken, $user->name, $user->email, $checkval, $message);
                            Mail::to($user->email)->send($email);
                        }

                    }

                    function AdmaffiliateDeletePage(Request $request)
                    {
                        $userRole = session('user_role');
                        $userId = session('user_id');
                        if($userId==''){
                            return redirect()->route('logout');
                        }
                        $loggedUserIp=$_SERVER['REMOTE_ADDR'];
                        $time=date('Y-m-d H:i:s');
                        $affliateid         = $request->input('userid');
                        $Affiliate   = Affiliate::find($affliateid);
                        $user           = UserAccount::find($Affiliate->user_id);
                        $delteaffliatDetail=$Affiliate->delete();
                        $delteuser        =$user->delete();
                        $msg="Affiliate Deleted =  ".$user->email." affiliate updated id : ".$Affiliate->user_id;
                        $LogDetails = new LogDetails();
                        $LogDetails->user_id = $user->email;
                        $LogDetails->ip_address = $loggedUserIp;
                        $LogDetails->log_time = $time;
                        $LogDetails->status = $msg;
                        $LogDetails->save();
                        if(($delteaffliatDetail>0) && ($delteuser>0)){
                            return response()->json(['result' => 1,'mesge'=>'Deleted Successfully']);
                        }
                        else{
                            return response()->json(['result' => 2,'mesge'=>'Failed']);
                        }

                    }




////////////////////////////Shops//////////////////////////////

    function ShopApproval()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if($userId==''){return redirect()->route('logout');}
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
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
            //$query->where('seller_details.shop_service_type',1);



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
                'manufactringdets' => 'required',
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
            $user->referal_id=$request->input('s_refralid');//$refer_chars;
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
                $sellerDetail->referal_id = $request->input('s_refralid');
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
                $sellerDetail->manufactoring_details = $request->input('manufactringdets');
                $sellerDetail->direct_affiliate = $request->input('directafflte');
                $sellerDetail->second_affiliate = $request->input('secondafflte');
                $sellerDetail->shop_coordinator = $request->input('coordinater');
                $sellerDetail->parent_id=$userId;
                $sellerDetail->user_id = $last_id;
                //$sellerDetail->referal_id = $refer_chars;
                $maxId = $sellerDetail->max('shop_reg_id');
                if ($maxId) {
                    $nextId = $maxId + 1;
                } else {
                    $nextId = '100';
                }
                $sellerDetail->shop_reg_id = $nextId;
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
            //->where('seller_details.shop_service_type',1)
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
            $userId = session('user_id');
            if($userId==''){
                return redirect()->route('logout');
            }
            $loggedUserIp=$_SERVER['REMOTE_ADDR'];
            $time=date('Y-m-d H:i:s');
            $validatedData = $request->validate([
                'es_name' => 'required|max:50',
                'es_ownername' => 'required|max:50',
                'es_mobno' => 'required|max:10',
                'es_email' => 'required|email|max:35',
                'es_refralid' => 'max:50',
                'es_busnestype' => 'required',
                'es_shopservice' => 'required',
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
            $sellerDetail->owner_name = $request->input('es_ownername');
            $sellerDetail->shop_email = $request->input('es_email');
            $sellerDetail->shop_mobno = $request->input('es_mobno');
            $sellerDetail->busnes_type = $request->input('es_busnestype');
            $sellerDetail->shop_service_type = $request->input('es_shopservice');
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
                $user->name = $request->es_name;
                $user->referal_id = $request->input('es_refralid');
                $user->ip=$loggedUserIp;
                $submt=$user->save();
            }

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
            $sellerDetails = SellerDetails::select('seller_details.*', 'business_type.business_name', 'service_types.service_name', 'executives.executive_name', 'country.country_name', 'state.state_name', 'district.district_name')
                ->leftJoin('business_type', 'business_type.id', 'seller_details.busnes_type')
                ->leftJoin('service_types', 'service_types.id', 'seller_details.shop_service_type')
                ->leftJoin('executives', 'executives.id', 'seller_details.shop_executive')
                ->leftJoin('country', 'country.id', 'seller_details.country')
                ->leftJoin('state', 'state.id', 'seller_details.state')
                ->leftJoin('district', 'district.id', 'seller_details.district')
                ->where('seller_details.id', $id)
                //->where('seller_details.shop_service_type',1)
                ->first();
            //echo $lastRegId = $sellerDetails->toSql();exit;
            $userdets       = DB::table('user_account')->where('id', $sellerDetails->user_id)->get();
            $countries      = DB::table('country')->get();
            $states         = DB::table('state')->where('country_id', $sellerDetails->country)->get();
            $districts      = DB::table('district')->where('state_id', $sellerDetails->state)->get();
            $business       = DB::table('business_type')->where('status','Y')->get();
            $shopservice    = DB::table('service_types')->where('status', 'active')->get();
            $executives     = DB::table('executives')->where(['executive_type' => 1, 'status' => 'Y'])->get();
            return view('admin.shop_approved_dets', compact('sellerDetails', 'countries', 'states', 'districts', 'business', 'shopservice', 'executives','userdets'));

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

<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\RolePermission;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use App\Models\LogDetails;
use App\Models\SellerDetails;
use App\Models\Affiliate;
use App\Models\ServiceType;
use App\Models\MenuMaster;
use App\Models\UserPage;
use App\Models\RolePage;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Exception;

class RoleController extends Controller
{
    function get_roles()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails = DB::table('users')
            ->where('id', $userId)
            ->get();
        $roles = DB::table('roles_permissions as rp')
            ->join('roles as r', 'r.id', '=', 'rp.role_id')
            ->join('permissions as p', 'p.id', '=', 'rp.permission_id')
            ->select('r.role_name', 'p.description')
            ->get();

        $formattedRoles = [];

        foreach ($roles as $role) {
            $roleName = $role->role_name;
            $permission = $role->description . ' ✓';

            if (!isset($formattedRoles[$roleName])) {
                $formattedRoles[$roleName] = [];
            }

            $formattedRoles[$roleName][] = $permission;
        }

        $rolesList = [];
        foreach ($formattedRoles as $roleName => $permissions) {
            $role = Role::where('role_name', $roleName)->first();
            if ($role) {
                $rolesList[] = [
                    'id' => $role->id,
                    'role_name' => $roleName,
                    'permissions' => implode($permissions),
                    'is_active' => $role->is_active,
                ];
            }
        }
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        return view('admin.role.list', compact('userdetails', 'loggeduser', 'rolesList', 'structuredMenu','selrdetails'));
    }
    function add_role()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails = DB::table('users')
            ->where('id', $userId)
            ->select('name')
            ->get();
        $site_module = DB::table('site_modules')
            ->select('*')
            ->orderby('module_order', 'asc')
            ->get();
        $roles = DB::table('roles')->where('roles.is_active', '1')->get();
        $sm = [];
        foreach ($site_module as $mv) {
            $mv->sub = DB::table('permissions')
                ->select('id', 'description', 'is_disabled')
                ->orderby('id', 'asc')
                ->where('module_id', $mv->id)
                ->get();
        }
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        return view('admin.role.add', compact('userdetails', 'loggeduser', 'site_module', 'roles', 'structuredMenu','selrdetails'));
    }

    function store_role(Request $request)
    {
        $userId = session('user_id');

        $validator = Validator::make($request->all(), [
            'role_name' => ['required'],
            'perm' => ['required'],
        ]);

        $messages = [
            'role_name.required' => 'Please select any role',
            'perm.required' => 'Please select permissions for the Role',
        ];

        $validator->setCustomMessages($messages);

        if ($validator->fails()) {
            $errors = Arr::flatten($validator->errors()->getMessages());
            $errors = implode("\n", $errors);
            return redirect()
                ->route('add.role')
                ->withErrors($validator)
                ->withInput();
        }
        foreach ($request->perm as $permissionId) {
            $hrp = new RolePermission();
            $hrp->role_id = $request->role_name;
            $hrp->permission_id = $permissionId;
            $hrp->rp_created_by = $userId;
            $hrp->save();
        }
        return redirect()
            ->route('get.roles')
            ->with('success', 'Role created successfully.');
    }

    function edit_role($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');

        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails = DB::table('users')
            ->where('id', $userId)
            ->select('name')
            ->get();
        $site_module = DB::table('site_modules')
            ->select('*')
            ->orderby('module_order', 'asc')
            ->get();
        $roles = DB::table('roles')
            ->pluck('role_name', 'id')
            ->toArray();
        $rs = DB::table('roles_permissions')
            ->where('role_id', $id)
            ->first();
        $selectedRole = Role::find($id);

        $selectedRolePermissions = DB::table('roles_permissions')
            ->where('role_id', $selectedRole->id)
            ->pluck('permission_id')
            ->toArray();

        $sm = [];
        foreach ($site_module as $mv) {
            $mv->sub = DB::table('permissions')
                ->select('id', 'description', 'is_disabled')
                ->orderby('id', 'asc')
                ->where('module_id', $mv->id)
                ->get();
        }

        $role = Role::find($id);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        return view('admin.role.edit', compact('role', 'loggeduser', 'userdetails', 'roles', 'site_module', 'rs', 'selectedRolePermissions', 'structuredMenu','selrdetails'));
    }

    function update_role(Request $request, $id)
    {
        // Retrieve the role you want to update
        $role = Role::find($id);

        if (!$role) {
            return redirect()
                ->route('get.roles')
                ->with('error', 'Role not found');
        }

        $userId = session('user_id');

        $validator = Validator::make($request->all(), [
            'role_name' => ['required'],
            'perm' => ['required'],
        ]);

        $messages = [
            'role_name.required' => 'Please select any role',
            'perm.required' => 'Please select permissions for the Role',
        ];

        $validator->setCustomMessages($messages);

        if ($validator->fails()) {
            return redirect()
                ->route('add.role')
                ->withErrors($validator)
                ->withInput();
        }

        $selectedPermissions = $request->input('perm', []);

        $role->permissions()->sync($selectedPermissions);

        return redirect()
            ->route('get.roles')
            ->with('success', 'Permissions updated successfully');
    }

    public function view_roles($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('list.roles')->with('error', 'Role not found.');
        }

        return view('admin.role.Role_Creation.view', compact('role', 'loggeduser', 'userdetails','structuredMenu','selrdetails'));
    }



    public function updateActivation($id)
    {
        $role = Role::findOrFail($id);

        $role->update(['is_active' => !$role->is_active]);

        return response()->json(['message' => 'Activation status updated successfully']);
    }

    function CreateNewUser()
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
        $alluserdetails = DB::table('users')
            ->select('users.id', 'users.name', 'users.email', 'users.mobno', 'users.user_status', 'roles.role_name')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.is_active', '1')
            ->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        return view('admin.role.create_user', compact('userdetails', 'userRole', 'loggeduser', 'alluserdetails', 'structuredMenu','selrdetails'));
    }

    function AllUsersList(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $emal_mob = $request->input('emal_mob');
        $uname = $request->input('uname');
        $query = User::select('users.*', 'roles.role_name')->leftJoin('roles', 'users.role_id', 'roles.id')->where('roles.is_active', '1');
        if ($emal_mob) {
            $query->where('users.email', 'LIKE', '%' . $emal_mob . '%')->orWhere('users.mobno', 'LIKE', '%' . $emal_mob . '%');
        }
        if ($uname) {
            $query->where('users.name', 'LIKE', '%' . $uname . '%');
        }
        $query ->orderBy('users.name', 'asc');
        $alluserdetails = $query->get();
        //echo $lastRegId = $query->toSql();exit;
        $allusercount = $alluserdetails->count();
        $roles = DB::table('roles')->where('roles.is_active', '1')->where('id', '!=', 1) ->orderBy('role_name', 'asc')->get();

        $queryactivecounts = User::select([
            DB::raw('SUM(CASE WHEN user_status = "Y" THEN 1 ELSE 0 END) AS user_status_y_count'),
            DB::raw('SUM(CASE WHEN user_status != "Y" THEN 1 ELSE 0 END) AS user_status_not_y_count'),
            DB::raw('SUM(CASE WHEN approved = "Y" THEN 1 ELSE 0 END) AS approved_y_count'),
            DB::raw('SUM(CASE WHEN approved != "Y" THEN 1 ELSE 0 END) AS approved_not_y_count'),
        ]);

        if ($roleid != 1 && $roleid != 11) {
            $queryactivecounts->where('id', $userId);
        }
        $activecounts = $queryactivecounts->first();

        return view('admin.role.user_dets', compact('alluserdetails', 'allusercount', 'roles','activecounts'));
    }

    function AdmUserRegistration(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $pass_chars = '';
        $refer_chars = '';
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $validatedData = $request->validate([
            's_name' => 'required|max:50',
            's_mobno' => 'required|max:10',
            'mobcntrycode' => 'required',
            // 's_email' => 'required|email|max:35',
            'roleid' => 'required',
        ]);
        $user = new User();
        $user->name = ucwords($request->s_name);
        $user->email = $request->s_email;
        $user->mobno = $request->s_mobno;
        $user->mob_countrycode = $request->mobcntrycode;
        $pass_characters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'M', 'N', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', '@', '#', "$", '%', '&', '!', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'm', 'n', 'r', 's', 't', 'u', 'v', 'w', 'x', 'z', '2', '3', '4', '5', '6', '7', '8', '9'];
        $passkeys = [];
        while (count($passkeys) < 6) {
            $x = mt_rand(0, count($pass_characters) - 1);
            if (!in_array($x, $passkeys)) {
                $passkeys[] = $x;
            }
        }
        foreach ($passkeys as $pkey) {
            $pass_chars .= $pass_characters[$pkey];
        }

        $user->password = Hash::make($pass_chars);
        $user->role_id = $request->roleid;
        $user->forgot_pass = $pass_chars;
        $user->user_status = 'Y';
        if($request->roleid==11 || $request->roleid==4)
        {
            $user->approved = 'Y';
        }
        else{
            $user->approved = 'N';
        }
        $user->ip = $loggedUserIp;
        $user->parent_id = $userId;
        $submt = $user->save();
        $lastRegId = $user->toSql();
        $last_id = $user->id;
        $msg = 'Registration Success! ' . $request->s_email . ' register id : ' . $last_id;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $request->s_email;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($request->roleid == 2) {
            $shopservice = 1;
        } elseif ($request->roleid == 9) {
            $shopservice = 2;
        }

        if ($submt > 0) {
            if ($request->roleid == 2 || $request->roleid == 9) {
                $sellerDetail = new SellerDetails();
                $sellerDetail->fill($validatedData);
                $sellerDetail->shop_name = ucfirst($request->input('s_name'));
                $sellerDetail->shop_email = $request->input('s_email');
                $sellerDetail->shop_mobno = $request->input('s_mobno');
                $sellerDetail->mob_country_code = $request->input('mobcntrycode');
                $sellerDetail->busnes_type = $shopservice;
                $sellerDetail->parent_id = $userId;
                $sellerDetail->user_id = $last_id;
                //$sellerDetail->referal_id = $refer_chars;
                $maxId = $sellerDetail->max('shop_reg_id');
                if ($maxId) {
                    $nextId = $maxId + 1;
                } else {
                    $nextId = '100';
                }
                $sellerDetail->shop_reg_id = $nextId;

                $input_datas = [];//'uploads/shopimages/shopimage.png'
                $input_vals = ['fileval' => $input_datas];
                $jsonimages = json_encode($input_vals);
                $sellerDetail->shop_photo = $jsonimages;
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
                $shopreg = $sellerDetail->save();
            } elseif ($request->roleid == 3) {
                $affliteDetail = new Affiliate();
                $affliteDetail->fill($validatedData);
                $affliteDetail->name = ucfirst($request->input('s_name'));
                $affliteDetail->email = $request->input('s_email');
                $affliteDetail->mob_no = $request->input('s_mobno');
                $input_datas = [];
                $input_vals = ['fileval' => $input_datas];
                $jsonimages = json_encode($input_vals);
                $affliteDetail->aadhar_file = $jsonimages;
                $input_datapass = [];
                $input_valsp = ['passbook' => $input_datapass];
                $jsonimagesp = json_encode($input_valsp);
                $affliteDetail->passbook_file = $jsonimagesp;
                $input_dataphoto = [];
                $input_valsph = ['photos' => $input_dataphoto];
                $jsonimagesph = json_encode($input_valsph);
                $affliteDetail->photo_file = $jsonimagesph;
                $affliteDetail->terms_condition = 0;
                $affliteDetail->account_holder_name = '';
                $affliteDetail->account_no = '';
                $affliteDetail->user_id = $last_id;
                $maxId = $affliteDetail->max('affiliate_reg_id');
                if ($maxId) {
                    $nextId = $maxId + 1;
                } else {
                    $nextId = '500';
                }
                $affliteDetail->affiliate_reg_id = $nextId;
                $afiltereg = $affliteDetail->save();
                //echo $lastRegId = $affliteDetail->toSql();exit;
            }



            if($request->input('s_email')!=''){
            $valencodemm = $lastRegId . '-' . $request->s_email;
            $valsmm = base64_encode($valencodemm);
            $verificationToken = base64_encode($last_id . '-' . $request->s_email . '-' . $pass_chars . '-');
            $checkval = '4';
            $message = '';
            $email = new EmailVerification($verificationToken, $request->s_name, $request->s_email, $checkval, $message);
            Mail::to($request->s_email)->send($email);
            }


        } else {
        }
    }

    function AdmUserViewEdit(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $id = $request->input('userid');
        $query = User::select('users.*', 'roles.role_name')
            ->leftJoin('roles', 'users.role_id', 'roles.id')->where('roles.is_active', '1')
            ->where('users.id', $id);
        $alluserdetails = $query->first();
        //echo $lastRegId = $query->toSql();exit;
        $roles = DB::table('roles')
            ->where('id', $alluserdetails->role_id)->where('roles.is_active', '1')
            ->get();
        return view('admin.role.user_viewedit', compact('alluserdetails', 'roles'));
    }

    function AdmUpdateUserDetails(Request $request)
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
            'es_name' => 'required|max:50',
            'es_mobno' => 'required|max:10',
            'emobcntrycode'=> 'required',
            // 'es_email' => 'required|email|max:35',
            'eroleid' => 'required',
            'userstatus' => 'required',
        ]);
        $useridhid = $request->useridhid;
        if ($request->eroleid == 2 || $request->eroleid == 9) {
            $userselrid = DB::table('seller_details')
                ->select('id')
                ->where('user_id', $useridhid)
                ->get();
            foreach ($userselrid as $selrusetid) {
                $sellerid = $selrusetid->id;
            }
            $sellerDetail = SellerDetails::find($sellerid);
            $sellerDetail->fill($validatedData);
            $sellerDetail->shop_name = ucfirst($request->input('es_name'));
            $sellerDetail->shop_email = $request->input('es_email');
            $sellerDetail->shop_mobno = $request->input('es_mobno');
            $sellerDetail->mob_country_code = $request->input('emobcntrycode');
            $shopreg = $sellerDetail->save();
        } elseif ($request->eroleid == 3) {
            $affiliateid = DB::table('affiliate')
                ->select('id')
                ->where('user_id', $useridhid)
                ->get();
            foreach ($affiliateid as $affusetid) {
                $affliateid = $affusetid->id;
            }

            $Affiliate = Affiliate::find($affliateid);
            $Affiliate->fill($validatedData);
            $Affiliate->name = ucfirst($request->input('es_name'));
            $Affiliate->email = $request->input('es_email');
            $Affiliate->mob_no = $request->input('es_mobno');
            $affiliatereg = $Affiliate->save();
        }

        $user = User::findOrFail($useridhid);
        if ($user->email !== $request->input('es_email') || $user->mobno !== $request->input('es_mobno')) {
            $user->email = $request->es_email;
            $user->mobno = $request->es_mobno;
        }
        $user->name = ucfirst($request->es_name);
        $user->role_id = $request->eroleid;
        $user->mob_countrycode = $request->emobcntrycode;
        $user->user_status = $request->userstatus;
        $user->ip = $loggedUserIp;
        $submt = $user->save();

        $msg = 'Successfully updated! ' . $request->es_email . ' shop updated id : ' . $useridhid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $request->es_email;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
    }
    function AdmuserDeletePage(Request $request)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $userid = $request->input('userid');
        $UsrroleID = DB::table('users')
            ->select('role_id')
            ->where('id', $userid)
            ->get();
        foreach ($UsrroleID as $rolid) {
            $roles = $rolid->role_id;
        }
        $roleIdsArray = explode(',', $roles);
        if ((in_array('2', $roleIdsArray)) || (in_array('9', $roleIdsArray))) {
            $sellerID = DB::table('seller_details')
                ->select('id')
                ->where('user_id', $userid)
                ->get();
            foreach ($sellerID as $selrid) {
                $selerid = $selrid->id;
            }
            $sellerDetail = SellerDetails::find($selerid);
            $user = User::find($userid);
            $delteUserDetail = $sellerDetail->delete();
            $delteuser = $user->delete();
        } else if ((in_array('3', $roleIdsArray))) {
            $affiliateID = DB::table('affiliate')
                ->select('id')
                ->where('user_id', $userid)
                ->get();

            foreach ($affiliateID as $affltid) {
                $afltid = $affltid->id;
            }

            $Affiliate = Affiliate::find($afltid);
            $user = User::find($userid);
            $delteUserDetail = $Affiliate->delete();
            $delteuser = $user->delete();
        }
        else{
            $user = User::find($userid);
            $delteuser = $user->delete();
            // $sellerDetail = SellerDetails::find($selerid);
             $delteUserDetail = 1;
        }
        $msg = 'User Deleted =  ' . $user->email . ' shop updated id : ' . $userid;
        $LogDetails = new LogDetails();
        $LogDetails->user_id = $user->email;
        $LogDetails->ip_address = $loggedUserIp;
        $LogDetails->log_time = $time;
        $LogDetails->status = $msg;
        $LogDetails->save();
        if ($delteUserDetail > 0 && $delteuser > 0) {
            return response()->json(['result' => 1, 'mesge' => 'Deleted Successfully']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function AdmUserMenuPage()
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
        //$roles          = DB::table('roles')->get();
        // $alluserdetails = DB::table('users')
        // ->select('users.id','users.name','users.email','users.mobno','users.user_status','roles.role_name')
        // ->join('roles', 'users.role_id', '=', 'roles.id')->get();

        $alluserdetails = DB::table('users')
            ->select('id', 'name', 'email', 'mobno', 'user_status', 'role_id')
            ->get();

        foreach ($alluserdetails as $userdet) {
            $roleIds = explode(',', $userdet->role_id);
            $roles = DB::table('roles')
                ->whereIn('id', $roleIds)
                ->pluck('role_name')
                ->implode(', ');
            $userdet->roles = $roles;
        }
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        return view('admin.role.user_menu', compact('userdetails', 'userRole', 'loggeduser', 'alluserdetails', 'structuredMenu','selrdetails'));
    }
    function AdmUserMenuViewPage(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $query = DB::table('menu_masters')->where('status',1)
            ->orderBy('menu_level_1')
            ->orderBy('menu_level_2')
            ->orderBy('menu_level_3')
            ->get();
        $allmenus = $query;
        //echo $lastRegId = $query->toSql();exit;
        return view('admin.role.user_menu_view', compact('allmenus'));
    }
    function AdmAddUserPageMenu(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $mid = '';
        $user_id = $request->input('user_id');
        $values = $request->input('values');
        $menuval = explode(',', $values);

        $mencount = count($menuval);
        $values1 = $request->input('values11');
        $menus = explode(',', $values1);

        $nums = count($menus);
        $rm = explode(',', $values);

        if ($menuval != '') {
            $delteUserPage = UserPage::where('user_id', $user_id)->delete();
        }
        for ($i = 0; $i < $mencount; $i++) {
            if (!empty($menuval[$i])) {
                $userroleID = DB::table('users')
                    ->select('role_id')
                    ->where('id', $user_id)
                    ->get();

                foreach ($userroleID as $roles) {
                    $uesrroleval = explode(',', $roles->role_id);

                    foreach ($uesrroleval as $role) {
                        $userPage = new UserPage();
                        $userPage->user_id = $user_id;
                        $userPage->menu_id = $menuval[$i];
                        $userPage->user_role = $role;
                        $userPage->updated_by = $userId;
                        $userPage->save();
                    }
                }
            }
        }
        $updteUserPage = '';
        for ($k = 0; $k < $nums; $k++) {
            if (!empty($menus[$k])) {
                $updteUserPage = UserPage::where('user_id', $user_id)
                    ->where('menu_id', $menus[$k])
                    ->update(['privilage' => 'A']);
            }
        }

        if ($updteUserPage !== false) {
            return response()->json(['result' => 1, 'mesge' => 'Successfully Mapped']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    function AdmgetUserMenu(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $user_id = $request->input('user_id');
        $menuIds = DB::table('user_pages')
            ->where('user_id', $user_id)
            ->pluck('menu_id')
            ->toArray();
        $menuIdsString = implode(',', $menuIds);
        echo ',' . $menuIdsString . ',';
    }
    function AdmgetPrivilageMenu(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $user_id = $request->input('user_id');
        $menuIds = DB::table('user_pages')
            ->where('user_id', $user_id)
            ->where('privilage', 'A')
            ->pluck('menu_id')
            ->toArray();
        $menuIdsString = implode(',', $menuIds);
        echo ',' . $menuIdsString . ',';
    }

    function AdmRoleMenuPage()
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
        $roles = DB::table('roles')->where('roles.is_active', '1')->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        return view('admin.role.role_menu', compact('userdetails', 'userRole', 'loggeduser', 'roles', 'structuredMenu','selrdetails'));
    }
    function AdmRoleMenuViewPage(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $query = DB::table('menu_masters')->where('status',1)
            ->orderBy('menu_level_1')
            ->orderBy('menu_level_2')
            ->orderBy('menu_level_3')
            ->get();
        $allmenus = $query;
        //echo $lastRegId = $query->toSql();exit;
        return view('admin.role.role_menu_view', compact('allmenus'));
    }
    function AdmAddRolePageMenu(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $mid = '';
        $values = request()->input('value');
        $role_id = request()->input('role_id');
        $values1 = request()->input('values11');
        $menus = explode(',', $values1);

        $nums = count($menus);
        $menuIds = DB::table('role_pages')
            ->where('role_id', $role_id)
            ->pluck('menu_id')
            ->toArray();
        $md = $menuIds;
        $m = count($md) - 1;
        DB::table('role_pages')
            ->where('role_id', $role_id)
            ->delete();
        $arr = explode(',', $values);
        $n = count($arr) - 1;

        foreach ($arr as $menuId) {
            if (!empty($menuId)) {
                DB::table('role_pages')->insert([
                    'role_id' => $role_id,
                    'menu_id' => $menuId,
                    'updated_by' => $userId,
                ]);
            }
        }
        foreach ($menus as $menu) {
            if (!empty($menu)) {
                DB::table('role_pages')
                    ->where('role_id', $role_id)
                    ->where('menu_id', $menu)
                    ->update(['privilage' => 'A']);
            }
        }
        $flag = 0;
        $userIds = DB::table('user_pages')
            ->where('user_role', $role_id)
            ->distinct()
            ->pluck('user_id')
            ->toArray();
        $user = $userIds;
        $u = count($user) - 1;
        foreach ($arr as $arrItem) {
            foreach ($md as $mdItem) {
                if ($mdItem != $arrItem) {
                    $flag = 1;
                } else {
                    $flag = 0;
                    break;
                }
            }
            if ($flag == 1 && $arrItem != '') {
                foreach ($user as $userId) {
                    if (!empty($arrItem)) {
                        DB::table('user_pages')->insert([
                            'user_id' => $userId,
                            'user_role' => $role_id,
                            'menu_id' => $arrItem,
                            'updated_by' => $userId,
                        ]);
                    }
                }
            }
        }
        $flag = 0;
        foreach ($md as $mdItem) {
            foreach ($arr as $arrItem) {
                if ($arrItem != $mdItem) {
                    $flag = 1;
                } else {
                    $flag = 0;
                    break;
                }
            }

            if ($flag == 1) {
                foreach ($user as $userId) {
                    if (!empty($mdItem)) {
                        DB::table('user_pages')
                            ->where('user_id', $userId)
                            ->where('user_role', $role_id)
                            ->where('menu_id', $mdItem)
                            ->delete();
                    }
                }
            }
        }

        return response()->json(['result' => 1, 'mesge' => 'Successfully Mapped']);
    }

    function AdmgetRoleMenu(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $role_id = $request->input('role_id');
        $menuIds = DB::table('role_pages')
            ->where('role_id', $role_id)
            ->pluck('menu_id')
            ->toArray();
        $menuIdsString = implode(',', $menuIds);
        echo ',' . $menuIdsString . ',';
    }

    function AdmgetrolePrivilage(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $roleid = $request->input('roleid');
        $menuIds = DB::table('role_pages')
            ->where('role_id', $roleid)
            ->where('privilage', 'A')
            ->pluck('menu_id')
            ->toArray();
        $menuIdsString = implode(',', $menuIds);
        echo ',' . $menuIdsString . ',';
    }

    function AdmuUserRoleMenuPage()
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
        $rolesm = DB::table('roles')->where('roles.is_active', '1')->get();
        // $alluserdetails = DB::table('users')
        // ->select('users.id','users.name','users.email','users.mobno','users.user_status','roles.role_name')
        // ->join('roles', 'users.role_id', '=', 'roles.id')->get();

        $alluserdetails = DB::table('users')
            ->select('id', 'name', 'email', 'mobno', 'user_status', 'role_id')
            ->get();

        foreach ($alluserdetails as $userdet) {
            $roleIds = explode(',', $userdet->role_id);
            $roles = DB::table('roles')
                ->whereIn('id', $roleIds)
                ->pluck('role_name')
                ->implode(', ');
            $userdet->roles = $roles;
        }
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        return view('admin.role.userrole_menu', compact('userdetails', 'userRole', 'loggeduser', 'rolesm', 'alluserdetails', 'structuredMenu','selrdetails'));
    }

    function AdmgetUserRoleMenu(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $user_id = $request->input('user_id');
        $userRoles = DB::table('users')
            ->select('role_id')
            ->where('id', $user_id)
            ->pluck('role_id')
            ->toArray();
        $userRolesString = implode(',', $userRoles);
        echo ',' . $userRolesString . ',';
    }
    public function AdmAddUserRolePageMenu(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');

        if (empty($userId)) {
            return redirect()->route('logout');
        }

        $user_id = $request->input('user_id');
        $roles = $request->input('roles');
        $roles = rtrim($roles, ',');
        $rolesArray = explode(',', $roles);
        foreach ($rolesArray as $role) {
            DB::table('user_pages')
                ->where('user_id', $user_id)
                ->delete();
            if (!empty($rolesArray)) {
                DB::table('users')
                    ->where('id', $user_id)
                    ->update(['role_id' => $roles]);

                $menuData = DB::table('role_pages')
                    ->select('menu_id', 'privilage')
                    ->whereIn('role_id', $rolesArray)
                    ->get();

                foreach ($menuData as $menuItem) {
                    DB::table('user_pages')->insert([
                        'user_id' => $user_id,
                        'user_role' => $role,
                        'menu_id' => $menuItem->menu_id,
                        'privilage' => $menuItem->privilage,
                        'updated_by' => $userId,
                    ]);
                }
                return response()->json(['result' => 1, 'mesge' => 'User Role Successfully Mapped']);
            } else {
                return response()->json(['result' => 2, 'mesge' => 'Failed']);
            }
        }
    }

    function ChangePasswordPagerd()
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

        return view('admin.role.changepassword', compact('userdetails', 'userRole', 'loggeduser', 'structuredMenu','selrdetails'));
    }

    public function ChangeNewPasswordPage(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');

        if (empty($userId)) {
            return redirect()->route('logout');
        }
        $request->validate([
            'u_paswd' => 'required|min:6',
            'u_rpaswd' => 'required|same:u_paswd',
        ]);
        $uid = $request->input('uid');
        $loggedUserIp = $_SERVER['REMOTE_ADDR'];
        $time = date('Y-m-d H:i:s');
        $User = new User();
        $LogDetails = new LogDetails();
        //$email = $emal_mob;
        $userAccuntData = User::where('id', $uid)->get();
        $cnt = count($userAccuntData);
        if ($cnt > 0) {
            foreach ($userAccuntData as $row) {
                $id = $row->id;
                $fname = $row->name;
                $email = $row->email;
                $mobno = $row->mobno;
                $role_id = $row->role_id;
                $approved = $row->approved;
            }
            $data = [
                'forgot_pass' => $request->u_paswd,
                'password' => Hash::make($request->u_paswd),
            ];
            User::where('id', $id)->update($data);
            $checkval = '3';
            $verificationToken = base64_encode($id . '-' . $email . '-,-');
            $emailid = new EmailVerification($verificationToken, $fname, $email, $checkval, $request->newpaswd);
            Mail::to($email)->send($emailid);
            $msg = 'Email ID : ' . $email . ' User Reg ID ' . $id . ' New Password is ' . $request->newpaswd;
            $logdata = [
                'user_id' => $email,
                'ip_address' => $loggedUserIp,
                'log_time' => $time,
                'status' => $msg,
            ];
            $LogDetails->insert($logdata);
            return response()->json(['result' => 1, 'mesge' => 'Password Successfully Changed']);
        } else {
            return response()->json(['result' => 2, 'mesge' => 'Failed']);
        }
    }

    public function list_roles()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $roles = DB::table('roles')->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        return view('admin.role.Role_Creation.list', compact('roles', 'loggeduser', 'userdetails','structuredMenu','selrdetails'));
    }

    public function add_roles()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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

        return view('admin.role.Role_Creation.add', compact('loggeduser', 'userdetails','structuredMenu','selrdetails'));
    }

    public function store_roles(Request $request)
    {
        $request->validate(
            [
                'role_name' => 'required|min:5|max:50|unique:roles|regex:/^[^\d]+$/',
            ],
                [
                    'role_name.required' => 'The role name field is required.',
                    // 'role_name.regex' => 'The role name must contain only letters and spaces.',
                    'role_name.min' => 'The role name must be at least 5 characters.',
                    'role_name.max' => 'The role name cannot exceed 50 characters.',
                    'role_name.unique' => 'This role name is already in use.',

                    // 'role_name.unique' => 'This role name is already in use.',
                ]
        );


        $role = new Role;
        $role->is_active = 1;
        $role->role_name = ucwords($request->role_name);
        $role->save();

        return redirect()->route('list.roles')->with('success', 'Role created successfully.');
    }

    public function edit_roles($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = User::sessionValuereturn_s($roleid);
        $structuredMenu = MenuMaster::UserPageMenu($userId);
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
        $userdetails    = DB::table('users')->where('id', $userId)->get();
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('list.roles')->with('error', 'Role not found.');
        }

        return view('admin.role.Role_Creation.edit', compact('role', 'loggeduser', 'userdetails','structuredMenu','selrdetails'));
    }

    public function update_roles(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('list.roles')->with('error', 'Business Type not found.');
        }
        //dd($request->all());
        $request->validate([
            'role_name' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        $role->role_name = $request->role_name;
        if ($request->status === 'Active')
        {
            $role->is_active = 1;
        } else {
            $role->is_active = 0;
        }
        $role->save();

        return redirect()->route('list.roles')->with('success', 'Role updated successfully.');
    }

    public function delete_roles($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return redirect()->route('list.roles')->with('error', 'Role not found.');
        }

        $role->delete();

        return redirect()->route('list.roles')->with('success', 'Role deleted successfully.');
    }
}

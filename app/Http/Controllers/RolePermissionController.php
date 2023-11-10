<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\Role;
use App\Models\UserAccount;
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

class RolePermissionController extends Controller
{
    function NewRoleNameSearch(Request $request)
    {
        $rolename = $request->input('rolename');
        $RoleDetails = Role::select('id', 'role_name')
            ->where('role_name', 'LIKE', $rolename . '%')
            ->distinct()
            ->get();
        //echo $lastRegId = $UserAccount->toSql();exit;
        header('Content-Type: application/json');
        echo json_encode($RoleDetails);
    }


    function AdmRoleperMenuPage()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails = DB::table('user_account')
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
        return view('admin.rolepermission.role_menu', compact('userdetails', 'userRole', 'loggeduser', 'roles', 'structuredMenu','selrdetails'));
    }
    function AdmRoleperMenuViewPage(Request $request)
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
        return view('admin.rolepermission.role_menu_view', compact('allmenus'));
    }
    function AdmAddRoleperPageMenu(Request $request)
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

    function AdmgetRoleperMenu(Request $request)
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

    function AdmgetroleperPrivilage(Request $request)
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

    function AdmuUserRoleperMenuPage()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails = DB::table('user_account')
            ->where('id', $userId)
            ->get();
        $rolesm = DB::table('roles')->where('roles.is_active', '1')->get();
        // $alluserdetails = DB::table('user_account')
        // ->select('user_account.id','user_account.name','user_account.email','user_account.mobno','user_account.user_status','roles.role_name')
        // ->join('roles', 'user_account.role_id', '=', 'roles.id')->get();

        $alluserdetails = DB::table('user_account')
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
        return view('admin.rolepermission.userrole_menu', compact('userdetails', 'userRole', 'loggeduser', 'rolesm', 'alluserdetails', 'structuredMenu','selrdetails'));
    }

    function AdmgetUserRoleperMenu(Request $request)
    {
        $userRole = session('user_role');
        $roleid = session('roleid');
        $userId = session('user_id');
        if ($userId == '') {
            return redirect()->route('logout');
        }
        $user_id = $request->input('user_id');
        $userRoles = DB::table('user_account')
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
                DB::table('user_account')
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
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails = DB::table('user_account')
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

        return view('admin.rolepermission.changepassword', compact('userdetails', 'userRole', 'loggeduser', 'structuredMenu','selrdetails'));
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
        $UserAccount = new UserAccount();
        $LogDetails = new LogDetails();
        //$email = $emal_mob;
        $userAccuntData = UserAccount::where('id', $uid)->get();
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
            UserAccount::where('id', $id)->update($data);
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
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
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
        return view('admin.rolepermission.Role_Creation.list', compact('roles', 'loggeduser', 'userdetails','structuredMenu','selrdetails'));
    }

    public function add_roles()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
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

        return view('admin.rolepermission.Role_Creation.add', compact('loggeduser', 'userdetails','structuredMenu','selrdetails'));
    }

    public function store_roles(Request $request)
    {
        $request->validate(
            [
                'role_name' => 'required|min:5|max:50|unique:roles',
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
        $role->role_name = ucfirst($request->role_name);
        $role->save();

        return redirect()->route('list.roles')->with('success', 'Role created successfully.');
    }

    public function edit_roles($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $roleid = session('roleid');
        $loggeduser = UserAccount::sessionValuereturn_s($roleid);
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
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
        $role = Role::find($id);
        if (!$role) {
            return redirect()->route('list.roles')->with('error', 'Role not found.');
        }

        return view('admin.rolepermission.Role_Creation.edit', compact('role', 'loggeduser', 'userdetails','structuredMenu','selrdetails'));
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

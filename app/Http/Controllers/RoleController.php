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

class RoleController extends Controller
{
    function get_roles()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser     = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->get();
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

        return view('admin.role.list', compact('userdetails', 'loggeduser', 'rolesList'));
    }
    function add_roles()
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->select('name')->get();
        $site_module = DB::table('site_modules')->select('*')->orderby('module_order', 'asc')->get();
        $roles = DB::table('roles')->get();
        $sm = [];
        foreach ($site_module as $mv) {

            $mv->sub = DB::table('permissions')->select('id', 'description', 'is_disabled')->orderby('id', 'asc')->where('module_id', $mv->id)->get();
        }

        return view('admin.role.add', compact('userdetails', 'loggeduser', 'site_module', 'roles'));
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
            return redirect()->route('add.role')->withErrors($validator)->withInput();
        }
        foreach ($request->perm as $permissionId) {
            $hrp = new RolePermission();
            $hrp->role_id = $request->role_name;
            $hrp->permission_id = $permissionId;
            $hrp->rp_created_by = $userId;
            $hrp->save();
        }
        return redirect()->route('get.roles')->with('success', 'Role created successfully.');
    }

    function edit_roles($id)
    {
        $userRole = session('user_role');
        $userId = session('user_id');
        $loggeduser = UserAccount::sessionValuereturn($userRole);
        $userdetails    = DB::table('user_account')->where('id', $userId)->select('name')->get();
        $site_module = DB::table('site_modules')->select('*')->orderby('module_order', 'asc')->get();
        $roles = DB::table('roles')->pluck('role_name', 'id')->toArray();
        $rs = DB::table('roles_permissions')->where('role_id', $id)->first();
        $selectedRole = Role::find($id);

        $selectedRolePermissions = DB::table('roles_permissions')
            ->where('role_id', $selectedRole->id)
            ->pluck('permission_id')
            ->toArray();

        $sm = [];
        foreach ($site_module as $mv) {

            $mv->sub = DB::table('permissions')->select('id', 'description', 'is_disabled')->orderby('id', 'asc')->where('module_id', $mv->id)->get();
        }

        $role = Role::find($id);
        return view('admin.role.edit', compact('role', 'loggeduser', 'userdetails', 'roles', 'site_module', 'rs', 'selectedRolePermissions'));
    }

    function update_roles(Request $request, $id)
    {
        // Retrieve the role you want to update
        $role = Role::find($id);

        if (!$role) {
            return redirect()->route('get.roles')->with('error', 'Role not found');
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
            return redirect()->route('add.role')->withErrors($validator)->withInput();
        }

        $selectedPermissions = $request->input('perm', []);

        $role->permissions()->sync($selectedPermissions);

        return redirect()->route('get.roles')->with('success', 'Permissions updated successfully');
    }

    public function updateActivation($id)
    {
        $role = Role::findOrFail($id);

        $role->update(['is_active' => !$role->is_active]);

        return response()->json(['message' => 'Activation status updated successfully']);
    }
}

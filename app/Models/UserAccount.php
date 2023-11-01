<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DB;
class UserAccount extends Model
{
    use HasFactory;

    protected $table = 'user_account';

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    protected function sessionValueReturn($userRole)
    {
        $roleNames = [
            'Super_admin' => 'Super Admin',
            'Seller' => 'Seller',
            'Affiliate' => 'Affiliate',
            'Customer' => 'Customer',
            'Affiliate_coordinator' => 'Affiliate Co-ordinator',
            'Product_adding_executive' => 'Product Adding Executive',
            'HR' => 'HR',
            'Shop_coordinator' => 'Shop Co-ordinator',
        ];

        $loggeduser = '';

        if (isset($roleNames[$userRole])) {
            $loggeduser = $roleNames[$userRole];
        }

        return $loggeduser;
    }
    protected function sessionValueReturn_s($roleid)
{
    $roleIds = explode(',', $roleid);
    $roleNames = [
        '1' => 'Super Admin',
        '2' => 'Seller',
        '3' => 'Affiliate',
        '4' => 'Customer',
        '5' => 'Affiliate Co-ordinator',
        '6' => 'Product Adding Executive',
        '7' => 'HR',
        '8' => 'Shop Co-ordinator',
        '9' => 'Services',
        '10' => 'Executives',
        '11' => 'Admin',



    ];
    $roles = [];
    foreach ($roleIds as $roleId) {
        if (isset($roleNames[$roleId])) {
            $roles[] = $roleNames[$roleId];
        }
    }
    return implode(' , ', $roles);
}

}

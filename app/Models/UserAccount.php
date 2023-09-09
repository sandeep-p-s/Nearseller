<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}

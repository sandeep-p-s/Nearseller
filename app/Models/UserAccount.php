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
    protected function sessionValuereturn($userRole)
    {
        if ($userRole === 'Super_admin') {
            $loggeduser='Super Admin';
        } elseif ($userRole === 'Seller') {
            $loggeduser='Seller';
        } elseif ($userRole === 'Affiliate') {
            $loggeduser='Affiliate';
        } elseif ($userRole === 'Customer') {
            $loggeduser='Customer';
        } elseif ($userRole === 'Affiliate_coordinator') {
            $loggeduser='Affiliate Co-ordinator';
        } elseif ($userRole === 'Product_adding_executive') {
            $loggeduser='Product Adding Executive';
        } elseif ($userRole === 'HR') {
            $loggeduser='HR';
        } elseif ($userRole === 'Shop_coordinator') {
            $loggeduser='Shop Co-ordinator';
        }
        return $loggeduser;

    }

}

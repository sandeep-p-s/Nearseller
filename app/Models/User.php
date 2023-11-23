<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name','email','password','mobno','email_verified_at','password','remember_token','user_status','forgot_pass','role_id','active_date','approved','approved_by','approved_at','ip','parent_id','email_verify','mobile_verify','referal_id','photo_file','user_dob','user_house_name','user_locality','user_city','user_country','user_state','user_dist','user_pincode','mob_countrycode','created_at','updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

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

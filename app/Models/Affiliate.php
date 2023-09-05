<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory;

    protected $table = 'affiliate';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [      'name','email','mob_no','dob','gender','profession','marital_status','religion','affiliate_reg_id','referal_id','aadhar_no','locality','country','state','district','aadhar_file','passbook_file','photo_file','terms_condition','direct_affiliate','aff_coordinator','user_id',
    ];


}

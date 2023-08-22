<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerDetails extends Model
{
    use HasFactory;
    protected $table = 'seller_details';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [

        'shop_name','owner_name','shop_email','shop_mobno','referal_id','busnes_type','shop_service_type','shop_executive','term_condition','shop_licence','shop_gstno','shop_panno','house_name_no','locality','village','country','state','district','pincode','googlemap','shop_photo','establish_date',
    ];

}

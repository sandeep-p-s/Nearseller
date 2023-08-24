<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BusinessType;
use App\Models\ServiceType;
use App\Models\Executives;
use App\Models\Country;
use App\Models\State;
use App\Models\District;
class SellerDetails extends Model
{
    use HasFactory;
    protected $table = 'seller_details';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [

        'shop_name','owner_name','shop_email','shop_mobno','shop_reg_id','affiliate_reg_id','referal_id','busnes_type','shop_service_type','shop_executive','term_condition','shop_licence','shop_gstno','shop_panno','house_name_no','locality','village','country','state','district','pincode','googlemap','shop_photo','establish_date','user_id',
    ];


    public function businessType()
    {
        return $this->belongsTo(BusinessType::class, 'busnes_type', 'id');
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'shop_service_type', 'id');
    }

    public function executive()
    {
        return $this->belongsTo(Executives::class, 'shop_executive', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district', 'id');
    }

}

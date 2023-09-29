<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;
    protected $table = 'product_details';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [    'id','shop_id','product_name','product_specification','category_id','product_description','product_images','product_videos','product_document','manufacture_details','brand_name','paying_mode','product_stock','is_attribute','created_by','created_time','product_status','is_approved','approved_by','approved_time','created_at','updated_at',
    ];
}

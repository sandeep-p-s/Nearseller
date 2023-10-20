<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetails extends Model
{
    use HasFactory;
    protected $table = 'service_details';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [    'id','service_id','service_name','service_images','is_attribute','created_by','created_time','service_status','is_approved','approved_by','approved_time','created_at','updated_at',
    ];

}

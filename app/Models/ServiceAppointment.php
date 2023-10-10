<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceAppointment extends Model
{
    use HasFactory;
    protected $table = 'service_appointments';
    protected $fillable = ['id','is_setdates','available_from_date','available_to_date','is_not_available','not_available_dates','working_hours','service_id','employee_id','suggestion','service_point','created_at','updated_at',
];
}

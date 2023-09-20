<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable =[
        'type',
        'offer_to_display',
        'conditions',
        'from_date_time',
        'to_date_time',
        'offer_image',
        'status'
    ];
}

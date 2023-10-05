<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddProductAttribute extends Model
{
    use HasFactory;
    protected $table = 'add_product_attributes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'product_id',
        'attribute_1',
        'attribute_2',
        'attribute_3',
        'attribute_4',
        'offer_price',
        'mrp_price',
        'attribute_stock',
        'stock_status',
    ];
}

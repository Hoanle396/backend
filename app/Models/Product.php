<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table ='products';
    protected $fillable=[
        'product_name',
        'product_description',
        'product_image',
        'product_price',
        'product_origin',
        'product_manufacturer',
        'product_discount'
    ];
    protected $primaryKey='product_id';
}

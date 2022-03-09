<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table ='order_details';
    protected $fillable=[
        'order_code',
        'product_id',
        'product_name',
        'product_quantity',
        'user_fullname',
        'user_email',
        'user_phonenumber',
        'user_address',
        'user_address2',
        'order_status',
        'order_pay',
    ];
    protected $primaryKey='id';
}

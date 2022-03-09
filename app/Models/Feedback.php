<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedBack extends Model
{
    use HasFactory;
    protected $table='feed_backs';
    protected $fillable=[
        'firstname',
        'lastname',
        'email',
        'phonenumber',
        'message'
    ];
    protected $primarykey='id';
}

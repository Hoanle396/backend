<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table='services';
    protected $fillable=[
        'fullname',
        'gender',
        'birthday',
        'address',
        'email',
        'mobilePhone',
        'homePhone',
        'officePhone',
        'status'
    ];
    protected $primarykey='id';
}

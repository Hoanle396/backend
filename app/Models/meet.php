<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meet extends Model
{
    use HasFactory;
    protected $table ='meets';
    protected $fillable =[
        'meets_id',
        'id',
        'service_fullname',
        'service_email',
        'time',
        'date',
        'description',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable = [
        'perHourFee',
        'experience',
        'expertField',
        'aboutme',
        'address',
        'mobileNumber',
        'user_id',
        'latitude',
        'longitude'
    ];
}

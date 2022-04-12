<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'fee',
        'appointmentDate',
        'client_id',
        'worker_id',
        'address',
        'isCanceled',
        'isReviewed',
        'isPaidUp',
        'isConfirmed'
    ];
    protected $casts = [
        'appointmentDate' => 'datetime:Y-m-d, h:i a',
    ];
}

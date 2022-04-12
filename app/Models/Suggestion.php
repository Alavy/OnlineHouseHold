<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'message',
        'contractEmail'
    ];
    protected $visible = [
        'id',
        'name', 
        'message',
        'contractEmail'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'routine_id',
        'time_entrance',
        'time_exit',
        'duty_user_id',
        'visitor_person_id',
        'description',
    ];
}

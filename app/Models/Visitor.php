<?php

namespace App\Models;

class Visitor extends Model
{
    protected $fillable = [
        'routine_id',
        'time_entrance',
        'time_exit',
        'duty_user_id',
        'visitor_person_id',
        'description',
    ];
}

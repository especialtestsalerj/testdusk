<?php

namespace App\Models;

class Stuff extends Model
{
    protected $fillable = [
        'routine_id',
        'time_entrance',
        'time_exit',
        'duty_user_id',
        'description',
    ];
}

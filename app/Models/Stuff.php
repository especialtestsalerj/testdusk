<?php

namespace App\Models;

class Stuff extends Model
{
    protected $fillable = [
        'routine_id',
        'entrance_date',
        'exit_date',
        'duty_user_id',
        'description',
    ];
}

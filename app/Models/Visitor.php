<?php

namespace App\Models;

class Visitor extends Model
{
    protected $fillable = [
        'routine_id',
        'entrance_date',
        'exit_date',
        'duty_user_id',
        'visitor_person_id',
        'description',
    ];
}

<?php

namespace App\Models;

class Event extends Model
{
    protected $fillable = ['routine_id', 'event_type_id', 'time', 'duty_user_id', 'description'];
}

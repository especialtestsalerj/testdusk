<?php

namespace App\Models;

class Routine extends Model
{
    protected $fillable = [
        'entrance_date',
        'entrance_user_id',
        'entrance_shift_id',
        'entrance_obs',
        'checkpoint_obs',
        'exit_date',
        'exit_user_id',
        'exit_obs',
    ];
}

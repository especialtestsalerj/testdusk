<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use HasFactory;

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

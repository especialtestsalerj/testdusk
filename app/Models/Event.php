<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'routine_id',
        'event_type_id',
        'event_date',
        'duty_user_id',
        'description',
    ];
}

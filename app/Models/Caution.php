<?php

namespace App\Models;

class Caution extends Model
{
    protected $fillable = [
        'routine_id',
        'duty_user_id',
        'person_id',
        'destiny_sector_id',
        'protocol_number',
        'concluded_at',
    ];
}

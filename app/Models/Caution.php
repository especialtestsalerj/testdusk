<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caution extends Model
{
    use HasFactory;

    protected $fillable = [
        'routine_id',
        'duty_user_id',
        'caution_person_id',
        'destiny_sector_id',
        'protocol_number',
        'concluded_at',
    ];
}

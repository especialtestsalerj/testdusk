<?php

namespace App\Models;

class Caution_Weapon extends Model
{
    protected $fillable = [
        'caution_id',
        'weapon_type_id',
        'description',
        'weapon_number',
        'cabinet_id',
        'shelf_id',
        'concluded_at',
    ];
}

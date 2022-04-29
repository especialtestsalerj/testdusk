<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caution_Weapon extends Model
{
    use HasFactory;

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

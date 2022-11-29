<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CautionWeapon extends Model
{
    use HasFactory;

    protected $fillable = [
        'caution_id',
        'entranced_at',
        'exited_at',
        'register_number',
        'weapon_type_id',
        'weapon_description',
        'weapon_number',
        'cabinet_id',
        'shelf_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'old_id',
    ];

    public function weaponType()
    {
        return $this->belongsTo(WeaponType::class);
    }

    public function cabinet()
    {
        return $this->belongsTo(Cabinet::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }

    public function caution()
    {
        return $this->belongsTo(Caution::class);
    }
}

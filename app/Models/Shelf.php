<?php

namespace App\Models;

class Shelf extends Model
{
    protected $fillable = ['name', 'status'];

    public function cautionWeapons()
    {
        return $this->hasMany(CautionWeapon::class);
    }
}

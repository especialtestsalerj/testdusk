<?php

namespace App\Models;

class Cabinet extends Model
{
    protected $fillable = ['name', 'status'];

    public function cautionWeapons()
    {
        return $this->hasMany(CautionWeapon::class);
    }
}

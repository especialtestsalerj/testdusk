<?php

namespace App\Models;

class ReservationStatus extends Model
{
    protected $fillable = ['name', 'status'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

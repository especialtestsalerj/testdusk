<?php

namespace App\Models;

use App\Models\Scopes\InCurrentBuilding;

class Reservation extends Model
{
//    protected $fillable = ['code', 'reservation_date', 'building_id', 'group_id'];
    protected $fillable = [
        'group_id',
        'reservation_type_id',
        'code',
        'reservation_date',
        'reservation_time',
        'sector_id',
        'person',
        'reservation_status_id',
        'reservation_status',
        'responsible_person_type',
        'responsible_name',
        'responsible_email'
    ];

    protected $casts = [
        'person' => 'array',
    ];

    protected $dates = [
        'reservation_date',
        'reservation_time',
    ];

//    protected $filterableColumns = ['name', 'status'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new InCurrentBuilding());
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function reservationStatus()
    {
        return $this->belongsTo(ReservationStatus::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }


    public static function disableGlobalScopes()
    {
        InCurrentBuilding::disable();
    }

    public static function enableGlobalScopes()
    {
        InCurrentBuilding::enable();
    }
}

<?php

namespace App\Models;

use App\Models\Scopes\InCurrentBuilding;
use App\Notifications\ReservationNotification;
use Illuminate\Notifications\Notifiable;

class Reservation extends Model
{
    use Notifiable;

    protected $fillable = [
        'group_id',
        'reservation_type_id',
        'code',
        'motive',
        'reservation_date',
        'capacity_id',
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

    protected $with=['capacity'];

//    protected $filterableColumns = ['name', 'status'];

    public static function boot()
    {
        parent::boot();
//        static::addGlobalScope(new InCurrentBuilding());

        static::created(function ($reservation) {

            $reservation->notify(new ReservationNotification($reservation));
        });
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

    public function capacity()
    {
        return $this->belongsTo(Capacity::class);
    }


    public static function disableGlobalScopes()
    {
        InCurrentBuilding::disable();
    }

    public static function enableGlobalScopes()
    {
        InCurrentBuilding::enable();
    }

    public function routeNotificationForMail($notification)
    {
//        dd($this->responsible_email);
        return $this->responsible_email;
    }
}

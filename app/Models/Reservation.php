<?php

namespace App\Models;

use App\Models\Scopes\InCurrentBuilding;
use App\Notifications\ReservationNotification;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class Reservation extends Model
{
    use Searchable, Notifiable;

    protected $fillable = [
        'group_id',
        'reservation_type_id',
        'code',
        'motive',
        'reservation_date',
        'capacity_id',
        'sector_id',
        'person',
        'quantity',
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

    public function toSearchableArray(): array
    {
        $person = json_decode($this->person, true);

        return [
            'code' => $this->code,
            'reservation_date_formatted' => $this->reservation_date?->format('d/m/Y'),
            'reservation_date' => $this->reservation_date?->format('Y-m-d'),
            'reservation_hour' => $this->capacity->hour,
            'created_at' => $this->created_at?->format('d/m/Y H:i'),
            'sector.name' => $this->sector?->name,
            'sector.id' => $this->sector_id,
            'status.name' => $this->reservationStatus?->name,
            'status.id' => $this->reservationStatus?->id,
            'person.full_name' => $person['full_name'] ?? null,
            'person.social_name' => $person['social_name'] ?? null,
            'person.document_number' => $personn['document_number'] ?? null,
            'person.email' => $person['email'] ?? null,
            'person.mobile' => $person['mobile'] ?? null,
            'motive' => $this->motive,
            'foo' => 'bar', //used to hack some queries
        ];
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

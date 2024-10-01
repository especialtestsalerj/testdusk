<?php

namespace App\Models;

use App\Models\Scopes\InCurrentBuilding;
use App\Notifications\ReservationCanceledNotification;
use App\Notifications\ReservationConfirmedNotification;
use App\Notifications\ReservationNotification;
use App\Notifications\ReservationRealizedNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Reservation extends Model
{
    use Searchable, Notifiable;

    protected $fillable = [
        'building_id',
        'group_id',
        'reservation_type_id',
        'code',
        'motive',
        'reservation_date',
        'capacity_id',
        'sector_id',
        'person',
        'guests',
        'quantity',
        'reservation_status_id',
        'reservation_status',
        'responsible_person_type',
        'responsible_name',
        'responsible_email',
        'person_id',
        'confirmed_by_id',
        'confimed_at',
        'canceled_by_id',
        'canceled_at',
        'uuid',
        'institution',
        'visitor_id'
    ];

    protected $casts = [
        'person' => 'array',
        'guests' => 'array',
    ];

    protected $dates = [
        'reservation_date',
        'reservation_time',
        'confirmed_at',
        'canceled_at',
    ];

    protected $with=['capacity','confirmedBy'];

//    protected $filterableColumns = ['name', 'status'];

    public static function boot()
    {
        parent::boot();
//        static::addGlobalScope(new InCurrentBuilding());



        static::created(function ($reservation) {


            if (empty($reservation->uuid)) {
                $reservation->uuid = Str::uuid()->toString();
                $reservation->save();
            }

            $reservation->notify(new ReservationNotification($reservation));
        });

        static::updated(function ($reservation) {


            // Verifique se o status foi alterado para 'visita confirmada'
            if ($reservation->isDirty('reservation_status_id')){

                if($reservation->reservationStatus->name == 'VISITA AGENDADA'){
                    // Envie o email de notificação
                    $reservation->notify(new ReservationConfirmedNotification($reservation));
                }

                if($reservation->reservationStatus->name == 'VISITA CANCELADA'){
                    $reservation->notify(new ReservationCanceledNotification($reservation));
                }

                if($reservation->reservationStatus->name == 'VISITA REALIZADA'){
                    // Envie o email de notificação
                    $reservation->notify(new ReservationRealizedNotification($reservation));
                }
            }
        });
    }

    function sendEmail($reservation)
    {

        if($reservation->reservationStatus->name == 'AGUARDANDO CONFIRMAÇÃO'){
            $reservation->notify(new ReservationNotification($reservation));
        }

        if($reservation->reservationStatus->name == 'VISITA AGENDADA'){
            // Envie o email de notificação
            $reservation->notify(new ReservationConfirmedNotification($reservation));
        }

        if($reservation->reservationStatus->name == 'VISITA CANCELADA'){
            $reservation->notify(new ReservationCanceledNotification($reservation));
        }

        if($reservation->reservationStatus->name == 'VISITA REALIZADA'){
            // Envie o email de notificação
            $reservation->notify(new ReservationRealizedNotification($reservation));
        }
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
            'person.full_name' => $this->person['full_name'] ?? null,
            'person.social_name' => $this->person['social_name'] ?? null,
            'person.document_number' => $this->personn['document_number'] ?? null,
            'person.email' => $this->person['email'] ?? null,
            'person.mobile' => $this->person['mobile'] ?? null,
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
        return $this->responsible_email;
    }

    public function responsible()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function guestsConfirmed()
    {
        return $this->belongsToMany(Person::class, 'reservation_person', 'reservation_id', 'person_id')
            ->withPivot('reservation_status_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function confirmedBy(){
        return $this->belongsTo(User::class, 'confirmed_by_id');
    }

    public function canceledBy(){
        return $this->belongsTo(User::class, 'canceled_by_id');
    }
}

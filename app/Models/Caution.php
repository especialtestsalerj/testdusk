<?php

namespace App\Models;

class Caution extends Model
{
    protected $fillable = [
        'routine_id',
        'started_at',
        'concluded_at',
        'duty_user_id',
        'person_id',
        'destiny_sector_id',
        'protocol_number',
    ];

    protected $casts = [
        'started_at' => 'datetime:Y-m-d H:i',
        'concluded_at' => 'datetime:Y-m-d H:i',
    ];

    public function dutyUser()
    {
        return $this->belongsTo(User::class, 'duty_user_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function destinySector()
    {
        return $this->belongsTo(Sector::class, 'destiny_sector_id');
    }

    public function getStartedAtFormattedAttribute()
    {
        return $this->started_at?->format('Y-m-d H:i');
    }

    public function getConcludedAtFormattedAttribute()
    {
        return $this->concluded_at?->format('Y-m-d H:i');
    }

    public function getProtocolNumberFormattedAttribute()
    {
        $ano = substr($this->protocol_number, 0, 4);
        $codigo = substr($this->protocol_number, 4, 4);
        return $codigo . '/' . $ano;
    }
}

<?php

namespace App\Models;

class PersonRestriction extends Model
{
    protected $fillable = ['person_id', 'started_at', 'ended_at', 'message', 'description'];

    protected $filterableColumns = ['started_at'];

    protected $casts = [
        'started_at' => 'datetime:Y-m-d H:i',
        'ended_at' => 'datetime:Y-m-d H:i',
    ];

    public function getStartedAtFormattedAttribute()
    {
        return $this->started_at?->format('Y-m-d H:i');
    }

    public function getEndedAtFormattedAttribute()
    {
        return $this->ended_at?->format('Y-m-d H:i');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}

<?php

namespace App\Models;

class Visitor extends Model
{
    protected $fillable = [
        'routine_id',
        'entranced_at',
        'exited_at',
        'duty_user_id',
        'person_id',
        'description',
    ];

    protected $casts = [
        'entranced_at' => 'datetime:Y-m-d H:i',
        'exited_at' => 'datetime:Y-m-d H:i',
    ];

    public function dutyUser()
    {
        return $this->belongsTo(User::class, 'duty_user_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function getEntrancedAtFormattedAttribute()
    {
        return $this->entranced_at?->format('d/m/Y H:i');
    }

    public function getExitedAtFormattedAttribute()
    {
        return $this->exited_at?->format('d/m/Y H:i');
    }
}

<?php

namespace App\Models;

class Visitor extends Model
{
    protected $fillable = [
        'routine_id',
        'entranced_at',
        'exited_at',
        'person_id',
        'sector_id',
        'duty_user_id',
        'description',
        'old_id',
    ];

    protected $casts = [
        'entranced_at' => 'datetime:Y-m-d H:i',
        'exited_at' => 'datetime:Y-m-d H:i',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    public function dutyUser()
    {
        return $this->belongsTo(User::class, 'duty_user_id');
    }

    public function getEntrancedAtFormattedAttribute()
    {
        return $this->entranced_at?->format('Y-m-d H:i');
    }

    public function getExitedAtFormattedAttribute()
    {
        return $this->exited_at?->format('Y-m-d H:i');
    }
}

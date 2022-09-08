<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'routine_id',
        'event_type_id',
        'occurred_at',
        'duty_user_id',
        'description',
    ];

    protected $casts = [
        'occurred_at' => 'datetime:Y-m-d H:i',
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    public function dutyUser()
    {
        return $this->belongsTo(User::class, 'duty_user_id');
    }

    public function getOccurredAtFormattedAttribute()
    {
        return $this->occurred_at?->format('d/m/Y H:i');
    }
}

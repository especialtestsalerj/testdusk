<?php

namespace App\Models;

use App\Models\Scopes\InCurrentBuilding;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'routine_id',
        'event_type_id',
        'occurred_at',
        'sector_id',
        'duty_user_id',
        'description',
        'building_id',
    ];

    protected $casts = [
        'occurred_at' => 'datetime:Y-m-d H:i',
    ];

    protected static function booted()
    {
        static::creating(function (Event $event) {
            $event->building_id = get_current_building()->id;
        });
    }
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new InCurrentBuilding());
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }

    public function dutyUser()
    {
        return $this->belongsTo(User::class, 'duty_user_id');
    }

    public function getOccurredAtFormattedAttribute()
    {
        return $this->occurred_at?->format('Y-m-d H:i');
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function attachedFiles()
    {
        return $this->morphMany(AttachedFile::class, 'fileable');
    }
}

<?php

namespace App\Models;

use App\Models\Scopes\InCurrentBuilding;

class Stuff extends Model
{
    protected $fillable = [
        'routine_id',
        'entranced_at',
        'exited_at',
        'sector_id',
        'duty_user_id',
        'description',
        'building_id',
    ];

    protected $casts = [
        'entranced_at' => 'datetime:Y-m-d H:i',
        'exited_at' => 'datetime:Y-m-d H:i',
    ];

    protected static function booted()
    {
        static::creating(function (Stuff $stuff) {
            $stuff->building_id = get_current_building()->id;
        });
    }
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new InCurrentBuilding());
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

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}

<?php

namespace App\Models;

class Caution extends Model
{
    protected $fillable = [
        'routine_id',
        'started_at',
        'concluded_at',
        'visitor_id',
        'duty_user_id',
        'protocol_number',
        'description',
        'old_id',
    ];

    protected $casts = [
        'started_at' => 'datetime:Y-m-d H:i',
        'concluded_at' => 'datetime:Y-m-d H:i',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    public function dutyUser()
    {
        return $this->belongsTo(User::class, 'duty_user_id');
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
        return mask_protocol_number($this->protocol_number);
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    public function hasPending()
    {
        return isset($this?->old_id);
    }

    public function hasWeapons()
    {
        $weapons = CautionWeapon::where('caution_id', $this->id)->get();

        return count($weapons) > 0;
    }
}

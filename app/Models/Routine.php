<?php

namespace App\Models;

use App\Models\Scopes\InCurrentBuilding;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Routine extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'shift_id',
        'entranced_at',
        'entranced_user_id',
        'entranced_obs',
        'checkpoint_obs',
        'exited_at',
        'exited_user_id',
        'exited_obs',
        'status',
        'building_id',
    ];

    protected $casts = [
        'entranced_at' => 'datetime:Y-m-d H:i',
        'exited_at' => 'datetime:Y-m-d H:i',
    ];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new InCurrentBuilding());
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function getEntrancedAtFormattedAttribute()
    {
        return $this->entranced_at?->format('Y-m-d H:i');
    }

    public function getExitedAtFormattedAttribute()
    {
        return $this->exited_at?->format('Y-m-d H:i');
    }

    public function entrancedUser()
    {
        return $this->belongsTo(User::class, 'entranced_user_id');
    }

    public function exitedUser()
    {
        return $this->belongsTo(User::class, 'exited_user_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'routine_id')
            ->orderBy('occurred_at')
            ->orderBy('id');
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class, 'routine_id')
            ->orderBy('entranced_at')
            ->orderBy('id');
    }

    public function stuffs()
    {
        return $this->hasMany(Stuff::class, 'routine_id')
            ->orderBy('entranced_at')
            ->orderBy('id');
    }

    public function cautions()
    {
        return $this->hasMany(Caution::class, 'routine_id')->orderBy('protocol_number');
    }

    public function getPendingVisitors()
    {
        return Visitor::whereNull('exited_at')
            ->orderBy('entranced_at')
            ->orderBy('id')
            ->get();
    }

    public function getPendingCautions()
    {
        return Caution::where('routine_id', $this->id)
            ->whereNull('concluded_at')
            ->orderBy('protocol_number')
            ->get();
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}

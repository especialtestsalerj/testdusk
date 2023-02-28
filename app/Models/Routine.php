<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Routine extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_id',
        'entranced_at',
        'entranced_user_id',
        'entranced_obs',
        'checkpoint_obs',
        'exited_at',
        'exited_user_id',
        'exited_obs',
        'status',
    ];

    protected $casts = [
        'entranced_at' => 'datetime:Y-m-d H:i',
        'exited_at' => 'datetime:Y-m-d H:i',
    ];

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
        return $this->hasMany(Event::class, 'routine_id')->orderBy('occurred_at');
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class, 'routine_id')->orderBy('entranced_at');
    }

    public function stuffs()
    {
        return $this->hasMany(Stuff::class, 'routine_id')->orderBy('entranced_at');
    }

    public function cautions()
    {
        return $this->hasMany(Caution::class, 'routine_id')->orderBy('started_at');
    }
}

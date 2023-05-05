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

    public function hasPending()
    {
        return isset($this?->old_id);
    }

    public function hasPendingFromCaution()
    {
        $cautions = Caution::whereNotNull('visitor_old_id')
            ->where('visitor_old_id', $this->old_id)
            ->get();

        return count($cautions) > 0;
    }

    public function hasCpfActiveOnRoutine($caution_id = null)
    {
        $cautions = Caution::select('cautions.*')
            ->join('visitors', 'visitors.id', '=', 'cautions.visitor_id')
            ->join('people', 'people.id', '=', 'visitors.person_id')
            ->where('cautions.routine_id', $this->routine_id)
            ->where('people.cpf', $this->person->cpf)
            ->whereRaw(isset($caution_id) ? 'cautions.id <> ' . $caution_id : '1=1')
            ->whereNull('cautions.concluded_at')
            ->get();

        return count($cautions) > 0;
    }
}

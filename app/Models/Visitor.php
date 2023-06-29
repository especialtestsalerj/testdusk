<?php

namespace App\Models;
use Ramsey\Uuid\Uuid;
class Visitor extends Model
{
    protected $fillable = [
        'routine_id',
        'entranced_at',
        'exited_at',
        'person_id',
        'sector_id',
        'description',
        'document_id',
    ];

    protected $casts = [
        'entranced_at' => 'datetime:Y-m-d H:i',
        'exited_at' => 'datetime:Y-m-d H:i',
    ];

    protected static function booted()
    {
        static::creating(fn(Visitor $visitor) => ($visitor->uuid = (string) Uuid::uuid4()));
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function cautions()
    {
        return $this->hasMany(Caution::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'sector_id');
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

    public function hasOpenCaution($caution_id = null)
    {
        return $this->cautions()
            ->whereRaw(isset($caution_id) ? 'cautions.id <> ' . $caution_id : '1=1')
            ->whereNull('cautions.concluded_at')
            ->count() > 0;
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}

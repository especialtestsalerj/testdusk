<?php

namespace App\Models;

use App\Models\Scopes\InCurrentBuilding;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CautionWeapon extends Model
{
    use HasFactory;

    protected $fillable = [
        'caution_id',
        'entranced_at',
        'exited_at',
        'register_number',
        'weapon_type_id',
        'weapon_description',
        'weapon_number',
        'cabinet_id',
        'shelf_id',
        'old_id',
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

    public function weaponType()
    {
        return $this->belongsTo(WeaponType::class);
    }

    public function cabinet()
    {
        return $this->belongsTo(Cabinet::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }

    public function caution()
    {
        return $this->belongsTo(Caution::class);
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

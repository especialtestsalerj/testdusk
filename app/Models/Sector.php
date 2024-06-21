<?php

namespace App\Models;

use App\Http\Requests\SectorDestroy;
use App\Models\Scopes\InCurrentBuilding;
use Illuminate\Support\Facades\Validator;

class Sector extends Model
{
    protected $fillable = ['name', 'status', 'building_id', 'nickname', 'is_visitable'];

    protected $filterableColumns = ['name', 'status'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new InCurrentBuilding());
    }

    public function canDelete()
    {
        $request = new SectorDestroy($this->toArray());

        return Validator::make($request->all(), $request->rules())->fails();
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function visitors()
    {
        return $this->belongsToMany(Visitor::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public static function disableGlobalScopes()
    {
        InCurrentBuilding::disable();
    }

    public static function enableGlobalScopes()
    {
        InCurrentBuilding::enable();
    }

    public function blockedDates()
    {
        return $this->hasMany(BlockedDate::class);
    }
    public function Capacities(){
        return $this->hasMany(Capacity::class);
    }
}

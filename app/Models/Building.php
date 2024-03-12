<?php

namespace App\Models;

use App\Models\Scopes\Active;

class Building extends Model
{
    protected $fillable = ['name', 'slug', 'created_by_id', 'updated_by_id'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new Active());
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    public function visitors()
    {
        return $this->belongsToMany(Visitor::class);
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }

    public function routines()
    {
        return $this->belongsToMany(Routine::class);
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class);
    }
}

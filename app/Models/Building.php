<?php

namespace App\Models;

use App\Http\Requests\SectorDestroy;
use Illuminate\Support\Facades\Validator;

class Building extends Model
{
    protected $fillable = ['name', 'slug', 'created_by_id', 'updated_by_id'];
    public function building()
    {
        return $this->belongsTo(Building::class);
    }
    public function visitors()
    {
        return $this->belongsToMany(Visitor::class);
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

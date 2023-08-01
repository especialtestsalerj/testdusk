<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Casts\Attribute;

class Disability extends Model
{
    use HasFactory;

    protected $fillable = ['person_id', 'disability_type_id', 'created_by_id', 'updated_by_id'];

    //protected $appends = ['type'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function disabilityType()
    {
        return $this->belongsTo(DisabilityType::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    /*public function type(): Attribute
    {
        return Attribute::make(get: fn($value) => $this->disabilityType->name);
    }*/
}

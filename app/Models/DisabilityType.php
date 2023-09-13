<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisabilityType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'created_by_id', 'updated_by_id'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function person()
    {
        return $this->belongsToMany(Person::class, 'disabilities');
    }
}

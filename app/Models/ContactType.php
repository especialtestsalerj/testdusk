<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function contacts()
    {
        return $this->belongsToMany(Person::class);
    }
}


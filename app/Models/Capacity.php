<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Capacity extends Model
{
    use HasFactory;

    protected $fillable = ['sector_id','hour','capacity'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

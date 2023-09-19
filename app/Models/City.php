<?php

namespace App\Models;

use App\Data\Repositories\States;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'state_id'];

    public function state()
    {
        return $this->belongsTo(States::class);
    }
}

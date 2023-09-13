<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'initial', 'status'];
}

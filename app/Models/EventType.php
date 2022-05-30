<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    protected $filterableColumns = ['name', 'status'];
}

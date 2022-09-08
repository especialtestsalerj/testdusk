<?php

namespace App\Models;

class EventType extends Model
{
    protected $fillable = ['name', 'status'];

    protected $filterableColumns = ['name', 'status'];
}

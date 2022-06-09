<?php

namespace App\Models;

class Sector extends Model
{
    protected $fillable = ['name', 'status'];

    protected $filterableColumns = ['name', 'status'];
}

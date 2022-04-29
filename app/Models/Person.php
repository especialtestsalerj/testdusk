<?php

namespace App\Models;

class Person extends Model
{
    protected $fillable = ['cpf', 'full_name', 'origin', 'photo', 'alert_obs'];
}

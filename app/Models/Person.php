<?php

namespace App\Models;

class Person extends Model
{
    protected $fillable = [
        'cpf',
        'full_name',
        'origin',
        'id_card',
        'certificate_type',
        'certificate_number',
        'certificate_valid_until',
        'photo',
        'alert_obs',
    ];
}

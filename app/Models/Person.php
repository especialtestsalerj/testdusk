<?php

namespace App\Models;

class Person extends Model
{
    protected $fillable = [
        'cpf',
        'full_name',
        'social_name',
        'origin',
        'id_card',
        'certificate_type',
        'certificate_number',
        'certificate_valid_until',
        'photo',
        'alert_obs',
    ];

    protected $appends = ['name'];

    public function getCpfFormattedAttribute()
    {
        $formatted = substr($this->cpf, 0, 3) . '.';
        $formatted .= substr($this->cpf, 3, 3) . '.';
        $formatted .= substr($this->cpf, 6, 3) . '-';
        $formatted .= substr($this->cpf, 9, 2) . '';

        return $formatted;
    }


    public function getNameAttribute()
    {
        return is_null($this->full_name) ? $this->social_name : $this->full_name;
    }
}

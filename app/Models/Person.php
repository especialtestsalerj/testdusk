<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
class Person extends Model
{
    protected $fillable = [
        'full_name',
        'social_name',
        //        'origin',
        'id_card',
        'certificate_type',
        'certificate_number',
        'certificate_valid_until',
        'alert_obs',
        'city_id',
        'state_id',
        'country_id',
        'other_city',
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
        return !is_null($this->social_name) ? $this->social_name : $this->full_name;
    }

    protected function abbreviatedName(): Attribute
    {
        $words = explode(' ', $this->full_name);
        $firstWord = $words[0];
        $concatenated = $firstWord . (count($words) > 1 ? ' ' . $words[count($words) - 1] : '');

        return Attribute::make(get: fn($value) => $concatenated);
    }

    protected function cpf(): Attribute
    {
        $documentWithCPF = $this->documents()->whereHas('documentType', function ($query) {
            $query->where('name', 'CPF');
        })->first();

        return Attribute::make(get: fn($value) => $documentWithCPF->number);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function visitors()
    {
        return $this->hasMany(Visitor::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function hasPendingVisitors()
    {
        foreach ($this->visitors as $visitor) {
            if (is_null($visitor->exited_at)) {
                return true;
            }
        }

        return false;
    }

    public function pendingVisit()
    {
        return $this->hasOne(Visitor::class)->whereNull('exited_at');
    }

    public function lastVisit()
    {
        return $this->hasOne(Visitor::class)->orderBy('created_at', 'desc');
    }

    public function photo(): Attribute
    {
        return Attribute::make(get: fn($value) => $this->lastVisit->photo ?? no_photo());
    }
}

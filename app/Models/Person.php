<?php

namespace App\Models;

use App\Data\Repositories\DocumentTypes;
use Illuminate\Database\Eloquent\Casts\Attribute;
class Person extends Model
{
    protected $fillable = [
        'full_name',
        'social_name',
        'birthdate',
        'gender_id',
        'has_disability',
        'city_id',
        'other_city',
        'state_id',
        'country_id',
        'email',
        //        'origin',
        'id_card',
        'certificate_type',
        'certificate_number',
        'certificate_valid_until',
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
        return !is_null($this->social_name) ? $this->social_name : $this->full_name;
    }

    protected function abbreviatedName(): Attribute
    {
        $words = explode(' ', $this->full_name);
        $firstWord = $words[0];
        $concatenated = $firstWord . (count($words) > 1 ? ' ' . $words[count($words) - 1] : '');

        return Attribute::make(get: fn($value) => $concatenated);
    }

    public function disabilities()
    {
        return $this->hasMany(Disability::class);
    }


    protected function cpf(): Attribute
    {
        $documentType = app(DocumentTypes::class)->getCPF();

        $documentWithCPF = $this->documents()->where('document_type_id', $documentType->id)
        ->first();

        return Attribute::make(get: fn($value) => $documentWithCPF->number ?? null);
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

    public function syncDisabilites($array, $person_id)
    {
        $disabilitiesToSync = [];

        foreach ($array as $disability) {
            $disabilitiesToSync[] = $disability['id'];
        }

        Person::sync($this)->disabilities(Disability::whereIn('id', $disabilitiesToSync)->get());
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

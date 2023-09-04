<?php

namespace App\Http\Livewire\Traits;

use App\Data\Repositories\Countries;
use App\Data\Repositories\States;
use App\Models\City;
use App\Models\Country;

trait Addressable
{
    //    protected $rules=
    //        [
    //            'countryBr'=>'',
    //            'country_id'=>'',
    //            'city_id'=>'',
    //            'state_id'=>'',
    //        ];

    public $country_id;
    public $state_id;
    public $city_id;
    public $other_city;
    public $countryBr;
    public $countryBrSelected;
    public $cities = [];

    /**
     * @return void
     */
    protected function fillAddress(): void
    {
        $this->loadCountryBr();
        $this->country_id = is_null(old('country_id'))
            ? $this->person->country_id ?? ''
            : old('country_id');
        $this->select2SelectOption('country_id', $this->country_id);

        if (!$this->detectIfCountryBrSelected()) {
            $this->countryBrNotSelected();
        } else {
            $this->state_id = is_null(old('state_id'))
                ? $this->person->state_id ?? ''
                : old('state_id');
            $this->select2SelectOption('state_id', $this->state_id);

            if (!empty($this->state_id)) {
                $this->updatedStateId($this->state_id);
            }

            $this->city_id = is_null(old('city_id'))
                ? $this->person->city_id ?? ''
                : old('city_id');
            $this->select2SelectOption('city_id', $this->city_id);
        }

        $this->other_city = is_null(old('other_city'))
            ? mb_strtoupper($this->person->other_city) ?? ''
            : old('other_city');
    }

    /**
     * @return void
     */
    protected function loadCountryBr(): void
    {
        $this->countryBr = Country::where('name', 'ilike', 'Brasil')->first();
    }

    /**
     * @return bool
     */
    protected function detectIfCountryBrSelected(): bool
    {
        return !!($this->country_id == $this->countryBr->id);
    }

    protected function setAddressReadOnly($value): void
    {
        $this->select2SetReadOnly('country_id', $value);
        $this->select2SetReadOnly('state_id', $value);
        $this->select2SetReadOnly('city_id', $value);
    }

    /**
     * @return void
     */
    protected function countryBrNotSelected(): void
    {
        $this->select2Destroy('city_id');
        $this->select2Disable('city_id');
        $this->select2Destroy('state_id');
        $this->select2Disable('state_id');
    }

    /**
     * @return void
     */
    protected function countryBrSelected(): void
    {
        $this->select2Reload('city_id');
        $this->select2Reload('state_id');
        $this->select2Enable('city_id');
        $this->select2Enable('state_id');
    }

    public function loadCities()
    {
        if ($this->state_id) {
            $this->cities = City::where('state_id', $this->state_id)->get();
        }
    }

    public function updatedCountryId($newValue)
    {
        if ($newValue != $this->countryBr->id) {
            $this->countryBrNotSelected();
        } else {
            $this->countryBrSelected();
        }
    }

    public function updatedStateId($newValue)
    {
        $this->loadCities();

        $this->cities = collect($this->cities);

        $this->select2ReloadOptions(
            $this->cities
                ->map(function ($city) {
                    return [
                        'name' => $city->name,
                        'value' => $city->id,
                    ];
                })
                ->toArray(),
            'city_id'
        );

        if ($this->city_id) {
            $this->select2SelectOption('city_id', $this->city_id);
        }
    }

    public function addressFormVariables()
    {
        return [
            'countries' => app(Countries::class)->allOrderBy('name', 'asc', null),
            'states' => app(States::class)->allOrderBy('name', 'asc', null),
            'country_br' => Country::where('id', '=', config('app.country_br'))->first(),
        ];
    }
}

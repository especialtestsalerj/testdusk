<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Gender;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {
        $faker = $this->faker;

        if (rand(1, 100) < 200) { //TODO: acertar essa probabilidade
            $country = Country::find(config('app.country_br'));
            $state = State::inRandomOrder()->first();
            $city = City::inRandomOrder()->where('state_id', $state->id)->first();
            $isBr = true;
        } else {
            $country = Country::inRandomOrder()->where('id', '<>', config('app.country_br'))->first();
            $city = $faker->name;
            $isBr = false;
        }

        $socialName = (rand(1, 100) < 30 ? $faker->name : null);

        return [
            'full_name' => convert_case($this->faker->name, MB_CASE_UPPER),
            'social_name' => convert_case($this->faker->optional()->name, MB_CASE_UPPER),
            'birthdate' => $this->faker->date,
            'gender_id' => Gender::inRandomOrder()->first()->id,
            'has_disability' => $this->faker->boolean,
            'city_id' => $city->id ?? null,
            'other_city' => $socialName,
            'state_id' => $state->id ?? null,
            'country_id' => $country->id,
            'email' => $this->faker->unique()->safeEmail,
            'created_by_id' => User::inRandomOrder()->first()->id,
            'updated_by_id' => User::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'id_card' => $this->faker->optional()->numerify('##############'),
            'certificate_type' => $this->faker->optional()->word,
            'certificate_number' => $this->faker->optional()->numerify('##########'),
            'certificate_valid_until' => $this->faker->optional()->date,
            'isBr' => $isBr
        ];
    }
}


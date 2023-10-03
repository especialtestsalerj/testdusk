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
        return [
            'full_name' => convert_case($this->faker->name, MB_CASE_UPPER),
            'social_name' => convert_case($this->faker->optional()->name, MB_CASE_UPPER),
            'birthdate' => $this->faker->date,
            'gender_id' => Gender::inRandomOrder()->first()->id,
            'has_disability' => $this->faker->boolean,
            'city_id' => City::inRandomOrder()->first()->id,
            'other_city' => convert_case($this->faker->optional()->city, MB_CASE_UPPER),
            'state_id' => State::inRandomOrder()->first()->id,
            'country_id' => Country::inRandomOrder()->first()->id,
            'email' => $this->faker->unique()->safeEmail,
            'created_by_id' => User::inRandomOrder()->first()->id,
            'updated_by_id' => User::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'id_card' => $this->faker->optional()->numerify('##############'),
            'certificate_type' => $this->faker->optional()->word,
            'certificate_number' => $this->faker->optional()->numerify('##########'),
            'certificate_valid_until' => $this->faker->optional()->date,
        ];
    }
}

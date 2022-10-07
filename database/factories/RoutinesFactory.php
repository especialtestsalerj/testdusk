<?php

namespace Database\Factories;

use App\Models\Routine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoutinesFactory extends Factory
{
     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Routine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = Carbon::now()
            ->toDateTimeString();
        $user_id = User::all()->random(1)->toArray()[0]['id'];
        return [
            'shift_id' => rand(1,2),
            'entranced_at' => $date,
            'entranced_user_id' => $user_id,
            
        ];
    }
}

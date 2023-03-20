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
class RoutineFactory extends Factory
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
        $date = Carbon::now()->toDateTimeString();

        $user_id = User::all()
            ->random(1)
            ->toArray()[0]['id'];

        return [
            'shift_id' => rand(1, 2),
            'entranced_at' => $date,
            'entranced_user_id' => $user_id,
            'entranced_obs' => str_random(15),
            'checkpoint_obs' => str_random(10),
            'exited_at' => faker()
                ->dateTimeBetween('+1 month', '+2 months')
                ->format('Y-m-d H:i:s'),
            'exited_user_id' => $user_id,
            'exited_obs' => str_random(5),
            'status' => false,
            'created_by_id' => $user_id,
            'created_at' => $date,
        ];
    }
}
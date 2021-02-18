<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'serial_or_plate' => $this->faker->unique()->word,
            'brand' => $this->faker->word,
            'model' => $this->faker->numberBetween(1850, Carbon::now()->year),
            'user_id' => User::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Parking;
use App\Models\Place;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Place::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vehicle_id' => null,
            'vehicle_type_id' => $this->faker->numberBetween(1, 3),
            'parking_id' => Parking::factory(),
            'is_free' => false
        ];
    }

    public function isNotFreePlace()
    {
        return $this->state([
            'vehicle_id' => Vehicle::factory(),
            'is_free' => true
        ]);
    }
}

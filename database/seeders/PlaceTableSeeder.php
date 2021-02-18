<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicleTypes = \App\Models\VehicleType::all();

        $vehicleTypes->each(function($vehicleType) {
            \App\Models\Place::factory($vehicleType->amount)->isNotFreePlace(10)->forParking()->create();
        });

    }
}

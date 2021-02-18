<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UsersTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->hasVehicles(3)->create();

        // $faker = Faker\Factory::create();

        // \App\Models\User::factory()->times(10)->state(new Sequence(
        //     ['email' => null],
        //     ['email' => $faker->unique()->safeEmail]
        // ))->create();
    }
}

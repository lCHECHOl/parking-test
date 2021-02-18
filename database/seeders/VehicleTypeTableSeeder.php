<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class VehicleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\VehicleType::factory()->times(3)->state(new Sequence(
            ['type' => 'A', 'amount' => 10],
            ['type' => 'M', 'amount' => 20],
            ['type' => 'B', 'amount' => 10]
        ))->create();
    }
}

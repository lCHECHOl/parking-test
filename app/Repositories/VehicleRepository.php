<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use App\Interfaces\VehiclesInterface;

class VehicleRepository implements VehiclesInterface
{
    public function getAll()
    {
        return Vehicle::all();
    }

    public function store($request, $vehicle)
    {
        $vehicle->serial_or_plate = $request->serial_or_plate;
        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;

        $user = User::firstOrCreate(
            ['document' => $request->document],
            ['name' => $request->name, 'email' => $request->get('email', null), 'password' => $request->get('password', Str::random(8))]
        );

        $vehicle->user()->associate($user);

        if ($vehicle->save()) {
            return [
                'code' => 201,
                'success' => true,
                'vehicle' => $vehicle
            ];
        } else {
            return [
                'code' => 500,
                'success' => false,
                'message' => "Lo sentimos ocurrio un error durante la creacón"
            ];
        }
    }

    public function show($vehicle)
    {
        return $vehicle;
    }

    public function update($request, $vehicle)
    {
        $vehicle->serial_or_plate = $request->serial_or_plate;
        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;

        $user = User::updateOrCreate(
            ['document' => $request->document],
            ['name' => $request->name, 'email' => $request->get('email', null), 'password' => $request->get('password', Str::random(8))]
        );

        $vehicle->user()->associate($user);

        if ($vehicle->save()) {
            return [
                'code' => 200,
                'success' => true,
                'vehicle' => $vehicle
            ];
        } else {
            return [
                'code' => 500,
                'success' => false,
                'message' => "Lo sentimos ocurrio un error durante la edición"
            ];
        }
    }

    public function destroy($vehicle)
    {
        if ($vehicle->delete()) {

            $vehicle->user()->dissociate();

            return [
                'code' => 200,
                'message' => "vehiculo eliminado exitosamente",
            ];
        } else {
            return [
                'code' => 500,
                'message' => "Lo sentimos ocurrio un error durante la eliminación"
            ];
        }
    }
}

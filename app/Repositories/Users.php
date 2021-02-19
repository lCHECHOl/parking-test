<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Vehicle;
use App\Interfaces\UsersInterface;
use Illuminate\Support\Facades\Auth;

class Users implements UsersInterface
{
    public function getAll()
    {
        return User::all();
    }

    public function store($request, $user)
    {
        $user->document = $request->document;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $vehicles = collect($request->vehicles ?? [])->each(function($vehicle) {
            new Vehicle([
                'serial_or_plate' => $vehicle['serial_or_plate'],
                'brand' => $vehicle['brand'],
                'model' => $vehicle['model'],
            ]);
        })->toArray();

        $user->vehicles()->createMany($vehicles);

        if ($user->save()) {
            return [
                'code' => 201,
                'success' => true,
                'user' => $user
            ];
        } else {
            return [
                'code' => 500,
                'success' => false,
                'message' => "Lo sentimos ocurrio un error durante la creacón"
            ];
        }
    }

    public function show($user)
    {
        return $user;
    }

    public function update($request, $user)
    {
        $user->document = $request->document;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        if ($user->save()) {
            return [
                'code' => 200,
                'success' => true,
                'user' => $user
            ];
        } else {
            return [
                'code' => 500,
                'success' => false,
                'message' => "Lo sentimos ocurrio un error durante la edición"
            ];
        }
    }

    public function destroy($user)
    {
        if ($user->id === Auth::id()) {
            return [
                'code' =>  404,
                'message' => "No te puede eliminar a ti mismo"
            ];
        } else {
            if ($user->delete()) {

                $user->vehicles()->delete();

                return [
                    'code' => 200,
                    'message' => "Usuario eliminado exitosamente",
                ];
            } else {
                return [
                    'code' => 500,
                    'message' => "Lo sentimos ocurrio un error durante la eliminación"
                ];
            }
        }
    }
}

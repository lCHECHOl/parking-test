<?php

namespace App\Transformers;

use App\Models\Vehicle;
use League\Fractal\TransformerAbstract;

class VehicleTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Vehicle $vehicle)
    {
        return [
            'SerialOrPlaca' => (string) $vehicle->serial_or_plate,
            'Marca' => (string) $vehicle->brand,
            'Modelo' => (int) $vehicle->model,
            'usuario_id' => (string) $vehicle->user_id,

            'extra' => [
                'self' => route('api.vehicles.show', $vehicle),
                'related' => $vehicle->user,
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'SerialOrPlaca' => 'serial_or_plate',
            'Marca' => 'brand',
            'Modelo' => 'model',
            'usuario_id' => 'user_id',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'serial_or_plate' => 'SerialOrPlaca',
            'brand' => 'Marca',
            'model' => 'Modelo',
            'user_id' => 'usuario_id',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'Documento' => (string) $user->document,
            'NombreCompleto' => (string) $user->name,
            'CorreoElectronico' => (string) $user->email,

            'extra' => [
                'self' => route('api.users.show', $user),
                'related' => $user->vehicles,
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'Documento' => 'document',
            'NombreCompleto' => 'name',
            'CorreoElectronico' => 'email',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'document' => 'Documento',
            'name' => 'NombreCompleto',
            'email' => 'CorreoElectronico',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
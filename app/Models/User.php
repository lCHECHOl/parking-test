<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use App\Transformers\UserTransformer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'document';
    protected $keyType = 'string';
    public $incrementing = false;
    public $transformer = UserTransformer::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document',
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'document' => 'string',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Función que encrypta las contraseñas cuando se guarda un usuario
     *
     * @param string $password
     * @return string
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'user_id', 'document');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $primaryKey = 'serial_or_plate';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'serial_or_plate',
        'brand',
        'model',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];


    public function place()
    {
        return $this->hasOne(Place::class, 'vehicle_id', 'serial_or_plate');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'document');
    }

}

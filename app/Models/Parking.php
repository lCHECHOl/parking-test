<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'time_start',
        'time_end',
        'place_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'time_start' => 'timestamp',
        'time_end' => 'timestamp',
        'place_id' => 'integer',
    ];


    public function places()
    {
        return $this->hasMany(Place::class);
    }

}

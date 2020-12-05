<?php

namespace App\Models;


class Room extends BaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'number',
        'description',
        'cost5',
        'cost6',
        'cost7',
        'cost8',
        'cost9',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

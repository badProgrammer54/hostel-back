<?php

namespace App\Models;


class Room extends BaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'number',
        'description',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

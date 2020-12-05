<?php

namespace App\Models;


class Reservation extends BaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'date_arrival',
        'date_leave',
        'number_guests',
        'phone',
        'name',
        'email',
        'message',
        'status',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

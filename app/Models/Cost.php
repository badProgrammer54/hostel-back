<?php

namespace App\Models;


class Cost extends BaseModel
{
    public $timestamps = false;

    protected $fillable = [
        'date_start',
        'date_end',
        'title',
        'cost',
        'room_id',
    ];

    public function room()
    {
        $this->belongsTo(Room::class);
    }
}

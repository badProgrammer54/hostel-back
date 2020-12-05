<?php


namespace App\Repositories;



use App\Models\Room;

class RoomRepository extends BaseRepository
{
    /** @return string */
    public function getModelClass(): string
    {
        return Room::class;
    }

}
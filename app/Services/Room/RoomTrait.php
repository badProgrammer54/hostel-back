<?php


namespace App\Services\Room;


use App\Repositories\RoomRepository;

trait RoomTrait
{
    /** @var RoomRepository */
    private $roomRepository;


    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function getRoomRepository(): RoomRepository
    {
        return $this->roomRepository;
    }
}
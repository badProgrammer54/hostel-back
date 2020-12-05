<?php


namespace App\Services\Room;

use App\Interfaces\DataCreateRoomInterface;
use App\Interfaces\DataUpdateRoomInterface;
use App\Models\Exceptions\ServiceException;
use App\Models\Room;
use App\Repositories\RoomRepository;
use App\Services\BaseService;

class RoomService extends BaseService
{

    private const FIELDS_UPDATE = [
        'number',
        'description',
        'cost5',
        'cost6',
        'cost7',
        'cost8',
        'cost9',
    ];

    /** @var RoomRepository */
    private $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * @param DataCreateRoomInterface $dataCreateRoom
     * @return Room
     */
    public function createRoom(DataCreateRoomInterface $dataCreateRoom): Room
    {
        /** @var Room $room */
        $room = (new Room())->create([
            'number' => $dataCreateRoom->getNumber(),
            'description' => $dataCreateRoom->getDescription(),
        ]);

        return $room;
    }

    /**
     * @param int $roomId
     * @param DataUpdateRoomInterface $dataUpdateRoom
     * @return Room
     * @throws ServiceException
     */
    public function updateRoom(DataUpdateRoomInterface $dataUpdateRoom, int $roomId): Room
    {
        /** @var Room $room */
        $room= $this->getModalById($this->roomRepository, $roomId);

        $room->update($this->getValidDataToRoom($dataUpdateRoom->getDataToUpdate()));

        return $room;
    }

    private function getValidDataToRoom(array $fieldsUpdate = []): array
    {
        $result = [];
        foreach (self::FIELDS_UPDATE as $field) {
            if (array_key_exists($field, $fieldsUpdate)) {
                if ($fieldsUpdate[$field] !== null && $fieldsUpdate[$field] !== 0) {
                    $result[$field] = $fieldsUpdate[$field];
                }
            }
        }

        return $result;
    }
}
<?php


namespace App\Services\Reservation;

use App\Interfaces\Reservation\DataCreateReservationInterface;
use App\Interfaces\Reservation\DataUpdateReservationInterface;
use App\Models\Exceptions\ServiceException;
use App\Models\Reservation;
use App\Repositories\ReservationRepository;
use App\Services\BaseService;
use Illuminate\Support\Facades\Date;

class ReservationService extends BaseService
{

    private const FIELDS_UPDATE = [
        'date_arrival',
        'date_leave',
        'number_guests',
        'phone',
        'name',
        'email',
        'message',
        'status',
    ];

    /** @var ReservationRepository */
    private $reservationRepository;


    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    /**
     * @param DataCreateReservationInterface $dataCreateReservation
     * @param int $roomId
     * @return Reservation
     */
    public function createReservation(DataCreateReservationInterface $dataCreateReservation, int $roomId): Reservation
    {
        /** @var Reservation $reservation */
        $reservation = (new Reservation())->create([
            'room_id' => $roomId,
            'date_arrival' => $dataCreateReservation->getDateArrival(),
            'date_leave' => $dataCreateReservation->getDateLeave(),
            'number_guests' => $dataCreateReservation->getNumberGuests(),
            'phone' => $dataCreateReservation->getPhone(),
            'name' => $dataCreateReservation->getName(),
            'email' => $dataCreateReservation->getEmail(),
            'message' => $dataCreateReservation->getMessage(),
        ]);
        return $reservation;
    }

    /**
     * @param int $reservationId
     * @param DataUpdateReservationInterface $dataUpdateReservation
     * @return Reservation
     * @throws ServiceException
     */
    public function updateReservation(DataUpdateReservationInterface $dataUpdateReservation, int $reservationId): Reservation
    {
        /** @var Reservation $reservation */
        $reservation= $this->getModalById($this->reservationRepository, $reservationId);

        $reservation->update($this->getValidDataToReservation($dataUpdateReservation->getDataToUpdate()));

        return $reservation;
    }

    private function getValidDataToReservation(array $fieldsUpdate = []): array
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
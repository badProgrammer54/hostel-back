<?php


namespace App\Services\Main;


use App\Models\Exceptions\ServiceException;
use App\Repositories\ReservationRepository;
use App\Repositories\RoomRepository;
use App\Services\BaseService;

class MonthService extends BaseService
{
    /** @var RoomRepository */
    private $roomRepository;

    /** @var ReservationRepository */
    private $reservationRepository;

    public function __construct(
        RoomRepository $roomRepository,
        ReservationRepository $reservationRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function getMonthMatrix()
    {
        $month = [];
        $rooms = $this->roomRepository->getAll();
        $days = (int)date('t');

        foreach ($rooms as $room) {
            $reservations = $this->reservationRepository->getForMonth($room['id'], 5);
            for ($i = 1; $i<= $days; $i++) {
                foreach ($reservations as $reservation)
                {
                    $month[$room['number']][$i]['number_reservations'] = 0;
                    $month[$room['number']][$i]['status'] = 0;
                    $month[$room['number']][$i]['reservations_ids'] = [];
                    $day_start = (int)substr((string)$reservation->date_arrival, -2, 2);
                    $day_end = (int)substr($reservation->date_leave, -2, 2);
                    if ($day_start <= $i && $i <= $day_end) {
                        $month[$room['number']][$i]['number_reservations']++;
                        $month[$room['number']][$i]['status'] = $reservation->status;
                        array_push($month[$room['number']][$i]['reservations_ids'], $reservation->id);
                    }
                }
            }
        }

        return $month;
    }
}
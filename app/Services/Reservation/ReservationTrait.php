<?php


namespace App\Services\Reservation;


use App\Repositories\ReservationRepository;

trait ReservationTrait
{
    /** @var ReservationRepository */
    private $reservationRepository;


    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function getReservationRepository(): ReservationRepository
    {
        return $this->reservationRepository;
    }
}
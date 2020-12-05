<?php


namespace App\Repositories;


use App\Models\Reservation;

class ReservationRepository extends BaseRepository
{
    /** @return string */
    public function getModelClass(): string
    {
        return Reservation::class;
    }
}
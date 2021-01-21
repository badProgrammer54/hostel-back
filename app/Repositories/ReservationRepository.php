<?php


namespace App\Repositories;


use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ReservationRepository extends BaseRepository
{
    /** @return string */
    public function getModelClass(): string
    {
        return Reservation::class;
    }

    public function getForMonth(int $roomId, $currentMonth = 0): array
    {
        if ($currentMonth === 0 ) {
            $currentMonth = (int)date('m');
        }
        if ($currentMonth < 10) {
            $currentMonth = '0'.$currentMonth;
        }
        $firstDay = date('2021-'.$currentMonth.'-01');
        $lastDay =  date('t',strtotime($firstDay));
        $lastDay = date('2021-'.$currentMonth.'-'.$lastDay);

        $reservations = DB::table('reservations')
            ->select(['id','date_arrival', 'date_leave', 'status'])
            ->whereBetween('date_arrival', [$firstDay, $lastDay])
            ->whereBetween('date_leave', [$firstDay, $lastDay])
            ->where('room_id', '=', $roomId)
            ->orderBy('status')->get()->toArray();

        return $reservations;

    }
}
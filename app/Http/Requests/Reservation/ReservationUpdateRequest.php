<?php

namespace App\Http\Requests\Reservation;

use App\Http\Requests\BaseRequest;
use App\Interfaces\Reservation\DataUpdateReservationInterface;

class ReservationUpdateRequest extends BaseRequest implements DataUpdateReservationInterface
{
    public function rules(): array
    {
        return [
            'date_arrival' => ['date', 'nullable'],
            'date_leave' => ['date', 'nullable'],
            'number_guests' => ['integer', 'nullable'],
            'phone' => ['string', 'nullable'],
            'name' => ['string', 'max:50', 'nullable'],
            'email' => ['string', 'nullable'],
            'message' => ['string', 'nullable'],
            'status' => ['integer', 'nullable'],
        ];
    }

    public function getDataToUpdate(): array
    {
        return $this->all() ?: [];
    }
}

<?php

namespace App\Http\Requests\Reservation;

use App\Http\Requests\BaseRequest;
use App\Interfaces\Reservation\DataCreateReservationInterface;

class ReservationCreateRequest extends BaseRequest implements DataCreateReservationInterface
{
    public function rules(): array
    {
        return [
            'date_arrival' => ['date', 'required'],
            'date_leave' => ['date', 'nullable'],
            'number_guests' => ['integer', 'nullable'],
            'phone' => ['string', 'nullable'],
            'name' => ['string', 'max:50', 'nullable'],
            'email' => ['string', 'nullable'],
            'message' => ['string', 'nullable'],
        ];
    }

    /**
     * @return mixed
     */
    public function getDateArrival()
    {
        return $this->get('date_arrival');
    }

    /**
     * @return mixed
     */
    public function getDateLeave()
    {
        return $this->get('date_leave');
    }

    /**
     * @return int|null
     */
    public function getNumberGuests(): ?int
    {
        return $this->get('number_guests');
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->get('phone');
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->get('name');
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->get('email');
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->get('message');
    }
}

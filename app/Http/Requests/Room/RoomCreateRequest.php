<?php

namespace App\Http\Requests\Room;

use App\Http\Requests\BaseRequest;
use App\Interfaces\DataCreateRoomInterface;

class RoomCreateRequest extends BaseRequest implements DataCreateRoomInterface
{
    public function rules(): array
    {
        return [
            'number' => ['integer', 'max:255', 'required', 'unique:rooms'],
            'description' => ['string', 'max:255', 'required'],
        ];
    }

    public function getNumber(): int
    {
        return $this->get('number');
    }

    public function getDescription(): string
    {
        return $this->get('description');
    }

}

<?php

namespace App\Http\Requests\Room;

use App\Http\Requests\BaseRequest;
use App\Interfaces\DataUpdateRoomInterface;

class RoomUpdateRequest extends BaseRequest implements DataUpdateRoomInterface
{
    public function rules(): array
    {
        return [
            'number' => ['integer', 'nullable', 'unique:rooms'],
            'description' => ['string', 'max:255', 'nullable'],
            'cost5' => ['integer', 'nullable'],
            'cost6' => ['integer', 'nullable'],
            'cost7' => ['integer', 'nullable'],
            'cost8' => ['integer', 'nullable'],
            'cost9' => ['integer', 'nullable'],
        ];
    }

    public function getDataToUpdate(): array
    {
        return $this->all() ?: [];
    }
}

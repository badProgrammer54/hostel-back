<?php

namespace App\Http\Requests\Cost;

use App\Http\Requests\BaseRequest;
use App\Interfaces\Cost\DataUpdateCostInterface;

class CostUpdateRequest extends BaseRequest implements DataUpdateCostInterface
{
    public function rules(): array
    {
        return [
            'date_start' => ['date', 'nullable'],
            'date_leave' => ['date', 'nullable'],
            'title' => ['string', 'nullable'],
            'cost' => ['integer', 'nullable'],
        ];
    }

    public function getDataToUpdate(): array
    {
        return $this->all() ?: [];
    }
}

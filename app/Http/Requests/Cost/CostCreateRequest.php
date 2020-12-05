<?php

namespace App\Http\Requests\Cost;

use App\Http\Requests\BaseRequest;
use App\Interfaces\Cost\DataCreateCostInterface;

class CostCreateRequest extends BaseRequest implements DataCreateCostInterface
{
    public function rules(): array
    {
        return [
            'date_start' => ['date', 'max:10', 'required'],
            'date_end' => ['date', 'max:10', 'required'],
            'title' => ['string', 'max:255', 'required'],
            'cost' => ['integer', 'required'],
        ];
    }


    public function getDateStart()
    {
        return $this->get('date_start');
    }

    public function getDateEnd()
    {
        return $this->get('date_end');
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->get('title');
    }

    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->get('cost');
    }
}

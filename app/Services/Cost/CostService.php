<?php


namespace App\Services\Cost;

use App\Interfaces\Cost\DataCreateCostInterface;
use App\Interfaces\Cost\DataUpdateCostInterface;
use App\Models\Cost;
use App\Models\Exceptions\ServiceException;use App\Models\Reservation;
use App\Repositories\CostRepository;
use App\Services\BaseService;

class CostService extends BaseService
{

    private const FIELDS_UPDATE = [
        'date_start',
        'date_end',
        'title',
        'cost',
        'room_id',
    ];

    /** @var CostRepository */
    private $costRepository;


    public function __construct(CostRepository $costRepository)
    {
        $this->costRepository = $costRepository;
    }

    /**
     * @param DataCreateCostInterface $dataCreateCost
     * @param int $roomId
     * @return Cost
     */
    public function createCost(DataCreateCostInterface $dataCreateCost, int $roomId): Cost
    {
        /** @var Cost $cost */
        $cost = (new Cost())->create([
            'room_id' => $roomId,
            'date_start' => $dataCreateCost->getDateStart(),
            'date_end' => $dataCreateCost->getDateEnd(),
            'title' => $dataCreateCost->getTitle(),
            'cost' => $dataCreateCost->getCost(),
        ]);
        return $cost;
    }

    /**
     * @param int $costId
     * @param DataUpdateCostInterface $dataUpdateCost
     * @return Cost
     * @throws ServiceException
     */
    public function updateCost(DataUpdateCostInterface $dataUpdateCost, int $costId): Cost
    {
        /** @var Cost $cost */
        $cost= $this->getModalById($this->costRepository, $costId);

        $cost->update($this->getValidDataToCost($dataUpdateCost->getDataToUpdate()));

        return $cost;
    }

    private function getValidDataToCost(array $fieldsUpdate = []): array
    {
        $result = [];
        foreach (self::FIELDS_UPDATE as $field) {
            if (array_key_exists($field, $fieldsUpdate)) {
                if ($fieldsUpdate[$field] !== null && $fieldsUpdate[$field] !== 0) {
                    $result[$field] = $fieldsUpdate[$field];
                }
            }
        }

        return $result;
    }
}
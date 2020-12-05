<?php

namespace App\Http\Controllers\Api;

use App\Models\Exceptions\BaseException;
use App\Services\Main\MonthService;
use Illuminate\Http\JsonResponse;
use Exception;

class MonthController extends ApiController
{

    /** @var MonthService */
    private $monthService;

    public function __construct(MonthService $monthService)
    {
        $this->monthService = $monthService;
    }


    public function index(): JsonResponse
    {
        try {
            $month = $this->monthService->getMonthMatrix();
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['month' => $month]);
    }
}

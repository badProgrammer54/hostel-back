<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Cost\CostCreateRequest;
use App\Http\Requests\Cost\CostUpdateRequest;
use App\Models\Cost;
use App\Repositories\CostRepository;
use App\Services\Cost\CostService;
use App\Models\Exceptions\BaseException;
use Illuminate\Http\JsonResponse;
use Exception;

class CostController extends ApiController
{
    /** @var CostService  */
    private $costService;

    /** @var CostRepository */
    private $costRepository;


    public function __construct(CostService $costService, CostRepository $costRepository)
    {
        $this->costService = $costService;
        $this->costRepository = $costRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $costs = Cost::all();
        return $this->sendResponse(['costs' => $costs]);
    }

    /**
     * @param CostCreateRequest $request
     * @param int $roomId
     * @return JsonResponse
     */
    public function create(CostCreateRequest $request, int $roomId): JsonResponse
    {
        try {
            $cost = $this->costService->createCost($request, $roomId);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['cost' => $cost]);
    }

    /**
     * @param int $costId
     * @return JsonResponse
     */
    public function getRoom(int $costId): JsonResponse
    {
        try {
            $room = $this->costService->getModalById($this->costRepository, $costId)->room;
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['room' => $room]);
    }

    /**
     * @param int $costId
     * @return JsonResponse
     */
    public function view(int $costId): JsonResponse
    {
        try {
            $cost = $this->costRepository->getById($costId);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['cost' => $cost]);
    }

    /**
     * @param CostUpdateRequest $request
     * @param int $costId
     * @return JsonResponse
     */
    public function update(CostUpdateRequest $request, int $costId): JsonResponse
    {
        try {
            $cost = $cost = $this->costRepository->getById($costId);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['cost' => $cost]);
    }

    /**
     * @param int $costId
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $costId): JsonResponse
    {
        try {
            $cost = $cost = $this->costRepository->getById($costId)->delete();
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), 404);
        }

        return $this->sendResponse(['cost' => $cost]);
    }
}

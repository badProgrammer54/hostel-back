<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Room\RoomCreateRequest;
use App\Http\Requests\Room\RoomUpdateRequest;
use App\Models\Exceptions\BaseException;
use App\Models\Room;
use App\Repositories\RoomRepository;
use Illuminate\Http\JsonResponse;
use App\Services\Room\RoomService;
use Exception;

class RoomController extends ApiController
{
    /** @var RoomService  */
    private $roomService;


    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $rooms = Room::all();
        return $this->sendResponse(['rooms' => $rooms]);
    }

    /**
     * @param RoomCreateRequest $request
     * @return JsonResponse
     */
    public function create(RoomCreateRequest $request): JsonResponse
    {
        try {
            $room = $this->roomService->createRoom($request);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['room' => $room]);
    }

    /**
     * @param int $roomId
     * @return JsonResponse
     */
    public function view(int $roomId): JsonResponse
    {
        try {
            $room = $this->roomService->getModalById($this->roomService->getRoomRepository(), $roomId);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['room' => $room]);
    }

    /**
     * @param RoomUpdateRequest $request
     * @param int $roomId
     * @return JsonResponse
     */
    public function update(RoomUpdateRequest $request, int $roomId): JsonResponse
    {
        try {
            $room = $this->roomService->updateRoom($request, $roomId);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['room' => $room]);
    }

    /**
     * @param int $roomId
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $roomId): JsonResponse
    {
        try {
            $room = $this->roomService->getModalById($this->roomService->getRoomRepository(), $roomId)->delete();
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), 404);
        }

        return $this->sendResponse(['room' => $room]);
    }
}

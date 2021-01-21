<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Reservation\ReservationCreateRequest;
use App\Http\Requests\Reservation\ReservationUpdateRequest;
use App\Models\Reservation;
use App\Models\Exceptions\BaseException;
use App\Repositories\ReservationRepository;
use Illuminate\Http\JsonResponse;
use App\Services\Reservation\ReservationService;
use Exception;

class ReservationController extends ApiController
{
    /** @var ReservationService  */
    private $reservationService;

    /** @var ReservationRepository */
    private $reservationRepository;


    public function __construct(ReservationService $reservationService, ReservationRepository $reservationRepository)
    {
        $this->reservationService = $reservationService;
        $this->reservationRepository = $reservationRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $reservations = Reservation::all();
        return $this->sendResponse(['reservations' => $reservations]);
    }

    /**
     * @param ReservationCreateRequest $request
     * @param int $roomId
     * @return JsonResponse
     */
    public function create(ReservationCreateRequest $request, int $roomId): JsonResponse
    {
        try {
            $reservation = $this->reservationService->createReservation($request, $roomId);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['reservation' => $reservation]);
    }

    /**
     * @param int $reservationId
     * @return JsonResponse
     */
    public function getRoom(int $reservationId): JsonResponse
    {
        try {
            $room = $this->reservationRepository->getById($reservationId)->room;
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['room' => $room]);
    }

    /**
     * @param int $reservationId
     * @return JsonResponse
     */
    public function view(int $reservationId): JsonResponse
    {
        try {
            $reservation = $this->reservationRepository->getById($reservationId);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['reservation' => $reservation]);
    }

    /**
     * @param ReservationUpdateRequest $request
     * @param int $reservationId
     * @return JsonResponse
     */
    public function update(ReservationUpdateRequest $request, int $reservationId): JsonResponse
    {
        try {
            $reservation = $this->reservationService->updateReservation($request, $reservationId);
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['reservation' => $reservation]);
    }

    /**
     * @param int $reservationId
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(int $reservationId): JsonResponse
    {
        try {
            $reservation = $this->reservationRepository->getById($reservationId)->delete();
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), 404);
        }

        return $this->sendResponse(['reservation' => $reservation]);
    }
}

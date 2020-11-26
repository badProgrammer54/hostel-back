<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Room\RoomCreateRequest;
use App\Models\Exceptions\BaseException;
use App\Models\Room;
use Illuminate\Http\JsonResponse;
use App\Services\Room\RoomService;
use Exception;

class RoomController extends ApiController
{

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

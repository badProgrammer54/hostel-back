<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\UserAuthorizationRequest;
use App\Http\Requests\User\UserRegistrationRequest;
use App\Models\Exceptions\BaseException;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class AuthController extends ApiController
{
    /** @var UserService */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function signIn(UserAuthorizationRequest $request): JsonResponse
    {
        try {
            $accessToken = $this->userService->generateAuthTokenToUser($request->getEmail(), $request->getPassword());
        } catch (BaseException $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }

        return $this->sendResponse(['access_token' => $accessToken]);
    }

    public function signUp(UserRegistrationRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->getName(), $request->getEmail(), $request->getPassword());

        return $this->sendResponse(['user' => $user]);
    }
}

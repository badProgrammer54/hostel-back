<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\UserAuthorizationRequest;
use App\Http\Requests\User\UserRegistrationRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function signIn(UserAuthorizationRequest $request): JsonResponse
    {
        try {
            $user = User::where('email', $request->getEmail())->first();
            if ($user === null) {
                return $this->sendError(1, 'Unauthenticated', 401);
            }
            if (!Hash::check($request->getPassword(), $user->password, [])) {
                return $this->sendError(1, 'Unauthenticated', 401);
            }

            $user->tokens()->where('name', 'authToken')->delete();
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return $this->sendResponse(['access_token' => $tokenResult]);
        } catch (Exception $e) {
            return $this->sendError(1, $e->getMessage(), $e->getCode());
        }
    }

    public function signUp(UserRegistrationRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'password' => Hash::make($request->getPassword()),
        ]);

        $user->save();

        return $this->sendResponse(['user' => $user]);

    }
}

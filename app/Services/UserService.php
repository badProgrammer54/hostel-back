<?php


namespace App\Services;


use App\Models\Exceptions\ServiceException;
use App\Models\User;
use RuntimeException;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(string $name, string $email, string $password): User
    {
        /** @var User $user */
        $user = (new User())->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return $user;
    }


    /**
     * @param string $email
     * @param string $password
     * @return string
     * @throws ServiceException
     */
    public function generateAuthTokenToUser(string $email, string $password): string
    {
        $user = User::where('email', $email)->first();
        if (!($user instanceof User)) {
            throw new ServiceException('Unauthenticated', 401);
        }

        if (!Hash::check($password, $user->password, [])) {
            throw new ServiceException('Unauthenticated', 401);
        }

        return $this->refreshBearerToken($user);
    }

    private function refreshBearerToken(User $user): string
    {
        $user->tokens()->where('name', 'authToken')->delete();
        return $user->createToken('authToken')->plainTextToken;
    }
}
<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UserAuthorizationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => ['string', 'max:20', 'required'],
            'password' => ['string', 'max:20', 'required'],
        ];
    }

    public function getEmail(): string
    {
        return $this->get('email');
    }

    public function getPassword(): string
    {
        return $this->get('password');
    }
}

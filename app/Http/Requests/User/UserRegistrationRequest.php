<?php


namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UserRegistrationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'password' => ['string', 'max:20', 'required'],
            'confirm_password' => ['string', 'max:20', 'required', 'same:password'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->get('password');
    }

    public function getEmail(): string
    {
        return $this->get('email');
    }

    public function getName(): string
    {
        return $this->get('name');
    }
}
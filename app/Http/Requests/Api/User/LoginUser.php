<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\AbstractRequest;

class LoginUser extends AbstractRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            'password' => ['string'],
        ];

    }
}

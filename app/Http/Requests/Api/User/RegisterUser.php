<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\AbstractRequest;

class RegisterUser extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'password' => ['string', 'required', 'min:6', 'max:100', 'confirmed'],
            'email' => ['string', 'required', 'email', 'unique:users'],
            'name' => ['string', 'required', 'min:2', 'max:55']
        ];
    }
}

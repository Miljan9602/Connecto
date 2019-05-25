<?php

namespace App\Http\Requests\Api\User;

use App\Http\Requests\Api\AbstractRequest;

class UpdateUser extends AbstractRequest
{
    public function rules(): array
    {
        return [
            'email' => ['string', 'email'],
            'name' => ['string', 'min:3', 'max:55'],
        ];
    }
}

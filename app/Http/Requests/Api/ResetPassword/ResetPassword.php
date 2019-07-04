<?php

namespace App\Http\Requests\Api\ResetPassword;

use App\Http\Requests\Api\AbstractRequest;

class ResetPassword extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'email' => ['required', 'string', 'email', 'exists:password_resets', 'exists:users'],
            'password' => ['required', 'string', 'confirmed'],
            'token' => ['required', 'string', 'exists:password_resets']
        ];
    }
}

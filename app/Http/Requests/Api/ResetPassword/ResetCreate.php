<?php

namespace App\Http\Requests\Api\ResetPassword;

use App\Http\Requests\Api\AbstractRequest;

class ResetCreate extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'email' => ['required', 'string', 'email', 'exists:users'],
        ];
    }
}

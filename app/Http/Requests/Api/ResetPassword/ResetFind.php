<?php

namespace App\Http\Requests\Api\ResetPassword;

use App\Http\Requests\Api\AbstractRequest;
use App\Rules\IsExpiredResetToken;

class ResetFind extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'token' => ['bail', 'string', 'exists:password_resets', new IsExpiredResetToken($this)]
        ];
    }

    public function all($keys = null)
    {
        return array_replace_recursive(
            parent::all(),
            $this->route()->parameters()
        );
    }
}

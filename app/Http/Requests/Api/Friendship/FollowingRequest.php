<?php

namespace App\Http\Requests\Api\Friendship;

use App\Http\Requests\Api\AbstractRequest;

class FollowingRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'from_id' => ['integer']
        ];
    }
}

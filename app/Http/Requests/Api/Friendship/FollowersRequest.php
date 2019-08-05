<?php

namespace App\Http\Requests\Api\Friendship;

use App\Http\Requests\Api\AbstractRequest;

class FollowersRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'last_id' => ['integer']
        ];
    }
}

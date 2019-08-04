<?php

namespace App\Http\Requests\Api\Friendship;

use App\Http\Requests\Api\AbstractRequest;
use App\Rules\IsValidFriendshipUser;

class CreateNewFriendship extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'user' => ['bail', 'required', new IsValidFriendshipUser()]
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

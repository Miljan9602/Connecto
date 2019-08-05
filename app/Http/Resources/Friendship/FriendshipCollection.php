<?php

namespace App\Http\Resources\Friendship;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

class FriendshipCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $users = FriendshipResource::collection($this->collection['users']);

        return [
            'users' => $users,
            'meta' => [
                'users_count' => $users->count(),
                'last_id' => Arr::get($this->collection, 'last_id', null)
            ]
        ];
    }
}

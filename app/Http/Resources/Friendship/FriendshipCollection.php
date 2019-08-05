<?php

namespace App\Http\Resources\Friendship;

use Illuminate\Http\Resources\Json\ResourceCollection;

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
        return [
            'users' => FriendshipResource::collection($this->collection),
            'meta' => [
                'users_count' => $this->collection->count()
            ]
        ];
    }
}

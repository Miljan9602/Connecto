<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * UserCollection constructor.
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
    }


    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'users' => UserResource::collection($this->collection),
            'meta' => [
                'users_count' => $this->collection->count()
            ]
        ];
    }
}

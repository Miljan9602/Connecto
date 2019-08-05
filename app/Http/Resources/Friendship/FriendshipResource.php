<?php

namespace App\Http\Resources\Friendship;

use Illuminate\Http\Resources\Json\JsonResource;

class FriendshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $this->follower;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'profile_pic_url' => $user->profile_pic_url
        ];
    }
}

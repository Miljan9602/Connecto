<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{

    protected $withAccessToken = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        // Default data which we will return.
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'profile_pic_url' => $this->profile_pic_url,
        ];

        if ($this->withAccessToken) {
            $data['token'] = $this->token;
        }

        return $data;
    }

    public function withAccessToken(){
        $this->withAccessToken = true;
        return $this;
    }
}

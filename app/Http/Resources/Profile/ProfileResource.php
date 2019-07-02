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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            $this->mergeWhen($this->withAccessToken, [
                'token' => $this->token
            ])
        ];
    }

    public function withAccessToken(){
        $this->withAccessToken = true;
        return $this;
    }
}

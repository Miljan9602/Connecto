<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{

    protected $withAccessToken;

    /**
     * UserResource constructor.
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->withAccessToken = false;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            $this->mergeWhen(Auth::user()->id === $this->id, [
                'email_verified_at' => Auth::user()->email_verified_at
            ])
        ];

        if ($this->withAccessToken) {
            $data['token'] = $this->token;
        }

        return $data;
    }

    public function withAccessToken() {
        $this->withAccessToken = true;
        return $this;
    }
}

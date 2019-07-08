<?php

namespace App\Repositories\Avatar;

use App\User;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;

class UserFileAvatarRepository implements IUserAvatarRepository
{
    public function createAvatar(User $user): ?string
    {
        $avatar = Avatar::create('rakita miljan')->toBase64();

        $hash = md5(strtolower(trim($user->email)));

        Storage::put('public/avatars/'.$hash.".png", base64_decode(explode("base64,", $avatar)[1]), 'public');

        return Storage::url('avatars/'.$hash.".png");
    }

    public function getAvatarPath(User $user): ?string
    {
        $hash = md5(strtolower(trim($user->email)));

        return Storage::url('avatars/'.$hash.".png");
    }
}
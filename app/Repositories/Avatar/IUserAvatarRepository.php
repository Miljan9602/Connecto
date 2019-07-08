<?php


namespace App\Repositories\Avatar;


use App\User;

interface IUserAvatarRepository
{
    /**
     * Create new avatar for user.
     * @param User $user for which we need to create new avatar.
     * @return string|null return string if we created url for retrieving user avatar. Null if we could not create it.
     */
    public function createAvatar(User $user) : ?string;

    /**
     * Returns avatar path from user.
     * @param User $user for which we want to get avatar
     * @return string|null avatar url, nullable if url does not exists.
     */
    public function getAvatarPath(User $user) : ?string;
}
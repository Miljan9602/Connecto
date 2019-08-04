<?php


namespace App\Repositories\Friendship;

use App\User;

interface IFriendshipRetrieveRepository
{

    /**
     * Return list of followers for passed user.
     * @param User $user
     * @param $nextId integer id which will be used for pagination.
     * @return mixed
     */
    public function getFollowers(User $user, $nextId);

    /**
     * Return list of followings for passed user.
     * @param User $user
     * @param $nextId integer id which will be used for pagination.
     * @return mixed
     */
    public function getFollowing(User $user, $nextId);
}
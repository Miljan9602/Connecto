<?php


namespace App\Repositories\Friendship;

use App\User;

interface IFriendshipRetrieveRepository
{

    /**
     * Return list of followers for passed user.
     *
     * @param User $user
     * @param $query
     * @return mixed
     */
    public function getFollowers(User $user, $query);

    /**
     * Return list of followings for passed user.
     *
     * @param User $user
     * @param $query
     * @return mixed
     */
    public function getFollowing(User $user, $query);
}
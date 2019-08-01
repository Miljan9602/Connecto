<?php


namespace App\Repositories\Friendship;


use App\Model\Friendship;
use App\User;

interface IFriendshipRepository
{
    /**
     * Create new friendship.
     *
     * @param User $user who request to create new friendship
     * @param User $follower person
     * @return Friendship
     */
    public function create(User $user, User $follower) : Friendship;

    /**
     * @param Friendship $friendship
     * @return mixed
     */
    public function destroy(Friendship $friendship);
}
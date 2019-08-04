<?php


namespace App\Repositories\Friendship;


use App\Model\Friendship;
use App\User;

/**
 * Interface IFriendshipStorageRepository for storage friendship actions such as create/destroy/update.
 * @package App\Repositories\Friendship
 */
interface IFriendshipStorageRepository
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
     * @param User $user logged user who want to perform unfollow action.
     * @param User $userToUnfollow user which has to be unfollowed
     * @return mixed
     */
    public function destroy(User $user, User $userToUnfollow);
}
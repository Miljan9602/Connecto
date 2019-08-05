<?php


namespace App\Repositories\Friendship;


use App\Model\Friendship;
use App\User;

class FriendshipRepository implements IFriendshipStorageRepository, IFriendshipRetrieveRepository
{
    public function create(User $user, User $follower): Friendship
    {
        $friendship = Friendship::create([
            'user_id' => $user->id,
            'follower_id' => $follower->id
        ]);

        return $friendship;
    }

    public function destroy(User $user, User $userToUnfollow)
    {
        $friendship = $user->getFriendship($userToUnfollow);

        $friendship->delete();
    }

    public function getFollowers(User $user, $nextId)
    {
        $followers = $user->getFollowers($nextId);

        return $followers;
    }

    public function getFollowing(User $user, $nextId)
    {
        $following = $user->getFollowing($nextId);

        return $following;
    }


}
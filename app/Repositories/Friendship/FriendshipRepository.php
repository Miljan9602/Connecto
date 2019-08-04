<?php


namespace App\Repositories\Friendship;


use App\Model\Friendship;
use App\User;

class FriendshipRepository implements IFriendshipRepository
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

}
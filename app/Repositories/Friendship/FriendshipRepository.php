<?php


namespace App\Repositories\Friendship;


use App\Model\Friendship;
use App\User;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\Types\Integer;

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

    public function getFollowers(User $user, $query)
    {
        $fromId = Arr::get($query, 'last_id', null);
        $size = Arr::get($query, 'size', 10);

        $followersResult = Friendship::where('follower_id', $user->id)->where(function ($query) use ($fromId) {

            if ($fromId) {
                $query->where('id', '>', $fromId);
            }

            return $query;
        })->orderBy('id')->with('user')->take($size)->get();

        // Create collection from results.
        $followers = collect([]);

        foreach ($followersResult as $result) {
            $followers->push($result->user);
        }

        return collect([
            'users' => $followers,
            'last_id' => $this->getLastFriendshipId($followersResult, $size)
        ]);
    }

    public function getFollowing(User $user, $query)
    {
        $fromId = Arr::get($query, 'last_id', null);
        $size = Arr::get($query, 'size', 10);

        $followingResult = Friendship::where('user_id', $user->id)->where(function ($query) use ($fromId) {

            if ($fromId) {
                $query->where('id', '>', $fromId);
            }

            return $query;
        })->orderBy('id')->with('follower')->take($size)->get();

        // Create collection from results.
        $following = collect([]);

        foreach ($followingResult as $result) {
            $following->push($result->follower);
        }

        return collect([
            'users' => $following,
            'last_id' => $this->getLastFriendshipId($followingResult, $size)
        ]);
    }

    /**
     * Returns last id from friendship collection. Null if there are no more results.
     *
     * @param $collection Friendship collection
     * @param $size integer numbers of results we tried to get.
     * @return int|null int if we got last id, null if there is no more results.
     */
    protected function getLastFriendshipId($collection, $size) {

        // If we could not retrieve wanted size, it means we got no more friendship.
        if ($size > $collection->count()) {
            return null;
        }

        // If we got last model, it means we might have more friendships. So we return our last id.
        if ($lastModel = $collection->last()) {
            return $lastModel->id;
        }

        return null;
    }
}
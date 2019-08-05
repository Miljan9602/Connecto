<?php

namespace App;

use App\Model\Friendship;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Checks if this user follow the passed user.
     *
     * @param User $user
     * @return bool true if this user follow passed user, false if not.
     */
    public function isFollowingUser(User $user) {

        $friendship = Friendship::where('user_id', $this->id)->where('follower_id', $user->id)->first();

        return $friendship !== null;
    }

    /**
     * Returns friendship instance if current user follow $user passed as parameter.
     * @param User $user to search if current user follow.
     * @return Friendship|null
     */
    public function getFriendship(User $user) : ?Friendship {
        return Friendship::where('user_id', $this->id)->where('follower_id', $user->id)->first();
    }

    /**
     * @param null $fromId
     * @return mixed
     */
    public function getFollowers($fromId = null) {

        $followersResult = Friendship::where('follower_id', $this->id)->with('user')->get();

        $followers = collect([]);

        foreach ($followersResult as $result) {
            $followers->push($result->user);
        }

        return $followers;
    }

    /**
     * @param null $fromId
     * @return mixed
     */
    public function getFollowing($fromId = null) {

        $followingResult = Friendship::where('user_id', $this->id)->with('follower')->get();

        $following = collect([]);

        foreach ($followingResult as $result) {
            $following->push($result->follower);
        }

        return $following;
    }
}

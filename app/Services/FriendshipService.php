<?php


namespace App\Services;

use App\Repositories\Friendship\IFriendshipRetrieveRepository;
use App\Repositories\Friendship\IFriendshipStorageRepository;
use App\User;

class FriendshipService
{
    /**
     * @var IFriendshipRetrieveRepository
     */
    private $friendshipRetrieveRepository;

    /**
     * @var IFriendshipStorageRepository
     */
    private $friendshipStorageRepository;

    /**
     * FriendshipService constructor.
     * @param IFriendshipRetrieveRepository $friendshipRetrieveRepository
     * @param IFriendshipStorageRepository $friendshipStorageRepository
     */
    public function __construct(IFriendshipRetrieveRepository $friendshipRetrieveRepository, IFriendshipStorageRepository $friendshipStorageRepository)
    {
        $this->friendshipRetrieveRepository = $friendshipRetrieveRepository;
        $this->friendshipStorageRepository = $friendshipStorageRepository;
    }

    /**
     * Create new friendship and return it. Event is created from eloquent model when friendship is created.
     * @param User $user
     * @param User $userToFollow
     * @return \App\Model\Friendship
     */
    public function create(User $user, User $userToFollow) {

        return $this->friendshipStorageRepository->create($user, $userToFollow);;
    }

    /**
     * Destroyed friendship between two users.
     * @param User $user
     * @param User $userToUnfollow
     * @return mixed
     */
    public function destroy(User $user, User $userToUnfollow) {
        return $this->friendshipStorageRepository->destroy($user, $userToUnfollow);
    }

    /**
     * Returns list of followers.
     * @param User $user
     * @param array $query
     * @return mixed
     */
    public function getFollowers(User $user, $query = []) {
        return $this->friendshipRetrieveRepository->getFollowers($user, $query);
    }

    /**
     * Returns list of following users.
     * @param User $user
     * @param array $query
     * @return mixed
     */
    public function getFollowing(User $user, $query = []) {
        return $this->friendshipRetrieveRepository->getFollowers($user, $query);
    }
}
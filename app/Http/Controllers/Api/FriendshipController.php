<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Friendship\CreateNewFriendship;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Friendship\DestroyFriendship;
use App\Http\Requests\Api\Friendship\FollowersRequest;
use App\Http\Requests\Api\Friendship\FollowingRequest;
use App\Http\Resources\Friendship\FriendshipCollection;
use App\Repositories\Friendship\IFriendshipRetrieveRepository;
use App\Repositories\Friendship\IFriendshipStorageRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{

    /**
     * @var IFriendshipStorageRepository
     */
    protected $friendshipStorageRepository;

    /**
     * @var IFriendshipRetrieveRepository
     */
    protected $friendshipRetrieveRepository;

    /**
     * FriendshipController constructor.
     * @param IFriendshipStorageRepository $friendshipStorageRepository
     * @param IFriendshipRetrieveRepository $friendshipRetrieveRepository
     */
    public function __construct(
        IFriendshipStorageRepository $friendshipStorageRepository,
        IFriendshipRetrieveRepository $friendshipRetrieveRepository)
    {
        $this->friendshipStorageRepository = $friendshipStorageRepository;
        $this->friendshipRetrieveRepository = $friendshipRetrieveRepository;
    }

    /**
     * @param CreateNewFriendship $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateNewFriendship $request)
    {
        $loggedUser = User::find(Auth::user()->id);

        // Model which is bind to the route.
        $toFollowUser = $request->user;

        $this->friendshipStorageRepository->create($loggedUser, $toFollowUser);

        return response()->json([], 201);
    }

    /**
     * @param DestroyFriendship $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyFriendship $request)
    {
        $loggedUser = User::find(Auth::user()->id);

        // Model which is bind to the route.
        $toFollowUser = $request->user;

        $this->friendshipStorageRepository->destroy($loggedUser, $toFollowUser);

        return response()->json([], 204);
    }

    /**
     * @param FollowersRequest $request
     * @param User $user
     * @return mixed
     */
    public function followers(FollowersRequest $request, User $user) {

        $friendships = $this->friendshipRetrieveRepository->getFollowers($user, $request->validated());

        $collection = (new FriendshipCollection($friendships));

        return response()->json(array_merge($collection->toArray($request), ['status' => 'ok']));
    }

    /**
     * @param FollowingRequest $request
     * @param User $user
     * @return mixed
     */
    public function following(FollowingRequest $request, User $user) {

        $friendships = $this->friendshipRetrieveRepository->getFollowing($user, $request->validated());

        $collection = (new FriendshipCollection($friendships));

        return response()->json(array_merge($collection->toArray($request), ['status' => 'ok']));
    }
}

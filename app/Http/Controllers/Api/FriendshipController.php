<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Friendship\CreateNewFriendship;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Friendship\DestroyFriendship;
use App\Repositories\Friendship\IFriendshipRepository;
use App\User;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{

    /**
     * @var IFriendshipRepository
     */
    protected $friendshipRepository;

    /**
     * FriendshipController constructor.
     * @param IFriendshipRepository $friendshipRepository
     */
    public function __construct(IFriendshipRepository $friendshipRepository)
    {
        $this->friendshipRepository = $friendshipRepository;
    }

    /**
     * @param CreateNewFriendship $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateNewFriendship $request)
    {
        $data = $request->validated();

        $loggedUser = User::find(Auth::user()->id);
        $toFollowUser = User::find($data['user_id']);

        $this->friendshipRepository->create($loggedUser, $toFollowUser);

        return response()->json([], 204);
    }

    /**
     * @param DestroyFriendship $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyFriendship $request)
    {
        $data = $request->validated();

        $loggedUser = User::find(Auth::user()->id);
        $toFollowUser = User::find($data['user_id']);

        $this->friendshipRepository->destroy($loggedUser, $toFollowUser);

        return response()->json([], 204);
    }
}

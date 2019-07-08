<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\User\UpdateUser;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Repositories\User\IUserRepository;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var IUserRepository
     */
    protected $user;

    /**
     * UserController constructor.
     *
     * @param IUserRepository $interface
     */
    public function __construct(IUserRepository $interface)
    {
        $this->user = $interface;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {

        $users = $this->user->all($request->all());

        $response = (new UserCollection($users));

        return response()->json(array_merge($response->toArray($request), ['status' => 'ok']));
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user) {

        $data = [
            'status' => 'ok',
            'user' => new UserResource($this->user->get($user))
        ];

        return response()->json($data);
    }
}

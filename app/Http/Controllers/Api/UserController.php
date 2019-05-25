<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\User\UpdateUser;
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

    public function index(Request $request) {
        $data = [
            'status' => 'ok',
            'users' => $this->user->all($request->all())
        ];

        return response()->json($data);
    }

    public function show(User $user) {

        $data = [
            'status' => 'ok',
            'user' => $this->user->get($user)
        ];

        return response()->json($data);
    }

    public function update(UpdateUser $request, User $user) {

        $data = [
            'status' => 'ok',
            'user' => $this->user->update($user, $request->validated())
        ];

        return response()->json($data);
    }

    public function delete(User $user) {

        $this->user->delete($user);

        return response()->json([], 204);
    }
}

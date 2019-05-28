<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\User\Login;
use App\Http\Requests\Api\User\LoginUser;
use App\Http\Requests\Api\User\RegisterUser;
use App\Http\Requests\Api\User\UpdateUser;
use App\Repositories\User\IUserRepository;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function login(LoginUser $request) {

        // we got logged in user.
        if ($user = $this->user->login($request->validated())) {
            return response()->json(['status' => 'ok','user' => $user]);
        }

        return response()->json(['status'=>'fail', 'message' => 'The password you entered is incorrect. Please try again.',
            'error_type' => 'bad_password'], 401);
    }

    public function register(RegisterUser $request) {

        $user = $this->user->register($request->all());

        return response()->json(['status'=>'ok', 'user' => $user], 201);
    }

    public function details(){
        return Auth::user();
    }
}

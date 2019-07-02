<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\User\LoginUser;
use App\Http\Requests\Api\User\RegisterUser;
use App\Http\Resources\Profile\ProfileResource;
use App\Http\Resources\User\UserResource;
use App\Repositories\Profile\IProfileRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * @var IProfileRepository
     */
    protected $profile;

    /**
     * ProfileController constructor.
     * @param IProfileRepository $profile
     */
    public function __construct(IProfileRepository $profile)
    {
        $this->profile = $profile;
    }

    public function currentUser() {

        $user = Auth::user();

        $data = [
            'status' => 'ok',
            'user' => new ProfileResource($user)
        ];

        return response()->json($data);
    }

    /**
     * @param LoginUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUser $request) {
        // we got logged in user.
        if ($user = $this->profile->login($request->validated())) {

            $user->token = $user->createToken('MyApp')->accessToken;

            $resource = (new ProfileResource($user))->withAccessToken();

            return response()->json([
                'status' => 'ok',
                'user' => $resource
            ]);
        }

        return response()->json(['status'=>'fail', 'message' => 'The password you entered is incorrect. Please try again.',
            'error_type' => 'bad_password'], 401);
    }

    /**
     * @param RegisterUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUser $request) {

        $user = $this->profile->register($request->all());

        $user->token = $user->createToken('MyApp')->accessToken;

        $resource = (new ProfileResource($user))->withAccessToken();

        return response()->json(['status'=>'ok', 'user' => $resource], 201);
    }

}

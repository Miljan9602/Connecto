<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\User\LoginUser;
use App\Http\Requests\Api\User\RegisterUser;
use App\Http\Resources\Profile\ProfileResource;
use App\Repositories\Profile\IProfileAuthenticationRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @var IProfileAuthenticationRepository
     */
    protected $profile;

    /**
     * ProfileController constructor.
     * @param IProfileAuthenticationRepository $profile
     */
    public function __construct(IProfileAuthenticationRepository $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
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

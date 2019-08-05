<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ResetPassword\ResetCreate;
use App\Http\Requests\Api\ResetPassword\ResetFind;
use App\Http\Requests\Api\ResetPassword\ResetPassword;
use App\Http\Resources\PasswordReset\PasswordResetResource;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use App\Repositories\PasswordReset\IPasswordResetRepository;
use App\Repositories\PasswordReset\PasswordResetRepository;
use App\User;

class PasswordResetController extends Controller
{

    /**
     * @var IPasswordResetRepository
     */
    protected $passwordReset;

    /**
     * PasswordResetController constructor.
     * @param PasswordResetRepository $passwordReset
     */
    public function __construct(PasswordResetRepository $passwordReset)
    {
        $this->passwordReset = $passwordReset;
    }

    /**
     * @param ResetCreate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(ResetCreate $request) {

        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        $resetPassword = $this->passwordReset->create($user);

        $user->notify(new PasswordResetRequest($resetPassword->token));

        return response()->json(['status' => 'ok', 'message' => 'We have e-mailed your password reset link!'], 201);
    }

    /**
     * @param ResetFind $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function find(ResetFind $request) {

        $passwordReset = $this->passwordReset->find($request->validated()['token']);

        return response()->json([
            'status' => 'ok',
            'password_reset' => new PasswordResetResource($passwordReset)
        ]);
    }

    public function reset(ResetPassword $request) {

        $data = $request->validated();

        $passwordReset = PasswordReset::where('token', $data['token'])->where('email', $data['email'])->first();

        $user = User::where('email', $data['email'])->first();

        $this->passwordReset->reset($user, $passwordReset, $data['password']);

        $user->notify(new PasswordResetSuccess());

        return response()->json([
            'status' => 'ok',
            'message' => 'Password reset successfully, you can now login to your account'
        ]);
    }
}

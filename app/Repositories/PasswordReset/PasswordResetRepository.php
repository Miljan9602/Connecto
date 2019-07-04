<?php


namespace App\Repositories\PasswordReset;


use App\Notifications\PasswordResetSuccess;
use App\PasswordReset;
use App\User;
use Illuminate\Support\Str;

class PasswordResetRepository implements IPasswordResetRepository
{
    public function create(User $user): PasswordReset
    {
        return PasswordReset::updateOrCreate(
            [
                'email' => $user->email
            ],
            [
                'email' => $user->email,
                'token' => Str::random(60)
            ]
        );
    }

    public function find($token): PasswordReset
    {
        return PasswordReset::where('token', $token)->first();
    }

   public function reset(User $user, PasswordReset $reset, $newPassword)
   {
       $user->password = bcrypt($newPassword);
       $user->save();
   }

}
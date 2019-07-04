<?php


namespace App\Repositories\PasswordReset;


use App\PasswordReset;
use App\User;

interface IPasswordResetRepository
{
    /**
     * @param User $user
     * @return PasswordReset
     */
    public function create(User $user) : PasswordReset;

    /**
     * @param $token
     * @return PasswordReset
     */
    public function find($token) : PasswordReset;

    /**
     * @param User $user
     * @param PasswordReset $reset
     * @param $newPassword
     * @return mixed
     */
    public function reset(User $user, PasswordReset $reset, $newPassword);
}
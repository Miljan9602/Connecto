<?php


namespace App\Repositories\Profile;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;

interface IProfileAuthenticationRepository
{
    /**
     * Login user.
     * @param array $data
     * @return User|null
     */
    public function login(array $data) : ?Authenticatable;

    /**
     * Register user.
     * @param array $data
     * @return User|null
     */
    public function register(array $data) : ?User;
}
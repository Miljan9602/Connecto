<?php
/**
 * Created by PhpStorm.
 * User: miki
 * Date: 2019-05-25
 * Time: 20:45
 */

namespace App\Repositories\User;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;

interface IUserRepository
{
    /**
     * Return single user.
     * @param User $user
     * @return User|null
     */
    public function get(User $user) : ?User;

    /**
     * Return users that match query
     * @param array $query
     * @return User[]|null
     */
    public function all(array $query);

    /**
     * Delete single user
     * @param User $user
     * @return mixed
     */
    public function delete(User $user);

    /**
     * Update single user
     * @param User $user
     * @param array $data
     * @return User|null
     */
    public function update(User $user, array $data) : ?User;

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

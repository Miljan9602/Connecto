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
     * @param User $user
     * @return User|null
     */
    public function get(User $user) : ?User;

    /**
     * @param array $query
     * @return User[]|null
     */
    public function all(array $query);

    /**
     * @param User $user
     * @return mixed
     */
    public function delete(User $user);

    /**
     * @param User $user
     * @param array $data
     * @return User|null
     */
    public function update(User $user, array $data) : ?User;

    /**
     * @param array $data
     * @return User|null
     */
    public function login(array $data) : ?Authenticatable;

    /**
     * @param array $data
     * @return User|null
     */
    public function register(array $data) : ?User;
}

<?php
/**
 * Created by PhpStorm.
 * User: miki
 * Date: 2019-05-25
 * Time: 20:45
 */

namespace App\Repositories\User;


use App\Repositories\AbstractRepository;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserRepository
 * @package App\Repositories\User
 */
class UserRepository implements IUserRepository
{

    public function get(User $user): ?User
    {
        return $user;
    }

    public function all(array $query = null)
    {
        return User::all();
    }
}

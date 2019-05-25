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

/**
 * Class UserRepository
 * @package App\Repositories\User
 */
class UserRepository extends AbstractRepository implements IUserRepository
{

    public function get(User $user): ?User
    {
        return $user;
    }

    public function all(array $query = null)
    {
        return User::all();
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function update(User $user, array $data): ?User
    {
        $user->update($data);

        return $user;
    }

}

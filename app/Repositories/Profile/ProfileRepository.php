<?php

namespace App\Repositories\Profile;

use App\Repositories\Avatar\IUserAvatarRepository;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class ProfileRepository implements IProfileAuthenticationRepository
{
    /**
     * @var IUserAvatarRepository
     */
    protected $userAvatarRepository;

    /**
     * ProfileRepository constructor.
     * @param $userAvatarRepository
     */
    public function __construct(IUserAvatarRepository $userAvatarRepository)
    {
        $this->userAvatarRepository = $userAvatarRepository;
    }


    public function login(array $data): ?Authenticatable
    {
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return Auth::user();
        }

        return null;
    }

    public function register(array $data): ?User
    {
        $data['password'] = bcrypt($data['password']);

        // Create new user object.
        $user = User::make($data);

        // Fill the profile_pic_url into user model
        $user->profile_pic_url = $this->userAvatarRepository->createAvatar($user);

        // Create new user into database.
        $user->save();

        return $user;
    }
}
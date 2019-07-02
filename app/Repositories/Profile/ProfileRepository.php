<?php


namespace App\Repositories\Profile;


use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class ProfileRepository implements IProfileRepository
{

    public function login(array $data): ?Authenticatable
    {
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            return Auth::user();
        }

        return null;
    }

    public function register(array $data): ?User
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }
}
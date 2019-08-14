<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\User\IUserRepository',
            'App\Repositories\User\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Profile\IProfileAuthenticationRepository',
            'App\Repositories\Profile\ProfileRepository'
        );

        $this->app->bind(
            'App\Repositories\PasswordReset\IPasswordResetRepository',
            'App\Repositories\PasswordReset\PasswordResetRepository'
        );

        $this->app->bind(
            'App\Repositories\Avatar\IUserAvatarRepository',
            'App\Repositories\Avatar\UserFileAvatarRepository'
        );

        $this->app->bind(
            'App\Repositories\Friendship\IFriendshipStorageRepository',
            'App\Repositories\Friendship\FriendshipRepository'
        );

        $this->app->bind(
            'App\Repositories\Friendship\IFriendshipRetrieveRepository',
            'App\Repositories\Friendship\FriendshipRepository'
        );
    }
}
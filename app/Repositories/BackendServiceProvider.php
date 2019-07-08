<?php
/**
 * Created by PhpStorm.
 * User: miki
 * Date: 2019-05-25
 * Time: 20:56
 */

namespace App\Repositories;


use Carbon\Laravel\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\User\IUserRepository',
            'App\Repositories\User\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Profile\IProfileRepository',
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
    }
}

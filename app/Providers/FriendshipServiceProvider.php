<?php


namespace App\Providers;


use App\Services\FriendshipService;
use Illuminate\Support\ServiceProvider;

class FriendshipServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('friendship', function ($app) {
            return new FriendshipService(
                $app->make('App\Repositories\Friendship\IFriendshipRetrieveRepository'),
                $app->make('App\Repositories\Friendship\IFriendshipStorageRepository')
            );
        });
    }
}
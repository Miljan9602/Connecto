<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;

class FriendshipTest extends TestCase
{
    public function testSuccessFriendship(){

        $loggedUser = factory(User::class)->create();

        $toFollowUser = factory(User::class)->create();

        $time = time();
        $query = ['user_id' => $toFollowUser->id];
        $url = env('APP_URL')."api/v1/friendships";
        $key = env('SIGNATURE_KEY');
        $jsonQuery = json_encode($query, JSON_UNESCAPED_SLASHES);

        $hash = hash('sha256', base64_encode($url.$key.$jsonQuery.$time));

        $response = $this->actingAs($loggedUser)->json('GET', 'api/v1/friendships', $query, [
            'Security-Token' => $hash
        ]);

        $response->assertStatus(204);
    }
}

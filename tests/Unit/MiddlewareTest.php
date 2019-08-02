<?php

namespace Tests\Unit;

use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    /**
     * Testing when our validate signature middleware fail
     * @return void
     */
    public function testFailedValidateSignature() {

        $key = env('SIGNATURE_KEY');
        $time = time();
        $hash = hash('sha256', base64_encode($key.$time));

        $response = $this->json('GET', '/api/v1/user', [], [
            'Security-Token' => $hash
        ]);

        $response->assertStatus(400 );
        $response->assertJson(['status' => 'fail', 'error_type' => 'bad_request']);
        $response->assertJsonStructure([
            'status',
            'error_type',
            'message'
        ]);
    }

    /**
     * Testing when our validate signature middleware fail without security token header.
     * @return void
     */
    public function testFailedValidationSignatureWithoutHeader() {

        $response = $this->json('GET', '/api/v1/user');

        $response->assertStatus(400 );
        $response->assertJson(['status' => 'fail', 'error_type' => 'bad_request']);
        $response->assertJsonStructure([
            'status',
            'error_type',
            'message'
        ]);
    }

    /**
     * Testing when our validate signature middleware succeed
     */
    public function testSuccessValidateSignature() {

        $time = time();
        $query = ['unit' => 'test'];
        $url = env('APP_URL')."/api/v1/user";
        $key = env('SIGNATURE_KEY');
        $jsonQuery = json_encode($query, JSON_UNESCAPED_SLASHES);

        $hash = hash('sha256', base64_encode($url.$key.$jsonQuery.$time));


        $response = $this->json('GET', '/api/v1/user', $query, [
            'Security-Token' => $hash
        ]);

        $response->assertStatus(200 );
    }

}

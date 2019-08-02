<?php

namespace Tests\Unit;

use App\PasswordReset;
use App\Rules\IsExpiredResetToken;
use Carbon\Carbon;
use Tests\TestCase;

class IsExpiredResetTokenRuleTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     * Testing IsExpiredResetToken validation rule, when rule passes test.
     */
    public function testExpiredResetToken() {

        $passReset = factory(PasswordReset::class)->create();

        // Rule to test.
        $rule = new IsExpiredResetToken();

        $this->assertTrue($rule->passes(null, $passReset->token));
    }

    /**
     * Testing IsExpiredResetToken validation rule, when rule fail test.
     */
    public function testNotExipredResetToken() {

        $passReset = factory(PasswordReset::class)->create();

        $passReset->updated_at = Carbon::now()->subMinute(720);
        $passReset->save();

        // Rule to test.
        $rule = new IsExpiredResetToken();

        $this->assertFalse($rule->passes(null, $passReset->token));
    }

    /**
     * Testing IsExpiredResetToken validation rule, when we pass non existing token.
     */
    public function testNonExistingResetToken() {

        // Rule to test.
        $rule = new IsExpiredResetToken();

        $this->assertFalse($rule->passes(null, \Illuminate\Support\Str::random(60)));
    }
}

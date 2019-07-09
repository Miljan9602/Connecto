<?php

namespace App\Rules;

use App\PasswordReset;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class IsExpiredResetToken implements Rule
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $passwordReset = PasswordReset::where('token', $value)->first();

        // If we found password reset and it is still valid. rule is valid.
        return $passwordReset && !Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This password reset token is invalid.';
    }
}

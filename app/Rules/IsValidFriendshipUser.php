<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class IsValidFriendshipUser implements Rule
{

    /**
     * @var string
     */
    private $message;

    /**
     * Create a new rule instance whcih will check if the friendship request has valid user to follow.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = "Already following this user.";
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
        $loggedUser = Auth::user();

        // If user asked to follow itself.
        if ($loggedUser->id == $value) {
            $this->message = "Wrong user to follow";
            return false;
        }

        // Check if user already follow current user. If we already follow user, request is not valid.
        return !$loggedUser->isFollowingUser(User::find($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}

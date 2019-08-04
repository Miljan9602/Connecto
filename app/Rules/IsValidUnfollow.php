<?php

namespace App\Rules;

use App\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class IsValidUnfollow implements Rule
{

    /**
     * @var string
     */
    private $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = 'You can\'t unfollow someone you don\'t follow';
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
        if ($loggedUser->id == $value->id) {
            $this->message = "Wrong user to unfollow";
            return false;
        }
        
        
        return $loggedUser->isFollowingUser($value);
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

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmojiValidationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $regex = '/^[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F700}-\x{1F77F}\x{1F780}-\x{1F7FF}\x{1F800}-\x{1F8FF}\x{1F900}-\x{1F9FF}\x{1FA00}-\x{1FA6F}\x{1FA70}-\x{1FAFF}\x{1F200}-\x{1F251}\x{1F004}\x{1F0CF}\x{1F004}\x{1F004}\x{1F004}\x{1F004}\x{1F300}-\x{1F6FF}\x{1F600}-\x{1F64F}\x{1F680}-\x{1F6FF}]+$/u';


        return preg_match($regex, $value) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must contain only emojis.';
    }
}

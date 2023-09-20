<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class CategoryLevelRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Assuming $value is the category level to validate
        // You can define your validation logic here
        // For example, to check if the category level is less than or equal to 5:
        return $value < 6;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // Customize the error message here
        return 'The :attribute must be less than 6.';
    }
}


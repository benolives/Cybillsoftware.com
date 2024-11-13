<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotStartWith implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the value starts with a digit from 1 to 9
        if (preg_match('/^[1-9]/', $value)) {
            $fail("The $attribute cannot start with a digit from 1 to 9.");
        }
    }
}
<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ComplexPassword implements Rule
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

    public function passes($attribute, $value)
    {
        // Define the complex password requirements.
        $containsUppercase = preg_match('/[A-Z]/', $value);
        $containsLowercase = preg_match('/[a-z]/', $value);
        $containsDigit = preg_match('/\d/', $value);
        $containsSpecialCharacter = preg_match('/[^A-Za-z0-9]/', $value);

        return $containsUppercase && $containsLowercase && $containsDigit && $containsSpecialCharacter && strlen($value) >= 8;
    }

    public function message()
    {
        return 'The :attribute must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one digit, and one special character.';
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check minimum length
        if (strlen($value) < 8) {
            $fail('Password must be at least 8 characters long.');
            return;
        }

        // Check maximum length
        if (strlen($value) > 128) {
            $fail('Password must not be more than 128 characters.');
            return;
        }

        // Check for at least one number
        if (!preg_match('/\d/', $value)) {
            $fail('Password must include at least one number.');
            return;
        }

        // Check for at least one special character
        if (!preg_match('/[^a-zA-Z0-9]/', $value)) {
            $fail('Password must include at least one special character.');
            return;
        }
    }

    /**
     * Get the validation rule as a string for use in validation arrays
     */
    public static function rule(): string
    {
        return 'required|string|min:8|max:128|regex:/^(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/';
    }

    /**
     * Get custom error messages for the password rule
     */
    public static function messages(): array
    {
        return [
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.max' => 'Password must not be more than 128 characters.',
            'password.regex' => 'Password must include at least one number and one special character.',
        ];
    }
}

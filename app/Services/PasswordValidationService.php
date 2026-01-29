<?php

namespace App\Services;

class PasswordValidationService
{
    /**
     * Get the password validation rule
     */
    public static function getRule(): array
    {
        return [
            'required',
            'string',
            'min:8',
            'max:128',
            'regex:/^(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/'
        ];
    }

    /**
     * Get password validation messages
     */
    public static function getMessages(): array
    {
        return [
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.max' => 'Password must not be more than 128 characters.',
            'password.regex' => 'Password must include at least one number and one special character.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }

    /**
     * Get password validation with confirmation
     */
    public static function getRuleWithConfirmation(): array
    {
        return [...self::getRule(), 'confirmed'];
    }

    /**
     * Validate password strength programmatically
     */
    public static function validateStrength(string $password): array
    {
        $errors = [];

        if (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters long.';
        }

        if (strlen($password) > 128) {
            $errors[] = 'Password must not be more than 128 characters.';
        }

        if (!preg_match('/\d/', $password)) {
            $errors[] = 'Password must include at least one number.';
        }

        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            $errors[] = 'Password must include at least one special character.';
        }

        return $errors;
    }

    /**
     * Get password requirements for frontend display
     */
    public static function getRequirements(): array
    {
        return [
            'length' => [
                'text' => 'At least 8 characters',
                'regex' => '.{8,}',
                'icon' => 'radio_button_unchecked'
            ],
            'number' => [
                'text' => 'Includes a number',
                'regex' => '\d',
                'icon' => 'radio_button_unchecked'
            ],
            'special' => [
                'text' => 'Special character',
                'regex' => '[^a-zA-Z0-9]',
                'icon' => 'radio_button_unchecked'
            ],
            'uppercase' => [
                'text' => 'Uppercase letter',
                'regex' => '[A-Z]',
                'icon' => 'radio_button_unchecked'
            ]
        ];
    }
}

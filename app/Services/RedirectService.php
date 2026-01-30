<?php

namespace App\Services;

use App\Models\User;

class RedirectService
{
    /**
     * Get the redirect route for a user based on their type and status
     *
     * @param User $user
     * @return string
     */
    public static function getRedirectRoute(User $user): string
    {


        // Handle incomplete doctor profiles
        if ($user->user_type === User::TYPE_DOCTOR && $user->status == User::STATUS_DOCTOR_PROFILE_INCOMPLETE) {
            return route('doctor.onboarding.step2');
        }

        // Handle email verification first (highest priority)
        if (!$user->hasVerifiedEmail()) {
            return route('verification.notice');
        }

        // Handle active users based on type
        return match($user->user_type) {
            User::TYPE_SUPER_ADMIN => route('admin.dashboard'),
            User::TYPE_CLIENT => route('client.dashboard'),
            User::TYPE_DOCTOR => route('professional.dashboard'),
            default => '/'
        };
    }

    /**
     * Get user role name for frontend
     *
     * @param User $user
     * @return string
     */
    public static function getUserRole(User $user): string
    {
        return match($user->user_type) {
            User::TYPE_SUPER_ADMIN => 'admin',
            User::TYPE_CLIENT => 'patient',
            User::TYPE_DOCTOR => 'doctor',
            default => 'user'
        };
    }

    /**
     * Get complete redirect data for AJAX responses
     *
     * @param User $user
     * @return array
     */
    public static function getRedirectData(User $user): array
    {
        return [
            'success' => true,
            'message' => $user->status == User::STATUS_DOCTOR_PROFILE_INCOMPLETE
                ? 'Login successful! Please complete your profile.'
                : 'Login successful!',
            'redirect' => self::getRedirectRoute($user),
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => self::getUserRole($user),
                'user_type' => $user->user_type,
                'status' => $user->status
            ]
        ];
    }
}

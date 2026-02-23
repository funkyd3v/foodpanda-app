<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Two\User as SocialiteUser;

class KeycloakUserService
{
    /**
     * Find or provision a local user from a Keycloak authenticated user.
     */
    public function findOrProvision(SocialiteUser $keycloakUser): User
    {
        $user = User::where('keycloak_id', $keycloakUser->id)->first();

        if (!$user) {
            $user = User::where('email', $keycloakUser->email)->first();
        }

        // Provision or update
        if ($user) {
            $user->update([
                'keycloak_id'       => $keycloakUser->id,
                'name'              => $keycloakUser->name ?? $keycloakUser->nickname ?? 'Unknown',
                'email_verified_at' => ($keycloakUser->user['email_verified'] ?? false) ? now() : $user->email_verified_at,
            ]);
        } else {
            $user = User::create([
                'keycloak_id'       => $keycloakUser->id,
                'email'             => $keycloakUser->email,
                'name'              => $keycloakUser->name ?? $keycloakUser->nickname ?? 'Unknown',
                'email_verified_at' => ($keycloakUser->user['email_verified'] ?? false) ? now() : null,
            ]);
        }

        Log::info('Keycloak SSO login', [
            'keycloak_id' => $user->keycloak_id,
            'email'       => $user->email,
        ]);

        return $user;
    }
}
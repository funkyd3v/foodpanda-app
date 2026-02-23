<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\KeycloakUserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class KeycloakController extends Controller
{
    public function __construct(
        protected KeycloakUserService $keycloakUserService
    ) {}

    /**
     * Redirect the user to Keycloak login page.
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('keycloak')->redirect();
    }

    /**
     * Handle the callback from Keycloak after successful authentication.
     */
    public function callback(): RedirectResponse
    {
        try {
            $keycloakUser = Socialite::driver('keycloak')->user();
            $user = $this->keycloakUserService->findOrProvision($keycloakUser);

            Auth::login($user, remember: true);

            session()->regenerate();

            return redirect()->intended(route('dashboard'));
        } catch (\Exception $e) {
            Log::error('Keycloak callback failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('login')
                ->with('error', 'Authentication failed. Please try again.');
        }
    }

    /**
     * Log the user out locally and redirect to Keycloak logout endpoint.
     * Keycloak will then trigger backchannel logout to all other clients.
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        $logoutUrl = sprintf(
            '%s/realms/%s/protocol/openid-connect/logout?%s',
            rtrim(config('services.keycloak.base_url'), '/'),
            config('services.keycloak.realms'),
            http_build_query([
                'client_id'                => config('services.keycloak.client_id'),
                'post_logout_redirect_uri' => config('app.url'),
            ])
        );

        return redirect($logoutUrl);
    }

    /**
     * Handle backchannel logout request from Keycloak.
     * Keycloak calls this server-to-server when any other client triggers logout.
     */
    public function backchannelLogout(): \Illuminate\Http\Response
    {
        return response('', 200);
    }
}
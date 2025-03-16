<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        $google_login_domain = env('GOOGLE_LOGIN_DOMAIN', null);

        return Socialite::driver('google')
            ->with(['hd' => $google_login_domain])
            ->redirect();
    }

    /**
     * Handle the callback from Google after authentication.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $social_user = Socialite::driver('google')->user();
        } catch (InvalidStateException $exception) {
            return redirect()->route('filament.auth.login')->withErrors(['email' => [__('Google Login failed, please try again.')]]);
        }

        $user_email = $social_user->getEmail();

        // Check if the email matches the valid domain pattern
        if (! User::isValidDomain($user_email)) {
            return redirect()->route('filament.auth.login')->withErrors([
                'email' => 'Invalid Domin.',
            ]);
        }

        // Check if the user already exists
        $user = User::where('email', $user_email)->first();

        // Update the user's profile photo
        if (! $user) {

            // Create a new user
            $user = User::create([
                'name' => $social_user->getName(),
                'email' => $user_email,
                'profile_photo' => $social_user->getAvatar(),
                'password' => Str::random(32),
            ]);

        } else {
            $user->update(['profile_photo' => $social_user->getAvatar()]);
        }

        Auth::login($user);

        User::attachRole($user);

        return redirect()->intended('/');
    }
}

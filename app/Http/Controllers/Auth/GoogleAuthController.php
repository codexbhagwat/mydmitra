<?php
// app/Http/Controllers/Auth/GoogleAuthController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    // User ko Google page par bhejo
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google wapas yahan bhejta hai
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Google login failed. Please try again.']);
        }

        // Database mein user dhundo ya naya banao
        $user = User::updateOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'name'   => $googleUser->getName(),
                'email'  => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                // password null rahega Google users ke liye
            ]
        );

        // Login karwao
        Auth::login($user, true); // true = remember me

        return redirect()->intended('/dashboard');
    }
}
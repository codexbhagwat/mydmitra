<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Google login failed.']);
        }

        $nameParts = explode(' ', $googleUser->getName(), 2);

        $user = User::updateOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'first_name' => $nameParts[0],
                'last_name'  => $nameParts[1] ?? '',
                'email'      => $googleUser->getEmail(),
                'avatar'     => $googleUser->getAvatar(),
            ]
        );

        if (!$user->wasRecentlyCreated) {
            User::where('email', $googleUser->getEmail())
                ->whereNull('google_id')
                ->update(['google_id' => $googleUser->getId(), 'avatar' => $googleUser->getAvatar()]);

            $user = User::where('email', $googleUser->getEmail())->first();
        }

        Auth::login($user, true);

        return redirect($user->isAdmin() ? '/admin/dashboard' : '/user/dashboard');
    }
}

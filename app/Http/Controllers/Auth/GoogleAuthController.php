<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Full name split karo
            $nameParts = explode(' ', $googleUser->getName(), 2);
            $firstName = $nameParts[0];
            $lastName  = $nameParts[1] ?? '';

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'google_id'  => $googleUser->getId(),
                    'name'       => $googleUser->getName(),
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'avatar'     => $googleUser->getAvatar(),
                    'password'   => null,
                ]
            );

            Auth::login($user, true);
            return redirect()->intended('/user/dashboard');

        } catch (\Exception $e) {
            dd($e->getMessage()); // Error dikhao
        }
    }
}
<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $avatarurl = $googleUser->getAvatar();
        $avatarcontent = file_get_contents($avatarurl);
        $filename = 'avatars/'. Str::uuid() . '.jpg';
        Storage::disk('public')->put($filename, $avatarcontent);
        $avatar = 'storage/' . $filename;
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            if (!$user->avatar) {
                $user->avatar = $avatar;
                $user->save();
            }

            Auth::login($user);

        }else{
            
        $user = User::create(
            [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt('google-logins'),
                'avatar' => $googleUser->getAvatar(),
            ]
        );
        Auth::login($user);
        }
        return redirect('/dashboard');
    }
}

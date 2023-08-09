<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        // Implement your logic to handle the user data returned by the provider
        // For example, you can create a new user account or log in an existing user.

        // $user->getId();
        // $user->getName();
        // $user->getEmail();
        // $user->getAvatar();

        // After handling the user, you can redirect to the desired page
        // For example:
        // return redirect()->route('home');
    }
}

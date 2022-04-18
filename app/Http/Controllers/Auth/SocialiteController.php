<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $authUser = $this->checkLogin($user);

        Auth::login($authUser);

        return redirect()->route('posts.index');
    }

    public function checkLogin($data)
    {
        $authUser = User::where('provider_id', $data->id)->first();
        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'provider_id' => $data->id,
        ]);
    }
}

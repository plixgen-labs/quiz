<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// to use the social login
use Socialite;

// to use the Auth Facades
use Illuminate\Support\Facades\Auth;

// to use the controller class
use App\Http\Controllers\Controller;

// to use Profiles
use App\Profile;

// to use user login controller
use App\User;

class LoginController extends Controller
{
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // print_r($user);die();
        // $user->token;
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect('/home');
    }

    /**
      * If a user has registered before using social auth, return the user
      * else, create a new user object.
      * @param  $user Socialite user object
      * @param $provider Social auth provider
      * @return  User
      */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }

        $authUserCreatedId = Profile::create([
            'name'    => $user->name,
            'email'   => $user->email,
            'avatar'  => $user->avatar,
        ])->id;

        $authlogin = User::create([
            'email'       => $user->email,
            'provider'    => $provider,
            'provider_id' => $user->id,
            'user_id'     => $authUserCreatedId,
        ]);

        return $authlogin;
    }
}

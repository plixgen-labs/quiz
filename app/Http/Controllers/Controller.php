<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// to use the Auth Facades
use Illuminate\Support\Facades\Auth;

// to use Profiles
use App\Profile;

// to use user login controller
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUserDetails()
    {
      // get the auth user data
      $authUser = Auth::user();
      // get the user details
      $userData = Profile::where('id', $authUser->user_id)->first();

      return $userData;
    }
}

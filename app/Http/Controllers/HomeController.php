<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// to use the Auth Facades
use Illuminate\Support\Facades\Auth;

// to use Profiles
use App\Profile;

// to use user login controller
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get the auth user data
        $authUser = Auth::user();
        // get the user details
        $userData = Profile::where('id', $authUser->user_id)->first();

        // render the view
        return view('home',['user'=>$userData]);
    }
}

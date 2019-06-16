<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// to use the Auth Facades
use Illuminate\Support\Facades\Auth;

use Validator;                          // to use the Validator functions to validate the user input

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
        // render the view
        return view('home',[
          'user'          =>  $this->getUserDetails(),
          'questionsList' =>  $this->getRecentQuestionList(),
        ]);
    }

    public function displayProfile()
    {
        // render the view
        return view('profile',[
          'user'          =>  $this->getUserDetails(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        // validate the input data
        $validator = Validator::make($request->all(), [
            'uname' => 'required|max:255',
            'email' => 'required|email',
            'dob'   => 'nullable|date',
            'gender'=> 'nullable',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ])->validate();

        // get the current user data
        $userData =  $this->getUserDetails();

        // check dob, gender, phone is null
        if($request->dob == NULL)
        {
          $request->dob=$userData->dob;
        }
        if($request->gender == NULL)
        {
          $request->gender=$userData->gender;
        }
        if($request->phone == NULL)
        {
          $request->phone=$userData->phone;
        }
        // update the data
        $result = Profile::where('id', $userData->id)->update([
            'name'=>$request->uname,
            'email'=>$request->email,
            'dob'=>$request->dob,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
          ]);

        if (is_null($result)) {
          // if there is problem updating update the alert
          $alert = array(
            'type' => 'danger',
            'message' => "Profile updation failed."
          );

          // return to same page
          session()->flash('alert',$alert);
          return redirect()->back();
        }
        // return to homepage
        // set the alert
        $alert = array(
          'type' => 'success',
          'message' => "Profile details updated sucessfully."
        );
        session()->flash('alert',$alert);
        return redirect()->action('HomeController@index');
    }

    public function leaderboard()
    {
        // get the users list to publish in leaderboard
        $usersList = Profile::where('isactive', 1)->orderBy('points', 'desc')->get();

        // render the view
        return view('leaderboard',[
          'user'          =>  $this->getUserDetails(),
          'questionsList' =>  $this->getRecentQuestionList(),
          'usersList'     =>  $usersList,
          'leaderboard'   =>  1,
        ]);
    }
}

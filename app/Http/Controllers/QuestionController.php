<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
                                        // to use the request function
use App\Http\Requests;

use Validator;                          // to use the Validator functions to validate the user input

use App\Http\Controllers\Controller;    // to use the controller class

use App\Profile;                        // to use Profiles

use App\Question;                       // to use the Question class

use DB;                                 // to acess to the database

use App\Http\Controllers\View;          // to acess the views functions

use Hash;                               // to access the hashing functions

class QuestionController extends Controller
{
    /**
    * making the controller procted by the auth of the user
    **/
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function ShowQuestionAdditionForm()
    {
      $user = $this->getUserDetails();
      return view('quesAns/addQuestion',['user'=>$user]);
    }

    public function AddQuestion(Request $request)
    {
      // Validate the request...
      $validator = Validator::make($request->all(), [
              'text' => 'required|max:255',
              'hint' => 'max:255',
              'image' => 'required',
              'bgimage' => '',
        ]);
        // if validation fails send back to register page
        if ($validator->fails()) {
            return redirect('/admin/register')
                        ->withErrors($validator)
                        ->withInput();
        }

        // storing the data
        $user = new Admin;
        // getting the users data
        $user->name = ucwords(strtolower($request->name));
        $user->username = strtolower($request->username);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->branch = $request->branch;
        $user->address = $request->address;

        //saving the data into table
        $user->save();
        if($user->save())
        {
            echo "data added to table";
            return redirect('/admin/dashboard');
        }
        return redirect('/admin/login');

    }
}

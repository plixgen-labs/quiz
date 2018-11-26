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
      return view('quesAns/addQuestion',[
        'user' => $user,
        'randomId' => [mt_rand(),mt_rand()],
      ]);
    }

    public function AddQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qtext'   => 'required|max:255',
            'hint'    => 'nullable',
            'ans'     => 'required|array|min:1',
            'ans.*'   => 'required|max:255',
            'files'   => 'required|array|min:2',
            'files.*' => 'required|mime:jpg,png,svg|dimensions:min_width=1000,min_height=2000',
        ])->validate();

        var_dump($request);die();
    }

    public function uploadImage ()
    {
      // code...
    }
}

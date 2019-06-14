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

use App\Question;                       // to use the Question class
use App\Answer;                       // to use the Answer class

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

    public function getRecentQuestionList($limit=10)
    {
        return Question::where('enable', 1)->orderBy('id', 'desc')->limit($limit)->get();
    }

    public function getQuestionPoints($qid)
    {
      // base point
      $base_point = env('BASE_POINTS');

      // get the question data
      $question = Question::where('qid', $qid)->where('enable', 1)->get();

      // get all the submitted answer of the question
      $submitted_answers = Answer::where('question_id', $qid)->count();

      // calculate the point
      if($submitted_answers > env('SUBMITTED_ANSWERS_THRESHOLD'))
      {
        // get all the submitted answer of the question
        $correct_answers = Answer::where('question_id', $qid)->where('result',1)->count();

        if ($correct_answers > env('CORRECT_ANSWERS_THRESHOLD'))
        {
          $difficulty = (float(1.00)-(float($correct_answers)/float($submitted_answers)));
          Question::where('qid', $qid)->update('difficulty', integer($difficulty));

          return $base_point*$difficulty;
        }
        return $base_point;
      }

      return $base_point;
    }
}

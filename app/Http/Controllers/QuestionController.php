<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
                                        // to use the request function
use App\Http\Requests;

use Validator;                          // to use the Validator functions to validate the user input

use App\Http\Controllers\Controller;    // to use the controller class

use App\Profile;                        // to use Profiles

use App\Question;                       // to use the Question class

use App\Answer;                       // to use the Answer class

use DB;                                 // to acess to the database

use App\Http\Controllers\View;          // to acess the views functions

use Hash;                               // to access the hashing functions

use Illuminate\Http\File;               // to access the file class

use Illuminate\Support\Facades\Storage; // for storage and retrival of files/images

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
        'questionsList' =>  $this->getRecentQuestionList(),
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
            'files.*' => 'required|mimes:jpg,png,svg|dimensions:min_width=400,min_height=600',
        ])->validate();

        // the array of the file id inserted into the database
        $insertedFilesArray = $this->uploadAndStoreFiles($request->file('files'));

        // get the current user Details
        $userData = $this->getUserDetails();

        // unique hash for the question to be used as question id which can be shared with the others
        $qId = hash('haval256,4', mt_rand().md5($request->qtext).mt_rand().md5($request->hint).mt_rand());

        // insert the Question into the database
        $insertedQuestion = Question::create([
            'qid'     => $qId,
            'text'    => $request->qtext,
            'hint'    => $request->hint,
            'image'   => implode(',', $insertedFilesArray),
            'bgimage' => '',
            'answer'  => implode(',', $request->ans),
            'user_id' => $userData->id,
        ])->id;

        // check for the insertion is success or not
        if ($insertedQuestion > 0 && $insertedQuestion != NULL)
        {
          $host = request()->getHttpHost();
          // render view with sucess message
          return view('quesAns/addQuestion',[
            'user'       => $userData,
            'randomId'   => [mt_rand(),mt_rand()],
            'status'     => 'success',
            'message'    => "Question Upload Sucess. Share the question with your friends ($host/show/question/$insertedQuestion)",
            'questionsList' =>  $this->getRecentQuestionList(),
          ]);
        }else{
          // render view with failure message
          return view('quesAns/addQuestion',[
            'user'       => $userData,
            'randomId'   => [mt_rand(),mt_rand()],
            'status'     => 'danger',
            'message'    => 'Question Upload failed',
            'questionsList' =>  $this->getRecentQuestionList(),
          ]);
        }

    }

    public function uploadAndStoreFiles($files)
    {
      // get the current user Details
      $userData = $this->getUserDetails();
      // set the $insertedId as NULL
      $insertedId = NULL;
      // loop each files and insert it into the database and get the Id of the inserted image
      foreach($files as $file)
      {
          $path = Storage::putFile('/images', $file);
          $insertedId[] = DB::table('images')->insertGetId([
                            'text'      =>$file->getClientOriginalName(),
                            'source'    =>$path,
                            'user_id'   =>$userData->id,
                            'type'      =>$file->clientExtension(),
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=>date('Y-m-d H:i:s'),
                          ]);
      }
      // return the inserted Id of the images
      return $insertedId;
    }

    public function ShowQuestion($qid)
    {
      // get the question data
      $question = Question::where('qid', $qid)->where('enable', 1)->get();

      // the files associated with the question
      $imagesList = explode(",", $question[0]->image);

      $imageArray = null;
      $imageURLArray = null;

      foreach ($imagesList as $imageId)
      {
          $imageArray[] = DB::table('images')->where('id', $imageId)->get(['source','type']);
      }

      // var_dump($imageURLArray);die();

      return view('quesAns/showQuestion',[
        'user'       => $this->getUserDetails(),
        'question'   => $question,
        'images'     => $imageArray,
        'questionsList' =>  $this->getRecentQuestionList(),
        'point' => $this->getQuestionPoints($question[0]->id),
      ]);

    }

    public function ListQuestion()
    {
      // get the question data
      $question = Question::where('qid', $qid)->where('enable', 1)->get();

      // the files associated with the question
      $imagesList = explode(",", $question[0]->image);

      $imageArray = null;
      $imageURLArray = null;

      foreach ($imagesList as $imageId)
      {
          $imageArray[] = DB::table('images')->where('id', $imageId)->get(['source','type']);
      }

      // var_dump($imageURLArray);die();

      return view('quesAns/showQuestion',[
        'user'       => $this->getUserDetails(),
        'question'   => $question,
        'images'     => $imageArray,
      ]);

    }

    public function ListRecentQuestions()
    {
      // get the question data
      $question = Question::where('qid', $qid)->where('enable', 1)->get();

      // the files associated with the question
      $imagesList = explode(",", $question[0]->image);

      $imageArray = null;
      $imageURLArray = null;

      foreach ($imagesList as $imageId)
      {
          $imageArray[] = DB::table('images')->where('id', $imageId)->get(['source','type']);
      }

      // var_dump($imageURLArray);die();

      return view('quesAns/showQuestion',[
        'user'       => $this->getUserDetails(),
        'question'   => $question,
        'images'     => $imageArray,
      ]);

    }

    public function submitAnswer($qid,Request $request)
    {
      // validate the input data
      $validator = Validator::make($request->all(), [
          'ans'     => 'required|max:255',
      ])->validate();

      // get the user Details
      $userData = $this->getUserDetails();

      // get the question data
      $question = Question::where('qid', $qid)->where('enable', 1)->get();

      // get the Points
      $points = $this->getQuestionPoints($question[0]->id);

      // convert the string stored in the db to an array
      $answerList = explode(",", $question[0]->answer);
      if(in_array($request->ans,$answerList))
      {
        // Correct answer
        // log the answer
        $insertedQuestion = Answer::create([
            'user_id'    => $userData->id,
            'question_id'  => $question[0]->id,
            'answer'   => $request->ans,
            'result' => True,
            'note'  => 'correct answer',
            'points_awarded' => $points,
        ]);

        // update the user points
        $user_points = $userData->points + $points;

        Profile::where('id', $userData->id)->update(['points'=>$user_points]);

        session()->flash('msg', 'correct answer');
        return redirect()->back();
      }
      else
      {
        // Wrong answer
        // log the answer
        $insertedQuestion = Answer::create([
            'user_id'    => $userData->id,
            'question_id' => $question[0]->id,
            'answer'   => $request->ans,
            'result' => False,
            'note'  => 'wrong answer',
            'points_awarded' => 0,
        ]);
        session()->flash('msg', 'wrong answer');
        return redirect()->back();
      }
      // var_dump($answerList);die();
    }
}

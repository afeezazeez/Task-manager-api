<?php

namespace App\Http\Controllers;


use JWTAuth;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\SaveTaskForm;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;

class TaskController extends Controller
{
      protected $user;

      public function __construct(){
          $this->user = JWTAuth::user();
        
      }

      public function index(){
    	    return $this->user ;
        	$tasks = $this->user->tasks()->get(['title', 'description'])->toArray();
        	return $tasks;
  	  }

      public function store(SaveTaskForm $request){
    
            

            $task = new Task();
            $task->title = $request->title;
            $task->description = $request->description;

            if ($this->user->tasks()->save($task))
                return response()->json([
                    'success' => true,
                    'message' =>'Task Saved successfully' 
                ],200);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, task could not be added.'
            ], 500);
}


}

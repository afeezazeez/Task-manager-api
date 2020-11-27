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
    	    
        	$tasks = $this->user->tasks()->get(['title', 'description'])->toArray();
        	 return response()->json([
                    'success' => true,
                    'tasks' =>$tasks 
                ],200);
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


            public function show($id){
                
                $task = $this->user->tasks()->find($id);

                if (!$task) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry, task with id ' . $id . ' cannot be found.'
                    ], 400);
                }

                return response()->json([
                    'success' => true,
                    'task' => $task
                ], 200);
          } 



}

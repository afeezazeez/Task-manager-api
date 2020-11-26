<?php

namespace App\Http\Controllers;


use JWTAuth;
use App\Task;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;


class TaskController extends Controller
{
      protected $user;

      public function __construct(){
        
        
        
        try {

        	$this->user= JWTAuth::parseToken()->authenticate();
            
        } catch (\Exception $exception) {

            if($exception instanceof JWTException) {
        
            return response()->json([ 
              'message' => "Unauthorized"]
              , 401);
            }

            return response()->json([
                'success' => false,
                'message' => 'User not Authenticated'
            ], 500);
        }

      }

      public function index(){
    	
        	$tasks = $this->user->tasks()->get(['title', 'description'])->toArray();
        	return "user tasks";
  	  }


}

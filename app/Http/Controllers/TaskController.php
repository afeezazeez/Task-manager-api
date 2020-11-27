<?php

namespace App\Http\Controllers;


use JWTAuth;
use App\Task;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Auth;

class TaskController extends Controller
{
      protected $user;

      public function __construct(){
          $this->user = JWTAuth::user()->email;
        
      }

      public function index(){
    	    return $this->user ;
        	$tasks = $this->user->tasks()->get(['title', 'description'])->toArray();
        	return $tasks;
  	  }


}

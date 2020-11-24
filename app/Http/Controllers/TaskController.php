<?php

namespace App\Http\Controllers;


use JWTAuth;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
      protected $user;

      public function __construct(){
        $this->user = JWTAuth::parseToken()->authenticate();
      }
}

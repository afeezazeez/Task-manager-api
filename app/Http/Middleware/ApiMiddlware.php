<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;


class ApiMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenBlacklistedException) {
                return response()->json(['errors' => 'Token  has been blacklisted'], 401);
            } 
            
            else if ($e instanceof TokenInvalidException){
                return response()->json(['errors' => 'Token is Invalid'], 401);
            } 
            else if ($e instanceof TokenExpiredException){
                return response()->json(['errors' => 'Token is Expired'], 401);
            }
            else{
                return response()->json(['errors' => 'Authorization Token not found'], 401);
            }
        }
        return $next($request);

        
    }
}

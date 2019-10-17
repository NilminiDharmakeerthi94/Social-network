<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
//use Illuminate\Http\Controllers\UserController;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
// extends Middleware
class Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
/*    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
*/
    public function handle($request,Closure $next,$guard=null){
        if(Auth::guard($guard)->guest()){
            if($request->ajax()){
                return response('unauthorized.',401);
            }
            else{
                return redirect()->route('home');
            }
        }
        return $next($request);
    } 
    
}

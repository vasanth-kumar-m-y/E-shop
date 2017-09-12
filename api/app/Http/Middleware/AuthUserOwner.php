<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;

class AuthUserOwner
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();

        if(!$user) return $this->accessDeniedResponse();

        preg_match('/user\/(\d+)/', '/' . request()->path(), $matches);
        
        if($matches && $user->id != $matches[1]){
             return $this->accessDeniedResponse();
        }

        return $next($request);
    }

    protected function accessDeniedResponse()
    {
        return new JsonResponse(['code' => 403, 'message' => 'Access Denied', 'extra' => [] ], 403);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class Auth extends Controller
{

    public function postLogin()
    {
        $credentials = ['password' => request('password')];

        $loginId = request('login_id');
        if(\filter_var($loginId, FILTER_VALIDATE_EMAIL) !== false){
            $credentials['email'] = $loginId;
        } else {
            $credentials['username'] = $loginId;
        }

        return \Auth::attempt($credentials, request('remember_me')) ?
                    $this->getMe(\Auth::user()) 
                  : $this->errorJson('bad credentials', 1);
    }


    public function postLogout()
    {
        \Auth::logout();

        return ['status' => 'guest'];
    }


    public function getUser()
    {
        return \Auth::user() ?: $this->notFoundJson();
    }


    public function getMe($user)
    {
        if($user->hasRole('admin')){
            $role = 'admin';
        }
        if($user->hasRole('customer')){
            $role = 'customer';
        }

        return ['user' => $user, 'role' => $role];
    }
}

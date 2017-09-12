<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable as UserAuth;

class User extends Controller
{
    protected $pageLimit = 10;

    public function __construct()
    {
        //$this->middleware('guest', ['only' => ['store']]);
        //$this->middleware('auth', ['only' => ['update', 'destroy']]);
        //$this->middleware('auth.userOwner', ['only' => ['store', update', 'destroy']]);
    }

    public function index(Request $request)
    {
        $users = \App\Models\User::query()
            ->select(['id', 'username', 'first_name', 'last_name']);

        $count = $users->count();

        $users->forPage($request->input('page', 1), $this->pageLimit);

        return [
            "count" => $count,
            "limit" => $this->pageLimit,
            "page" => $request->input('page', 1),
            "items" => $users->get()
        ];
    }


    public function store()
    {
        $this->validateJson(request()->all(), $rules = [
            'username' => 'required|alpha_dash|min:3|max:20|unique:users,username',
            'first_name' => 'required|alpha|max:60',
            'last_name' => 'required|alpha|max:60',
            'email' => 'required|email|unique:users,email',
            'phone' => 'max:30',
            'password' => 'required|min:3|max:20|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = \App\Models\User::create(reqOnlyIfExists(array_keys($rules)));

        $user->roles()->attach(\App\Models\Role::where('name', 'customer')->first());

        return $user;
    }


    public function show($id)
    {
        $user = \App\Models\User::find($id) ?: $this->notFoundJson();
        
        $query = \App\Models\User::query();

        if($user != null && $user['id'] == $id)
             $query->select('id', 'username', 'first_name', 'last_name', 'email', 'phone');
        else $query->select(['id', 'username', 'first_name', 'last_name']);
            
        return $query->find($id) ?: $this->notFoundJson();
    }


    public function update($id)
    {
        $user = \App\Models\User::find($id) ?: $this->notFoundJson();

        $this->validateJson(request()->all(), $rules = [
            'first_name' => 'alpha|max:60',
            'last_name' => 'alpha|max:60',
            'email' => 'email|unique:users,email,'.$id.',id',
            'phone' => 'max:30',
            'password' => 'sometimes|required|min:3|max:20|confirmed',
            'password_confirmation' => 'sometimes|required',
        ]);

        $user->update(reqOnlyIfExists(array_keys($rules)));

        return $user;
    }


    public function destroy($id)
    {
        $user = \App\Models\User::find($id) ?: $this->notFoundJson();

        $user->delete();

        return ['status' => 'deleted'];
    }
}

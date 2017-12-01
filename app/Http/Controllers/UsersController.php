<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index()
    {
        if (request()->wantsJson()) {
            return User::all();
        }

        return view("users.index", [
            'users' => User::all(),
        ]);
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'chat_id' => 'required | unique:users,chat_id,' . $user->id,
            'token' => 'required',
        ]);
        $user->update($request->only('chat_id', 'token'));
        return response("success", 200);
    }

}

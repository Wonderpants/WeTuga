<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    {
        if (Auth::user()->email == request('email')) {

            $this->validate(request(), [
//                    'name' => 'required',
//                    'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ]);

//            $user->name = request('name');
//            $user->email = request('email');
            $user->password = bcrypt(request('password'));

            $user->update();

            return back();

        } else {

            try {
                $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6|confirmed'
                ]);
            } catch (ValidationException $e) {
            }

            $user->name = request('name');
            $user->email = request('email');
            $user->password = bcrypt(request('password'));

            $user->update();

            return back();

        }
    }
}

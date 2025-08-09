<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(){
        // validate

        $validated = request()->validate([
            'first_name'=> ['required'],
            'last_name'=> ['required'],
            'email'=> ['required', 'email'],
            'password'=> ['required', Password::min(6), 'confirmed']
        ]);
        // create user in db

        $user = User::create($validated);
        // login

        Auth::login($user);
        // redirect to dashboard
        return redirect('/jobs');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use illuminate\http\Response;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function signup(SignupRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create($validatedData);
    

        return response()->json([
            'message' => 'User created successfully', 
            'user' => $user,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        

        if (!Auth::attempt($validatedData)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
        $user = User::where('email', $validatedData['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }
}
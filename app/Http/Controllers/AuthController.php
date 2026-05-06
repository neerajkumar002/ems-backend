<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        //create user
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),

        ]);

        //generate token
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only("email", "password"))) {
            return response()->json(["message" => "Invaild Credentials"], 401);
        }

        $user = Auth::user();

        //create token
        $token = $user->createToken("auth_token")->plainTextToken;


        return response()->json([
            "user" => $user,
            "token" => $token,
        ]);
    }


    // logout 
    public function logout(Request $request)
    {
        // delete current device token
        // $request->user()->currentAccessToken()->delete();

        //delete all device tokens
        $request->user()->tokens()->delete();

        return response()->json(["message" => "Logged out successfully"]);
    }
}

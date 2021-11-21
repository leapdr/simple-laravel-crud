<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class CustomAuthController extends Controller
{
    /**
     * User registration
     */
    public function register(Request $request){
        $data = $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'email' => 'required|string|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username'  => $data['username'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);

        $tokenString = Hash::make($data['username'] . "|" . Carbon::now()->format('YmdHis'));
        $token = $user->createToken($tokenString)->plainTextToken;

        $response = [
            'user'  => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }

    /**
     * Logout user from API
     */
    public function logoutAPI(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out',
        ];
    }

    /**
     * Logout user from UI
     */
    public function logout(){
        # remove user token
        auth()->user()->tokens()->delete();

        # return to login
    }

    /**
     * User login
     */
    public function login(Request $request){
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $data['username'])->first();
        if(!$user){
            $user = User::where('email', $data['email'])->first();
        }

        if( !$user || !Hash::check($data['password'], $user->password) ) {
            return response([
                'message' => 'Login failed. Incorrect username or password'
            ], 401);
        }

        $tokenString = Hash::make($data['username'] . "|" . Carbon::now()->format('YmdHis'));
        $token = $user->createToken($tokenString)->plainTextToken;

        $response = [
            'user'  => $user->username,
            'token' => $token,
        ];

        return response($response, 201);
    }
}

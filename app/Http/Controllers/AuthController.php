<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{    

    public function register(StoreUserRequest $request){

        if($request->password !== $request->password_confirmation){
            return response()->json([
                'message' => "Passwords dont't match", 
                'status' => 400
            ], 400);
        }

        $defaultRole =  Role::where('name', 'USER')->get();

        $newUser = User::create([
            'name' => $request->name,
            'role_id' => $defaultRole[0]->id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $newUser->createToken('access_token');

        $newUser['token'] = $token->plainTextToken;
        return response()->json([
            'message' => "OK", 
            'status' => 201,
            'data' => $newUser
        ], 201);


    }

    public function login(LoginRequest $request){
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();
        $token = $user->createToken('access_token');
        $user['token'] = $token->plainTextToken;
            
        return response()->json($user, 200);
    }

}

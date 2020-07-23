<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function login(Request $request) {
        $user = User::whereEmail($request->email)->first();
        if(!is_null($user) && Hash::check($request->password, $user->password))
        {
            $token = $user->createToken('Business')->accessToken;

            return response()->json([
                'status' => true,
                'token'  => $token,
                'message' => 'Successful login'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Wrong email or password'
            ], 200);
        }
    }
}

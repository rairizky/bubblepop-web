<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller {

    public function login(Request $request) {

        $validation = Validator::make($request->only('email', 'password'), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validation->errors(),
            ], 400);
        } else {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = User::where('email', $request->get('email'))->first();
                if ($user->role != "user") {
                    return response()->json([
                        'status' => false,
                        'message' => 'you are not authorized',
                    ], 403);
                } else {
                    return response()->json([
                        'status' => true,
                        'message' => 'login success',
                        'user' => $user,
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'credentials not match'
                ], 200);
            }
    
        }
    }

    public function register(Request $request) {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validation->errors(),
            ], 400);
        } else {
            $post = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'role' => 'user',
            ]);
            if ($post) {
                $user = User::where('email', $post->email)->first();
                return response()->json([
                    'status' => true,
                    'message' => 'create account successfully',
                    'user' => $user,
                ], 201);
            }
        }
    }
}

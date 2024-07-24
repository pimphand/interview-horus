<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ], [
            'username.exists' => 'Username tidak ditemukan',
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ])->validate();

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return response()->json([
                'error' => 'Username tidak ditemukan'
            ], 404);
        }

        if (!password_verify($request->password, $user->password)) {
            return response()->json([
                'error' => 'Password salah'
            ], 401);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
        ], [
            'username.unique' => 'Username sudah terdaftar',
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'name' =>  'Nama wajib diisi',
        ])->validate();

        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $user,
        ], 201);
    }
}

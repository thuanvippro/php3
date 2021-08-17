<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRequest $request){
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user =  User::create($validated);
        $user->assignRole("nguoi dung");
        return response()->json(["user" => $user, 'msg' => 'đăng kí thành công'], 200);
    }
    public function login(AuthLoginRequest $request){
        $validated = $request->validated();
        if(Auth::attempt($validated)){
            $user = Auth::user();
            $token = $user->createToken("apiAuth")->accessToken;
            return response()->json(['user' => $user, 'token' => $token, 'msg' => 'đăng nhập thành công'], 200);
        }else{
            return response()->json(['msg' => 'đăng nhập thất bại'], 211);
        }
    }
}

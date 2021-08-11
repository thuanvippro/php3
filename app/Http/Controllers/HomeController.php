<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class HomeController extends Controller
{
    public function index(){
        return view('home');
    }
    public function formLogin(){
        return view('auth.login');
    }
    public function login(Request $request){
        $request->validate(
            [
                'email' => "required|email",
                'password' => "required"
            ],
            [
                'email.required' => "hay nhập email",
                'email.email' => "email k dung dinh dang",
                'password.required' => "hay nhập mk",
            ]
        );
        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password])){
            return redirect(route('listProduct'));
        }else{
            return redirect()->back()->with('msg', 'tài khoản hoặc mật khẩu không đúng');
        }
    }
}

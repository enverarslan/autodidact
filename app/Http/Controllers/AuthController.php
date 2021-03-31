<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }

    public function login_attempt(LoginRequest $request){

        $authenticated = Auth::guard('web')->attempt($request->only(['email', 'password']), $request->get('remember', false));

        if ($authenticated){
            return redirect('/');
        }

        $errors = new MessageBag(['login' => ['Email and/or password invalid.']]);
        return redirect()->back()->withErrors($errors)->withInput($request->except('password'));
    }

    public function register_attempt(RegisterRequest $request){

        try{
            $user = User::create($request->all());
            Auth::login($user);
            return redirect('/');
        }catch (\Exception $e){
            $errors = new MessageBag(['register' => ["Unexpected problem: {$e->getMessage()}"]]);
            return redirect()->back()->withErrors($errors)->withInput($request->except('password'));
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        session()->flush();
        return redirect()->route('auth.login');
    }

}

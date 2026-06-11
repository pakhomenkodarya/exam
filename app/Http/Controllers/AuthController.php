<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Appointment;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth.register');
    }
    public function register(Request $request){
        $request->validate([
        'login'=>'required|regex:/^[a-zA-Z0-9]+$/|min:6|unique:users',
        'password'=>'required|min:8',
        'name'=>'required|',
        'date'=>'required|',
        'tel'=>'required|',
        'email'=>'required|',
        ],[
        'login.required'=>'Введите логин',
        'login.regex'=>'Логин: латиница и цифры',
        'login.min'=>'Логин минимум 6 символов',
        'login.unique'=>'Логин не уникален',
        'password.required'=>'Введите пароль',
        'password.min'=>'Пароль имнимум 8 символов',
        'name.required'=>'Введите ФИО',
        'date.required'=>'Введите дату рождения',
        'tel.required'=>'Введите телефон',
        'email.required'=>'Введите email',
        ]);
        $user=User::create([
        'login'=>$request->login,
        'password'=>Hash::make($request->password),
        'name'=>$request->name,
        'date'=>$request->date,
        'tel'=>$request->tel,
        'email'=>$request->email,
        'role'=>'user',
        ]);
        Auth::login($user);
        return redirect()->route('appointments.index')->with('success','Вы зарегистрированы');
    }
    public function showLogin(){
        return view('auth.login');
    }
    public function login(Request $request){
        $data=$request->validate([
        'login'=>'required',
        'password'=>'required',
        ],[
        'login.required'=>'Введите логин',
        'password.required'=>'Введите пароль',
        ]);
       if(Auth::attempt([
        'login'=>$data['login'],
        'password'=>$data['password'],
       ])){
        $request->session()->regenerate();
        if(Auth::user()->role==='admin'){
        return redirect()->route('admin.index')->with('success','Вы вошли в админ-панель');
        }else{
            return redirect()->route('appointments.index')->with('success','Вы вошли в аккаунт');
        }
       }
        return back()->withErrors(['login'=>'Неверный логин или пароль']);
    }
    public function logout(Request $request){
        Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('welcome')->with('success','Вы вышли из аккаунта');
    }
}

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
    public function showLogin(){
        return view('auth.login');
    }
}

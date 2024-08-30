<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    public function login(){
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        $messages = [
            'userID.required' => 'User ID wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.max' => 'Maximal Kata Sandi 10 Karakter',
            'password.min' => 'Maximal Kata Sandi 3 Karakter'
        ];
    
        Validator::make($request->all(), [
            'userID' => 'required|string',
            'password' => 'required|max:10|min:3'
        ], $messages)->validate();

        $credentials = [
            'userID' => $request->input('userID'),
            'password' => $request->input('password')
        ];
    
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'userID' => 'User ID atau kata sandi salah.',
            ]);
        }

        // Autentikasi user
        $user = Auth::user();
        $request->session()->regenerate();
    
        // Redirect berdasarkan level pengguna
        if ($user->Level == 'Admin') {
            return redirect()->route('usi.index');
        } elseif ($user->Level == 'Visitor') {
            return redirect()->route('user.index');
        } else {
            return redirect()->route('home');
        }
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

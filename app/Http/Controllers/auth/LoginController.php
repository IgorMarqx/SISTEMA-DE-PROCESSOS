<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login_action(Request $request)
    {
        $data = $request->only('email', 'password');

        $validator = Validator::make(
            $data,
            [
                'email' => ['required', 'email'],
                'password' => ['required', 'min:5'],
            ],
            [
                'email.required' => 'Insira seu e-mail',
                'email.email' => 'Preencha o campo com um e-mail válido.',

                'password.required' => 'Insira sua senha',
                'password.min' => 'Tamanho minimo 5 caracteres',
            ]
        );

        if (Auth::attempt($data)) {
            return redirect()->route('welcome');
        } else {
            $validator->errors()->add('email', 'E-mail ou senha incorretos');

            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}

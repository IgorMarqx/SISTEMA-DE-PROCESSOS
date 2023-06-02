<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LawyerController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only('lawyer', 'emailLaw', 'password', 'password_confirmation', 'OAB', 'CPF', 'admin');

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $data['lawyer'],
            'email' => $data['emailLaw'],
            'password' => Hash::make($data['password']),
            'oab' => $data['OAB'],
            'cpf' => $data['CPF'],
            'admin' => $data['admin'],
        ]);
        $user->save();

        session()->flash('success', 'Advogado criado com sucesso.');
        return redirect()->back();
    }

    public function validator($data)
    {
        return Validator::make(
            $data,
            [
                'lawyer' => ['required'],
                'emailLaw' => ['required', 'unique:users,email'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
                'OAB' => ['required', 'unique:users'],
                'CPF' => ['required', 'unique:users'],
            ],
            [
                'lawyer.required' => 'Preencha esse campo.',

                'password.required' => 'Preencha esse campo.',
                'password.confirmed' => 'Senhas não coincidem.',
                'password.min' => 'Tamanho minimo de 5 caracteres.',

                'emailLaw.required' => 'Preencha esse campo.',
                'emailLaw.email' => 'Insira um e-mail válido.',
                'emailLaw.unique' => 'Já existe esse e-mail.',

                'OAB.required' => 'Preencha esse campo.',
                'OAB.unique' => 'Já existe essa OAB.',

                'CPF.required' => 'Preencha esse campo.',
                'CPF.unique' => 'Já existe esse CPF.',
            ]
        );
    }
}

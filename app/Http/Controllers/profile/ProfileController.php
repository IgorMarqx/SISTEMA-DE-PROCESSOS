<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeCollective;
use App\Models\AdministrativeIndividual;
use App\Models\JudicialCollective;
use App\Models\JudicialIndividual;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $loggedId = auth()->user()->id;

        $judicial_collective = JudicialCollective::where('user_id', $loggedId)->count();
        $judicial_individual = JudicialIndividual::where('user_id', $loggedId)->count();

        $adm_collective = AdministrativeCollective::where('user_id', $loggedId)->count();
        $adm_individual = AdministrativeIndividual::where('user_id', $loggedId)->count();

        $count_judicial = ($judicial_collective + $judicial_individual);
        $count_adm = ($adm_collective + $adm_individual);

        return view('admin.profiles.profile', [
            'count_adm' => $count_adm,
            'count_judicial' => $count_judicial,
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $data = $request->only('id', 'name', 'email', 'password', 'password_confirmation');

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($user->email !== $data['email']) {
            $hasEmail = User::where('email', $request->email)->get();

            if (count($hasEmail) == 0) {
                $user->email = $request->email;
            } else {
                $validator->errors()->add('email', 'Esse e-mail já existe.');
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if (!empty($data['password'])) {
            if (strlen($data['password']) >= 5) {
                if ($data['password'] === $data['password_confirmation']) {
                    $user->password = Hash::make($data['password']);
                } else {
                    $validator->errors()->add('password', 'Senhas não coincidem.');
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            } else {
                $validator->errors()->add('password', 'No minimo 5 caracteres.');
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $user->name = $data['name'];
        $user->save();

        session()->flash('success', 'Perfil atualizado com sucesso.');
        return redirect()->back();
    }

    public function validator($data)
    {
        return Validator::make($data, [
            'name' => ['required', 'max:100'],
            'email' => ['required'],
        ],
        [
            'name.required' => 'Preencha esse campo.',
            'name.max' => 'Máximo 100 caracteres.',

            'email.required' => 'Preencha esse campo.',
        ]
    );
    }
}

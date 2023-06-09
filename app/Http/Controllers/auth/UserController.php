<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeCollective;
use App\Models\AdministrativeIndividual;
use App\Models\JudicialCollective;
use App\Models\JudicialIndividual;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manager-lawyer');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(7);
        $loggedId = User::find(intval(Auth::id()));

        $userCount = User::count();
        $userAdminCount = User::where('admin', 1)->count();
        $userLawyerCount = User::where('admin', 2)->count();
        $userBrandCount = User::where('admin', 3)->count();

        return view('admin.users.users', [
            'users' => $users,
            'loggedId' => $loggedId,
            'userCount' => $userCount,

            'userAdminCount' => $userAdminCount,
            'userLawyerCount' => $userLawyerCount,
            'userBrandCount' => $userBrandCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loggedId = User::find(intval(Auth::id()));

        return view('admin.users.create', [
            'loggedId' => $loggedId,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only('name', 'email', 'organ', 'office', 'capacity', 'telephone', 'cpf', 'oab', 'password', 'password_confirmation', 'admin');

        $validator = $this->validator($data);

        if ($data['admin'] == 'error') {
            $validator->errors()->add('admin', 'Escolha uma opção');

            return redirect()->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }


        if ($validator->fails()) {
            return redirect()->route('users.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'admin' => $data['admin'],
            'organ' => $data['organ'],
            'office' => $data['office'],
            'capacity' => $data['capacity'],
            'telephone' => $data['telephone'],
            'cpf' => $data['cpf'],
            'oab' => $data['oab'],
        ]);
        $user->save();

        session()->flash('success', 'Usuário criado com sucesso.');
        return redirect()->route('users.index');
    }

    public function storeModal(Request $request)
    {
        $data = $request->only('name', 'email', 'organ', 'office', 'capacity', 'telephone', 'password', 'password_confirmation', 'admin');

        $validator = $this->modalValidator($data);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'admin' => $data['admin'],
            'organ' => $data['organ'],
            'office' => $data['office'],
            'capacity' => $data['capacity'],
            'telephone' => $data['telephone']
        ]);
        $user->save();


        session()->flash('success', 'Usuário criado com sucesso.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        return view('admin.users.details', [
            'users' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $loggedId = User::find(intval(Auth::id($id)));

        if ($user) {
            return view('admin.users.edit', [
                'users' => $user,
                'loggedId' => $loggedId,
            ]);
        }

        return redirect()->route('users.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if ($user) {
            $data = $request->only('name', 'email', 'organ', 'office', 'cpf', 'oab', 'capacity', 'telephone', 'password', 'password_confirmation', 'admin');

            $validator = $this->validatorUpdate($data);

            if ($validator->fails()) {
                return redirect()->route('users.edit', ['user' => $id])->withErrors($validator);
            }

            $user->name = $data['name'];
            $user->organ = $data['organ'];
            $user->office =  $data['office'];
            $user->capacity = $data['capacity'];
            $user->telephone = $data['telephone'];

            if ($user->email !== $data['email']) {
                $hasEmail = User::where('email', $data['email'])->get();

                if (count($hasEmail) == 0) {
                    $user->email = $data['email'];
                } else {
                    $validator->errors()->add('email', 'Já possui e-mail cadastrado.');
                }
            }

            if (!empty($data['password'])) {
                if (strlen($data['password']) >= 5) {
                    if ($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    } else {
                        $validator->errors()->add('password', 'Senhas não correspondem.');
                    }
                } else {
                    $validator->errors()->add('password', 'No minimo 5 caracteres.');
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('users.edit', ['user' => $id])->withErrors($validator);
            }

            $user->admin = $data['admin'];
            $user->touch();
            $user->save();
        }

        session()->flash('success', 'Usuário atualizado com sucesso.');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loggedId = intval(Auth::id());

        if ($loggedId != intval($id)) {
            $user = User::find($id);
            $judicialCollective = JudicialCollective::where('user_id', $user->id);
            $admCollective = AdministrativeCollective::where('user_id', $user->id);

            $judicialIndividual = JudicialIndividual::where('user_id', $user->id);
            $admIndividual = AdministrativeIndividual::where('user_id', $user->id);

            $user->delete();

            $judicialCollective->delete();
            $admCollective->delete();

            $judicialIndividual->delete();
            $admIndividual->delete();
        }

        session()->flash('success', 'Usuário deletado com sucesso.');
        return redirect()->route('users.index');
    }

    public function modalValidator($data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'string', 'max:100', 'unique:users'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
                'organ' => ['required', 'string'],
                'office' =>  ['required', 'string'],
                'capacity' =>  ['required', 'string'],
                'telephone' =>  ['required', 'min:15'],
            ],
            [
                'name.required' => 'Preencha esse campo.',
                'name.max' => 'Máximo 100 caracteres.',

                'email.required' => 'Preencha esse campo.',
                'email.email' => 'Preencha o campo com um e-mail válido.',
                'email.max' => 'Máximo 100 caracteres.',
                'email.unique' => 'Já possui um e-mail como esse.',

                'password.required' => 'Preencha esse campo.',
                'password.min' => 'Minimo 5 caracteres.',
                'password.confirmed' => 'Senhas não coincidem.',

                'organ.required' => 'Preencha esse campo',
                'office.required' => 'Preencha esse campo',
                'capacity.required' => 'Preencha esse campo',

                'telephone.required' => 'Preencha esse campo',
                'telephone.min' => 'Número inválido.',
            ]
        );
    }

    public function validator($data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'min:5', 'string', 'max:100'],
                'email' => ['required', 'email', 'string', 'max:100', 'unique:users'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
                'telephone' => 'required_if:admin,2,3,0 | min:15',
                'cpf' => [
                    'required_if:admin,2',
                    'nullable',
                    'min:14',
                ],
                'oab' => 'required_if:admin,2',
                'organ' => 'required_if:admin,3,0',
                'office' => 'required_if:admin,3,0',
                'capacity' => 'required_if:admin,3,0',
            ],
            [
                'name.required' => 'Preencha esse campo.',
                'name.min' => 'Minimo 5 caracteres.',
                'name.max' => 'Máximo 100 caracteres.',

                'email.required' => 'Preencha esse campo.',
                'email.email' => 'Preencha o campo com um e-mail válido.',
                'email.max' => 'Máximo 100 caracteres.',
                'email.unique' => 'Já possui um e-mail como esse.',

                'password.required' => 'Preencha esse campo.',
                'password.min' => 'Minimo 5 caracteres.',
                'password.confirmed' => 'Senhas não coincidem.',

                'telephone.required_if' => 'Preencha esse campo.',
                'telephone.min' => 'Informe um telefone válido.',

                'cpf.required_if' => 'Preencha esse campo.',
                'cpf.min' => 'Informe um CPF válido.',

                'oab.required_if' => 'Preencha esse campo.',

                'organ' => 'Preencha esse campo.',
                'office' => 'Preencha esse campo.',
                'capacity' => 'Preencha esse campo.',
            ]
        );
    }

    public function validatorUpdate($data)
    {
        return Validator::make(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'admin' => $data['admin'],
                'organ' => $data['organ'],
                'office' => $data['office'],
                'capacity' => $data['capacity'],
                'telephone' => $data['telephone'],
                'cpf' => $data['cpf'],
                'oab' => $data['oab'],
            ],
            [
                'name' => ['required', 'min:5', 'string', 'max:100'],
                'email' => ['required', 'email', 'string', 'max:100'],
                'telephone' => 'required_if:admin,2,3,0 | min:15',
                'cpf' => [
                    'required_if:admin,2',
                    'nullable',
                    'min:14',
                ],
                'oab' => 'required_if:admin,2',
                'organ' => 'required_if:admin,3,0',
                'office' => 'required_if:admin,3,0',
                'capacity' => 'required_if:admin,3,0',
            ],
            [
                'name.required' => 'Preencha esse campo.',
                'name.min' => 'Minimo 5 caracteres.',
                'name.max' => 'Máximo 100 caracteres.',

                'email.required' => 'Preencha esse campo.',
                'email.email' => 'Preencha o campo com um e-mail válido.',
                'email.max' => 'Máximo 100 caracteres.',

                'telephone.required_if' => 'Preencha esse campo.',
                'telephone.min' => 'Informe um telefone válido.',

                'cpf.required_if' => 'Preencha esse campo.',
                'cpf.min' => 'Informe um CPF válido.',

                'oab.required_if' => 'Preencha esse campo.',

                'organ' => 'Preencha esse campo.',
                'office' => 'Preencha esse campo.',
                'capacity' => 'Preencha esse campo.',
            ]
        );
    }
}

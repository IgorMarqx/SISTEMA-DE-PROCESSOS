<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Proccess;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manager-users');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        $loggedId = intval(Auth::id());

        $userCount = User::count();
        $userAdminCount = User::where('admin', '=', '1')->count();

        return view('admin.users.users', [
            'users' => $users,
            'loggedId' => $loggedId,
            'userCount' => $userCount,
            'userAdminCount' => $userAdminCount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only('name', 'email', 'admin',  'password', 'password_confirmation');

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
        ]);
        $user->save();

        session()->flash('success', 'Usuário criado com sucesso.');
        return redirect()->route('users.index');
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

        if ($user) {
            return view('admin.users.edit', [
                'users' => $user,
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
            $data = $request->only('name', 'email', 'admin', 'password', 'password_confirmation');

            $validator = $this->validatorUpdate($data);

            if ($validator->fails()) {
                return redirect()->route('users.edit', ['user' => $id])->withErrors($validator);
            }

            $user->name = $data['name'];

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
            $proccess = Proccess::where('user_id', $user->id);

            $user->delete();
            $proccess->delete();
        }

        session()->flash('success', 'Usuário deletado com sucesso.');
        return redirect()->route('users.index');
    }

    public function validator($data)
    {
        return Validator::make(
            $data,
            [
                'name' => ['required', 'min:5', 'string', 'max:100'],
                'email' => ['required', 'email', 'string', 'max:100', 'unique:users'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
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
            ],
            [
                'name' => ['required', 'min:5', 'string', 'max:100'],
                'email' => ['required', 'email', 'string', 'max:100'],
            ],
            [
                'name.required' => 'Preencha esse campo.',
                'name.min' => 'Minimo 5 caracteres.',
                'name.max' => 'Máximo 100 caracteres.',

                'email.required' => 'Preencha esse campo.',
                'email.email' => 'Preencha o campo com um e-mail válido.',
                'email.max' => 'Máximo 100 caracteres.',
            ]
        );
    }
}

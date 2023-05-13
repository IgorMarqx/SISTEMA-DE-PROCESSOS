<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Proccess;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProccessController extends Controller
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
        $proccess = Proccess::paginate(7);

        $proccess_count = Proccess::count('id');

        $progress_proccess_count = Proccess::where('progress_proccess', '=', '1')->count();
        $finish_proccess_count = Proccess::where('finish_proccess', '=', '1')->count();
        $update_proccess_count = Proccess::where('update_proccess', '=', '1')->count();


        return view('admin.proccess.proccess', [
            'proccess' => $proccess,
            'proccessCount' => $proccess_count,
            'progressCount' => $progress_proccess_count,
            'finishCount' => $finish_proccess_count,
            'updateCount' => $update_proccess_count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::all();


        return view('admin.proccess.create', [
            'users' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->only(['proccess', 'user_id', 'url', 'email_corp', 'email_client', 'progress_proccess']);
        $progress = $data['progress_proccess'];

        $validator = $this->validator($data);

        if ($data['user_id'] == 'error') {
            $validator->errors()->add('user_id', 'Escolha um cliente');

            return redirect()->route('proccess.create')
                ->withErrors($validator)
                ->withInput();
        }

        if ($validator->fails()) {
            return redirect()->route('proccess.create')
                ->withErrors($validator)
                ->withInput();
        }

        $proccess = Proccess::create([
            'name' => $data['proccess'],
            'user_id' => $data['user_id'],
            'url_proccess' => $data['url'],
            'email_coorporative' => $data['email_corp'],
            'email_client' => $data['email_client'],
            'progress_proccess' => intval($progress),
        ]);
        $proccess->save();

        session()->flash('success', 'Processo criado com sucesso.');
        return redirect()->route('proccess.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd($id);
    }

    public function finish(string $id)
    {
        session()->flash('success', 'Processo finalizado com sucesso.');
        return redirect()->route('proccess.index');
    }

    public function validator($data)
    {
        return Validator::make(
            $data,
            [
                'proccess' => ['required', 'max:100'],
                'url' => ['active_url', 'max:2048'],
                'email_corp' => ['required', 'max:100', 'email'],
                'email_client' => ['required', 'max:100', 'email'],
            ],
            [
                'proccess.required' => 'Preencha esse campo.',
                'proccess.max' => 'Máximo de 100 caracteres.',

                'url.active_url' => 'Informe uma URL válida.',
                'url.max' => 'Máximo de 2048 caracteres.',

                'email_corp.required' => 'Preencha esse campo.',
                'email_corp.max' => 'Máximo de 100 caracteres.',
                'email_corp.email' => 'Informe um e-mail válido.',

                'email_client.required' => 'Preencha esse campo.',
                'email_client.max' => 'Máximo de 100 caracteres.',
                'email_client.email' => 'Informe um e-mail válido.',
            ]
        );
    }
}

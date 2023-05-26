<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeIndividual;
use App\Models\JudicialIndividual;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndividualController extends Controller
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
        $individual = JudicialIndividual::paginate(7);

        $individual_count =  JudicialIndividual::count();

        $progress_count = JudicialIndividual::where('progress_individuals', 1)->count();
        $update_count = JudicialIndividual::where('update_individuals', 1)->count();
        $finish_count = JudicialIndividual::where('finish_individuals', 1)->count();

        return view('admin.individual.judicial.index', [
            'individual' => $individual,

            'individual_count' => $individual_count,
            'progress_count' => $progress_count,
            'update_count' => $update_count,
            'finish_count' => $finish_count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::where('admin', 0)->get();

        return view('admin.individual.judicial.create', [
            'users' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->type == 1) {
            $data = $request->only('progress_individuals', 'individuals', 'user_id', 'url', 'email_corp', 'email_client', 'type', 'action_type');
            $progress = $data['progress_individuals'];

            $validator = $this->validator($data);

            if ($data['type'] == 'error') {
                $validator->errors()->add('type', 'Escolha um tipo de processo.');

                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($data['action_type'] == 'error') {
                $validator->errors()->add('action_type', 'Escolha uma opção.');

                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($data['user_id'] == 'error') {
                $validator->errors()->add('user_id', 'Escolha um cliente.');

                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $individual = JudicialIndividual::create([
                'name' => $data['individuals'],
                'user_id' => $data['user_id'],
                'url_individuals' => $data['url'],
                'email_coorporative' => $data['email_corp'],
                'email_client' => $data['email_client'],
                'progress_individuals' => $data['progress_individuals'],
                'action_type' => $data['action_type']
            ]);
            $individual->save();

            session()->flash('success', 'Processo criado com sucesso.');
            return redirect()->route('individual.index');
        } else {
            $data = $request->only('progress_individuals', 'individuals', 'user_id', 'url', 'email_corp', 'email_client', 'type', 'action_type');
            $progress = $data['progress_individuals'];

            $validator = $this->validator($data);

            if ($data['type'] == 'error') {
                $validator->errors()->add('type', 'Escolha um tipo de processo.');

                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($data['action_type'] == 'error') {
                $validator->errors()->add('action_type', 'Escolha uma opção.');

                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($data['user_id'] == 'error') {
                $validator->errors()->add('user_id', 'Escolha um cliente.');

                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $individual = AdministrativeIndividual::create([
                'name' => $data['individuals'],
                'user_id' => $data['user_id'],
                'url_individuals' => $data['url'],
                'email_coorporative' => $data['email_corp'],
                'email_client' => $data['email_client'],
                'progress_individuals' => $data['progress_individuals'],
                'action_type' => $data['action_type']
            ]);
            $individual->save();

            session()->flash('success', 'Processo criado com sucesso.');
            return redirect()->route('administrative_individual.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    public function validator($data)
    {
        return Validator::make(
            $data,
            [
                'individuals' => ['required', 'max:100'],
                'url' => ['max:2048'],
                'email_corp' => ['required', 'max:100', 'email'],
                'email_client' => ['max:100'],
            ],
            [
                'individuals.required' => 'Preencha esse campo.',
                'individuals.max' => 'Máximo de 100 caracteres.',

                'url.max' => 'Máximo de 2048 caracteres.',

                'email_corp.required' => 'Preencha esse campo.',
                'email_corp.max' => 'Máximo de 100 caracteres.',
                'email_corp.email' => 'Informe um e-mail válido.',

                'email_client.max' => 'Máximo de 100 caracteres.',
                'email_client.unique' => 'Já existe um e-mail como esse.',
            ]
        );
    }
}

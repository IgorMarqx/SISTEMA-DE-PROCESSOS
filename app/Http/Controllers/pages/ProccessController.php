<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Proccess;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $loggedId = intval(Auth::id());

        $proccess_count = Proccess::count('id');

        $progress_proccess_count = Proccess::where('progress_proccess', '=', '1')->count();
        $finish_proccess_count = Proccess::where('finish_proccess', '=', '1')->count();
        $update_proccess_count = Proccess::where('update_proccess', '=', '1')->count();


        return view('admin.proccess.proccess', [
            'proccess' => $proccess,
            'loggedId' => $loggedId,

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
        $proccess = Proccess::find($id);
        $user = $proccess->user;
        $attachment = Attachment::where('proccess_id', '=', $id)->get();

        return view('admin.proccess.details', [
            'proccess' => $proccess,
            'user' => $user,
            'attachment' => $attachment
        ]);
    }

    public function attachment(Request $request, string $id)
    {
        if ($request->file == "") {
            session()->flash('error', 'Arquivo não encontrado.');
            return redirect()->route('proccess.show', ['proccess' => $id]);
        } else {
            $originalName = $request->file('file')->getClientOriginalName();

            $attachment = Attachment::create([
                'title' => $originalName,
                'proccess_id' => $request->proccess_id,
                'user_id' => $request->user_id,
                'path' => $request->file('file')->store(),
            ]);
        }
        $attachment->save();

        session()->flash('success', 'Anexado com sucesso.');
        return redirect()->route('proccess.show', ['proccess' => $id]);
    }

    public function deletAttachment(Request $request, string $id)
    {
        $attachment = Attachment::find($id);

        if ($attachment) {
            $attachment->delete();
        }

        session()->flash('success', 'Anexo deletado com sucesso.');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proccess = Proccess::find($id);
        $user = User::all();

        if ($proccess) {
            return view('admin.proccess.edit', [
                'proccess' => $proccess,
                'users' => $user,
            ]);
        }

        session()->flash('warning', 'Usuário não encontrado.');
        return redirect()->route('proccess.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proccess = Proccess::find($id);

        if ($proccess) {
            $data = $request->only('proccess', 'url', 'email_corp', 'email_client', 'user_id', 'status');

            $validator = $this->validator($data);

            if ($validator->fails()) {
                return redirect()->route('proccess.edit', ['proccess' => $proccess])->withErrors($validator);
            }

            $proccess->name = $data['proccess'];

            if ($proccess->email_client !== $data['email_client']) {
                $hasEmail = Proccess::where('email_client', $data['email_client'])->get();

                if (count($hasEmail) == 0) {
                    $proccess->email_client = $data['email_client'];
                } else {
                    $validator->errors()->add('email', 'Já existe um e-mail com esse.');
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('proccess.edit', ['proccess' => $id])->withErrors($validator);
            }

            if ($data['status'] == 1) {
                $proccess->finish_proccess = 0;
                $proccess->progress_proccess = 0;
                $proccess->reopen_proccess = 0;
                $proccess->update_proccess = 1;

                $proccess->qtd_update += 1;
                session()->flash('success', 'Processo Atualizado com sucesso.');
            } else if ($data['status'] == 2) {

                if ($proccess->finish_proccess == 1) {
                    session()->flash('error', 'Esse processo ja foi finalizado.');
                    return redirect()->route('proccess.index');
                }

                $proccess->progress_proccess = 0;
                $proccess->update_proccess = 0;
                $proccess->reopen_proccess = 0;
                $proccess->finish_proccess = 1;

                $proccess->qtd_finish += 1;
                session()->flash('success', 'Processo Finalizado com sucesso.');
            } else if ($data['status'] == 3) {
                $proccess->finish_proccess = 0;
                $proccess->update_proccess = 0;
                $proccess->reopen_proccess = 0;
                $proccess->progress_proccess = 1;

                $proccess->reopen_proccess += 1;
                session()->flash('success', 'Processo em andamento.');
            }

            $proccess->touch();
            $proccess->save();
        }

        return redirect()->route('proccess.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proccess = Proccess::find($id);
        $attachment = Attachment::where('proccess_id', $proccess->id);

        if ($proccess) {
            $proccess->delete();
            $attachment->delete();
        }

        session()->flash('success', 'Processo deletado com sucesso.');
        return redirect()->back();
    }

    public function finish(string $id)
    {
        $proccess = Proccess::find($id);

        if ($proccess->finish_proccess == 1) {
            session()->flash('error', 'Esse processo ja foi finalizado.');
            return redirect()->route('proccess.index');
        } else {
            $proccess->progress_proccess = 0;
            $proccess->update_proccess = 0;
            $proccess->reopen_proccess = 0;
            $proccess->finish_proccess = 1;

            if ($proccess->finish_proccess == 1) {
                $proccess->qtd_finish += 1;
            }

            $proccess->save();
        }

        session()->flash('success', 'Processo finalizado com sucesso.');
        return redirect()->route('proccess.index');
    }

    public function reopen(String $id)
    {
        $proccess = Proccess::find($id);

        if ($proccess) {
            $proccess->finish_proccess = 0;
            $proccess->reopen_proccess = 1;

            if ($proccess->reopen_proccess == 1) {
                $proccess->qtd_reopen += 1;
            }

            $proccess->save();
        }

        session()->flash('success', 'Processo reaberto com sucesso.');
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
                'email_client.unique' => 'Já existe um e-mail como esse.',
            ]
        );
    }
}

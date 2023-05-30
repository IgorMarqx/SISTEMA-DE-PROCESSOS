<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeCollective;
use App\Models\Attachment;
use App\Models\JudicialCollective;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

class CollectiveController extends Controller
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
        $proccess = JudicialCollective::paginate(7);
        $loggedId = intval(Auth::id());

        $proccess_count = JudicialCollective::count();

        $progress_proccess_count = JudicialCollective::where('progress_collective', '=', '1')->count();
        $finish_proccess_count = JudicialCollective::where('finish_collective', '=', '1')->count();
        $update_proccess_count = JudicialCollective::where('update_collective', '=', '1')->count();


        return view('admin.collective.judicial.index', [
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
        $user = User::where('admin', 0)->get();


        return view('admin.collective.judicial.create', [
            'users' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->type == 1) {
            $data = $request->only(['collective', 'subject', 'jurisdiction', 'cause_value', 'priority', 'judgmental_organ', 'justice_secret', 'free_justice', 'tutelar', 'user_id', 'url', 'url_noticies', 'email_corp', 'email_client', 'progress_collective', 'type', 'action_type']);
            $progress = $data['progress_collective'];

            $justiceSecret = $request->input('justice_secret', []);
            $freeJustice = $request->input('free_justice', []);
            $tutelar = $request->input('tutelar', []);

            $justiceSecret = !empty($justiceSecret);
            $freeJustice = !empty($freeJustice);
            $tutelar = !empty($tutelar);

            $validator = $this->validator($data);

            if ($data['action_type'] == 'error') {
                $validator->errors()->add('action_type', 'Escolha um tipo de ação.');

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

            if ($data['type'] == 'error') {
                $validator->errors()->add('type', 'Escolha um tipo de processo.');

                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $collective = JudicialCollective::create([
                'name' => $data['collective'],
                'subject' => $data['subject'],
                'jurisdiction' => $data['jurisdiction'],
                'cause_value' => $data['cause_value'],
                'justice_secret' => $justiceSecret,
                'free_justice' => $freeJustice,
                'tutelar' => $tutelar,
                'priority' => $data['priority'],
                'judgmental_organ' => $data['judgmental_organ'],
                'user_id' => $data['user_id'],
                'url_collective' => $data['url'],
                'url_noticies' => $data['url_noticies'],
                'email_coorporative' => $data['email_corp'],
                'email_client' => $data['email_client'],
                'progress_collective' => intval($progress),
                'action_type' => $data['type'],
            ]);
            $collective->save();

            session()->flash('success', 'Processo Judicial criado com sucesso.');
            return redirect()->route('collective.index');
        } else {
            $data = $request->only(['collective', 'subject', 'jurisdiction', 'cause_value', 'priority', 'judgmental_organ', 'justice_secret', 'free_justice', 'tutelar', 'user_id', 'url', 'url_noticies', 'email_corp', 'email_client', 'progress_collective', 'type', 'action_type']);
            $progress = $data['progress_collective'];

            $justiceSecret = $request->input('justice_secret', []);
            $freeJustice = $request->input('free_justice', []);
            $tutelar = $request->input('tutelar', []);

            $justiceSecret = !empty($justiceSecret);
            $freeJustice = !empty($freeJustice);
            $tutelar = !empty($tutelar);

            $validator = $this->validator($data);

            if ($data['user_id'] == 'error') {
                $validator->errors()->add('user_id', 'Escolha um cliente');

                return redirect()->route('administrative_collective.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($data['type'] == 'error') {
                $validator->errors()->add('type', 'Escolha um tipo de processo');

                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($validator->fails()) {
                return redirect()->route('administrative_collective.create')
                    ->withErrors($validator)
                    ->withInput();
            }

            $collective = AdministrativeCollective::create([
                'name' => $data['collective'],
                'subject' => $data['subject'],
                'jurisdiction' => $data['jurisdiction'],
                'cause_value' => $data['cause_value'],
                'justice_secret' => $justiceSecret,
                'free_justice' => $freeJustice,
                'tutelar' => $tutelar,
                'priority' => $data['priority'],
                'judgmental_organ' => $data['judgmental_organ'],
                'user_id' => $data['user_id'],
                'url_collective' => $data['url'],
                'url_noticies' => $data['url_noticies'],
                'email_coorporative' => $data['email_corp'],
                'email_client' => $data['email_client'],
                'progress_collective' => intval($progress),
                'action_type' => $data['type'],
            ]);
            $collective->save();

            session()->flash('success', 'Processo Administrativo criado com sucesso.');
            return redirect()->route('administrative_collective.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $collective = JudicialCollective::find($id);
        if ($collective) {
            $user = $collective->user;
            $attachment = Attachment::where('judicial_collective_id', '=', $id)->get();

            return view('admin.collective.judicial.details', [
                'proccess' => $collective,
                'user' => $user,
                'attachment' => $attachment
            ]);
        }

        session()->flash('warning', 'Processo não encontrado.');
        return redirect()->back();
    }

    public function attachment(Request $request, string $id)
    {
        $data = $request->only('file');

        $validator = $this->validatorFile($data);

        if ($validator->fails()) {
            return redirect()->route('collective.show', ['collective' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            $originalName = $request->file('file')->getClientOriginalName();

            $attachment = Attachment::create([
                'title' => $originalName,
                'judicial_collective_id' => $request->collective_id,
                'user_id' => $request->user_id,
                'path' => $request->file('file')->store(),
            ]);
        }
        $attachment->save();

        session()->flash('success', 'Anexado com sucesso.');
        return redirect()->route('collective.show', ['collective' => $id]);
    }

    public function downloadAttachment(string $id)
    {
        $attachment = Attachment::find($id);

        $path = $attachment->path;
        $fileName = $attachment->title;

        if (Storage::exists($path)) {
            return Storage::download($path, $fileName);
        }

        session()->flash('warning', 'Anexo não encontrado. Delete esse anexo e insira de novo.');
        return redirect()->back();
    }

    public function deletAttachment(string $id)
    {
        $attachment = Attachment::find($id);
        $path = $attachment->path;

        if ($attachment) {
            $attachment->delete();

            if (Storage::exists($path)) {
                Storage::delete($path);
            }

            session()->flash('success', 'Anexo deletado com sucesso.');
            return redirect()->back();
        }

        session()->flash('warning', 'Anexo não encontrado');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $collective = JudicialCollective::find($id);
        $user = User::all();

        if ($collective) {
            return view('admin.collective.judicial.edit', [
                'proccess' => $collective,
                'users' => $user,
            ]);
        }

        session()->flash('warning', 'Usuário não encontrado.');
        return redirect()->route('collective.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $collective = JudicialCollective::find($id);

        if ($collective) {
            $data = $request->only('collective', 'url', 'url_noticies', 'subject', 'jurisdiction', 'priority', 'judgmental_organ', 'email_corp', 'email_client', 'user_id', 'status');

            $justiceSecret = $request->input('justice_secret', []);
            $freeJustice = $request->input('free_justice', []);
            $tutelar = $request->input('tutelar', []);

            $justiceSecret = !empty($justiceSecret);
            $freeJustice = !empty($freeJustice);
            $tutelar = !empty($tutelar);

            $validator = $this->validator($data);

            if ($validator->fails()) {
                return redirect()->route('collective.edit', ['collective' => $collective])->withErrors($validator);
            }

            $collective->name = $data['collective'];
            $collective->url_collective = $data['url'];

            $collective->url_noticies = $data['url_noticies'];
            $collective->user_id = $data['user_id'];

            $collective->subject = $data['subject'];
            $collective->jurisdiction = $data['jurisdiction'];

            $collective->priority = $data['priority'];
            $collective->judgmental_organ = $data['judgmental_organ'];

            $collective->justice_secret = $justiceSecret;
            $collective->free_justice = $freeJustice;
            $collective->tutelar = $tutelar;

            if ($collective->email_client !== $data['email_client']) {
                $hasEmail = JudicialCollective::where('email_client', $data['email_client'])->get();

                if (count($hasEmail) == 0) {
                    $collective->email_client = $data['email_client'];
                } else {
                    $validator->errors()->add('email', 'Já existe um e-mail com esse.');
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('collective.edit', ['collective' => $id])->withErrors($validator);
            }

            if ($data['status'] == 1) {
                $collective->finish_collective = 0;
                $collective->progress_collective = 0;
                $collective->update_collective = 1;

                $collective->qtd_update += 1;
                session()->flash('success', 'Processo Atualizado com sucesso.');
            } else if ($data['status'] == 2) {

                if ($collective->finish_collective == 1) {
                    session()->flash('error', 'Esse processo ja foi finalizado.');
                    return redirect()->route('collective.index');
                }

                $collective->progress_collective = 0;
                $collective->update_collective = 0;
                $collective->finish_collective = 1;

                $collective->qtd_finish += 1;
                session()->flash('success', 'Processo Finalizado com sucesso.');
            } else if ($data['status'] == 3) {
                $collective->finish_collective = 0;
                $collective->update_collective = 0;
                $collective->progress_collective = 1;

                session()->flash('success', 'Processo em andamento.');
            }

            $collective->touch();
            $collective->save();
        }

        return redirect()->route('collective.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $collective = JudicialCollective::find($id);
        $attachment = Attachment::where('judicial_collective_id', $collective->id);

        if ($collective) {
            $collective->delete();
            $attachment->delete();
        }

        session()->flash('success', 'Processo deletado com sucesso.');
        return redirect()->back();
    }

    public function finish(string $id)
    {
        $collective = JudicialCollective::find($id);

        if ($collective->finish_collective == 1) {
            session()->flash('error', 'Esse processo ja foi finalizado.');
            return redirect()->route('collective.index');
        } else {
            $collective->progress_collective = 0;
            $collective->update_collective = 0;
            $collective->finish_collective = 1;

            if ($collective->finish_collective == 1) {
                $collective->qtd_finish += 1;
            }

            $collective->save();
        }

        session()->flash('success', 'Processo finalizado com sucesso.');
        return redirect()->route('collective.index');
    }


    public function validator($data)
    {
        return Validator::make(
            $data,
            [
                'collective' => ['required', 'max:100'],
                'subject' => ['required', 'max:100'],
                'jurisdiction' => ['required', 'max:100'],
                'priority' => ['required', 'max:100'],
                'judgmental_organ' => ['required', 'max:100'],
                'url' => ['max:2048'],
                'url_noticies' => ['max:2048'],
                'email_corp' => ['required', 'max:100', 'email'],
                'email_client' => ['max:100'],
            ],
            [
                'collective.required' => 'Preencha esse campo.',
                'collective.max' => 'Máximo de 100 caracteres.',

                'subject.required' => 'Preencha esse campo.',
                'subject.max' => 'Máximo de 100 caracteres.',

                'priority.required' => 'Preencha esse campo.',
                'priority.max' => 'Máximo de 100 caracteres.',

                'judgmental_organ.required' => 'Preencha esse campo.',
                'judgmental_organ.max' => 'Máximo de 100 caracteres.',

                'jurisdiction.required' => 'Preencha esse campo.',
                'jurisdiction.max' => 'Máximo de 100 caracteres.',

                'url.max' => 'Máximo de 2048 caracteres.',

                'email_corp.required' => 'Preencha esse campo.',
                'email_corp.max' => 'Máximo de 100 caracteres.',
                'email_corp.email' => 'Informe um e-mail válido.',

                'email_client.max' => 'Máximo de 100 caracteres.',
                'email_client.unique' => 'Já existe um e-mail como esse.',
            ]
        );
    }

    public function validatorFile($data)
    {
        return Validator::make(
            $data,
            [
                'file' => [
                    'required',
                    'mimes:pdf',
                    'max:9048',
                ]
            ],
            [
                'file.required' => 'Escolha algum arquivo.',
                'file.mimes' => 'Tipo de arquivo não suportado.',
                'file.max' => 'Máximo de 9MB.'
            ]
        );
    }
}

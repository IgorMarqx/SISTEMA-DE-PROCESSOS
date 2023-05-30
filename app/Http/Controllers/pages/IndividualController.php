<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeIndividual;
use App\Models\Attachment;
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
            $data = $request->only('progress_individuals', 'individuals', 'user_id', 'subject', 'jurisdiction', 'cause_value', 'priority', 'judgmental_organ',  'judicial_office', 'competence', 'justice_secret', 'free_justice', 'tutelar', 'url', 'url_noticies', 'email_corp', 'email_client', 'type', 'action_type');
            $progress = $data['progress_individuals'];

            $justiceSecret = $request->input('justice_secret', []);
            $freeJustice = $request->input('free_justice', []);
            $tutelar = $request->input('tutelar', []);

            $justiceSecret = !empty($justiceSecret);
            $freeJustice = !empty($freeJustice);
            $tutelar = !empty($tutelar);

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
                'subject' => $data['subject'],
                'jurisdiction' => $data['jurisdiction'],
                'cause_value' => $data['cause_value'],
                'justice_secret' => $justiceSecret,
                'free_justice' => $freeJustice,
                'tutelar' => $tutelar,
                'priority' => $data['priority'],
                'judgmental_organ' => $data['judgmental_organ'],
                'judicial_office' => $data['judicial_office'],
                'competence' => $data['competence'],
                'user_id' => $data['user_id'],
                'url_individuals' => $data['url'],
                'url_noticies' => $data['url_noticies'],
                'email_coorporative' => $data['email_corp'],
                'email_client' => $data['email_client'],
                'progress_individuals' => intval($progress),
                'action_type' => $data['action_type']
            ]);
            $individual->save();

            session()->flash('success', 'Processo criado com sucesso.');
            return redirect()->route('individual.index');
        } else {
            $data = $request->only('progress_individuals', 'individuals', 'user_id', 'subject', 'jurisdiction', 'cause_value', 'priority', 'judgmental_organ',  'judicial_office', 'competence', 'justice_secret', 'free_justice', 'tutelar', 'url', 'url_noticies', 'email_corp', 'email_client', 'type', 'action_type');
            $progress = $data['progress_individuals'];

            $justiceSecret = $request->input('justice_secret', []);
            $freeJustice = $request->input('free_justice', []);
            $tutelar = $request->input('tutelar', []);

            $justiceSecret = !empty($justiceSecret);
            $freeJustice = !empty($freeJustice);
            $tutelar = !empty($tutelar);

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
                'subject' => $data['subject'],
                'jurisdiction' => $data['jurisdiction'],
                'cause_value' => $data['cause_value'],
                'justice_secret' => $justiceSecret,
                'free_justice' => $freeJustice,
                'tutelar' => $tutelar,
                'priority' => $data['priority'],
                'judgmental_organ' => $data['judgmental_organ'],
                'judicial_office' => $data['judicial_office'],
                'competence' => $data['competence'],
                'user_id' => $data['user_id'],
                'url_individuals' => $data['url'],
                'url_noticies' => $data['url_noticies'],
                'email_coorporative' => $data['email_corp'],
                'email_client' => $data['email_client'],
                'progress_individuals' => intval($progress),
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
        $individual = JudicialIndividual::find($id);

        if ($individual) {
            $user = $individual->user;
            $attachment = Attachment::where('judicial_individual_id', $id)->get();

            return view('admin.individual.judicial.details', [
                'individual' => $individual,
                'user' => $user,
                'attachment' => $attachment
            ]);
        }
    }

    public function finish(string $id)
    {
        $judicial_individual = JudicialIndividual::find($id);

        if ($judicial_individual->finish_individuals == 0) {
            $judicial_individual->progress_individuals = 0;
            $judicial_individual->update_individuals = 0;
            $judicial_individual->finish_individuals = 1;

            $judicial_individual->qtd_finish += 1;

            $judicial_individual->save();

            session()->flash('success', 'Processo finalizado com sucesso.');
            return redirect()->back();
        } else {
            session()->flash('warning', 'Esse processo já foi finalizado.');
            return redirect()->back();
        }

        session()->flash('warning', 'Não foi possivel encontrar esse processo.');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $individual = JudicialIndividual::find($id);
        $user = User::all();

        if ($individual) {
            return view('admin.individual.judicial.edit', [
                'individual' => $individual,
                'users' => $user,
            ]);
        }

        session()->flash('warning', 'Processo não encontrado.');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $individual = JudicialIndividual::find($id);

        if ($individual) {
            $data = $request->only('individuals', 'url', 'subject', 'jurisdiction', 'cause_value', 'priority', 'judgmental_organ', 'url_noticies', 'email_corp', 'email_client', 'user_id', 'status');

            $justiceSecret = $request->input('justice_secret', []);
            $freeJustice = $request->input('free_justice', []);
            $tutelar = $request->input('tutelar', []);

            $justiceSecret = !empty($justiceSecret);
            $freeJustice = !empty($freeJustice);
            $tutelar = !empty($tutelar);

            $validator = $this->validator($data);

            if ($validator->fails()) {
                return redirect()->route('individual.edit', ['individual' => $individual])->withErrors($validator);
            }

            $individual->name = $data['individuals'];
            $individual->url_individuals = $data['url'];

            $individual->url_noticies = $data['url_noticies'];
            $individual->user_id = $data['user_id'];

            $individual->subject = $data['subject'];
            $individual->jurisdiction = $data['jurisdiction'];

            $individual->cause_value = $data['cause_value'];
            $individual->priority = $data['priority'];
            $individual->judgmental_organ = $data['judgmental_organ'];

            $individual->justice_secret = $justiceSecret;
            $individual->free_justice = $freeJustice;
            $individual->tutelar = $tutelar;

            if ($individual->email_client !== $data['email_client']) {
                $hasEmail = JudicialIndividual::where('email_client', $data['email_client'])->get();

                if (count($hasEmail) == 0) {
                    $individual->email_client = $data['email_client'];
                } else {
                    $validator->errors()->add('email', 'Já existe um e-mail com esse.');
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('individual.edit', ['individual' => $id])->withErrors($validator);
            }

            if ($data['status'] == 1) {
                $individual->finish_individuals = 0;
                $individual->progress_individuals = 0;
                $individual->update_individuals = 1;

                $individual->qtd_update += 1;
                session()->flash('success', 'Processo Atualizado com sucesso.');
            } else if ($data['status'] == 2) {

                if ($individual->finish_individuals == 1) {
                    session()->flash('error', 'Esse processo ja foi finalizado.');
                    return redirect()->route('individual.index');
                }

                $individual->progress_individuals = 0;
                $individual->update_individuals = 0;
                $individual->finish_individuals = 1;

                $individual->qtd_finish += 1;
                session()->flash('success', 'Processo Finalizado com sucesso.');
            } else if ($data['status'] == 3) {
                $individual->finish_individuals = 0;
                $individual->update_individuals = 0;
                $individual->progress_individuals = 1;

                session()->flash('success', 'Processo em andamento.');
            }

            $individual->touch();
            $individual->save();
        }

        return redirect()->route('individual.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $individual = JudicialIndividual::find($id);
        $attachment = Attachment::where('judicial_individual_id', $individual->id);


        if ($individual) {
            $individual->delete();
            $attachment->delete();

            session()->flash('success', 'Processo deletado com sucesso.');
            return redirect()->back();
        }

        session()->flash('warning', 'Processo não encontrado.');
        return redirect()->back();
    }

    public function attachment(Request $request, string $id)
    {
        $data = $request->only('file');

        $validator = $this->validatorFile($data);

        if ($validator->fails()) {
            return redirect()->route('individual.show', ['individual' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            $originalName = $request->file('file')->getClientOriginalName();

            $attachment = Attachment::create([
                'title' => $originalName,
                'judicial_individual_id' => $request->judicial_individual_id,
                'user_id' => $request->user_id,
                'path' => $request->file('file')->store(),
            ]);
        }
        $attachment->save();

        session()->flash('success', 'Anexado com sucesso.');
        return redirect()->route('individual.show', ['individual' => $id]);
    }

    public function validator($data)
    {
        return Validator::make(
            $data,
            [
                'individuals' => ['required', 'max:100'],
                'url' => ['max:2048'],
                'subject' => ['required', 'max:100'],
                'jurisdiction' => ['required', 'max:100'],
                'priority' => ['required', 'max:100'],
                'judgmental_organ' => ['required', 'max:100'],
                'email_corp' => ['required', 'max:100', 'email'],
                'email_client' => ['max:100'],
            ],
            [
                'individuals.required' => 'Preencha esse campo.',
                'individuals.max' => 'Máximo de 100 caracteres.',

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

<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeIndividual;
use App\Models\Attachment;
use App\Models\Defendant;
use App\Models\Lawyer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdministrativeIndividualController extends Controller
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
        $individual = AdministrativeIndividual::paginate(7);

        $individual_count =  AdministrativeIndividual::count();

        $progress_count = AdministrativeIndividual::where('progress_individuals', 1)->count();
        $update_count = AdministrativeIndividual::where('update_individuals', 1)->count();
        $finish_count = AdministrativeIndividual::where('finish_individuals', 1)->count();


        return view('admin.individual.administrative.index', [
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $adm_individual = AdministrativeIndividual::find($id);

        if ($adm_individual) {
            $user = $adm_individual->user;
            $attachment = Attachment::where('administrative_individual_id', '=', $id)->get();
            $judicial = Lawyer::where('administrative_individual_id', $id)->get();
            $defendant = Defendant::where('administrative_individual_id', $id)->get();

            $user_1 = null;
            $user_2 = null;
            $user_3 = null;
            $user_4 = null;

            foreach ($judicial as $judicials) {
                $name_1 = $judicials->email_lawyer_1;
                $id_1 = $judicials->user_id_1;

                $name_2 = $judicials->email_lawyer_2;
                $id_2 = $judicials->user_id_2;

                $name_3 = $judicials->email_lawyer_3;
                $id_3 = $judicials->user_id_3;

                $name_4 = $judicials->email_lawyer_4;
                $id_4 = $judicials->user_id_4;

                if ($id_1) {
                    $user_1 = User::where('id', $id_1)->value('oab');
                }
                if ($id_2) {
                    $user_2 = User::where('id', $id_2)->value('oab');
                }
                if ($id_3) {
                    $user_3 = User::where('id', $id_3)->value('oab');
                }
                if ($id_4) {
                    $user_4 = User::where('id', $id_4)->value('oab');
                }
            }

            $lawData = [
                'lawyer_1' => $user_1 ? $user_1 : null,
                'lawyer_2' => $user_2 ? $user_2 : null,
                'lawyer_3' => $user_3 ? $user_3 : null,
                'lawyer_4' => $user_4 ? $user_4 : null,
            ];

            $data = [$name_1, $name_2, $name_3, $name_4];



            return view('admin.individual.administrative.details', [
                'administrative_individual' => $adm_individual,
                'user' => $user,
                'attachment' => $attachment,
                'data' => $data,
                'lawyer' => $lawData,
                'defendants' => $defendant,
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
            return redirect()->route('administrative_individual.show', ['administrative_individual' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            $originalName = $request->file('file')->getClientOriginalName();

            $attachment = Attachment::create([
                'title' => $originalName,
                'administrative_individual_id' => $request->administrative_individual_id,
                'user_id' => $request->user_id,
                'path' => $request->file('file')->store(),
            ]);
        }
        $attachment->save();

        session()->flash('success', 'Anexado com sucesso.');
        return redirect()->route('administrative_individual.show', ['administrative_individual' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adm_individual = AdministrativeIndividual::find($id);
        $defendant =  Defendant::where('administrative_individual_id', $id)->get();

        foreach ($defendant as $defendants) {
            $defendants;
        }

        if ($adm_individual) {
            $user = User::all();

            return view('admin.individual.administrative.edit', [
                'administrative_individual' => $adm_individual,
                'users' => $user,
                'defendant' => $defendants
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $individual = AdministrativeIndividual::find($id);
        $defendants =  Defendant::where('administrative_individual_id', $id)->get();


        if ($individual) {
            $data = $request->only('administrative_individuals', 'url', 'subject', 'jurisdiction', 'cause_value', 'priority', 'judgmental_organ', 'url_noticies', 'email_corp', 'email_client', 'user_id', 'status');

            $justiceSecret = $request->input('justice_secret', []);
            $freeJustice = $request->input('free_justice', []);
            $tutelar = $request->input('tutelar', []);

            $justiceSecret = !empty($justiceSecret);
            $freeJustice = !empty($freeJustice);
            $tutelar = !empty($tutelar);

            $validator = $this->validator($data);

            if ($validator->fails()) {
                return redirect()->route('administrative_individual.edit', ['administrative_individual' => $individual])->withErrors($validator);
            }

            $defendant = $request->only('defendant', 'cnpj');

            $validatorDefendant = $this->validatorDefendant($defendant);

            if ($request->cnpj != null) {
                if (strlen($request->cnpj) < 18) {
                    $validator->errors()->add('cnpj', 'Informe um CNPJ válido');

                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            }

            if ($validatorDefendant->fails()) {
                return redirect()->back()
                    ->withErrors($validatorDefendant)
                    ->withInput();
            }

            foreach($defendants as $defendant){
                $defendant->defendant = $request->defendant;
                $defendant->cnpj = $request->cnpj;
            }

            $defendant->save();


            $individual->name = $data['administrative_individuals'];
            $individual->url_individuals = $data['url'];

            $individual->url_noticies = $data['url_noticies'];
            // $individual->user_id = $data['user_id'];

            $individual->subject = $data['subject'];
            $individual->jurisdiction = $data['jurisdiction'];

            $individual->cause_value = $data['cause_value'];
            $individual->priority = $data['priority'];
            $individual->judgmental_organ = $data['judgmental_organ'];

            $individual->justice_secret = $justiceSecret;
            $individual->free_justice = $freeJustice;
            $individual->tutelar = $tutelar;

            if ($individual->email_client !== $data['email_client']) {
                $hasEmail = AdministrativeIndividual::where('email_client', $data['email_client'])->get();

                if (count($hasEmail) == 0) {
                    $individual->email_client = $data['email_client'];
                } else {
                    $validator->errors()->add('email', 'Já existe um e-mail com esse.');
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('administrative_individual.edit', ['administrative_individual' => $id])->withErrors($validator);
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
                    return redirect()->route('administrative_individual.index');
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

        return redirect()->route('administrative_individual.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adm_individual = AdministrativeIndividual::find($id);
        $attachment = Attachment::where('administrative_individual_id', $id);

        if ($adm_individual) {
            $attachment->delete();
            $adm_individual->delete();

            session()->flash('success', 'Processo deletado com sucesso.');
            return redirect()->back();
        }

        session()->flash('warning', 'Processo não encontrado.');
        return redirect()->back();
    }

    public function finish(string $id)
    {
        $judicial_individual = AdministrativeIndividual::find($id);

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

    public function validator($data)
    {
        return Validator::make(
            $data,
            [
                'administrative_individuals' => ['required', 'max:100'],
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

    public function validatorDefendant($defendant)
    {
        return Validator::make(
            $defendant,
            [
                'defendant' => ['required', 'max:100']
            ],
            [
                'defendant.required' => 'Preencha esse campo.',
                'defendant.max' => 'Máximo 100 caracteres.',
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

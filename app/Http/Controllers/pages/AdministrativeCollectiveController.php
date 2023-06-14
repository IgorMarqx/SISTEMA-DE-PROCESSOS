<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeCollective;
use App\Models\Attachment;
use App\Models\Defendant;
use App\Models\Lawyer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class AdministrativeCollectiveController extends Controller
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
        $administrative =  AdministrativeCollective::latest()->paginate(7);

        $administrative_count = AdministrativeCollective::count();

        $progress_administrative = AdministrativeCollective::where('progress_collective', '1')->count();
        $update_administrative = AdministrativeCollective::where('update_collective', '1')->count();
        $finish_administrative = AdministrativeCollective::where('finish_collective', '1')->count();

        return view('admin.collective.administrative.index', [
            'administrative' => $administrative,

            'administrative_count' =>  $administrative_count,
            'progress_administrative' => $progress_administrative,

            'update_administrative' => $update_administrative,
            'finish_administrative' => $finish_administrative,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::where('admin', 0)->get();
        $lawyer = User::where('admin', 2)->get();

        return view('admin.collective.administrative.create', [
            'users' =>  $user,
            'lawyer' => $lawyer,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $administrative = AdministrativeCollective::find($id);
        if ($administrative) {
            $user = $administrative->user;
            $attachment = Attachment::where('administrative_collective_id', '=', $id)->get();
            $judicial = Lawyer::where('administrative_collective_id', $id)->get();
            $defendant = Defendant::where('administrative_collective_id', $id)->get();

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

            return view('admin.collective.administrative.details', [
                'administrative' => $administrative,
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
            return redirect()->route('administrative_collective.show', ['administrative_collective' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            $originalName = $request->file('file')->getClientOriginalName();

            $attachment = Attachment::create([
                'title' => $originalName,
                'administrative_collective_id' => $request->administrative_collective_id,
                'user_id' => $request->user_id,
                'path' => $request->file('file')->store(),
            ]);
        }
        $attachment->save();

        session()->flash('success', 'Anexado com sucesso.');
        return redirect()->route('administrative_collective.show', ['administrative_collective' => $id]);
    }

    public function finish(string $id)
    {
        $collective = AdministrativeCollective::find($id);

        if ($collective->finish_collective == 1) {
            session()->flash('error', 'Esse processo ja foi finalizado.');
            return redirect()->back();
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
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $adm_collective = AdministrativeCollective::find($id);
        $user = User::all();
        $defendant =  Defendant::where('administrative_collective_id', $id)->get();

        foreach ($defendant as $defendants) {
            $defendants;
        }

        if ($adm_collective) {
            return view('admin.collective.administrative.edit', [
                'administrative' => $adm_collective,
                'users' => $user,
                'defendant' => $defendants
            ]);
        }

        session()->flash('warning', 'Usuário não encontrado.');
        return redirect()->route('administrative_collective.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $adm_collective = AdministrativeCollective::find($id);
        $defendants =  Defendant::where('administrative_collective_id', $id)->get();

        if ($adm_collective) {
            $data = $request->only('collective', 'url', 'url_noticies', 'subject', 'jurisdiction',  'cause_value', 'priority', 'judgmental_organ', 'judicial_office', 'competence', 'email_corp', 'email_client', 'user_id', 'status');

            $justiceSecret = $request->input('justice_secret', []);
            $freeJustice = $request->input('free_justice', []);
            $tutelar = $request->input('tutelar', []);

            $justiceSecret = !empty($justiceSecret);
            $freeJustice = !empty($freeJustice);
            $tutelar = !empty($tutelar);

            $validator = $this->validator($data);

            if ($validator->fails()) {
                return redirect()->route('administrative_collective.edit', ['administrative_collective' => $adm_collective])->withErrors($validator);
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

            foreach ($defendants as $defendant) {
                $defendant->defendant = $request->defendant;
                $defendant->cnpj = $request->cnpj;

                // dd($defendant);
            }

            $defendant->save();

            $adm_collective->name = $data['collective'];
            $adm_collective->url_collective = $data['url'];

            $adm_collective->url_noticies = $data['url_noticies'];
            // $adm_collective->user_id = $data['user_id'];

            $adm_collective->judicial_office = $data['judicial_office'];
            $adm_collective->competence = $data['competence'];

            $adm_collective->justice_secret = $justiceSecret;
            $adm_collective->free_justice = $freeJustice;
            $adm_collective->tutelar = $tutelar;

            $adm_collective->cause_value = $data['cause_value'];

            if ($adm_collective->email_client !== $data['email_client']) {
                $hasEmail = AdministrativeCollective::where('email_client', $data['email_client'])->get();

                if (count($hasEmail) == 0) {
                    $adm_collective->email_client = $data['email_client'];
                } else {
                    $validator->errors()->add('email', 'Já existe um e-mail com esse.');
                }
            }

            if ($adm_collective->email_coorporative !== $data['email_corp']) {
                $hasEmail = AdministrativeCollective::where('email_coorporative', $data['email_corp'])->get();

                if (count($hasEmail) == 0) {
                    $adm_collective->email_coorporative = $data['email_corp'];
                } else {
                    $validator->errors()->add('email_corp', 'Já existe um e-mail com esse.');
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('administrative_collective.edit', ['administrative_collective' => $id])->withErrors($validator);
            }

            if ($data['status'] == 1) {
                $adm_collective->finish_collective = 0;
                $adm_collective->progress_collective = 0;
                $adm_collective->update_collective = 1;

                $adm_collective->qtd_update += 1;
                session()->flash('success', 'Processo Atualizado com sucesso.');
            } else if ($data['status'] == 2) {

                if ($adm_collective->finish_collective == 1) {
                    session()->flash('error', 'Esse processo ja foi finalizado.');
                    return redirect()->route('administrative_collective.index');
                }

                $adm_collective->progress_collective = 0;
                $adm_collective->update_collective = 0;
                $adm_collective->finish_collective = 1;

                $adm_collective->qtd_finish += 1;
                session()->flash('success', 'Processo Finalizado com sucesso.');
            } else if ($data['status'] == 3) {
                $adm_collective->finish_collective = 0;
                $adm_collective->update_collective = 0;
                $adm_collective->progress_collective = 1;

                session()->flash('success', 'Processo em andamento.');
            }

            $adm_collective->touch();
            $adm_collective->save();
        }

        return redirect()->route('administrative_collective.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adm_collective = AdministrativeCollective::find($id);
        $attachment = Attachment::where('administrative_collective_id', $id);

        if ($adm_collective) {
            $attachment->delete();
            $adm_collective->delete();

            session()->flash('success', 'Processo deletado com sucesso.');
            return redirect()->back();
        }

        session()->flash('warning', 'Processo não encontrado.');
        return redirect()->back();
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
                'judicial_office' => ['required', 'max:100'],
                'competence' => ['required', 'max:100'],
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

                'competence.required' => 'Preencha esse campo.',
                'competence.max' => 'Máximo de 100 caracteres.',

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

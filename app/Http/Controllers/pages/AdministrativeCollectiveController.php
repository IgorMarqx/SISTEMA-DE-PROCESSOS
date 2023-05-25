<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeCollective;
use App\Models\Attachment;
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
        $administrative =  AdministrativeCollective::paginate(7);

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
        $user = User::all();

        return view('admin.collective.administrative.create', [
            'users' =>  $user
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
        $user = $administrative->user;
        $attachment = Attachment::where('administrative_collective_id', $id)->get();

        return view('admin.collective.administrative.details', [
            'administrative' => $administrative,
            'user' => $user,
            'attachment' => $attachment,
        ]);
    }

    public function attachment(Request $request, string $id)
    {
        if ($request->file == "") {
            session()->flash('error', 'Arquivo não encontrado.');
            return redirect()->route('administrative_collective.show', ['administrative_collective' => $id]);
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
        }

        session()->flash('success', 'Anexo apagado com sucesso.');
        return redirect()->back();
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

        if ($adm_collective) {
            return view('admin.collective.administrative.edit', [
                'administrative' => $adm_collective,
                'users' => $user,
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

        if ($adm_collective) {
            $data = $request->only('collective', 'url', 'email_corp', 'email_client', 'user_id', 'status');

            $validator = $this->validator($data);

            if ($validator->fails()) {
                return redirect()->route('administrative_collective.edit', ['administrative_collective' => $adm_collective])->withErrors($validator);
            }

            $adm_collective->name = $data['collective'];
            $adm_collective->url_collective = $data['url'];
            $adm_collective->user_id = $data['user_id'];

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
                'url' => ['max:2048'],
                'email_corp' => ['required', 'max:100', 'email'],
                'email_client' => ['max:100'],
            ],
            [
                'collective.required' => 'Preencha esse campo.',
                'collective.max' => 'Máximo de 100 caracteres.',

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

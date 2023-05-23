<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeCollective;
use App\Models\Attachment;
use App\Models\User;
use Illuminate\Http\Request;

class AdministrativeCollectiveController extends Controller
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

    public function deletAttachment(string $id)
    {
        $attachment = Attachment::find($id);

        if ($attachment) {
            $attachment->delete();
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
}

<?php

namespace App\Http\Controllers\requeriments;

use App\Http\Controllers\Controller;
use App\Models\Requeriment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequerimentController extends Controller
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
        $requeriment = Requeriment::paginate(8);

        $count_requeriment = Requeriment::count('id');

        return view('admin.requeriments.index', [
            'requeriment' => $requeriment,
            'count_requeriment' => $count_requeriment
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.requeriments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only('destinatario', 'office', 'subject', 'description', 'coord_1', 'coord_2', 'coord_3');

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $ultimoOficio = Requeriment::orderBy('id', 'desc')->first();

        if ($ultimoOficio) {
            $numero = intval(substr($ultimoOficio->oficio_num, -4)) + 1;
        } else {
            $numero = 1;
        }

        $oficioNum = sprintf('%04d', $numero);

        $requeriment = Requeriment::create([
            'oficio_num' => $oficioNum,
            'destinatario' => $data['destinatario'],
            'office' => $data['office'],
            'subject' => $data['subject'],
            'description' => $data['description'],
            'coord_1' => $data['coord_1'],
            'coord_2' => $data['coord_2'],
            'coord_3' => $data['coord_3'],
        ]);
        $requeriment->save();

        session()->flash('success', 'Requerimento Criado com sucesso.');
        return redirect()->route('requeriments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $requeriment = Requeriment::find($id);

        if ($requeriment) {
            return view('admin.requeriments.details', [
                'requeriment' => $requeriment,
            ]);
        }

        session()->flash('warning', 'Requerimento não encontrado.');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $requeriment =  Requeriment::find($id);

        if ($requeriment) {
            return view('admin.requeriments.edit', [
                'requeriment' => $requeriment
            ]);
        }

        session()->flash('warning', 'Requerimento não encontrado.');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requeriment = Requeriment::find($id);

        $data = $request->only('destinatario', 'office', 'subject', 'description', 'coord_1', 'coord_2', 'coord_3');

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $requeriment->destinatario = $data['destinatario'];
        $requeriment->office = $data['office'];
        $requeriment->subject = $data['subject'];
        $requeriment->description = $data['description'];
        $requeriment->coord_1 = $data['coord_1'];
        $requeriment->coord_2 = $data['coord_2'];
        $requeriment->coord_3 = $data['coord_3'];
        $requeriment->save();

        session()->flash('success', 'Requerimento atualizado com sucesso.');
        return redirect()->route('requeriments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $requeriment =  Requeriment::find($id);

        if ($requeriment) {
            $requeriment->delete();

            session()->flash('success', 'Requerimento deletado com sucesso.');
            return redirect()->back();
        }

        session()->flash('warning', 'Requerimento não encontrado.');
        return redirect()->back();
    }

    public function validator($data)
    {
        return Validator::make(
            $data,
            [
                'destinatario' => ['required'],
                'office' => ['required'],
                'subject' => ['required'],
                'description' => ['required'],
                'coord_1' => ['required'],
            ],
            [
                'destinatario.required' => 'Preencha esse campo.',

                'office.required' => 'Preencha esse campo.',

                'subject.required' => 'Preencha esse campo',

                'description.required' => 'Preencha esse campo.',

                'coord_1.required' => 'Informe pelo menos um Coordenador.',
            ],
        );
    }
}

<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeIndividual;
use Illuminate\Http\Request;

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
        //
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
}

<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\JudicialCollective;
use Illuminate\Http\Request;

class SingleProccessController extends Controller
{
    public function index()
    {
        $loggedId = auth()->user();

        $judicialCollective = $loggedId->judicialCollectives;
        $judicialIndividual = $loggedId->judicialIndividuals;
        $administrativeCollective = $loggedId->administrativeCollectives;
        $administrativeIndividual = $loggedId->administrativeIndividuals;

        $process = $judicialCollective
            ->concat($judicialIndividual)
            ->concat($administrativeCollective)
            ->concat($administrativeIndividual);


        return view('admin.myProccess.judicial.index', [
            'process' => $process,
        ]);
    }
}

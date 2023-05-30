<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeCollective;
use App\Models\AdministrativeIndividual;
use App\Models\JudicialCollective;
use App\Models\JudicialIndividual;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $loggedId = auth()->user()->id;

        $judicial_collective = JudicialCollective::where('user_id', $loggedId)->count();
        $judicial_individual = JudicialIndividual::where('user_id', $loggedId)->count();

        $adm_collective = AdministrativeCollective::where('user_id', $loggedId)->count();
        $adm_individual = AdministrativeIndividual::where('user_id', $loggedId)->count();

        $count_judicial = ($judicial_collective + $judicial_individual);
        $count_adm = ($adm_collective + $adm_individual);

        return view('admin.profiles.profile', [
            'count_adm' => $count_adm,
            'count_judicial' => $count_judicial,
        ]);
    }
}

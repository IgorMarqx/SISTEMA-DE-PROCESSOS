<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Collective;
use App\Models\JudicialCollective;
use App\Models\Proccess;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manager-users');
    }

    public function index()
    {
        $qtd_update = JudicialCollective::sum('qtd_update');
        $updatePie = $qtd_update;

        $qtd_finish = JudicialCollective::sum('qtd_finish');
        $finishPie = $qtd_finish;


        $sum_update = json_encode($updatePie);
        $sum_finish = json_encode($finishPie);

        $status_proccess = JudicialCollective::all();
        $limit_proccess = JudicialCollective::limit(8)->get();


        return view('admin.dashboard.dashboard', [
            'qtd_values' => $sum_update,
            'qtd_finish' => $sum_finish,

            'proccess' => $status_proccess,
            'limit_proccess' => $limit_proccess,
        ]);
    }
}

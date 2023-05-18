<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
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
        $qtd_update = Proccess::sum('qtd_update');
        $updatePie = $qtd_update;

        $qtd_finish = Proccess::sum('qtd_finish');
        $finishPie = $qtd_finish;

        $qtd_reopen = Proccess::sum('qtd_reopen');
        $reopenPie = $qtd_reopen;

        $sum_update = json_encode($updatePie);
        $sum_finish = json_encode($finishPie);
        $sum_reopen = json_encode($reopenPie);

        $status_proccess = Proccess::all();
        $limit_proccess = Proccess::limit(8)->get();


        return view('admin.dashboard.dashboard', [
            'qtd_values' => $sum_update,
            'qtd_finish' => $sum_finish,
            'qtd_reopen' => $sum_reopen,

            'proccess' => $status_proccess,
            'limit_proccess' => $limit_proccess,
        ]);
    }
}

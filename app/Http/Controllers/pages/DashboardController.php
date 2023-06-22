<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeCollective;
use App\Models\AdministrativeIndividual;
use App\Models\Collective;
use App\Models\JudicialCollective;
use App\Models\JudicialIndividual;
use App\Models\Proccess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manager-lawyer');
    }

    public function index(Request $request)
    {
        // if ($filterYear < 2023 || $filterYear > date('Y')) {
        //     $filterYear = date('Y');
        // }
        $filter = intval($request->input('filterDays', 30));
        $filterYear = intval($request->input('filterYear', date('Y')));

        if ($filter > 365) {
            $filter = 365;
        }

        // Obtém a data atual
        $currentDate = date('Y-m-d');

        // Verifica se o ano selecionado é o ano atual
        if ($filterYear == date('Y')) {
            // Define a data de filtro como a data atual
            $filterDate = $currentDate;
        } else {
            // Obtém o último dia do ano selecionado
            $filterDate = $filterYear . '-12-31';
        }

        // Se o filtro for em meses, atualiza a data de filtro para o último mês do ano selecionado
        if ($filter > 30) {
            $filterDate = date('Y-m-d', strtotime($filterDate . ' -' . ($filter - 1) . ' months'));
        }

        // COLETIVOS INICIO
        $queryJudicial = JudicialCollective::where('updated_at', '>=', $filterDate);
        $queryAdmJudicial = AdministrativeCollective::where('updated_at', '>=', $filterDate);


        if ($filterYear !== date('Y-m-d')) {
            $queryJudicial->whereYear('updated_at', $filterYear);
            $queryAdmJudicial->whereYear('updated_at', $filterYear);
        }

        $qtd_update_judicial = $queryJudicial->sum('qtd_update');
        $updateJudicial = $qtd_update_judicial;

        $qtd_finish_judicial = $queryJudicial->sum('qtd_finish');
        $finishJudicial = $qtd_finish_judicial;

        $update_adm_judicial = $queryAdmJudicial->sum('qtd_update');
        $admUpdateJudicial = $update_adm_judicial;

        $finish_adm_judicial = $queryAdmJudicial->sum('qtd_finish');
        $admFinishJudicial = $finish_adm_judicial;

        $sum_update_judicial = json_encode($updateJudicial);
        $sum_finish_judicial = json_encode($finishJudicial);

        $sum_update_adm = json_encode($admUpdateJudicial);
        $sum_finish_adm = json_encode($admFinishJudicial);
        // COLETIVOS FIM

        // INDIVIDUAL INICIO
        $queryIndividual = JudicialIndividual::where('updated_at', '>=', $filterDate);
        $queryAdmIndividual = AdministrativeIndividual::where('updated_at', '>=', $filterDate);

        if ($filterYear !== date('Y')) {
            $queryIndividual->whereYear('updated_at', $filterYear);
            $queryAdmIndividual->whereYear('updated_at', $filterYear);
        }

        $qtd_update_judicial = $queryIndividual->sum('qtd_update');
        $updateIndividual = $qtd_update_judicial;

        $qtd_finish_judicial = $queryIndividual->sum('qtd_finish');
        $finishIndividual = $qtd_finish_judicial;

        $update_adm_judicial = $queryAdmIndividual->sum('qtd_update');
        $admUpdateIndividual = $update_adm_judicial;

        $finish_adm_judicial = $queryAdmIndividual->sum('qtd_finish');
        $admFinishIndividual = $finish_adm_judicial;

        $sum_update_individual = json_encode($updateIndividual);
        $sum_finish_individual = json_encode($finishIndividual);

        $sum_update_admIndividual = json_encode($admUpdateIndividual);
        $sum_finish_admIndividual = json_encode($admFinishIndividual);
        // INDIVIDUAL FIM

        // OPEN PROCESS INICIO
        $startDate = Carbon::create(date('Y'), 1, 1, 0, 0, 0);
        $endDate = Carbon::create(date('Y'), 12, 31, 23, 59, 59);
        $months = [];

        while ($startDate <= $endDate) {
            $months[] = $startDate->format($filterYear . '-m');
            $startDate->addMonth();
        }

        $results = [];

        foreach ($months as $month) {
            $total = 0;

            $total += JudicialCollective::whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '{$month}'")->count();
            $total += AdministrativeCollective::whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '{$month}'")->count();
            $total += JudicialIndividual::whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '{$month}'")->count();
            $total += AdministrativeIndividual::whereRaw("DATE_FORMAT(created_at, '%Y-%m') = '{$month}'")->count();

            $results[$month] = $total;
        }

        $resultsMonths = json_encode($results);
        // OPEN PROCESS FIM


        return view('admin.dashboard.dashboard', [
            'judicial_up' => $sum_update_judicial,
            'judicial_finish' => $sum_finish_judicial,

            'adm_up' => $sum_update_adm,
            'adm_finish' => $sum_finish_adm,

            'individual_up' => $sum_update_individual,
            'individual_finish' => $sum_finish_individual,

            'admIndividual_up' => $sum_update_admIndividual,
            'admIndividual_finish' => $sum_finish_admIndividual,

            'resultsMonths' => $resultsMonths,

            'filterDay' => $filter,
            'filterYear' => $filterYear,
        ]);
    }
}

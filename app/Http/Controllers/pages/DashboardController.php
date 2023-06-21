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
        $filter = intval($request->input('filterDays', 30));
        $filterYear =  intval($request->input('filterYear', date('Y')));

        if ($filter > 365) {
            $filter = 365;
        }

        if($filterYear < 2023 || $filterYear > date('Y')){
            $filterYear = date('Y');
        }

        $filterDate = date('Y-m-d', strtotime('-' . $filter . ' days'));

        // COLETIVOS INICIO
        $qtd_update_judicial = JudicialCollective::where('updated_at', '>=', $filterDate)->sum('qtd_update');
        $updateJudicial = $qtd_update_judicial;

        $qtd_finish_judicial = JudicialCollective::where('updated_at', '>=', $filterDate)->sum('qtd_finish');
        $finishJudicial = $qtd_finish_judicial;

        $update_adm_judicial = AdministrativeCollective::where('updated_at', '>=', $filterDate)->sum('qtd_update');
        $admUpdateJudicial =  $update_adm_judicial;

        $finish_adm_judicial = AdministrativeCollective::where('updated_at', '>=', $filterDate)->sum('qtd_finish');
        $admFinishJudicial =  $finish_adm_judicial;

        $sum_update_judicial = json_encode($updateJudicial);
        $sum_finish_judicial = json_encode($finishJudicial);

        $sum_update_adm = json_encode($admUpdateJudicial);
        $sum_finish_adm = json_encode($admFinishJudicial);
        // COLETIVOS FIM

        // INDIVIDUAL INICIO
        $qtd_update_individual = JudicialIndividual::where('updated_at', '>=', $filterDate)->sum('qtd_update');
        $updateIndividual = $qtd_update_individual;

        $qtd_finish_individual = JudicialIndividual::where('updated_at', '>=', $filterDate)->sum('qtd_finish');
        $finishIndividual = $qtd_finish_individual;

        $update_adm_individual = AdministrativeIndividual::where('updated_at', '>=', $filterDate)->sum('qtd_update');
        $admUpdateIndividual =  $update_adm_individual;

        $finish_adm_individual = AdministrativeIndividual::where('updated_at', '>=', $filterDate)->sum('qtd_finish');
        $admFinishIndividual =  $finish_adm_individual;

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
            $months[] = $startDate->format('Y-m');
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

            'filterDay' => $filter
        ]);
    }
}

@extends('adminlte::page')
@extends('layout.links')

@section('plugins.Chartjs', true)

@section('title', 'Dashboard')

@section('content_header')
    <div class="mb-2 flex justify-between 2xl:flex xl:flex lg:flex md:justify-center sm:justify-center xs:justify-center">
        <h1 class="underline font-bold text-red-500">Dashboard</h1>

        <div class="2xl:flex xl:flex lg:flex md:hidden sm:hidden xs:hidden">
            <form method="get" class="mr-2">
                <select id="filterDays" name="filterDays" onchange="this.form.submit()"
                    class="w-[11rem] border border-1 rounded focus:ring-1 focus:ring-red-500">
                    <option {{ $filterDay == 30 ? 'selected="selected"' : '' }} value="30">Últimos 30 dias</option>
                    <option {{ $filterDay == 60 ? 'selected="selected"' : '' }} value="60">Últimos 2 meses</option>
                    <option {{ $filterDay == 120 ? 'selected="selected"' : '' }} value="120">Últimos 4 meses</option>
                    <option {{ $filterDay == 180 ? 'selected="selected"' : '' }} value="180">Últimos 6 meses</option>
                    <option {{ $filterDay == 365 ? 'selected="selected"' : '' }} value="365">Últimos 12 meses</option>
                </select>

                <select name="filterYear" id="filterYear" onchange="this.form.submit()"
                    class="w-[6rem] border border-1 rounded focus:ring-1 focus:ring-red-500">
                </select>
            </form>
        </div>
    </div>
@endsection

@section('content')

    <div class="2xl:hidden xl:hidden lg:hidden md:flex sm:flex xs:flex  mb-2 justify-end">
        <form method="get" class="mr-2">
            <select id="filterDays" name="filterDays" onchange="this.form.submit()"
                class="w-[6rem] border border-1 rounded focus:ring-1 focus:ring-red-500">
                <option {{ $filterDay == 30 ? 'selected="selected"' : '' }} value="30">Últimos 30 dias</option>
                <option {{ $filterDay == 60 ? 'selected="selected"' : '' }} value="60">Últimos 2 meses</option>
                <option {{ $filterDay == 120 ? 'selected="selected"' : '' }} value="120">Últimos 4 meses</option>
                <option {{ $filterDay == 180 ? 'selected="selected"' : '' }} value="180">Últimos 6 meses</option>
                <option {{ $filterDay == 365 ? 'selected="selected"' : '' }} value="365">Últimos 12 meses</option>
            </select>

            <select name="filterYear" id="filterYear2" onchange="this.form.submit()"
                class="w-[7rem] border border-1 rounded focus:ring-1 focus:ring-red-500">
            </select>
        </form>
    </div>

    <div class="card">
        <div class="bg-red-500 h-1">
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Situação dos Processos Coletivos
                            </h3>
                        </div>

                        <div class="m-0 flex justify-center items-center w-full">
                            <canvas id="barChart" class="h-[20rem]"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Situação dos Processos Individuais
                            </h3>
                        </div>

                        <div class="m-0 flex justify-center items-center w-full">
                            <canvas id="individualChart" class="h-[20rem]"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card p-2">
                        <div class="card-header">
                            <h3 class="card-title">
                                Quantidade de processos por mês
                            </h3>
                        </div>

                        <div class="flex justify-center items-center">
                            <canvas id="doughnutChart" class="h-[17rem]"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="card p-2">
                        <div class="card-header">
                            <h3 class="card-title">
                                Status dos processos
                            </h3>
                        </div>

                        <div class="m-7 flex justify-center items-center">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>

                {{-- <div class="card col-md-7">
                    <div class="card-header border-0">
                        <h3 class="card-title">Processos Coletivos em Andamento</h3>
                    </div>

                    <div class="card-body table-responsive p-0 w-full">
                        <table class="table table-hover table-valign-middle mb-2">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nome do processo</th>
                                    <th class="text-center">Status do processo</th>
                                    <th class="text-center">Detalhes do processo</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($limit_proccess as $proccesses)
                                    @if ($proccesses->progress_collective == 1 || $proccesses->update_collective == 1)
                                        <tr>
                                            <td class="text-center">{{ $proccesses->id }}</td>
                                            <td class="text-center">{{ $proccesses->name }}</td>
                                            @if ($proccesses->progress_collective == 1)
                                                <x-status textCenter="text-center" color="bg-primary">
                                                    <i class="fa-solid fa-gavel text-xs mr-1"></i>
                                                    Andamento
                                                </x-status>
                                            @else
                                                <x-status textCenter="text-center" color="bg-success">
                                                    <i class="fa-solid fa-circle-check text-xs mr-1"></i>
                                                    Atualizado
                                                </x-status>
                                            @endif

                                            <td class="text-center">
                                                <a
                                                    href="{{ route('collective.show', ['collective' => $proccesses->id]) }}">
                                                    <i class="fa-solid fa-file-lines text-sm mr-1"></i>
                                                    Detalhes
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>


    <script>
        var canvas = document.getElementById('barChart');
        var barChart;

        function createChart() {
            barChart = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: [
                        'Judicial Atualizados',
                        'Judicial Finalizados',
                        'Adm Atualizados',
                        'Adm Finalizados',
                    ],
                    datasets: [{
                        label: 'Situação dos Processos Coletivos',
                        barThickness: 50,
                        data: [
                            {!! $judicial_up !!},
                            {!! $judicial_finish !!},
                            {!! $adm_up !!},
                            {!! $adm_finish !!},
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(0, 255, 0, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgba(0, 255, 0)',
                            'rgba(75, 192, 192)',
                        ],
                        borderWidth: 1
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        tooltip: {
                            intersect: false,
                            mode: 'index',
                        },
                    }
                }
            });
        }

        function updateCollectiveNames() {
            if (window.innerWidth < 768) {
                barChart.data.labels = [
                    'Jud. Att',
                    'Jud. Final',
                    'Adm. Att',
                    'Adm. Final',
                ];
            } else {
                barChart.data.labels = [
                    'Judicial Atualizados',
                    'Judicial Finalizados',
                    'ADM Atualizados',
                    'ADM Finalizados',
                ];
            }

            barChart.update();
        }

        function updateChartOptions() {
            if (window.innerWidth < 768) {
                barChart.options.maintainAspectRatio = false;
                barChart.data.datasets[0].barThickness = 40;
            } else {
                barChart.options.maintainAspectRatio = true;
                barChart.data.datasets[0].barThickness = 80;
            }

            barChart.update();
        }
        createChart();
        updateChartOptions();
        updateCollectiveNames();

        window.addEventListener('resize', updateChartOptions);

        var individual = document.getElementById('individualChart');
        var individualChart;

        function createIndividualChart() {
            individualChart = new Chart(individual, {
                type: 'bar',
                data: {
                    labels: [
                        'Judicial Atualizados',
                        'Judicial Finalizados',
                        'ADM Atualizados',
                        'ADM Finalizados',
                    ],
                    datasets: [{
                        label: 'Situação dos Processos Individuais',
                        barThickness: 50,
                        data: [
                            {!! $individual_up !!},
                            {!! $individual_finish !!},
                            {!! $admIndividual_up !!},
                            {!! $admIndividual_finish !!},
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(0, 255, 0, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgba(0, 255, 0)',
                            'rgba(75, 192, 192)',
                        ],
                        borderWidth: 1
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        tooltip: {
                            intersect: false,
                            mode: 'index',
                        },
                    }
                }
            });
        }

        function updateLabelNames() {
            if (window.innerWidth < 768) {
                individualChart.data.labels = [
                    'Jud. Att',
                    'Jud. Final',
                    'Adm. Att',
                    'Adm. Final',
                ];
            } else {
                individualChart.data.labels = [
                    'Judicial Atualizados',
                    'Judicial Finalizados',
                    'ADM Atualizados',
                    'ADM Finalizados',
                ];
            }

            individualChart.update();
        }

        function updateIndividualChartOptions() {
            if (window.innerWidth < 768) {
                individualChart.options.maintainAspectRatio = false;
                individualChart.data.datasets[0].barThickness = 40;
                individualChart.data.labels[0].barThickness = 'Jud. Atual.';
            } else {
                individualChart.options.maintainAspectRatio = true;
                individualChart.data.datasets[0].barThickness = 80;
            }

            individualChart.update();
        }

        createIndividualChart();
        updateIndividualChartOptions();
        updateLabelNames();

        window.addEventListener('resize', updateIndividualChartOptions);

        const doughnut = document.getElementById('doughnutChart').getContext('2d')

        const resultsJson = '{!! $resultsMonths !!}';
        const resultsData = JSON.parse(resultsJson);

        new Chart(doughnut, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Agos', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: 'Quantidade de processos por mês',
                    data: Object.values(resultsData),
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132)',
                    ],
                    borderWidth: 1,
                    tension: 0.1,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            }
        });

        const pie = document.getElementById('pieChart').getContext('2d')

        new Chart(pie, {
            type: 'pie',
            data: {
                labels: ['Ganhos', 'Perdidos', 'Andamento'],
                datasets: [{
                    label: 'Proccesos',
                    data: [9, 2, 5, ],
                    backgroundColor: [
                        'rgb(75, 192, 192)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)'
                    ],
                    borderColor: [
                        'rgb(75, 192, 192,0.2)',
                    ],
                    borderWidth: 1,
                    tension: 0.1,
                }],
            },
            options: {
                responsive: true,
            }
        });
    </script>

    <script src="{{ asset('assets/js/getYear.js') }}"></script>
@endsection

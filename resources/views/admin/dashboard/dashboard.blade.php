@extends('adminlte::page')
@extends('layout.links')

@section('plugins.Chartjs', true)

@section('title', 'Dashboard')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')

    <div class="card">
        <div class="bg-red-500 h-1">
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Situação dos Processos
                            </h3>
                        </div>

                        <div class="m-2 flex justify-center items-center">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-2">
                        <div class="card-header">
                            <h3 class="card-title">
                                Situação de processos por mês
                            </h3>
                        </div>

                        <div class="flex justify-center items-center">
                            <canvas id="doughnutChart"></canvas>
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

                <div class="card col-md-7">
                    <div class="card-header border-0">
                        <h3 class="card-title">Processos em andamento</h3>
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
                                    @if ($proccesses->progress_proccess == 1 || $proccesses->update_proccess == 1)
                                        <tr>
                                            <td class="text-center">{{ $proccesses->id }}</td>
                                            <td class="text-center">{{ $proccesses->name }}</td>
                                            @if ($proccesses->progress_proccess == 1)
                                                <x-status textCenter="text-center" borderColor="border-sky-500"
                                                    textColor="text-sky-500">
                                                    <i class="fa-solid fa-gavel text-sm mr-1"></i>
                                                    Andamento
                                                </x-status>
                                            @else
                                                <x-status textCenter="text-center" borderColor="border-green-500"
                                                    textColor="text-green-500">
                                                    <i class="fa-solid fa-gavel text-sm mr-1"></i>
                                                    Atualizado
                                                </x-status>
                                            @endif

                                            <td class="text-center">
                                                <a href="{{ route('proccess.show', ['proccess' => $proccesses->id]) }}">
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
                </div>
            </div>
        </div>
    </div>


    <script>
        const bar = document.getElementById('barChart').getContext('2d')

        new Chart(bar, {
            type: 'bar',
            data: {
                labels: ['QTD: ATUALIZADOS', 'QTD: FINALIZADOS', 'QTD: REABERTOS'],
                datasets: [{
                    label: 'Situação dos Processos',
                    data: [{!! $qtd_values !!}, {!! $qtd_finish !!}, {!! $qtd_reopen !!}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgba(75, 192, 192)'
                    ],
                    borderWidth: 1
                }],
            },
            options: {
                responsive: true,
            }
        });

        const doughnut = document.getElementById('doughnutChart').getContext('2d')

        new Chart(doughnut, {
            type: 'line',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'],
                datasets: [{
                    label: 'Proccesos abertos por mês',
                    data: [9, 2, 5, 4, 8],
                    backgroundColor: [
                        'rgb(75, 192, 192)',
                    ],
                    borderColor: [
                        'rgb(75, 192, 192)',
                    ],
                    borderWidth: 1,
                    tension: 0.1,
                }],
            },
            options: {
                responsive: true,
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
                    // borderColor: [
                    //     'rgb(75, 192, 192)',
                    // ],
                    borderWidth: 1,
                    tension: 0.1,
                }],
            },
            options: {
                responsive: true,
            }
        });
    </script>
@endsection

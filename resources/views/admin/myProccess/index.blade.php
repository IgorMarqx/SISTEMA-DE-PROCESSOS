@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Meus Processos')

@section('content_header')
    <div class="mb-2">
    </div>
@endsection

@section('content')

    <div class="card">
        <div class="bg-red-500 h-1">

        </div>

        <div class="table-responsive">
            <table class="table table-hover table-valign-middle">
                <tr>
                    <th class="w-[15rem] text-center">Ação</th>
                    <th class="w-[15rem] text-center">Meu Processo</th>
                    <th class="w-[15rem] text-center">Tipo da ação</th>
                    <th class="w-[20rem] text-center">Status do Processo</th>
                    <th class="text-center">Ações</th>
                </tr>

                @foreach ($process as $processo)
                    <tr>

                        <td class="text-center">
                            @if ($processo->is_collective == 1)
                                <span class="float-center badge text-sm p-2 rounded-full bg-danger">
                                    Judicial Coletivo
                                </span>
                            @elseif ($processo->is_individual == 1)
                                <span class="float-center badge text-sm p-2 rounded-full bg-danger">
                                    Judicial Individual
                                </span>
                            @elseif ($processo->is_AdmCollective == 1)
                                <span class="float-center badge text-sm p-2 rounded-full bg-danger">
                                    Administrativo Coletivo
                                </span>
                            @elseif ($processo->is_AdmIndividual == 1)
                                <span class="float-center badge text-sm p-2 rounded-full bg-danger">
                                    Administrativo Individual
                                </span>
                            @endif
                        </td>

                        <td class="text-center">{{ $processo->name }}</td>

                        <td class="text-center">
                            @if ($processo->action_type == 1)
                                Coletivo Judicial Funcional
                            @else
                                Coletivo Judicial Particular
                            @endif
                        </td>

                        @if ($processo->progress_collective == 1)
                            <x-status textCenter="text-center" color="bg-primary">
                                <i class="fa-solid fa-gavel text-xs mr-1"></i>
                                Andamento
                            </x-status>
                        @elseif($processo->finish_collective == 1)
                            <x-status textCenter="text-center" color="bg-danger">
                                <i class="fa-solid fa-flag-checkered text-xs mr-1"></i>
                                Finalizado
                            </x-status>
                        @elseif($processo->update_collective == 1)
                            <x-status textCenter="text-center" color="bg-success">
                                <i class="fa-solid fa-circle-check text-xs mr-1"></i>
                                Atualizado
                            </x-status>
                        @endif

                        @if ($processo->progress_individuals == 1)
                            <x-status textCenter="text-center" color="bg-primary">
                                <i class="fa-solid fa-gavel text-xs mr-1"></i>
                                Andamento
                            </x-status>
                        @elseif($processo->finish_individuals == 1)
                            <x-status textCenter="text-center" color="bg-danger">
                                <i class="fa-solid fa-flag-checkered text-xs mr-1"></i>
                                Finalizado
                            </x-status>
                        @elseif($processo->update_individuals == 1)
                            <x-status textCenter="text-center" color="bg-success">
                                <i class="fa-solid fa-circle-check text-xs mr-1"></i>
                                Atualizado
                            </x-status>
                        @endif

                        <td class="text-center">
                            <x-button route="{{ route('singleProccess.show', ['singleProccess' => $processo->id]) }}"
                                color="text-yellow-400" hover="hover:text-yellow-500" margin="mr-2"
                                icon="fa-solid fa-eye text-sm mr-[0.2rem]">
                                Detalhes
                            </x-button>
                        </td>
                    </tr>
                @endforeach

        </div>
    </div>

    <script src="{{ asset('assets/js/activeNav.js') }}"></script>
@endsection

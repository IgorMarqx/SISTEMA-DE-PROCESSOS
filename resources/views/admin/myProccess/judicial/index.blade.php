@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Meus Processos')

@section('content_header')
    <div class="mb-2">
    </div>
@endsection

@section('content')

    <div class="flex justify-center items-center gap-4 font-bold mb-3">
        <a id="judicial" class="border-2 border-red-500 p-2 rounded text-red-500 hover:bg-red-500 hover:text-white"
            href="{{ route('singleProccess.index') }}">Coletivos</a>
        <a id="administrative" class="border-2 border-red-500 p-2 rounded text-red-500 hover:bg-red-500 hover:text-white"
            href="{{ route('administrativeIndex') }}">Individuais</a>
    </div>

    <div class="card">
        <div class="bg-red-500 h-1">

        </div>

        <div class="table-responsive">
            <table class="table table-hover table-valign-middle">
                <tr>
                    <th class="w-[15rem] text-center">N° Processo</th>
                    <th class="w-[15rem] text-center">Meu Processo</th>
                    <th class="w-[15rem] text-center">Tipo da ação</th>
                    <th class="w-[20rem] text-center">Status do Processo</th>
                    <th class="text-center">Ações</th>
                </tr>

                @foreach ($process as $processo)
                    <tr>
                        <td class="text-center">{{ $processo->id }}</td>
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

                        <td class="text-center"></td>
                    </tr>
                @endforeach

        </div>
    </div>

    <script src="{{ asset('assets/js/activeNav.js') }}"></script>
@endsection

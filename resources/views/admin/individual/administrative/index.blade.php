@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Processos')

@section('content_header')
    <div class="mb-2">
        <h3 class="text-red-500 font-bold underline flex justify-center items-center">Processos Administrativos Individuais
        </h3>
    </div>
@endsection

@section('content')

    @if (session('success'))
        @include('components.success')
    @endif

    @if (session('error'))
        @include('components.error')
    @endif

    @if (session('warning'))
        @include('components.warning')
    @endif


    <div class="mb-4">
        <a href="{{ route('individual.create') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
            Novo Processo
        </a>

        <div class="row mt-3">
            <x-card quantity="{{ $individual_count }}" size="col-md-3" icon="fa-solid fa-book">
                Processos Judiciais
            </x-card>

            <x-card quantity="{{ $progress_count }}" size="col-md-3" icon="fa-solid fa-gavel">
                Processos em Andamento
            </x-card>

            <x-card quantity="{{ $update_count }}" size="col-md-3" icon="fa-solid fa-circle-check">
                Processos Atualizados
            </x-card>

            <x-card quantity="{{ $finish_count }}" size="col-md-3" icon="fa-solid fa-flag-checkered">
                Processos Finalizados
            </x-card>
        </div>

        <div class="flex justify-center items-center gap-4 font-bold mb-3">
            <a id="" class="border-2 border-red-500 p-2 rounded text-red-500 hover:bg-red-500 hover:text-white"
                href="{{ route('individual.index') }}">Judiciais</a>
            <a id="judicial" class="border-2 border-red-500 p-2 rounded text-red-500 hover:bg-red-500 hover:text-white"
                href="{{ route('administrative_individual.index') }}">Administrativos</a>
        </div>

        @if ($individual->isEmpty())
            <div class="flex flex-col justify-center items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="text-base">Você não possui processos!</span>
                <span class="text-base">Seus Processos aparecerão aqui.</span>
            </div>
        @else
            <div class="card mt-1 ">
                <div class="bg-red-500 h-1">

                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-valign-middle">
                        <tr>
                            <th class="w-[5rem] text-center">ID</th>
                            <th class="w-[15rem] text-center">Nome do Processo</th>
                            <th class="w-[15rem] text-center">Tipo da ação</th>
                            <th class="w-[20rem] text-center">Status do Processo</th>
                            <th class="text-center">Ações</th>
                        </tr>

                        @foreach ($individual as $individuals)
                            <tr>
                                <td class="text-center">{{ $individuals->id }}</td>
                                <td class="text-center">{{ ucfirst($individuals->name) }} </td>
                                <td class="text-center">
                                    @if ($individuals->action_type == 1)
                                        Individual Judicial Funcional
                                    @else
                                        Individual Judicial Particular
                                    @endif
                                </td>

                                @if ($individuals->progress_individuals == 1)
                                    <x-status textCenter="text-center" color="bg-primary">
                                        <i class="fa-solid fa-gavel text-xs mr-1"></i>
                                        Andamento
                                    </x-status>
                                @elseif($individuals->finish_individuals == 1)
                                    <x-status textCenter="text-center" color="bg-danger">
                                        <i class="fa-solid fa-flag-checkered text-xs mr-1"></i>
                                        Finalizado
                                    </x-status>
                                @elseif($individuals->update_individuals == 1)
                                    <x-status textCenter="text-center" color="bg-success">
                                        <i class="fa-solid fa-circle-check text-xs mr-1"></i>
                                        Atualizado
                                    </x-status>
                                @endif

                                <td class="lg:hidden md:hidden sm:hidden xs:hidden xl:text-center 2xl:text-center">
                                    <x-button
                                        route="{{ route('administrative_individual.show', ['administrative_individual' => $individuals->id]) }}"
                                        color="text-yellow-400" hover="hover:text-yellow-500" margin="mr-2"
                                        icon="fa-solid fa-eye text-sm mr-[0.2rem]">
                                        Detalhes
                                    </x-button>

                                    @if ($individuals->finish_individuals == 1)
                                    @else
                                        <x-button
                                            route="{{ route('administrative_individual.edit', ['administrative_individual' => $individuals->id]) }}"
                                            color="text-green-500" hover="hover:text-green-600" margin="mr-2"
                                            icon="fa-solid fa-pencil text-sm mr-[0.2rem]">
                                            Editar
                                        </x-button>
                                    @endif

                                    <x-button route="{{ route('adm_individual_finish', ['id' => $individuals->id]) }}"
                                        color="text-sky-500" hover="hover:text-sky-600" margin="mr-1"
                                        icon="fa-solid fa-flag-checkered text-sm mr-[0.2rem]">
                                        Finalizar
                                    </x-button>

                                    <a href="" data-bs-toggle="modal"
                                        onclick="exibirModalExclusao({{ $individuals->id }})"
                                        class="text-red-500 hover:text-red-600 ml-1">
                                        <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                        Excluir
                                    </a>
                                </td>

                                @include('admin.modals.individual.administrativeDelete')

                                <td class="xl:hidden 2xl:hidden">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Ações
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('individual.show', ['individual' => $individuals->id]) }}">
                                                <span class="text-yellow-500">
                                                    <i class="fa-solid fa-eye text-sm mr-[0.2rem]"></i>
                                                    Detalhes
                                                </span>
                                            </a>

                                            @if ($individuals->finish_individuals == 1)
                                            @else
                                                <a class="dropdown-item"
                                                    href="{{ route('individual.edit', ['individual' => $individuals->id]) }}">
                                                    <span class="text-green-500">
                                                        <i class="fa-solid fa-pencil text-sm mr-[0.2rem]"></i>
                                                        Editar
                                                    </span>
                                                </a>
                                            @endif

                                            <a class="dropdown-item"
                                                href="{{ route('adm_individual_finish', ['id' => $individuals->id]) }}">
                                                <span class="text-sky-500">
                                                    <i class="fa-solid fa-flag-checkered text-sm mr-[0.2rem]"></i>
                                                    Finalizar
                                                </span>
                                            </a>
                                            <a href="" data-bs-toggle="modal"
                                                onclick="exibirModalExclusao({{ $individuals->id }})"
                                                class="dropdown-item text-danger">
                                                <span class="text-red-500">
                                                    <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                                    Excluir
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @endif
    </div>

    <script src="{{ asset('assets/js/activeNav.js') }}"></script>
    {{ $individual->links('pagination::bootstrap-4') }}
@endsection

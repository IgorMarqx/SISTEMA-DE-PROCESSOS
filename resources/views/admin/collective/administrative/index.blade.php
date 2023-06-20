@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Processos')

@section('content_header')
    <div class="mb-2">
        <h3 class="text-red-500 font-bold underline flex justify-center items-center">Processos Administrativos Coletivos
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
        <a href="{{ route('administrative_collective.create') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
            Novo Processo
        </a>

        <div class="row mt-3">
            <x-card quantity="{{ $administrative_count }}" size="col-md-3" icon="fa-solid fa-book">
                Processos Administrativos
            </x-card>

            <x-card quantity="{{ $progress_administrative }}" size="col-md-3" icon="fa-solid fa-gavel">
                Processos em Andamento
            </x-card>

            <x-card quantity="{{ $update_administrative }}" size="col-md-3" icon="fa-solid fa-circle-check">
                Processos Atualizados
            </x-card>

            <x-card quantity="{{ $finish_administrative }}" size=" col-md-3" icon="fa-solid fa-flag-checkered">
                Processos Finalizados
            </x-card>
        </div>

        <div class="flex justify-center items-center gap-4 font-bold mb-3">
            <a id="" class="border-2 border-red-500 p-2 rounded text-red-500 hover:bg-red-500 hover:text-white "
                href="{{ route('collective.index') }}">Judiciais</a>
            <a id="judicial" class="border-2 border-red-500 p-2 rounded text-red-500 hover:bg-red-500 hover:text-white"
                href="{{ route('administrative_collective.index') }}">Administrativos</a>
        </div>

        @if ($administrative->isEmpty())
            <div class="flex flex-col justify-center items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="text-base">Você não possui processos!</span>
                <span class="text-base">Seus Processos aparecerão aqui.</span>
            </div>
        @else
            <x-tabela>
                <tr>
                    <th class="w-[5rem] text-center">ID</th>
                    <th class="w-[15rem] text-center">Nome do Processo</th>
                    <th class="w-[15rem] text-center">Tipo do ação</th>
                    <th class="w-[20rem] text-center">Status do Processo</th>
                    <th class="text-center">Ações</th>
                </tr>

                @foreach ($administrative as $administratives)
                    <tr>
                        <td class="text-center">{{ $administratives->id }}</td>
                        <td class="text-center">{{ ucfirst($administratives->name) }} </td>
                        <td class="text-center">
                            @if ($administratives->action_type == 1)
                                Coletivo Judicial Funcional
                            @else
                                Coletivo Judicial Particular
                            @endif
                        </td>

                        @if ($administratives->progress_collective == 1)
                            <x-status textCenter="text-center" color="bg-primary">
                                <i class="fa-solid fa-gavel text-xs mr-1"></i>
                                Andamento
                            </x-status>
                        @elseif($administratives->finish_collective == 1)
                            <x-status textCenter="text-center" color="bg-danger">
                                <i class="fa-solid fa-flag-checkered text-xs mr-1"></i>
                                Finalizado
                            </x-status>
                        @elseif($administratives->update_collective == 1)
                            <x-status textCenter="text-center" color="bg-success">
                                <i class="fa-solid fa-circle-check text-xs mr-1"></i>
                                Atualizado
                            </x-status>
                        @endif

                        <td class="lg:hidden md:hidden sm:hidden xs:hidden xl:text-center 2xl:text-center">
                            <x-button
                                route="{{ route('administrative_collective.show', ['administrative_collective' => $administratives->id]) }}"
                                color="text-yellow-400" hover="hover:text-yellow-500" margin="mr-2"
                                icon="fa-solid fa-eye text-sm mr-[0.2rem]">
                                Detalhes
                            </x-button>

                            @if ($administratives->finish_collective == 1)
                            @else
                                <x-button
                                    route="{{ route('administrative_collective.edit', ['administrative_collective' => $administratives->id]) }}"
                                    color="text-green-500" hover="hover:text-green-600" margin="mr-2"
                                    icon="fa-solid fa-pencil text-sm mr-[0.2rem]">
                                    Editar
                                </x-button>
                            @endif

                            <x-button route="{{ route('adm_finish', ['id' => $administratives->id]) }}"
                                color="text-sky-500" hover="hover:text-sky-600" margin="mr-1"
                                icon="fa-solid fa-flag-checkered text-sm mr-[0.2rem]">
                                Finalizar
                            </x-button>

                            <a href="" data-bs-toggle="modal"
                                onclick="exibirModalExclusao({{ $administratives->id }})"
                                class="text-red-500 hover:text-red-600 ml-1">
                                <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                Excluir
                            </a>
                        </td>

                        @include('admin.modals.administrative.administrative')

                        <td class="xl:hidden 2xl:hidden">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Ações
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('administrative_collective.show', ['administrative_collective' => $administratives->id]) }}">
                                        <span class="text-yellow-500">
                                            <i class="fa-solid fa-eye text-sm mr-[0.2rem]"></i>
                                            Detalhes
                                        </span>
                                    </a>

                                    @if ($administratives->finish_collective == 1)
                                    @else
                                        <a class="dropdown-item"
                                            href="{{ route('administrative_collective.edit', ['administrative_collective' => $administratives->id]) }}">
                                            <span class="text-green-500">
                                                <i class="fa-solid fa-pencil text-sm mr-[0.2rem]"></i>
                                                Editar
                                            </span>
                                        </a>
                                    @endif

                                    <a class="dropdown-item"
                                        href="{{ route('adm_finish', ['id' => $administratives->id]) }}">
                                        <span class="text-sky-500">
                                            <i class="fa-solid fa-flag-checkered text-sm mr-[0.2rem]"></i>
                                            Finalizar
                                        </span>
                                    </a>
                                    <a href="" data-bs-toggle="modal"
                                        onclick="exibirModalExclusao({{ $administratives->id }})"
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
            </x-tabela>
        @endif
    </div>

    <script src="{{ asset('assets/js/activeNav.js') }}"></script>

@endsection

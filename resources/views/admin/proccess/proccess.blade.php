@extends('adminlte::page')
@extends('layout.links')

@section('title', 'Processos - SINDJUF')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')

    @if (session()->has('success'))
        @include('components.notification')
    @endif

    <div class="mb-4">
        <a href="{{ route('proccess.create') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
            Novo Processo
        </a>

        <div class="row mt-3">
            <x-card quantity="{{ $proccessCount }}" size="col-md-3" icon="fa-solid fa-book">
                Quantidade de Processos
            </x-card>

            <x-card quantity="{{ $progressCount }}" size="col-md-3" icon="fa-solid fa-gavel">
                Processos em Andamento
            </x-card>

            <x-card quantity="{{ $updateCount }}" size="col-md-3" icon="fa-solid fa-circle-check">
                Processos Atualizados
            </x-card>

            <x-card quantity="{{ $finishCount }}" size="col-md-3" icon="fa-solid fa-flag-checkered">
                Processos Finalizados
            </x-card>
        </div>

        <div class="card mt-1 sm:overflow-x-scroll">
            <div class="bg-red-500 h-1">

            </div>

            <table class="table table-hover">
                <tr>
                    <th class="w-[5rem] text-center">ID</th>
                    <th class="w-[15rem] text-center">Nome do Processo</th>
                    <th class="w-[20rem] text-center">URL do Processo</th>
                    <th class="w-[15rem] text-center">Status do Processo</th>
                    <th class="text-center">Ações</th>
                </tr>

                @foreach ($proccess as $proccesses)
                    <tr>
                        <td class="text-center">{{ $proccesses->id }}</td>
                        <td class="text-center">{{ ucfirst($proccesses->name) }} </td>
                        <td class="text-center"><a href="{{ $proccesses->url_proccess }}" target="_blank">
                                {{ $proccesses->url_proccess }}</a>
                        </td>

                        @if ($proccesses->progress_proccess == 1)
                            <x-status borderColor="border-sky-500" textColor="text-sky-500">
                                <i class="fa-solid fa-gavel text-sm mr-1"></i>
                                Andamento
                            </x-status>
                        @elseif($proccesses->finish_proccess == 1)
                            <x-status borderColor="border-red-500" textColor="text-red-500">
                                <i class="fa-solid fa-flag-checkered text-sm mr-1"></i>
                                Finalizado
                            </x-status>
                        @elseif($proccesses->update_proccess == 1)
                            <x-status borderColor="border-green-500" textColor="text-green-500">
                                <i class="fa-solid fa-circle-check text-sm mr-1"></i>
                                Atualizado
                            </x-status>
                        @endif

                        <td>
                            <x-button route="{{ route('proccess.show', ['proccess' => $proccesses->id]) }}"
                                color="text-yellow-400" hover="hover:text-yellow-500" margin="mr-2"
                                icon="fa-solid fa-circle-info text-sm mr-[0.2rem]">
                                Detalhes
                            </x-button>

                            <x-button route="{{ route('proccess.edit', ['proccess' => $proccesses->id]) }}"
                                color="text-green-500" hover="hover:text-green-600" margin="mr-1"
                                icon="fa-solid fa-pencil text-sm mr-[0.2rem]">
                                Editar
                            </x-button>

                            <a href="" data-bs-toggle="modal" data-bs-target="#finishModal"
                                class="text-sky-500 hover:text-sky-600 mr-1">
                                <i class="fa-solid fa-flag-checkered text-sm mr-[0.2rem]"></i>
                                Finalizar
                            </a>
                            @include('admin.modals.finish')

                            {{-- <x-button route="{{ route('finish', ['id' => $proccesses->id]) }}" color="text-sky-500"
                                hover="hover:text-sky-600" margin="mr-1"
                                icon="fa-solid fa-flag-checkered text-sm mr-[0.2rem]">
                                Finalizar
                            </x-button> --}}

                            @if ($proccesses->id)
                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    class="text-red-500 hover:text-red-600 ml-1">
                                    <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                    Excluir
                                </a>
                                @include('admin.modals.proccess')
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


    {{ $proccess->links('pagination::bootstrap-4') }}
@endsection

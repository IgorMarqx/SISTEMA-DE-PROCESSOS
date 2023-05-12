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
            <x-card quantity="" size="col-md-3" icon="fa-solid fa-book">
                Quantidade de Processos
            </x-card>

            <x-card quantity="" size="col-md-3" icon="fa-solid fa-gavel">
                Processos em Andamento
            </x-card>

            <x-card quantity="" size="col-md-3" icon="fa-solid fa-circle-check">
                Processos Atualizados
            </x-card>

            <x-card quantity="" size="col-md-3" icon="fa-solid fa-flag-checkered">
                Processos Finalizados
            </x-card>
        </div>


        <div class="card mt-1">
            <div class="bg-red-500 h-1">

            </div>

            <table class="table table-hover">
                <tr>
                    <th class="w-[5rem]">ID</th>
                    <th class="w-[15rem]">Nome do Processo</th>
                    <th class="w-[20rem]">URL do Processo</th>
                    <th class="w-[20rem]">Status do Processo</th>
                    <th>Ações</th>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td>
                        <x-button route="" color="text-yellow-400" hover="hover:text-yellow-500" margin="mr-2"
                            icon="fa-solid fa-circle-info text-sm mr-[0.2rem]">
                            Detalhes
                        </x-button>

                        <x-button route="{{ route('proccess.edit', ['proccess']) }}" color="text-green-500"
                            hover="hover:text-green-600" margin="mr-1" icon="fa-solid fa-pencil text-sm mr-[0.2rem]">
                            Editar
                        </x-button>

                        <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            class="text-red-500 hover:text-red-600 ml-1">
                            <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                            Excluir
                        </a>
                        @include('admin.modals.proccess')
                    </td>
                </tr>
            </table>
        </div>
    </div>


    {{-- {{ $users->links('pagination::bootstrap-4') }} --}}
@endsection

@extends('adminlte::page')
@extends('layout.links')

@section('title', 'Processos')

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

            <a href="#" class="col-md-3">
                <div class="info-box bg-white ">
                    <span class="info-box-icon bg-danger text-white elevation-1">
                        <i class="fa-solid fa-book"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Quantidade de Processos</span>
                        <span class="info-box-number"></span>
                    </div>
                </div>
            </a>

            <a href="#" class="col-md-3">
                <div class="info-box bg-white ">
                    <span class="info-box-icon bg-danger elevation-1">
                        <i class="fa-solid fa-gavel"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Processos em Andamento</span>
                        <span class="info-box-number"></span>
                    </div>
                </div>
            </a>

            <a href="#" class="col-md-3">
                <div class="info-box bg-white ">
                    <span class="info-box-icon bg-danger elevation-1">
                        <i class="fa-solid fa-circle-check"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Processos Atualizados</span>
                        <span class="info-box-number"></span>
                    </div>
                </div>
            </a>

            <a href="#" class="col-md-3">
                <div class="info-box bg-white ">
                    <span class="info-box-icon bg-danger elevation-1">
                        <i class="fa-solid fa-flag-checkered"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Processos Concluidos</span>
                        <span class="info-box-number"></span>
                    </div>
                </div>
            </a>
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
                        <x-button route="" color="text-yellow-400" hover="hover:text-yellow-500" margin="mr-2">
                            <i class="fa-solid fa-circle-info text-sm mr-[0.2rem]"></i>
                            Detalhes
                        </x-button>

                        <x-button route="{{ route('proccess.edit', ['proccess']) }}" color="text-green-500" hover="hover:text-green-600"
                            margin="mr-1">
                            <i class="fa-solid fa-pencil text-sm mr-[0.2rem]"></i>
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

@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Processos')

@section('content_header')
    <div class="mb-2"></div>
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
        <a href="{{ route('proccess.index') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
            <i class="fa-solid fa-reply"></i>
        </a>

        @if ($proccess->finish_proccess == 1)
            <a href="{{ route('reopen', ['id' => $proccess->id]) }}"
                class="bg-yellow-400 text-white p-2 rounded hover:bg-yellow-500 transition ease-in-out duration-600 mr-2">
                <i class="fa-solid fa-gavel text-sm mr-1"></i>
                Reabrir Processo
            </a>
        @else
            <a
                href="{{ route('proccess.edit', ['proccess' => $proccess->id]) }}"class="bg-green-500 text-white p-2 rounded hover:bg-green-600 transition ease-in-out duration-600 mr-2">
                <i class="fa-solid fa-pen text-sm mr-1"></i>
                Editar Processo
            </a>
        @endif



        <div class="row mt-3">
            <x-card quantity="{{ $proccess->qtd_update }}" size="col-md-4" icon="fa-solid fa-circle-check">
                Atualizações
            </x-card>

            <x-card quantity="{{ $proccess->qtd_finish }}" size="col-md-4" icon="fa-solid fa-flag-checkered">
                Finalizações
            </x-card>

            <x-card quantity="{{ $proccess->qtd_reopen }}" size="col-md-4" icon="fa-solid fa-gavel">
                Reabertos
            </x-card>
        </div>

        <div class="card mt-1">
            <div class="bg-red-500 h-1">

            </div>

            <div class="card-body">
                <div class="flex items-center justify-center text-white bg-red-500">
                    <h4 class="m-0 text-bold">Informações do cliente</h4>
                </div>

                <div
                    class="flex justify-center items-center gap-12 mt-2 flex-wrap hover:bg-gray-100 p-4 border border-gray-200">

                    <x-details title="ID do Cliente">
                        {{ ucfirst($user->id) }}
                    </x-details>

                    <x-details title="Nome do Cliente">
                        {{ ucfirst($user->name) }}
                    </x-details>

                    <x-details title="E-mail do Cliente">
                        {{ ucfirst($user->email) }}
                    </x-details>

                    <x-details title="Data de criação">
                        {{ date('d/m/Y H:i', strtotime($user->created_at)) }}
                    </x-details>

                </div>

                <div class="flex items-center justify-center text-white bg-red-500 mt-4">
                    <h4 class="m-0 text-bold">Informações do processo</h4>
                </div>

                <div
                    class="flex justify-center items-center gap-12 mt-2 flex-wrap hover:bg-gray-100 p-4 border border-gray-200">

                    <x-details title="ID do Processo">
                        {{ ucfirst($proccess->id) }}
                    </x-details>

                    <x-details title="Nome do Processo">
                        {{ ucfirst($proccess->name) }}
                    </x-details>

                    <x-details title="E-mail da coorporação">
                        {{ $proccess->email_coorporative }}
                    </x-details>

                    <x-detailsLink title="Data de criação" url="{{ $proccess->url_proccess }}">
                        {{ $proccess->url_proccess }}
                    </x-detailsLink>

                    <x-details title="Data de criação">
                        {{ date('d/m/Y H:i', strtotime($proccess->created_at)) }}
                    </x-details>

                    <x-details title="Data de atualização">
                        {{ date('d/m/Y H:i', strtotime($proccess->updated_at)) }}
                    </x-details>

                </div>
            </div>

        </div>
    </div>


@endsection

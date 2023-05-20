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
        <div class="flex justify-between">
            <div>
                <a href="{{ route('administrative_collective.index') }}"
                    class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
                    <i class="fa-solid fa-reply"></i>
                </a>

                @if ($administrative->finish_collective == 1)
                    <a href="{{ route('reopen', ['id' => $administrative->id]) }}"
                        class="bg-yellow-400 text-white p-2 rounded hover:bg-yellow-500 transition ease-in-out duration-600 mr-2">
                        <i class="fa-solid fa-gavel text-sm mr-1"></i>
                        Reabrir Processo
                    </a>
                @else
                    <a
                        href="{{ route('collective.edit', ['collective' => $administrative->id]) }}"class="bg-green-500 text-white p-2 rounded hover:bg-green-600 transition ease-in-out duration-600 mr-2">
                        <i class="fa-solid fa-pen text-sm mr-1"></i>
                        Editar Processo
                    </a>
                @endif

                @if ($administrative->finish_collective == 1)
                @else
                    <a href="" data-bs-toggle="modal" data-bs-target="#fileModal"
                        class="bg-sky-500 text-white p-2 rounded hover:bg-sky-600 transition ease-in-out duration-600 mr-2">
                        Anexar Arquivo
                    </a>
                @endif
                {{-- @include('admin.modals.file') --}}
            </div>

            <div>
                @if ($administrative->progress_collective == 1)
                    <x-status textCenter="text-center" borderColor="border-sky-500" textColor="text-sky-500">
                        <i class="fa-solid fa-gavel text-sm mr-1"></i>
                        Andamento
                    </x-status>
                @elseif($administrative->finish_collective == 1)
                    <x-status textCenter="text-center" borderColor="border-red-500" textColor="text-red-500">
                        <i class="fa-solid fa-flag-checkered text-sm mr-1"></i>
                        Finalizado
                    </x-status>
                @elseif($administrative->update_collective == 1)
                    <x-status textCenter="text-center" borderColor="border-green-500" textColor="text-green-500">
                        <i class="fa-solid fa-circle-check text-sm mr-1"></i>
                        Atualizado
                    </x-status>
                @endif
            </div>

        </div>




        <div class="row mt-3">
            <x-card quantity="{{ $administrative->qtd_update }}" size="col-md-4" icon="fa-solid fa-circle-check">
                Atualizações
            </x-card>

            <x-card quantity="{{ $administrative->qtd_finish }}" size="col-md-4" icon="fa-solid fa-flag-checkered">
                Finalizações
            </x-card>

            <x-card quantity="{{ $administrative->qtd_reopen }}" size="col-md-4" icon="fa-solid fa-gavel">
                Reaberto
            </x-card>
        </div>

        <div class="card mt-1">
            <div class="bg-red-500 h-1">

            </div>

            <div class="card-body">
                <div class="flex items-center justify-center text-black bg-gray-200">
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

                <div class="flex items-center justify-center bg-gray-200 mt-4">
                    <h4 class=" text-black m-0 text-bold">Informações do processo</h4>
                </div>

                <div
                    class="flex justify-center items-center gap-12 mt-2 flex-wrap hover:bg-gray-100 p-4 border border-gray-200">

                    <x-details title="ID do Processo">
                        {{ ucfirst($administrative->id) }}
                    </x-details>

                    <x-details title="Nome do Processo">
                        {{ ucfirst($administrative->name) }}
                    </x-details>

                    <x-details title="E-mail da Coorporação">
                        {{ $administrative->email_coorporative }}
                    </x-details>

                    <x-detailsLink title="URL do Processo" url="{{ $administrative->url_collective }}">
                        {{ $administrative->url_collective }}
                    </x-detailsLink>

                    <x-details title="Data de Criação">
                        {{ date('d/m/Y H:i', strtotime($administrative->created_at)) }}
                    </x-details>

                    <x-details title="Data de Atualização">
                        {{ date('d/m/Y H:i', strtotime($administrative->updated_at)) }}
                    </x-details>

                </div>

                <div class="flex items-center justify-center text-black bg-gray-200 mt-4">
                    <h4 class="m-0 text-bold">Anexos</h4>
                </div>

                <div class="flex justify-center items-center flex-wrap mt-3 mb-3 gap-3">
                    @foreach ($attachment as $attachments)
                        <div class="flex flex-col">
                            <div class="bg-gray-200 hover:bg-gray-300 rounded p-4 cursor-pointer text-black">
                                <i class="fa-solid fa-file-pdf text-lg"></i>
                                {{ $attachments->title }}
                            </div>
                            <div class="flex items-center justify-center">
                                <a href="" data-bs-toggle="modal"
                                    onclick="exibirModalExclusao({{ $attachments->id }})"
                                    class="text-red-500 hover:text-red-600">
                                    <i class="fa-solid fa-trash-can text-sm mr-1"></i>
                                    Excluir anexo
                                </a>
                            </div>
                            @include('admin.modals.pdf')
                        </div>
                    @endforeach
                </div>

            </div>


        </div>
    </div>


@endsection

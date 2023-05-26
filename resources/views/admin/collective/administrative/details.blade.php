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

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#fileModal').modal('show');
            });
        </script>
        @include('admin.modals.admFile')
    @endif


    <div class="mb-4">
        <div class="flex justify-between">
            <div>
                <a href="{{ route('administrative_collective.index') }}"
                    class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
                    <i class="fa-solid fa-reply"></i>
                </a>

                @if ($administrative->finish_collective == 1)
                @else
                    <a
                        href="{{ route('administrative_collective.edit', ['administrative_collective' => $administrative->id]) }}"class="bg-green-500 text-white p-2 rounded hover:bg-green-600 transition ease-in-out duration-600 mr-2">
                        <i class="fa-solid fa-pen text-sm mr-1"></i>
                        Editar Processo
                    </a>

                    <a href="" data-bs-toggle="modal" data-bs-target="#fileModal"
                        class="bg-sky-500 text-white p-2 rounded hover:bg-sky-600 transition ease-in-out duration-600 mr-2">
                        Anexar Arquivo
                    </a>
                @endif
                @include('admin.modals.admFile')
            </div>

            <div>
                @if ($administrative->progress_collective == 1)
                    <x-status textCenter="text-center" color="bg-primary">
                        <i class="fa-solid fa-gavel text-xs mr-1"></i>
                        Andamento
                    </x-status>
                @elseif($administrative->finish_collective == 1)
                    <x-status textCenter="text-center" color="bg-danger">
                        <i class="fa-solid fa-flag-checkered text-xs mr-1"></i>
                        Finalizado
                    </x-status>
                @elseif($administrative->update_collective == 1)
                    <x-status textCenter="text-center" color="bg-success">
                        <i class="fa-solid fa-circle-check text-xs mr-1"></i>
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

                    @if ($user->email)
                        <x-details title="E-mail do Cliente">
                            {{ ucfirst($user->email) }}
                        </x-details>
                    @else
                        <x-details title="E-mail do Cliente">
                            <span class="text-red-500">E-mail não informado</span>
                        </x-details>
                    @endif

                    <x-details title="Orgão">
                        {{ ucfirst($user->organ) }}
                    </x-details>

                    <x-details title="Cargo">
                        {{ ucfirst($user->office) }}
                    </x-details>

                    <x-details title="Lotação">
                        {{ ucfirst($user->capacity) }}
                    </x-details>

                    <x-details title="Telefone">
                        {{ ucfirst($user->telephone) }}
                    </x-details>

                    @if ($user->created_at == null)
                        <x-details title="E-mail do Cliente">
                            <span class="text-red-500">E-mail não informado</span>
                        </x-details>
                    @else
                        <x-details title="Data de criação">
                            {{ date('d/m/Y H:i', strtotime($user->created_at)) }}
                        </x-details>
                    @endif



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

                    @if ($administrative->url_collective)
                        <x-detailsLink title="URL do Processo" url="{{ $administrative->url_collective }}">
                            {{ $administrative->url_collective }}
                        </x-detailsLink>
                    @else
                        <x-details title="URL do Processo">
                            <span class="text-red-500">URL não informada</span>
                        </x-details>
                    @endif



                    <x-details title="Tipo da ação">
                        @if ($administrative->action_type == 1)
                            Processo Coletivo Judicial Funcional
                        @else
                            Processo Coletivo Judicial Particular
                        @endif
                    </x-details>

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
                            <a href="{{ route('downloadAttachment', ['id' => $attachments->id]) }}"
                                class="bg-gray-200 hover:bg-gray-300 hover:text-gray-500 rounded p-4 cursor-pointer text-black">
                                <i class="fa-solid fa-file-pdf text-lg"></i>
                                {{ $attachments->title }}
                            </a>
                            <div class="flex items-center justify-center">
                                <a href="" data-bs-toggle="modal"
                                    onclick="exibirModalExclusao({{ $attachments->id }})"
                                    class="text-red-500 hover:text-red-600">
                                    <i class="fa-solid fa-trash-can text-sm mr-1"></i>
                                    Excluir anexo
                                </a>
                            </div>
                            @include('admin.modals.admPdf')
                        </div>
                    @endforeach
                </div>

            </div>


        </div>
    </div>


@endsection

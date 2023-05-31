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
                $('#indFileModal').modal('show');
            });
        </script>
    @endif

    @include('admin.modals.individual.individualFile')

    <div class="mb-4">
        <div class="flex justify-between">
            <div>
                <a href="{{ route('individual.index') }}"
                    class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
                    <i class="fa-solid fa-reply"></i>
                </a>

                @if ($individual->finish_individuals == 1)
                @else
                    <a
                        href="{{ route('individual.edit', ['individual' => $individual->id]) }}"class="bg-green-500 text-white p-2 rounded hover:bg-green-600 transition ease-in-out duration-600 mr-2">
                        <i class="fa-solid fa-pen text-sm mr-1"></i>
                        Editar Processo
                    </a>
                    @endif

                @if ($individual->finish_individuals == 1)
                @else
                    <a href="" data-bs-toggle="modal" data-bs-target="#indFileModal"
                        class="bg-sky-500 text-white p-2 rounded hover:bg-sky-600 transition ease-in-out duration-600 mr-2">
                        Anexar Arquivo
                    </a>
                @endif
            </div>

            <div>
                @if ($individual->progress_individuals == 1)
                    <x-status textCenter="text-center" color="bg-primary">
                        <i class="fa-solid fa-gavel text-xs mr-1"></i>
                        Andamento
                    </x-status>
                @elseif($individual->finish_individuals == 1)
                    <x-status textCenter="text-center" color="bg-danger">
                        <i class="fa-solid fa-flag-checkered text-xs mr-1"></i>
                        Finalizado
                    </x-status>
                @elseif($individual->update_individuals == 1)
                    <x-status textCenter="text-center" color="bg-success">
                        <i class="fa-solid fa-circle-check text-xs mr-1"></i>
                        Atualizado
                    </x-status>
                @endif
            </div>

        </div>

        <div class="row mt-3">
            <x-card quantity="{{ $individual->qtd_update }}" size="col-md-6" icon="fa-solid fa-circle-check">
                Atualizações
            </x-card>

            <x-card quantity="{{ $individual->qtd_finish }}" size="col-md-6" icon="fa-solid fa-flag-checkered">
                Finalizações
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
                class="flex justify-center items-center gap-5 mt-2 flex-wrap hover:bg-gray-100 p-4 border border-gray-200">

                <x-details title="ID do Processo">
                    {{ ucfirst($individual->id) }}
                </x-details>

                <x-details title="Classe Judicial">
                    {{ ucfirst($individual->name) }}
                </x-details>

                <x-details title="Assunto">
                    {{ ucfirst($individual->subject) }}
                </x-details>

                <x-details title="Jurisdição">
                    {{ strtoupper($individual->jurisdiction) }}
                </x-details>

                <x-details title="Valor da Causa">
                    @if ($individual->cause_value == null)
                        <span class="text-red-500">Valor não informado</span>
                    @else
                        {{ 'R$ ' . $individual->cause_value }}
                    @endif
                </x-details>

                @if (auth()->user()->can('admin-3'))
                @else
                    <x-details title="Segredo de Justiça?">
                        @if ($individual->justice_secret == 1)
                            <span class="text-green-500">Sim</span>
                        @else
                            <span class="text-red-500">Não</span>
                        @endif
                    </x-details>
                @endif

                <x-details title="Justiça Gratuita?">
                    @if ($individual->free_justice == 1)
                        <span class="text-green-500">Sim</span>
                    @else
                        <span class="text-red-500">Não</span>
                    @endif
                </x-details>

                <x-details title="Tutelar/Liminar?">
                    @if ($individual->tutelar == 1)
                        <span class="text-green-500">Sim</span>
                    @else
                        <span class="text-red-500">Não</span>
                    @endif
                </x-details>


            </div>

            <div
                class="flex justify-center items-center gap-8 mt-2 flex-wrap hover:bg-gray-100 p-4 border border-gray-200">
                <x-details title="Prioridade">
                    {{ ucfirst($individual->priority) }}
                </x-details>

                <x-details title="Órgão Julgador">
                    {{ ucfirst($individual->judgmental_organ) }}
                </x-details>

                <x-details title="Cargo Judicial">
                    {{ ucfirst($individual->judicial_office) }}
                </x-details>

                <x-details title="Competência">
                    {{ ucfirst($individual->competence) }}
                </x-details>

                <x-details title="E-mail da Coorporação">
                    {{ $individual->email_coorporative }}
                </x-details>

                @if ($individual->url_collective == null)
                    <x-details title="URL do Processo">
                        <span class="text-red-500">URL não informada</span>
                    </x-details>
                @else
                    <x-detailsLink title="URL do Processo" url="{{ $individual->url_collective }}">

                        {{ $individual->url_collective }}
                    </x-detailsLink>
                @endif

                @if ($individual->url_noticies == null)
                    <x-details title="URL da Noticia">
                        <span class="text-red-500">URL não informada</span>
                    </x-details>
                @else
                    <x-detailsLink title="URL da Noticia" url="{{ $individual->url_noticies }}">

                        {{ $individual->url_noticies }}
                    </x-detailsLink>
                @endif

            </div>

            <div
                class="flex justify-center items-center gap-16 mt-2 flex-wrap hover:bg-gray-100 p-4 border border-gray-200">
                <x-details title="Autuação">
                    {{ date('d/m/Y H:i', strtotime($individual->created_at)) }}
                </x-details>

                <x-details title="Última Distribuição">
                    {{ date('d/m/Y H:i', strtotime($individual->updated_at)) }}
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
                            @include('admin.modals.pdf')
                        </div>
                    @endforeach
                </div>

            </div>


        </div>
    </div>


@endsection

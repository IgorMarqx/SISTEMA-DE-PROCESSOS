@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Processos')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')
    <div class="mb-4">
        <div class="flex justify-between">
            <div>
                <a href="{{ route('singleProccess.index') }}"
                    class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
                    <i class="fa-solid fa-reply"></i>
                </a>
            </div>

            <div>
                @if ($proccess->progress_collective == 1)
                    <x-status textCenter="text-center" color="bg-primary">
                        <i class="fa-solid fa-gavel text-xs mr-1"></i>
                        Andamento
                    </x-status>
                @elseif($proccess->finish_collective == 1)
                    <x-status textCenter="text-center" color="bg-danger">
                        <i class="fa-solid fa-flag-checkered text-xs mr-1"></i>
                        Finalizado
                    </x-status>
                @elseif($proccess->update_collective == 1)
                    <x-status textCenter="text-center" color="bg-success">
                        <i class="fa-solid fa-circle-check text-xs mr-1"></i>
                        Atualizado
                    </x-status>
                @endif
            </div>

        </div>

        <div class="card mt-1">
            <div class="bg-red-500 h-1">

            </div>

            <div class="card-body">
                <div class="flex items-center justify-center text-black bg-gray-200">
                    <h4 class="m-0 text-bold">Informações do Autor</h4>
                </div>

                <div class="flex justify-center items-center">
                    @include('admin.myProccess.partials.user')
                </div>

                <div class="flex items-center justify-center bg-gray-200 mt-4">
                    <h4 class=" text-black m-0 text-bold">Informações do processo</h4>
                </div>

                <div class="flex flex-1 flex-wrap">
                    <div class="flex-col items-start justify-center overflow-y-auto h-[500px]">
                        <div class="flex flex-col items-start overflow-y-auto p-1">
                            <x-details title="Classe Judicial">
                                {{ ucfirst($proccess->name) }}
                            </x-details>

                            <x-details title="Assunto">
                                {{ ucfirst($proccess->subject) }}
                            </x-details>

                            <x-details title="Jurisdição">
                                {{ strtoupper($proccess->jurisdiction) }}
                            </x-details>

                            <x-details title="Autuação">
                                {{ date('d/m/Y H:i', strtotime($proccess->created_at)) }}
                            </x-details>

                            <x-details title="Última Distribuição">
                                {{ date('d/m/Y H:i', strtotime($proccess->updated_at)) }}
                            </x-details>

                            <x-details title="Valor da Causa">
                                @if ($proccess->cause_value == null)
                                    <span class="text-red-500">Valor não informado</span>
                                @else
                                    {{ 'R$ ' . $proccess->cause_value }}
                                @endif
                            </x-details>

                            @if (auth()->user()->can('admin-3'))
                            @else
                                <x-details title="Segredo de Justiça?">
                                    @if ($proccess->justice_secret == 1)
                                        <span class="text-green-500">Sim</span>
                                    @else
                                        <span class="text-red-500">Não</span>
                                    @endif
                                </x-details>
                            @endif

                            <x-details title="Justiça Gratuita?">
                                @if ($proccess->free_justice == 1)
                                    <span class="text-green-500">Sim</span>
                                @else
                                    <span class="text-red-500">Não</span>
                                @endif
                            </x-details>

                            <x-details title="Tutelar/Liminar?">
                                @if ($proccess->tutelar == 1)
                                    <span class="text-green-500">Sim</span>
                                @else
                                    <span class="text-red-500">Não</span>
                                @endif
                            </x-details>

                            <x-details title="Prioridade">
                                {{ ucfirst($proccess->priority) }}
                            </x-details>

                            <x-details title="Órgão Julgador">
                                {{ ucfirst($proccess->judgmental_organ) }}
                            </x-details>

                            <x-details title="Cargo Judicial">
                                {{ ucfirst($proccess->judicial_office) }}
                            </x-details>

                            <x-details title="Competência">
                                {{ ucfirst($proccess->competence) }}
                            </x-details>

                            <x-details title="E-mail da Coorporação">
                                {{ $proccess->email_coorporative }}
                            </x-details>

                            @if ($proccess->url_collective == null)
                                <x-details title="URL do Processo">
                                    <span class="text-red-500">URL não informada</span>
                                </x-details>
                            @else
                                <x-detailsLink title="URL do Processo" url="{{ $proccess->url_collective }}">

                                    {{ $proccess->url_collective }}
                                </x-detailsLink>
                            @endif

                            @if ($proccess->url_noticies == null)
                                <x-details title="URL da Noticia">
                                    <span class="text-red-500">URL não informada</span>
                                </x-details>
                            @else
                                <x-detailsLink title="URL da Noticia" url="{{ $proccess->url_noticies }}">

                                    {{ $proccess->url_noticies }}
                                </x-detailsLink>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-1">
                        @include('admin.partials.lawyer')
                    </div>

                </div>

                <div class="flex items-center justify-center text-black bg-gray-200 mt-4">
                    <h4 class="m-0 text-bold">Anexos</h4>
                </div>

                <div class="flex justify-center items-center flex-wrap mt-3 mb-3 gap-3">
                    @foreach ($attachment as $attachments)
                        <div class="flex flex-col">
                            <a href="{{ route('downloadAttachmentSingle', ['id' => $attachments->id]) }}"
                                class="bg-gray-200 hover:bg-gray-300 hover:text-gray-500 rounded p-4 cursor-pointer text-black">
                                <i class="fa-solid fa-file-pdf text-lg"></i>
                                {{ $attachments->title }}
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>


        </div>
    </div>
@endsection

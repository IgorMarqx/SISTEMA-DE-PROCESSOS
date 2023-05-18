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

        <div class="card mt-1 ">
            <div class="bg-red-500 h-1">

            </div>

            <div class="table-responsive">
                <table class="table table-hover table-valign-middle">
                    <tr>
                        <th class="w-[5rem] text-center">ID</th>
                        <th class="w-[15rem] text-center">Nome do Processo</th>
                        <th class="w-[15rem] text-center">URL do Processo</th>
                        <th class="w-[20rem] text-center">Status do Processo</th>
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
                                <x-status textCenter="text-center" borderColor="border-sky-500" textColor="text-sky-500">
                                    <i class="fa-solid fa-gavel text-sm mr-1"></i>
                                    Andamento
                                </x-status>
                            @elseif($proccesses->finish_proccess == 1)
                                <x-status textCenter="text-center" borderColor="border-red-500" textColor="text-red-500">
                                    <i class="fa-solid fa-flag-checkered text-sm mr-1"></i>
                                    Finalizado
                                </x-status>
                            @elseif($proccesses->update_proccess == 1)
                                <x-status textCenter="text-center" borderColor="border-green-500"
                                    textColor="text-green-500">
                                    <i class="fa-solid fa-circle-check text-sm mr-1"></i>
                                    Atualizado
                                </x-status>
                            @elseif($proccesses->reopen_proccess == 1)
                                <x-status textCenter="text-center" borderColor="border-yellow-300"
                                    textColor="text-yellow-400">
                                    <i class="fa-solid fa-gavel text-sm mr-1"></i>
                                    Reaberto
                                </x-status>
                            @endif

                            <td class="flex">
                                <x-button route="{{ route('proccess.show', ['proccess' => $proccesses->id]) }}"
                                    color="text-yellow-400" hover="hover:text-yellow-500" margin="mr-2"
                                    icon="fa-solid fa-file-lines text-sm mr-[0.2rem]">
                                    Detalhes
                                </x-button>

                                @if ($proccesses->finish_proccess == 1)
                                    <x-button route="{{ route('reopen', ['id' => $proccesses->id]) }}"
                                        color="text-green-500" hover="hover:text-green-600" margin="mr-1"
                                        icon="fa-solid fa-gavel text-sm mr-[0.2rem]">
                                        Reabrir
                                    </x-button>
                                @else
                                    <x-button route="{{ route('proccess.edit', ['proccess' => $proccesses->id]) }}"
                                        color="text-green-500" hover="hover:text-green-600" margin="mr-1"
                                        icon="fa-solid fa-pencil text-sm mr-[0.2rem]">
                                        Editar
                                    </x-button>

                                    <x-button route="{{ route('finish', ['id' => $proccesses->id]) }}" color="text-sky-500"
                                        hover="hover:text-sky-600" margin="mr-1"
                                        icon="fa-solid fa-flag-checkered text-sm mr-[0.2rem]">
                                        Finalizar
                                    </x-button>
                                @endif

                                <form action="{{ route('proccess.destroy', ['proccess' => $proccesses->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600 ml-1">
                                        <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>


    {{ $proccess->links('pagination::bootstrap-4') }}
@endsection

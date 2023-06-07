@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Requerimentos')

@section('content_header')
    <div class="mb-2">
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

    <div class="">
        <div class="flex mb-3 items-center">
            <a href="{{ route('requeriments.create') }}"
                class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
                Novo Requerimento
            </a>

            <span class="bg-sky-500 text-white p-2 rounded hover:bg-sky-600">
                Total de Requerimentos:
                {{ $count_requeriment }}
            </span>
        </div>

        <div class="card ">
            <div class="bg-red-500 h-1">

            </div>

            <div class="table-responsive">
                <table class="table table-hover table-valign-middle">
                    <tr>
                        <th class="w-[10rem] text-center">Oficio N°</th>
                        <th class="w-[10rem] text-center">Assunto</th>
                        <th class="w-[10rem] text-center">Destinatario</th>
                        <th class="w-[10rem] text-center">Ações</th>
                    </tr>
                    @foreach ($requeriment as $requeriments)
                        <tr>
                            <td class="text-center">
                                {{ $requeriments->oficio_num }}
                            </td>

                            <td class="text-center">
                                {{ $requeriments->subject }}
                            </td>

                            <td class="text-center">
                                <span
                                    class="bg-blue-500 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded border border-blue-400 text-sm">
                                    {{ strtoupper($requeriments->destinatario) }}
                                </span>
                            </td>

                            <td class="lg:hidden md:hidden sm:hidden xs:hidden xl:flex 2xl:flex">
                                <x-button route="{{ route('requeriments.show', ['requeriment' => $requeriments->id]) }}"
                                    color="text-yellow-400" hover="hover:text-yellow-500" margin="mr-2"
                                    icon="fa-solid fa-eye text-sm mr-[0.2rem]">
                                    Detalhes
                                </x-button>

                                <x-button route="{{ route('requeriments.edit', ['requeriment' => $requeriments->id]) }}"
                                    color="text-green-500" hover="hover:text-green-600" margin="mr-2"
                                    icon="fa-solid fa-pencil text-sm mr-[0.2rem]">
                                    Editar
                                </x-button>

                                <a href="" data-bs-toggle="modal"
                                    onclick="exibirModalExclusao({{ $requeriments->id }})"
                                    class="text-red-500 hover:text-red-600 ml-1">
                                    <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                    Excluir
                                </a>
                                @include('admin.modals.requeriments.requeriment')
                            </td>

                            <td class="xl:hidden 2xl:hidden">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('requeriments.show', ['requeriment' => $requeriments->id]) }}">
                                            <span class="text-yellow-500">
                                                <i class="fa-solid fa-eye text-sm mr-[0.2rem]"></i>
                                                Detalhes
                                            </span>
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('requeriments.edit', ['requeriment' => $requeriments->id]) }}">
                                            <span class="text-green-500">
                                                <i class="fa-solid fa-pencil text-sm mr-[0.2rem]"></i>
                                                Editar
                                            </span>
                                        </a>
                                        <a href="" data-bs-toggle="modal"
                                            onclick="exibirModalExclusao({{ $requeriments->id }})"
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

                </table>
            </div>
        </div>
    </div>

    {{ $requeriment->links('pagination::bootstrap-5') }}
@endsection

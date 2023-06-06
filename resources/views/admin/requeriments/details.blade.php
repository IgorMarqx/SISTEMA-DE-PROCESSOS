@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Requerimentos')

@section('content_header')
    <div class="mb-2">
    </div>
@endsection

@section('content')
    <div class="mb-4">
        <a href="{{ route('requeriments.index') }}" class="p-2 bg-red-500 text-white hover:bg-red-600 rounded">
            <i class="fa-solid fa-reply"></i>
        </a>
    </div>

    <div class="card mt-1">
        <div class="bg-red-500 h-1">

        </div>

        <div class="card-body">
            <div class="flex items-center justify-center text-black bg-gray-200">
                <h4 class="m-0 text-bold">Requerimento N°: {{ $requeriment->oficio_num }}</h4>
            </div>

            <div class="flex justify-center items-center gap-8 mt-2 flex-wrap hover:bg-gray-100 p-4 border border-gray-200">
                <x-clientDetails title="Destinatário">
                    {{ ucfirst($requeriment->destinatario) }}
                </x-clientDetails>

                <x-clientDetails title="Cargo">
                    {{ ucfirst($requeriment->office) }}
                </x-clientDetails>

                <x-clientDetails title="Assunto">
                    {{ ucfirst($requeriment->subject) }}
                </x-clientDetails>

                <x-clientDetails title="Coordenador 1">
                    {{ ucfirst($requeriment->coord_1) }}
                </x-clientDetails>
                @if ($requeriment->coord_2 == null)
                    <x-clientDetails title="Coordenador 2">
                        <span class="text-red-500">Não informado</span>
                    </x-clientDetails>
                @else
                    <x-clientDetails title="Coordenador 2">
                        {{ ucfirst($requeriment->coord_2) }}
                    </x-clientDetails>
                @endif

                @if ($requeriment->coord_3 == null)
                    <x-clientDetails title="Coordenador 3">
                        <span class="text-red-500">Não informado</span>
                    </x-clientDetails>
                @else
                    <x-clientDetails title="Coordenador 3">
                        {{ ucfirst($requeriment->coord_3) }}
                    </x-clientDetails>
                @endif
            </div>

            <div class="flex items-center justify-center bg-gray-200 mt-4">
                <h4 class=" text-black m-0 text-bold">Descrição do Requerimento</h4>
            </div>

            <div class="flex flex-1 flex-wrap">
                <div class="flex-col items-start justify-center overflow-y-auto h-[500px]">
                    {{ $requeriment->description }}
                </div>
            </div>

        </div>
    @endsection

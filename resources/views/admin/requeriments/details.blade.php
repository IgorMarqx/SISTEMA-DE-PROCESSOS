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

        <a href="{{ route('downloadPdf', ['id' => $requeriment->id]) }}"
            class="bg-sky-500 text-white p-2 hover:bg-sky-600 rounded ml-2">
            Gerar PDF
        </a>
    </div>

    <div class="card mt-1">
        <div class="bg-red-500 h-1">

        </div>

        <div class="card-body">
            <div class="flex items-center justify-center text-black bg-gray-200">
                <h4 class="m-0 text-bold">Requerimento</h4>
            </div>

            <div class="flex flex-1 flex-wrap">
                <div class="flex-col items-start justify-center w-full overflow-y-auto h-[350px]">
                    <div class="flex flex-col items-start overflow-y-auto p-1">
                        @include('admin.requeriments.partials.content')
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center bg-gray-200 mt-4">
                <h4 class=" text-black m-0 text-bold">Descrição do Requerimento</h4>
            </div>

            <div class="flex flex-1 flex-wrap items-center justify-center">
                <div class="flex-col items-center justify-center overflow-y-auto h-[500px]">
                    {!! $requeriment->description !!}
                </div>
            </div>

        </div>
    @endsection

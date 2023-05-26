@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Requerimentos')

@section('content_header')
    <div class="mb-2">
        <h3 class="text-red-500 font-bold underline flex justify-center items-center">Requerimentos</h3>
    </div>
@endsection

@section('content')
    <div class="mb-2 flex">
        <a href="{{ route('collective.index') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600">
            <i class="fa-solid fa-reply"></i>
        </a>

        <div class="bg-green-500 hover:bg-green-600 ml-2 flex items-center text-white p-2 rounded">
            <span class="">Criação de Requerimentos</span>
        </div>
    </div>

    <div class="card">
        <div class="bg-red-500 h-1">

        </div>

        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <x-labels id="name" colorSpan="text-red-500">
                        Nome
                    </x-labels>

                    <x-inputs id="name" form="form-control" placeholder="Informe o nome" value="{{ old('name') }}"
                        type="text" name="name" focus="{{ true }}" error="name" />
                </div>

                <div class="col-md-6">
                    <x-labels id="name" colorSpan="text-red-500">
                        Nome
                    </x-labels>

                    <x-inputs id="name" form="form-control" placeholder="Informe o nome" value="{{ old('name') }}"
                        type="text" name="name" focus="{{ true }}" error="name" />
                </div>
            </div>
        </div>
    </div>
@endsection

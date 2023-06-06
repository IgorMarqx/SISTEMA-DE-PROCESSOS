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

    <div class="card">
        <div class="bg-red-500 h-1">

        </div>

        <div class="card-body">
            @include('admin.requeriments.partials.form')
        </div>
    </div>
@endsection

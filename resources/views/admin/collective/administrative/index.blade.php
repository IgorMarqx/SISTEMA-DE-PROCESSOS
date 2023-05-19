@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Processos')

@section('content_header')
    <div class="mb-2">
        <h3 class="text-red-500 font-bold underline">Processos Administrativos</h3>
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

    <div class="flex justify-center items-center gap-4 font-bold mb-3">
        <a id="" class="border-2 border-red-500 p-2 rounded text-red-500 hover:bg-red-500 hover:text-white "
            href="{{ route('collective.index')}}">Judiciais</a>
        <a id="judicial" class="border-2 border-red-500 p-2 rounded text-red-500 hover:bg-red-500 hover:text-white"
            href="{{ route('administrative_collective.index') }}">Administrativos</a>
    </div>

@endsection

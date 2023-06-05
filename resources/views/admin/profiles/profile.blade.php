@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Meu Perfil')

@section('content_header')
    <div class="mb-2 flex justify-center">
        <h3 class="text-red-500 font-bold underline">
            Seja Bem vindo!
        </h3>
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

    <div class="row">
        <div class="col-lg-6">
            @include('admin.profiles.layouts.card')
            @include('admin.profiles.layouts.table')
        </div>

        <div class="col-lg-6">
            @include('admin.profiles.layouts.profile')
        </div>
    </div>


@endsection

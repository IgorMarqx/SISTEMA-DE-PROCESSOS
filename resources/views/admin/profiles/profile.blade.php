@extends('adminlte::page')
@extends('layout.links')

@section('title', 'Detalhes')

@section('content_header')
    <div class="mb-2 flex justify-center">
        <h3 class="text-red-500 font-bold underline">
            Seja Bem vindo!
        </h3>
    </div>
@endsection

@section('content')
    @include('admin.profiles.layouts.card')
@endsection

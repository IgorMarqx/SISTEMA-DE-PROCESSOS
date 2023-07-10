@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Usuários')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')
    <div class="mb-2 flex flex-wrap">
        <a href="{{ route('users.index') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600">
            <i class="fa-solid fa-reply"></i>
        </a>

        <a href="{{ route('users.edit', ['user' => $users->id]) }}"
            class="bg-green-500 hover:bg-green-600 ml-2 flex items-center text-white p-2 rounded">
            Editar
        </a>
    </div>



    <div class="card mt-4">
        <div class="bg-red-500 h-1">
            .
        </div>


        <div class="card-body">

            <div class="flex items-center justify-center text-black bg-gray-200">
                <h4 class="m-0 text-bold">Informações do Autor</h4>
            </div>

            <div class="flex justify-center items-center">
                @include('admin.users.partials.user')
            </div>

        </div>
    </div>

@endsection

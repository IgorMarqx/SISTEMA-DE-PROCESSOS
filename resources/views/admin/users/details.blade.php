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

        <div class="w-full bg-gray-200 flex items-center justify-center">
            <h3 class="font-bold">Detalhes</h3>
        </div>

        <div class="card-body">

            <div class="flex items-center justify-center gap-20 border border-slate-500 p-4 hover:bg-gray-200 flex-wrap">

                <div class="flex flex-col items-center justify-center">
                    <h4 class="font-bold text-lg">Id</h4>
                    <span>{{ $users->id }}</span>
                </div>

                <div class="flex flex-col items-center justify-center">
                    <h4 class="font-bold text-lg">Nome</h4>
                    <span>{{ $users->name }}</span>
                </div>

                <div class="flex flex-col items-center justify-center">
                    <h4 class="font-bold text-lg">E-mail</h4>
                    <span class="break-all break-words">{{ $users->email }}</span>
                </div>

            </div>

            <div
                class="flex items-center justify-center gap-20 border border-slate-500 p-4 hover:bg-gray-200 flex-wrap mt-2">

                <div class="flex flex-col items-center justify-center">
                    <h4 class="font-bold text-lg">Data de criação</h4>
                    <span>{{ date('d/m/Y H:i', strtotime($users->created_at)) }}</span>
                </div>

                <div class="flex flex-col items-center justify-center">
                    <h4 class="font-bold text-lg">Data de Atualização</h4>
                    <span>{{ date('d/m/Y H:i', strtotime($users->updated_at)) }}</span>
                </div>

            </div>

        </div>
    </div>

@endsection

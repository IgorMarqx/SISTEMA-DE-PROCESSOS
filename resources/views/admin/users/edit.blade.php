@extends('adminlte::page')
@extends('layout.links')

@section('title', 'Usuários - SINDJUF')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')
    <div class="mb-2 flex">
        <a href="{{ route('users.index') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600">
            <i class="fa-solid fa-reply"></i>
        </a>

        <div class="bg-green-500 hover:bg-green-600 ml-2 flex items-center text-white p-2 rounded">
            <span class="">Edição de Usuário</span>
        </div>
    </div>

    <div class="card mt-4">
        <div class="bg-red-500 h-1">
            .
        </div>

        <form action="{{ route('users.update', ['user' => $users->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $users->id }}">

            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-3">
                        <label for="name">
                            Usuário <span class="text-red-500">*</span>
                        </label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ $users->name }}" placeholder="Informe seu usuário" autofocus>

                        @error('name')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <label for="email">
                            E-mail <span class="text-red-500">*</span>
                        </label>

                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $users->email }}" placeholder="Informe seu e-mail">

                        @error('email')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="admin">
                            Acesso <span class="text-red-500">*</span>
                        </label>

                        <select name="admin" id="admin" class="form-control @error('admin') is-invalid @enderror">
                            <option value="{{ $users->admin }}" selected>
                                @if ($users->admin == 1)
                                    <span class="text-red-500">Administrador</span>
                                @else
                                    <span class="text-sky-500">Usuário</span>
                                @endif
                            </option>
                            <option value="0" class="text-sky-500"><i class="fa-solid fa-circle-user text-sm mr-[0.2rem]"></i> Usuário</option>
                            <option value="1" class="text-red-500">Administrador</option>
                        </select>

                        @error('admin')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="password">
                            Nova Senha <span class="text-red-500">*</span>
                        </label>

                        <input id="password" type="text" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Informe sua senha">

                        @error('password')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-2">
                        <label for="passwordConfirmation">
                            Confirme sua senha <span class="text-red-500">*</span>
                        </label>

                        <input id="password_confirmation" type="text"
                            class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                            placeholder="Confirme a senha">
                    </div>

                    <div class="col-md-12 mt-3">
                        <input type="submit"
                            class="bg-red-500 block w-full text-white rounded p-1 hover:bg-red-600 transition ease-in-out" value="Editar">
                    </div>

                </div>
            </div>
        </form>

    </div>
@endsection

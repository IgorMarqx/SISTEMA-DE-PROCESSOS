@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Usuários')

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
            <span class="">Criação de Usuário</span>
        </div>
    </div>

    <div class="card mt-4">
        <div class="bg-red-500 h-1">
            .
        </div>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-3">
                        <label for="name">
                            Nome <span class="text-red-500">*</span>
                        </label>

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" placeholder="Informe seu usuário" autofocus>

                        @error('name')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <label for="email">
                            E-mail <span class="text-red-500">*</span>
                        </label>

                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Informe seu e-mail">

                        @error('email')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="admin">
                            Acesso <span class="text-red-500">*</span>
                        </label>

                        <select name="admin" id="admin"
                            class="valueAdmin form-control @error('admin') is-invalid @enderror">
                            <option value="error" selected>Informe um acesso</option>

                            @if ($loggedId->admin == 1)
                                <option value="0" class="text-sky-500">Usuário</option>
                                <option value="1" class="text-red-500">Administrador</option>
                                <option value="2" class="text-yellow-500">Advogado</option>
                                <option value="3" class="text-green-500">Diretoria</option>
                            @elseif($loggedId->admin == 2)
                                <option value="0" class="text-sky-500">Usuário</option>
                                <option value="2" class="text-yellow-500">Advogado</option>
                            @else
                                <option value="0" class="text-sky-500">Usuário</option>
                            @endif
                        </select>

                        @error('admin')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 organ">
                        <x-labels id="organ" colorSpan="text-red-500">
                            Orgão
                        </x-labels>

                        <input placeholder="Informe o orgão" id="organ" name="organ" type="text"
                            class="form-control @error('organ') is-invalid @enderror">

                        @error('organ')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-2 office">
                        <x-labels id="office" colorSpan="text-red-500">
                            Cargo
                        </x-labels>

                        <input placeholder="Informe o Cargo" id="office" name="office" type="text"
                            class="form-control @error('office') is-invalid @enderror">

                        @error('office')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 capacity">
                        <x-labels id="capacity" colorSpan="text-red-500">
                            Lotação
                        </x-labels>

                        <input placeholder="Informe a lotação" id="capacity" name="capacity" type="text"
                            class="form-control @error('capacity') is-invalid @enderror">

                        @error('capacity')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4 telephone">
                        <x-labels id="telephone" colorSpan="text-red-500">
                            Telefone
                        </x-labels>

                        <input placeholder="Informe o telefone" id="telephone" name="telephone" type="text"
                            class="form-control @error('telephone') is-invalid @enderror">

                        @error('telephone')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4 cpf">
                        <x-labels id="cpf" colorSpan="text-red-500">
                            CPF
                        </x-labels>

                        <input placeholder="Informe o CPF" id="cpf" name="cpf" type="text"
                            class="form-control @error('cpf') is-invalid @enderror">

                        @error('cpf')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4 oab">
                        <x-labels id="oab" colorSpan="text-red-500">
                            OAB
                        </x-labels>

                        <input placeholder="Informe sua OAB" id="oab" name="oab" type="text"
                            class="form-control @error('oab') is-invalid @enderror">

                        @error('oab')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-2 mb-2">
                        <label for="password">
                            Senha <span class="text-red-500">*</span>
                        </label>

                        <input id="password" type="text" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Informe sua senha">

                        @error('password')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-2 mb-2">
                        <label for="password_confirmation">
                            Confirme sua senha <span class="text-red-500">*</span>
                        </label>

                        <input id="password_confirmation" type="text"
                            class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                            placeholder="Confirme a senha">
                    </div>

                    <div class="col-md-12 mt-3">
                        <input type="submit"
                            class="bg-red-500 block w-full text-white rounded p-1 hover:bg-red-600 transition ease-in-out"
                            value="Criar">
                    </div>

                </div>
            </div>
        </form>
    </div>

    <script>
        $('#telephone').mask('(00) 00000-0000');

        $('#cpf').mask('000.000.000-00', {
            reverse: true
        });
    </script>
    <script src="{{ asset('assets/js/users.js') }}"></script>
@endsection

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

                    <div class="col-md-4 mb-2">
                        <label for="admin">
                            Acesso <span class="text-red-500">*</span>
                        </label>

                        <select name="admin" id="admin" class="form-control @error('admin') is-invalid @enderror">
                            <option value="{{ $users->admin }}" selected>
                                @if ($users->admin == 1)
                                    <span class="text-red-500">Administrador</span>
                                @elseif($users->admin == 2)
                                    <span class="text-yellow-500">Advogado</span>
                                @elseif($users->admin == 3)
                                    <span class="text-red-500">Você não possui permissão</span>
                                @else
                                    <span class="text-sky-500">Usuário</span>
                                @endif
                            </option>

                            @if ($loggedId->admin == 1)
                                <option value="0" class="text-sky-500">Usuário</option>
                                <option value="1" class="text-red-500">Administrador</option>
                                <option value="2" class="text-yellow-500">Advogado</option>
                                <option value="3" class="text-green-500">Diretoria</option>
                            @elseif($loggedId->admin == 2)
                                @if ($users->admin == 3)
                                @else
                                    <option value="0" class="text-sky-500">Usuário</option>
                                    <option value="2" class="text-yellow-500">Advogado</option>
                                @endif
                            @endif

                        </select>

                        @error('admin')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels id="organ" colorSpan="text-red-500">
                            Orgão
                        </x-labels>

                        <input placeholder="Informe o orgão" id="organ" name="organ" type="text"
                            class="form-control @error('organ') is-invalid @enderror" value="{{ $users->organ }}">

                        @error('organ')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels id="office" colorSpan="text-red-500">
                            Cargo
                        </x-labels>

                        <input placeholder="Informe o Cargo" id="office" name="office" type="text"
                            class="form-control @error('office') is-invalid @enderror" value="{{ $users->office }}">

                        @error('office')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels id="capacity" colorSpan="text-red-500">
                            Lotação
                        </x-labels>

                        <input placeholder="Informe a lotação" id="capacity" name="capacity" type="text"
                            class="form-control @error('capacity') is-invalid @enderror" value="{{ $users->capacity }}">

                        @error('capacity')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels id="telephone" colorSpan="text-red-500">
                            Telefone
                        </x-labels>

                        <input placeholder="Informe o telefone" id="telephone" name="telephone" type="text"
                            class="form-control @error('telephone') is-invalid @enderror" value="{{ $users->telephone }}">

                        @error('telephone')
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
                            class="bg-red-500 block w-full text-white rounded p-1 hover:bg-red-600 transition ease-in-out"
                            value="Editar">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $('#telephone').mask('(00) 00000-0000');
    </script>
@endsection

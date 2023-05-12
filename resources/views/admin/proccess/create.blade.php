@extends('adminlte::page')
@extends('layout.links')

@section('title', 'Processos - SINDJUF')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')
    <div class="mb-2 flex">
        <a href="{{ route('proccess.index') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600">
            <i class="fa-solid fa-reply"></i>
        </a>

        <div class="bg-green-500 hover:bg-green-600 ml-2 flex items-center text-white p-2 rounded">
            <span class="">Criação de Processo</span>
        </div>
    </div>

    <div class="card mt-4">
        <div class="bg-red-500 h-1">

        </div>



        <div class="card-body">
            <form action="{{ route('proccess.store') }}" method="POST">
                @csrf

                <input type="hidden" name="progress_proccess" value="1">

                <div class="row g-3">

                    <div class="col-md-6 mb-3">
                        <x-labels colorSpan="text-red-500" id="proccess">
                            Nome do Processo
                        </x-labels>

                        <x-inputs id="proccess" form="form-control" placeholder="Informe o nome do processo"
                            value="{{ old('proccess') }}" type="text" name="proccess" focus="{{ true }}"
                            error="proccess" />

                        @error('proccess')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-labels colorSpan="text-red-500" id="url">
                            URL do Processo
                        </x-labels>

                        <x-inputs id="url" form="form-control" placeholder="Informe a URL do processo"
                            value="{{ old('url') }}" type="text" name="url" focus="{{ false }}"
                            error="url" />

                        @error('url')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <x-labels colorSpan="text-red-500" id="email_corp">
                            E-mail Coorporativo
                        </x-labels>

                        <x-inputs id="email_corp" form="form-control" placeholder="Informe o e-mail coorporativo"
                            value="{{ old('email_corp') }}" type="text" name="email_corp" focus="{{ false }}"
                            error="email_corp" />

                        @error('email_corp')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <x-labels colorSpan="text-red-500" id="email_client">
                            E-mail do Cliente
                        </x-labels>

                        <x-inputs id="email_client" form="form-control" placeholder="Informe o e-mail do cliente"
                            value="{{ old('email_client') }}" type="text" name="email_client"
                            focus="{{ false }}" error="email_client" />

                        @error('email_client')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels colorSpan="text-red-500" id="user_id">
                            Selecione o cliente que você deseja
                        </x-labels>

                        <select name="user_id" id="user_id" class="form-control">
                            <option value="error" selected>Informe o cliente</option>

                            @foreach ($users as $user)
                                @if ($user->admin === 1)
                                @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        @error('user_id')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="col-md-12 mt-3">
                        <input type="submit"
                            class="bg-red-500 block w-full text-white rounded p-1 hover:bg-red-600 transition ease-in-out"
                            value="Criar">
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

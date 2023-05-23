@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Processos')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')

    <div class="mb-2 flex">
        <a href="{{ route('collective.index') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600">
            <i class="fa-solid fa-reply"></i>
        </a>

        <div class="bg-green-500 hover:bg-green-600 ml-2 flex items-center text-white p-2 rounded">
            <span class="">Edição de Processos</span>
        </div>
    </div>

    <div class="card mt-4">

        <div class="bg-red-500 h-1">
            .
        </div>

        <form action="{{ route('collective.update', ['collective' => $proccess->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row g-3">

                    <input type="hidden" name="id" value="{{ $proccess->id }}">


                    <div class="col-md-6 mb-3">
                        <x-labels colorSpan="text-red-500" id="collective">
                            Nome do Processo
                        </x-labels>

                        <x-inputs id="collective" form="form-control" placeholder="Informe o nome do processo"
                            value="{{ $proccess->name }}" type="text" name="collective" focus="{{ true }}"
                            error="collective" />

                        @error('collective')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-labels colorSpan="hidden" id="url">
                            URL do Processo
                        </x-labels>

                        <x-inputs id="url" form="form-control" placeholder="Informe a URL do processo"
                            value="{{ $proccess->url_collective }}" type="text" name="url"
                            focus="{{ false }}" error="url" />

                        @error('url')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels colorSpan="text-red-500" id="email_corp">
                            E-mail Coorporativo
                        </x-labels>

                        <x-inputs id="email_corp" form="form-control" placeholder="Informe o e-mail coorporativo"
                            value="{{ $proccess->email_coorporative }}" type="text" name="email_corp"
                            focus="{{ false }}" error="email_corp" />

                        @error('email_corp')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels colorSpan="hidden" id="email_client">
                            E-mail do Cliente
                        </x-labels>

                        <x-inputs id="email_client" form="form-control" placeholder="Informe o e-mail do cliente"
                            value="{{ $proccess->email_client }}" type="text" name="email_client"
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
                            @foreach ($users as $user)
                                @if ($proccess->user_id == $user->id)
                                    <option value="{{ $user->id }}" selected>{{ ucfirst($user->name) }}</option>
                                @endif
                            @endforeach

                            @foreach ($users as $user)
                                @if ($user->admin === 1)
                                @else
                                    <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                                @endif
                            @endforeach
                        </select>

                        @error('user_id')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels colorSpan="hidden" id="status">
                            Selecione o status do processo
                        </x-labels>

                        <select class="form-control" name="status" id="status">
                            <option class="text-green-500" value="1" selected>Atualizar</option>
                            <option class="text-red-500" value="2">Finalizar</option>
                            <option class="text-yellow-500" value="3">Andamento</option>
                        </select>
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


@endsection

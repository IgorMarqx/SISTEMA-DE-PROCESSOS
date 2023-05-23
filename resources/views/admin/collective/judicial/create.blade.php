@extends('adminlte::page')
@extends('layout.links')

@section('title', 'Processos - SINDJUF')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')

    @if (session('success'))
        @include('components.success')
    @endif

    @if (session('error'))
        @include('components.error')
    @endif

    <div class="mb-2 flex">
        <a href="{{ route('collective.index') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600">
            <i class="fa-solid fa-reply"></i>
        </a>

        <div class="bg-green-500 hover:bg-green-600 ml-2 flex items-center text-white p-2 rounded">
            <span class="">Criação de Processo</span>
        </div>

        <div class="rounded ml-2 p-2 bg-sky-500 hover:bg-sky-600 text-white transition-all">
            <input type="button" id="client" class="text-white" data-bs-toggle="modal" data-bs-target="#clientModal"
                value="Novo Cliente" />
            @include('admin.modals.createClient.client')
        </div>
    </div>

    @include('admin.modals.createClient.error')

    <div class="card mt-4">
        <div class="bg-red-500 h-1">

        </div>
        <div class="card-body">
            <form action="{{ route('collective.store') }}" method="POST">
                @csrf

                <input type="hidden" name="progress_collective" value="1">

                <div class="row g-3">

                    <div class="col-md-6 mb-3">
                        <x-labels colorSpan="text-red-500" id="collective">
                            Nome do Processo
                        </x-labels>

                        <x-inputs id="collective" form="form-control" placeholder="Informe o nome do processo"
                            value="{{ old('collective') }}" type="text" name="collective" focus="{{ true }}"
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
                            value="{{ old('url') }}" type="text" name="url" focus="{{ false }}"
                            error="url" />

                        @error('url')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
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

                    <div class="col-md-6 mb-3">
                        <x-labels colorSpan="hidden" id="email_client">
                            E-mail do Cliente
                        </x-labels>

                        <x-inputs id="email_client" form="form-control" placeholder="Informe o e-mail do cliente"
                            value="{{ old('email_client') }}" type="text" name="email_client"
                            focus="{{ false }}" error="email_client" />

                        @error('email_client')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <x-labels colorSpan="text-red-500" id="user_id">
                            Selecione o cliente que você deseja
                        </x-labels>

                        <div class="input-group">
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="error" selected>Selecione um cliente</option>

                                @foreach ($users as $user)
                                    @if ($user->admin == 1)
                                    @else
                                        <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                                    @endif
                                @endforeach
                            </select>

                            <div>
                                <label
                                    class="p-[7px] bg-sky-500 hover:bg-sky-600 text-white transition-all cursor-pointer rounded-ee-xl"
                                    for="client">
                                    Novo Cliente
                                </label>
                            </div>
                        </div>

                        @error('user_id')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="col-md-4">
                        <x-labels colorSpan="text-red-500" id="type">
                            Informe o tipo do processo
                        </x-labels>

                        <select name="type" id="type" class="form-control">
                            <option value="error" selected>Informe o tipo do processo</option>
                            <option value="Processo Judicial">Processo Judicial</option>
                            <option value="Processo Administrativo">Processo Administrativo</option>
                        </select>

                        @error('type')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels colorSpan="text-red-500" id="action_type">
                            Tipo da ação
                        </x-labels>

                        <select name="action_type" id="action_type" class="form-control">
                            <option value="error" selected>Informe o tipo da ação</option>
                            <option value="1">Ação Coletivo Judicial Funcional</option>
                            <option value="2">Ação Coletivo Judicial Particular</option>
                        </select>

                        @error('action_type')
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

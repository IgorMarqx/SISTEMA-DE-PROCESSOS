@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Usuários')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')

    @if (session()->has('success'))
        @include('components.success')
    @endif

    <div class="mb-4">
        <a href="{{ route('users.create') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
            Novo Usuário
        </a>

        <div class="row mt-3">
            <x-card quantity="{{ $userCount }}" size="col-md-6" icon="fa-solid fa-users">
                Quantidade de usuários
            </x-card>

            <x-card quantity="{{ $userAdminCount }}" size="col-md-6" icon="fa-solid fa-crown">
                Usuários Administradores
            </x-card>
        </div>


        <div class="card mt-1">
            <div class="bg-red-500 h-1">

            </div>

            <div class="table-responsive">

                <table class="table table-hover table-valign-middle">
                    <tr>
                        <th class="w-[5rem] text-center">ID</th>
                        <th class="w-[15rem] text-center">Nome</th>
                        <th class="w-[20rem] text-center">E-mail</th>
                        <th class="w-[20rem] text-center">Acesso</th>
                        <th class="text-center">Ações</th>
                    </tr>

                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td class="text-center">{{ ucfirst($user->name) }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            @if ($user->admin == 1)
                                <td class="text-red-500 text-center">
                                    <span class="float-center badge bg-danger">
                                        <i class="fa-solid fa-circle-user text-sm mr-[0.2rem]"></i>
                                        Admin
                                    </span>
                                </td>
                            @else
                                <td class="text-sky-500 text-center">
                                    <span class="float-center badge bg-primary">
                                        <i class="fa-solid fa-circle-user text-sm mr-[0.2rem]"></i>
                                        Usuário
                                    </span>
                                </td>
                            @endif

                            <td>
                                <x-button route="{{ route('users.show', ['user' => $user->id]) }}" color="text-yellow-400"
                                    hover="hover:text-yellow-500" margin="mr-2"
                                    icon="fa-solid fa-circle-info text-sm mr-[0.2rem] ">

                                    Detalhes
                                </x-button>

                                <x-button route="{{ route('users.edit', ['user' => $user->id]) }}" color="text-green-500"
                                    hover="hover:text-green-600" margin="mr-1"
                                    icon="fa-solid fa-pencil text-sm mr-[0.2rem]">
                                    Editar
                                </x-button>

                                @if ($loggedId !== intval($user->id))
                                    <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        class="text-red-500 hover:text-red-600 ml-1">
                                        <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                        Excluir
                                    </a>
                                    @include('admin.modals.users')
                                @else
                                    <span class="text-green-500"><i class="fa-solid fa-globe text-sm mr-[0.2rem]"></i>
                                        Logado</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>


    {{ $users->links('pagination::bootstrap-4') }}

@endsection

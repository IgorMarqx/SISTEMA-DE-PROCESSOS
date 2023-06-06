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
            <x-card quantity="{{ $userCount }}" size="col-md-3" icon="fa-solid fa-users">
                Quantidade de usuários
            </x-card>

            <x-card quantity="{{ $userAdminCount }}" size="col-md-3" icon="fa-solid fa-crown">
                Administradores Cadastrados
            </x-card>

            <x-card quantity="{{ $userLawyerCount }}" size="col-md-3" icon="fa-solid fa-user-tie">
                Advogados Cadastrados
            </x-card>

            <x-card quantity="{{ $userBrandCount }}" size="col-md-3" icon="fa-brands fa-black-tie">
                Diretores Cadastrados
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
                        <th class="w-[15rem] text-center">E-mail</th>
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
                            @elseif($user->admin == 2)
                                <td class="text-sky-500 text-center">
                                    <span class="float-center badge bg-yellow-400 text-white">
                                        <i class="fa-solid fa-circle-user text-sm mr-[0.2rem]"></i>
                                        Advogado
                                    </span>
                                </td>
                            @elseif($user->admin == 3)
                                <td class="text-sky-500 text-center">
                                    <span class="float-center badge bg-success">
                                        <i class="fa-solid fa-circle-user text-sm mr-[0.2rem]"></i>
                                        Diretoria
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

                                @if (auth()->user()->can('admin-1'))
                                    <x-button route="{{ route('users.edit', ['user' => $user->id]) }}"
                                        color="text-green-500" hover="hover:text-green-600" margin="mr-1"
                                        icon="fa-solid fa-pencil text-sm mr-[0.2rem]">
                                        Editar
                                    </x-button>
                                @elseif($loggedId->admin != 1)
                                    @if ($user->admin != 1)
                                        <x-button route="{{ route('users.edit', ['user' => $user->id]) }}"
                                            color="text-green-500" hover="hover:text-green-600" margin="mr-1"
                                            icon="fa-solid fa-pencil text-sm mr-[0.2rem]">
                                            Editar
                                        </x-button>
                                    @endif
                                @endif

                                @if (auth()->user()->can('admin-3'))
                                    @if ($user->admin == 0)
                                        <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="text-red-500 hover:text-red-600 ml-1">
                                            <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                            Excluir
                                        </a>
                                        @include('admin.modals.users')
                                    @else
                                        <span class="text-red-500"><i class="fa-solid fa-xmark text-sm mr-[0.2rem]"></i>Sem
                                            permissão</span>
                                    @endif
                                @elseif(auth()->user()->can('admin-2'))
                                    @if ($user->admin == 0)
                                        <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="text-red-500 hover:text-red-600 ml-1">
                                            <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                            Excluir
                                        </a>
                                        @include('admin.modals.users')
                                    @else
                                        <span class="text-red-500"><i class="fa-solid fa-xmark text-sm mr-[0.2rem]"></i>Sem
                                            permissão</span>
                                    @endif
                                @elseif($loggedId->id == intval($user->id))
                                    <span class="text-red-500"><i class="fa-solid fa-xmark text-sm mr-[0.2rem]"></i>Sem
                                        permissão</span>
                                @else
                                    <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        class="text-red-500 hover:text-red-600 ml-1">
                                        <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                        Excluir
                                    </a>
                                    @include('admin.modals.users')
                                @endif

                                {{-- @if ($loggedId->id !== intval($user->id))
                                    <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        class="text-red-500 hover:text-red-600 ml-1">
                                        <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                        Excluir
                                    </a>
                                    @include('admin.modals.users')
                                @else
                                    <span class="text-green-500"><i class="fa-solid fa-globe text-sm mr-[0.2rem]"></i>
                                        Logado</span>
                                @endif --}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>


    {{ $users->links('pagination::bootstrap-5') }}

@endsection

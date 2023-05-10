@extends('adminlte::page')
@extends('layout.links')

@section('title', 'Usuários')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')

    @if (session()->has('success'))
        <script type="text/javascript">
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif

    <div class="mb-4">
        <a href="{{ route('users.create') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600 mr-2">
            Novo Usuário
        </a>

        <div class="row mt-3">

            <a href="#" class="col-md-6">
                <div class="info-box bg-white ">
                    <span class="info-box-icon bg-danger text-white elevation-1">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de Usuários</span>
                        <span class="info-box-number">{{ $userCount }}</span>
                    </div>
                </div>
            </a>

            <a href="#" class="col-md-6">
                <div class="info-box bg-white ">
                    <span class="info-box-icon bg-danger elevation-1">
                        <i class="fa-solid fa-crown"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Usuários Administradores</span>
                        <span class="info-box-number">{{ $userAdminCount }}</span>
                    </div>
                </div>
            </a>

        </div>


        <div class="card mt-1">
            <div class="bg-red-500 h-1">

            </div>

            <table class="table table-hover">
                <tr>
                    <th class="w-[5rem]">ID</th>
                    <th class="w-[15rem]">Nome</th>
                    <th class="w-[20rem]">E-mail</th>
                    <th class="w-[20rem]">Acesso</th>
                    <th>Ações</th>
                </tr>

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if ($user->admin == 1)
                            <td class="text-red-500"><i class="fa-solid fa-circle-user text-sm mr-[0.2rem]"></i> Admin</td>
                        @else
                            <td class="text-sky-500"><i class="fa-solid fa-circle-user text-sm mr-[0.2rem]"></i> Usuário
                            </td>
                        @endif

                        <td>
                            <a href="{{ route('users.show', ['user' => $user->id]) }}"
                                class="text-yellow-400 hover:text-yellow-500 mr-2">
                                <i class="fa-solid fa-circle-info text-sm mr-[0.2rem]"></i>
                                Detalhes
                            </a>

                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                class="text-green-500 hover:text-green-600 mr-1">
                                <i class="fa-solid fa-pencil text-sm mr-[0.2rem]"></i>
                                Editar
                            </a>

                            @if ($loggedId !== intval($user->id))
                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    class="text-red-500 hover:text-red-600 ml-1" data-id="{{ $user->id }}">
                                    <i class="fa-solid fa-trash-can text-sm mr-[0.2rem]"></i>
                                    Excluir
                                </a>
                            @else
                                <span class="text-green-500"><i class="fa-solid fa-globe text-sm mr-[0.2rem]"></i> Logado</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>


        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5 text-red-500" id="exampleModalLabel">Deletando
                            Usuário</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="text-red-500">Atenção!</span>
                        <p class="text-red-500">Tem certeza que você deseja apagar esse usuário</p>
                    </div>

                    <form id="deleteForm" method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                        @csrf
                        @method('DELETE')

                        <input type="text" name="users_id" id="users_id">
                        <div class="modal-footer">
                            <button type="button" class="bg-green-500 p-2 text-white rounded hover:bg-green-600"
                                data-bs-dismiss="modal">Fechar</button>
                            <input type="submit" value="Excluir"
                                class="bg-red-500 p-2 text-white rounded hover:bg-red-600">
                    </form>

                </div>
            </div>
        </div>
    </div>


    {{ $users->links('pagination::bootstrap-4') }}
    </div>

@endsection

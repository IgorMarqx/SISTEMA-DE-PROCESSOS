<div class="col-md-12">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Editar Perfil</h3>
        </div>

        <form action="{{ route('profile.update', ['profile' => auth()->user()->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" value="{{ auth()->user()->id }}" name="id">

            <div class="card-body">
                <div class="form-group">
                    <x-labels id="name" colorSpan="hidden">
                        Nome
                    </x-labels>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}"
                        name="name">
                    @error('name')
                        <span class="text-red-500 flex">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <x-labels id="email" colorSpan="hidden">
                        E-mail
                    </x-labels>

                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ auth()->user()->email }}"
                        name="email">
                    @error('email')
                        <span class="text-red-500 flex">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <x-labels id="password" colorSpan="hidden">
                        Nova senha
                    </x-labels>

                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password">
                    @error('password')
                        <span class="text-red-500 flex">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <x-labels id="password_confirmation" colorSpan="hidden">
                        Confirmar senha
                    </x-labels>

                    <input id="password_confirmation" class="form-control @error('password') is-invalid @enderror" name="password_confirmation">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-danger">Salvar</button>
            </div>
        </form>

    </div>
</div>

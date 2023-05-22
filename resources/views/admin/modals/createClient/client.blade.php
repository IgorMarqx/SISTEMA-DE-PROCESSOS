<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="clientModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5 text-sky-500" id="exampleModalLabel">Novo Usuário</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('store_modal') }}" method="POST">
                @csrf
                <input type="hidden" name="admin" value="0">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <x-labels id="user" colorSpan="text-red-500">
                                Nome do Cliente
                            </x-labels>

                            <input name="name" type="text"
                                class="form-control  @error('name') is-invalid @enderror"
                                placeholder="Informe o nome do cliente" value="{{ old('name') }}">

                            @error('name')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="user" colorSpan="text-red-500">
                                E-mail
                            </x-labels>

                            <input name="email" type="text"
                                class="form-control  @error('email') is-invalid @enderror"
                                placeholder="Informe o e-mail" value="{{ old('email') }}">

                            @error('email')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="user" colorSpan="text-red-500">
                                Orgão
                            </x-labels>

                            <input name="organ" type="text"
                                class="form-control  @error('organ') is-invalid @enderror" placeholder="Informe o orgão"
                                value="{{ old('organ') }}">

                            @error('organ')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="user" colorSpan="text-red-500">
                                Cargo
                            </x-labels>

                            <input name="office" type="text"
                                class="form-control  @error('office') is-invalid @enderror"
                                placeholder="Informe o cargo" value="{{ old('office') }}">

                            @error('office')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="user" colorSpan="text-red-500">
                                Lotação
                            </x-labels>

                            <input name="capacity" type="text"
                                class="form-control  @error('capacity') is-invalid @enderror"
                                placeholder="Informe a lotação" value="{{ old('capacity') }}">

                            @error('capacity')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="user" colorSpan="text-red-500">
                                Telefone
                            </x-labels>

                            <input name="telephone" type="text" id="telephone"
                                class="form-control  @error('telephone') is-invalid @enderror"
                                placeholder="Informe o telefone" value="{{ old('telephone') }}">

                            @error('telephone')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="password" colorSpan="text-red-500">
                                Senha
                            </x-labels>

                            <input id="password" type="text"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Informe sua senha">

                            @error('password')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="password_confirmation" colorSpan="text-red-500">
                                Confirme sua senha
                            </x-labels>

                            <input id="password_confirmation" type="text"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password_confirmation" placeholder="Confirme a senha">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="bg-green-500 p-2 text-white rounded hover:bg-green-600"
                        data-bs-dismiss="modal">Fechar</button>
                    <input type="submit" value="Criar" class="bg-sky-500 p-2 text-white rounded hover:bg-sky-600">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#telephone').mask('(00) 00000-0000');
</script>

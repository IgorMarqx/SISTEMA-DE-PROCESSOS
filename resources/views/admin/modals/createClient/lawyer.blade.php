<div class="modal fade" id="lawyerModal" tabindex="-1" role="dialog" aria-labelledby="clientModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fs-5 text-yellow-500" id="exampleModalLabel">Novo Advogado</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('lawyer') }}" method="POST">
                @csrf
                <input type="hidden" name="admin" value="2">
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <x-labels id="lawyer" colorSpan="text-red-500">
                                Nome do Advogado
                            </x-labels>

                            <input name="lawyer" type="text"
                                class="form-control  @error('lawyer') is-invalid @enderror"
                                placeholder="Informe o nome do advogado" value="{{ old('lawyer') }}">

                            @error('lawyer')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="emailLaw" colorSpan="text-red-500">
                                E-mail
                            </x-labels>

                            <input name="emailLaw" type="text"
                                class="form-control  @error('emailLaw') is-invalid @enderror"
                                placeholder="Informe o e-mail" value="{{ old('emailLaw') }}">

                            @error('emailLaw')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="OAB" colorSpan="text-red-500">
                                OAB
                            </x-labels>

                            <input name="OAB" type="text"
                                class="form-control  @error('OAB') is-invalid @enderror"
                                placeholder="Informe a OAB" value="{{ old('OAB') }}">

                            @error('OAB')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="CPF" colorSpan="text-red-500">
                                CPF
                            </x-labels>

                            <input name="CPF" type="text" id="CPF"
                                class="form-control  @error('CPF') is-invalid @enderror"
                                placeholder="Informe o e-mail" value="{{ old('CPF') }}">

                            @error('CPF')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="password" colorSpan="text-red-500">
                                Senha
                            </x-labels>

                            <input id="password" type="text"
                                class="form-control @error('password_lawyer') is-invalid @enderror" name="password_lawyer"
                                placeholder="Informe sua senha">

                            @error('password_lawyer')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <x-labels id="password_confirmation" colorSpan="text-red-500">
                                Confirme sua senha
                            </x-labels>

                            <input id="password_confirmation" type="text"
                                class="form-control @error('password_lawyer') is-invalid @enderror"
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
   $('#CPF').mask('000.000.000-00', {reverse: true});
</script>

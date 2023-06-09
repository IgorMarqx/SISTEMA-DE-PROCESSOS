<form action="{{ route('requeriments.store') }}" method="post">
    <div class="flex flex-wrap">
        @csrf
        <div class="col-md-4">
            <x-labels id="destinatario" colorSpan="text-red-500">
                Destinatário
            </x-labels>

            <input id="destinatario" type="text" class="form-control @error('destinatario') is-invalid @enderror"
                name="destinatario" placeholder="Informe um destinatário" value="{{ old('destinatario') }}" autofocus>

            @error('destinatario')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <x-labels id="office" colorSpan="text-red-500">
                Cargo
            </x-labels>

            <input id="office" type="text" class="form-control @error('office') is-invalid @enderror"
                name="office" placeholder="Informe um cargo" autofocus value="{{ old('office') }}">

            @error('office')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <x-labels id="subject" colorSpan="text-red-500">
                Assunto
            </x-labels>

            <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror"
                name="subject" placeholder="Informe um assunto" autofocus value="{{ old('subject') }}">

            @error('subject')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="flex mt-2">
        <div class="col-md-6">
            <x-labels id="coord_1" colorSpan="text-red-500">
                Requisitante 1
            </x-labels>

            <input id="coord_1" type="text" class="form-control coord1 @error('coord_1') is-invalid @enderror"
                name="coord_1" placeholder="Informe um coordenador" autofocus value="{{ old('coord_1') }}">

            @error('coord_1')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 ">
            <x-labels colorSpan="text-red-500" id="coord_office_1">
                Cargo do Requisitante 1
            </x-labels>

            <div class="">
                <select name="coord_office_1" id="coord_office_1" class="form-control coord1">
                    @if (old('coord_office_1'))
                        <option value="{{ old('coord_office_1') }}" selected>{{ old('coord_office_1') }}</option>
                    @else
                        <option value="error" selected disabled>Selecione um Requisitante</option>
                    @endif
                    <option value="Coordenador Geral">Coordenador Geral</option>
                    <option value="Coordenador de Finanças e Patrimônio">Coordenador de Finanças e Patrimônio</option>
                    <option value="Coordenador Jurídico">Coordenador Jurídico</option>
                    <option value="Coordenador de Comunicação e Imprensa">Coordenador de Comunicação e Imprensa</option>
                    <option value="Coordenador do Alto Sertão">Coordenador do Alto Sertão</option>
                    <option value="Coordenador do Litoral, Brejo e Curimataú">Coordenador do Litoral, Brejo e Curimataú
                    </option>
                    <option value="Coordenador de Formação Sindical, Cultural, Esporte e Cidadania">Coordenador de
                        Formação Sindical, Cultural, Esporte e Cidadania</option>
                </select>

                @error('coord_office_1')
                    <span class="text-red-500 flex">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex mt-2">
        <div class="col-md-6 ">
            <x-labels id="coord_2" colorSpan="hidden">
                Requisitante 2
                <span class="text-xs text-red-500">(Não obrigatório)</span>
            </x-labels>

            <input id="coord_2" type="text" class="form-control @error('coord_2') is-invalid @enderror"
                name="coord_2" placeholder="Informe um coordenador" autofocus value="{{ old('coord_2') }}">

            @error('coord_2')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 ">
            <x-labels colorSpan="text-red-500" id="coord_office_2">
                Cargo do Requisitante 2
            </x-labels>

            <div class="input-group">
                <select name="coord_office_2" id="coord_office_2" class="form-control coord1">
                    <option value="error" selected disabled>Selecione um Requisitante</option>
                    <option value="">Coordenador Geral</option>
                    <option value="">Coordenador de Finanças e Patrimônio</option>
                    <option value="">Coordenador Jurídico</option>
                    <option value="">Coordenador de Comunicação e Imprensa</option>
                    <option value="">Coordenador do Alto Sertão</option>
                    <option value="">Coordenador do Litoral, Brejo e Curimataú</option>
                    <option value="">Coordenador de Formação Sindical, Cultural, Esporte e Cidadania</option>
                </select>

                @error('coord_office_2')
                    <span class="text-red-500 flex">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex mt-2">
        <div class="col-md-6">
            <x-labels id="coord_3" colorSpan="hidden">
                Requisitante 3
                <span class="text-xs text-red-500">(Não obrigatório)</span>
            </x-labels>

            <input id="coord_3" type="text" class="form-control coord3 @error('coord_3') is-invalid @enderror"
                name="coord_3" placeholder="Informe um coordenador" autofocus value="{{ old('coord_3') }}">

            @error('coord_3')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 ">
            <x-labels colorSpan="text-red-500" id="coord_office_3">
                Cargo do Requisitante 3
            </x-labels>

            <div class="input-group">
                <select name="coord_office_3" id="coord_office_3" class="form-control coord1">
                    <option value="error" selected disabled>Selecione um Requisitante</option>
                    <option value="">Coordenador Geral</option>
                    <option value="">Coordenador de Finanças e Patrimônio</option>
                    <option value="">Coordenador Jurídico</option>
                    <option value="">Coordenador de Comunicação e Imprensa</option>
                    <option value="">Coordenador do Alto Sertão</option>
                    <option value="">Coordenador do Litoral, Brejo e Curimataú</option>
                    <option value="">Coordenador de Formação Sindical, Cultural, Esporte e Cidadania</option>
                </select>

                @error('coord_office_3')
                    <span class="text-red-500 flex">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <x-labels id="description" colorSpan="text-red-500">
            Descrição
        </x-labels>

        <textarea id="description" name="description"
            class="form-control bodyfield @error('description') is-invalid @enderror"id="" cols="2"
            rows="7" placeholder="Insira uma descrição">{{ old('description') }}</textarea>

        @error('description')
            <span class="text-red-500 flex">{{ $message }}</span>
        @enderror
    </div>

    <div class="col-md-12 mt-3">
        <input type="submit"
            class="bg-red-500 block w-full text-white rounded p-1 hover:bg-red-600 transition ease-in-out"
            value="Criar">
    </div>
</form>

<script>
    tinymce.init({
        selector: 'textarea.bodyfield',
        height: 300,
        menubar: false,
        plugins: ['link', 'table', 'image', 'autoresize', 'lists'],
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bulllist numlist',
    })
</script>
<script src="{{ asset('assets/js/requeriment.js') }}"></script>

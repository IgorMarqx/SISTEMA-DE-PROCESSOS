<form action="{{ route('requeriments.update', ['requeriment' => $requeriment->id]) }}" method="post">
    <div class="row g-3">
        @csrf
        @method('PUT')
        <div class="col-md-4">
            <x-labels id="destinatario" colorSpan="text-red-500">
                Destinatário
            </x-labels>

            <input id="destinatario" type="text" class="form-control @error('destinatario') is-invalid @enderror"
                name="destinatario" placeholder="Informe um destinatário" value="{{ $requeriment->destinatario }}" autofocus>

            @error('destinatario')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <x-labels id="office" colorSpan="text-red-500">
                Cargo
            </x-labels>

            <input id="office" type="text" class="form-control @error('office') is-invalid @enderror"
                name="office" placeholder="Informe um cargo" autofocus value="{{ $requeriment->office }}">

            @error('office')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <x-labels id="subject" colorSpan="text-red-500">
                Assunto
            </x-labels>

            <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror"
                name="subject" placeholder="Informe um assunto" autofocus value="{{ $requeriment->subject }}">

            @error('subject')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <x-labels id="coord_1" colorSpan="text-red-500">
                Coordenador 1
            </x-labels>

            <input id="coord_1" type="text" class="form-control @error('coord_1') is-invalid @enderror"
                name="coord_1" placeholder="Informe um coordenador" autofocus value="{{ $requeriment->coord_1 }}">

            @error('coord_1')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <x-labels id="coord_2" colorSpan="hidden">
                Coordenador 2
                <span class="text-xs text-red-500">(Não obrigatório)</span>
            </x-labels>

            <input id="coord_2" type="text" class="form-control @error('coord_2') is-invalid @enderror"
                name="coord_2" placeholder="Informe um coordenador" autofocus value="{{ $requeriment->coord_2 }}">

            @error('coord_2')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4">
            <x-labels id="coord_3" colorSpan="hidden">
                Coordenador 3
                <span class="text-xs text-red-500">(Não obrigatório)</span>
            </x-labels>

            <input id="coord_3" type="text" class="form-control @error('coord_3') is-invalid @enderror"
                name="coord_3" placeholder="Informe um coordenador" autofocus value="{{ $requeriment->coord_3 }}">

            @error('coord_3')
                <span class="text-red-500 flex">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12">
            <x-labels id="description" colorSpan="text-red-500">
                Descrição
            </x-labels>

            <textarea id="description" name="description"
                class="form-control @error('description') is-invalid @enderror"id="" cols="2" rows="7"
                placeholder="Insira uma descrição">{{ $requeriment->description }}</textarea>

            @error('description')
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

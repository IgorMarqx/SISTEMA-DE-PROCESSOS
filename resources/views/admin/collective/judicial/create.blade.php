@extends('adminlte::page')
@extends('layout.links')

@section('title', 'Processos - SINDJUF')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

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
                value="Novo Autor" />
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

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="collective">
                            Classe Judicial
                        </x-labels>

                        <x-inputs id="collective" form="form-control" placeholder="Informe o nome da classe judicial"
                            value="{{ old('collective') }}" type="text" name="collective" focus="{{ true }}"
                            error="collective" />

                        @error('collective')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="subject">
                            Assunto
                        </x-labels>

                        <x-inputs id="subject" form="form-control" placeholder="ex: Assitência Pré Escolar"
                            value="{{ old('subject') }}" type="text" name="subject" focus="{{ true }}"
                            error="subject" />

                        @error('subject')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="jurisdiction">
                            Jurisdição
                        </x-labels>

                        <x-inputs id="jurisdiction" form="form-control" placeholder="ex: PB / Patos"
                            value="{{ old('jurisdiction') }}" type="text" name="jurisdiction" focus="{{ true }}"
                            error="jurisdiction" />

                        @error('jurisdiction')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="judicial_office">
                            Cargo Judicial
                        </x-labels>

                        <x-inputs id="judicial_office" form="form-control" placeholder="ex: Juiz Federal Titular"
                            value="{{ old('judicial_office') }}" type="text" name="judicial_office"
                            focus="{{ true }}" error="judicial_office" />

                        @error('judicial_office')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="hidden" id="cause_value">
                            Valor da Causa
                            <span class="text-xs text-red-500">(Não obrigatório)</span>
                        </x-labels>

                        <div class="flex">
                            <span
                                class="py-1 px-3 bg-red-500 text-white font-bold flex items-center justify-center text-md rounded-s">
                                $
                            </span>
                            <x-inputs id="cause_value" form="form-control" placeholder="ex: 1.510,00"
                                value="{{ old('cause_value') }}" type="text" name="cause_value"
                                focus="{{ true }}" error="cause_value" />

                            @error('cause_value')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="priority">
                            Prioridade
                        </x-labels>

                        <x-inputs id="priority" form="form-control" placeholder="ex: 100% Digital"
                            value="{{ old('priority') }}" type="text" name="priority" focus="{{ true }}"
                            error="priority" />

                        @error('priority')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="judgmental_organ">
                            Orgão Julgador
                        </x-labels>

                        <x-inputs id="judgmental_organ" form="form-control" placeholder="ex: 14° Vara Federal PB"
                            value="{{ old('judgmental_organ') }}" type="text" name="judgmental_organ"
                            focus="{{ true }}" error="judgmental_organ" />

                        @error('judgmental_organ')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="competence">
                            Competência
                        </x-labels>

                        <x-inputs id="competence" form="form-control" placeholder="ex: JEF - Joâo Pessoa"
                            value="{{ old('competence') }}" type="text" name="competence"
                            focus="{{ false }}" error="competence" />

                        @error('competence')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="email_corp">
                            E-mail Coorporativo
                        </x-labels>

                        <x-inputs id="email_corp" form="form-control" placeholder="Informe o e-mail coorporativo"
                            value="{{ old('email_corp') }}" type="text" name="email_corp"
                            focus="{{ false }}" error="email_corp" />

                        @error('email_corp')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="hidden" id="url">
                            URL do Processo
                            <span class="text-xs text-red-500">(Não obrigatório)</span>
                        </x-labels>

                        <x-inputs id="url" form="form-control" placeholder="Informe a URL do processo"
                            value="{{ old('url') }}" type="text" name="url" focus="{{ false }}"
                            error="url" />

                        @error('url')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="hidden" id="url_noticies">
                            URL da Noticia
                            <span class="text-xs text-red-500">(Não obrigatório)</span>
                        </x-labels>

                        <x-inputs id="url_noticies" form="form-control" placeholder="Informe a URL da noticia"
                            value="{{ old('url_noticies') }}" type="text" name="url_noticies"
                            focus="{{ false }}" error="url_noticies" />

                        @error('url')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="hidden" id="email_client">
                            E-mail do Cliente
                            <span class="text-xs text-red-500">(Não obrigatório)</span>
                        </x-labels>

                        <x-inputs id="email_client" form="form-control" placeholder="Informe o e-mail do cliente"
                            value="{{ old('email_client') }}" type="text" name="email_client"
                            focus="{{ false }}" error="email_client" />

                        @error('email_client')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <x-labels colorSpan="text-red-500" id="user_id">
                            Selecione o autor que você deseja
                        </x-labels>

                        <div class="input-group">
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="error" selected>Selecione um Autor</option>

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
                                    Novo Autor
                                </label>
                            </div>
                        </div>

                        @error('user_id')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <x-labels colorSpan="text-red-500" id="lawyers">
                            Selecione o advogado que você deseja
                        </x-labels>

                        <div class="input-group">
                            <select name="lawyers[]" id="lawyers"
                                class="js-example-basic-multiple js-states js-example-responsive form-control" multiple>
                                <option value="error" disabled>Selecione um Advogado</option>

                                @foreach ($lawyer as $lawyers)
                                    @if ($lawyers->admin == 1)
                                    @else
                                        <option value="{{ $lawyers->id }}">{{ ucfirst($lawyers->name) }} </option>
                                    @endif
                                @endforeach
                            </select>

                            <div>
                                <label
                                    class="p-[7px] bg-yellow-500 hover:bg-yellow-600 text-white transition-all cursor-pointer rounded-ee-xl"
                                    for="client">
                                    Novo Advogado
                                </label>
                            </div>
                        </div>

                        @error('lawyers[]')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <x-labels colorSpan="text-red-500" id="type">
                            Informe o tipo do processo
                        </x-labels>

                        <select name="type" id="type" class="form-control">
                            <option value="error" selected>Informe o tipo do processo</option>
                            <option value="1">Processo Judicial</option>
                            <option value="2">Processo Administrativo</option>
                        </select>

                        @error('type')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-labels colorSpan="text-red-500" id="action_type">
                            Tipo da ação
                        </x-labels>

                        <select name="action_type" id="action_type" class="form-control">
                            <option value="error" selected>Informe o tipo da ação</option>
                            <option value="1">Coletivo Judicial Funcional</option>
                            <option value="2">Coletivo Judicial Particular</option>
                        </select>

                        @error('action_type')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 flex flex-col">
                        <div class="flex justify-center items-center">
                            <x-labels colorSpan="hidden" id="">
                                Informações Adicionais
                            </x-labels>
                        </div>

                        <div class="flex items-center justify-center gap-6 flex-wrap">
                            @if (auth()->user()->can('admin-3'))
                            @else
                                <div>
                                    <span class="mr-2">Segredo de justiça?</span>

                                    <input type="checkbox" name="justice_secret[]" value="1"
                                        @checked(old('justice_secret'))
                                        class="form-checkbox rounded text-red-500 border-red-500">
                                </div>
                            @endif

                            <div>
                                <span class="mr-2">Justiça Gratuita?</span>

                                <input type="checkbox" name="free_justice[]" value="1" @checked(old('free_justice'))
                                    class="form-checkbox rounded text-red-500 border-red-500">
                            </div>

                            <div>
                                <span class="mr-2">Tutelar/Liminar?</span>

                                <input type="checkbox" name="tutelar[]" value="1" @checked(old('tutelar'))
                                    class="form-checkbox rounded text-red-500 border-red-500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center items-center bg-red-500 mt-4 mb-3">
                    <h4 class="m-0 text-bold text-white text-lg">Polo Passivo (Réu)</h4>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <x-labels colorSpan="text-red-500" id="name_reu">
                            Nome
                        </x-labels>

                        <x-inputs id="name_reu" form="form-control" placeholder="Informe o nome do REU"
                            value="{{ old('name_reu') }}" type="text" name="name_reu" focus="{{ false }}"
                            error="name_reu" />
                    </div>

                    <div class="col-md-6">
                        <x-labels colorSpan="hidden" id="cnpj">
                            CNPJ
                            <span class="text-xs text-red-500">(Não obrigatório)</span>
                        </x-labels>

                        <x-inputs id="cnpj" form="form-control" placeholder="Informe o CNPJ do REU"
                            value="{{ old('cnpj') }}" type="text" name="cnpj" focus="{{ false }}"
                            error="cnpj" />
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

    <script>
        $('#cause_value').mask("#.##0,00", {
            reverse: true
        });

        $('#cnpj').mask('00.000.000/0000-00', {
            reverse: true
        });

        $('#lawyers').select2();
    </script>

@endsection

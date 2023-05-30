@extends('adminlte::page')
@extends('layout.links')

@section('title', 'SINDJUF - Processos')

@section('content_header')
    <div class="mb-2"></div>
@endsection

@section('content')

    <div class="mb-2 flex">
        <a href="{{ route('collective.index') }}"
            class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition ease-in-out duration-600">
            <i class="fa-solid fa-reply"></i>
        </a>

        <div class="bg-green-500 hover:bg-green-600 ml-2 flex items-center text-white p-2 rounded">
            <span class="">Edição de Processos</span>
        </div>
    </div>

    <div class="card mt-4">

        <div class="bg-red-500 h-1">
            .
        </div>

        <form action="{{ route('collective.update', ['collective' => $proccess->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row g-3">

                    <input type="hidden" name="id" value="{{ $proccess->id }}">


                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="collective">
                            Classe Judicial
                        </x-labels>

                        <x-inputs id="collective" form="form-control" placeholder="Informe o nome do processo"
                            value="{{ $proccess->name }}" type="text" name="collective" focus="{{ true }}"
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
                            value="{{ $proccess->subject }}" type="text" name="subject" focus="{{ true }}"
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
                            value="{{ $proccess->jurisdiction }}" type="text" name="jurisdiction"
                            focus="{{ true }}" error="jurisdiction" />

                        @error('jurisdiction')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="judicial_office">
                            Cargo Judicial
                        </x-labels>

                        <x-inputs id="judicial_office" form="form-control" placeholder="ex: Juiz Federal Titular"
                            value="{{ $proccess->judicial_office }}" type="text" name="judicial_office"
                            focus="{{ true }}" error="judicial_office" />

                        @error('judicial_office')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <x-labels colorSpan="hidden" id="cause_value">
                            Valor da Causa
                        </x-labels>

                        <div class="flex">
                            <span
                                class="py-1 px-3 bg-red-500 text-white font-bold flex items-center justify-center text-md rounded-s">
                                $
                            </span>
                            <x-inputs id="cause_value" form="form-control" placeholder="ex: 1.510,00"
                                value="{{ $proccess->cause_value }}" type="text" name="cause_value"
                                focus="{{ true }}" error="cause_value" />

                            @error('cause_value')
                                <span class="text-red-500 flex">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <x-labels colorSpan="text-red-500" id="priority">
                            Prioridade
                        </x-labels>

                        <x-inputs id="priority" form="form-control" placeholder="ex: 100% Digital"
                            value="{{ $proccess->priority }}" type="text" name="priority" focus="{{ true }}"
                            error="priority" />

                        @error('priority')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <x-labels colorSpan="text-red-500" id="judgmental_organ">
                            Orgão Julgador
                        </x-labels>

                        <x-inputs id="judgmental_organ" form="form-control" placeholder="ex: 14° Vara Federal PB"
                            value="{{ $proccess->judgmental_organ }}" type="text" name="judgmental_organ"
                            focus="{{ true }}" error="judgmental_organ" />

                        @error('judgmental_organ')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-6 mb-3">
                        <x-labels colorSpan="hidden" id="url">
                            URL do Processo
                        </x-labels>

                        <x-inputs id="url" form="form-control" placeholder="Informe a URL do processo"
                            value="{{ $proccess->url_collective }}" type="text" name="url"
                            focus="{{ false }}" error="url" />

                        @error('url')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="text-red-500" id="competence">
                            Competência
                        </x-labels>

                        <x-inputs id="competence" form="form-control" placeholder="ex: JEF - Joâo Pessoa"
                            value="{{ $proccess->competence }}" type="text" name="competence"
                            focus="{{ false }}" error="competence" />

                        @error('competence')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <x-labels colorSpan="hidden" id="url_noticies">
                            URL da Noticia
                        </x-labels>

                        <x-inputs id="url_noticies" form="form-control" placeholder="Informe a URL da noticia"
                            value="{{ old('url_noticies') }}" type="text" name="url_noticies"
                            focus="{{ false }}" error="url_noticies" />

                        @error('url')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels colorSpan="text-red-500" id="email_corp">
                            E-mail Coorporativo
                        </x-labels>

                        <x-inputs id="email_corp" form="form-control" placeholder="Informe o e-mail coorporativo"
                            value="{{ $proccess->email_coorporative }}" type="text" name="email_corp"
                            focus="{{ false }}" error="email_corp" />

                        @error('email_corp')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels colorSpan="hidden" id="email_client">
                            E-mail do Cliente
                        </x-labels>

                        <x-inputs id="email_client" form="form-control" placeholder="Informe o e-mail do cliente"
                            value="{{ $proccess->email_client }}" type="text" name="email_client"
                            focus="{{ false }}" error="email_client" />

                        @error('email_client')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels colorSpan="text-red-500" id="user_id">
                            Selecione o cliente que você deseja
                        </x-labels>

                        <select name="user_id" id="user_id" class="form-control">
                            @foreach ($users as $user)
                                @if ($proccess->user_id == $user->id)
                                    <option value="{{ $user->id }}" selected>{{ ucfirst($user->name) }}</option>
                                @endif
                            @endforeach

                            @foreach ($users as $user)
                                @if ($user->admin === 1)
                                @else
                                    <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                                @endif
                            @endforeach
                        </select>

                        @error('user_id')
                            <span class="text-red-500 flex">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <x-labels colorSpan="hidden" id="status">
                            Selecione o status do processo
                        </x-labels>

                        <select class="form-control" name="status" id="status">
                            <option class="text-green-500" value="1" selected>Atualizar</option>
                            <option class="text-red-500" value="2">Finalizar</option>
                            <option class="text-yellow-500" value="3">Andamento</option>
                        </select>
                    </div>

                    <div class="col-md-12 flex flex-col">
                        <div class="flex justify-center items-center">
                            <x-labels colorSpan="hidden" id="">
                                Informações Adicionais
                            </x-labels>
                        </div>

                        <div class="flex items-center justify-center gap-6 flex-wrap">
                            <div>
                                @if (auth()->user()->can('admin-3'))
                                @else
                                    @if ($proccess->justice_secret == 1)
                                        <span class="mr-2">Segredo de justiça?</span>
                                        <input type="checkbox" name="justice_secret[]"
                                            value="{{ $proccess->justice_secret }}" checked
                                            class="form-checkbox rounded text-red-500 border-red-500">
                                    @else
                                        <span class="mr-2">Segredo de justiça?</span>
                                        <input type="checkbox" name="justice_secret[]" value="1"
                                            @checked(old('justice_secret'))
                                            class="form-checkbox rounded text-red-500 border-red-500">
                                    @endif
                                @endif
                            </div>

                            <div>
                                <span class="mr-2">Justiça Gratuita?</span>

                                @if ($proccess->free_justice == 1)
                                    <input type="checkbox" name="free_justice[]" value="{{ $proccess->free_justice }}"
                                        checked class="form-checkbox rounded text-red-500 border-red-500">
                                @else
                                    <input type="checkbox" name="free_justice[]" value="1"
                                        @checked(old('free_justice'))
                                        class="form-checkbox rounded text-red-500 border-red-500">
                                @endif
                            </div>

                            <div>
                                <span class="mr-2">Tutelar/Liminar?</span>

                                @if ($proccess->tutelar == 1)
                                    <input type="checkbox" name="tutelar[]" value="{{ $proccess->tutelar }}" checked
                                        class="form-checkbox rounded text-red-500 border-red-500">
                                @else
                                    <input type="checkbox" name="tutelar[]" value="1" @checked(old('tutelar'))
                                        class="form-checkbox rounded text-red-500 border-red-500">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <input type="submit"
                            class="bg-red-500 block w-full text-white rounded p-1 hover:bg-red-600 transition ease-in-out"
                            value="Editar">
                    </div>

                </div>
            </div>
        </form>
    </div>


@endsection

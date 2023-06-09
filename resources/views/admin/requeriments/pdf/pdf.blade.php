{{-- <img src="data:image/png;base64,{{ $data['imagemBase64'] }}" width="40px" alt=""> --}}
@extends('admin.requeriments.pdf.template')

@section('content')
    <div class="content">
        <br>
        <br>
        <div>
            <span>Oficio D.A. n°. {{ $data['requeriment']->oficio_num }}/2023-<strong>SINDJUF/PB</strong></span>
            <span style="position: absolute; margin-left: 12rem;">J. Pessoa/PB, 09 de setembro 2022.</span>
        </div>

        <br>
        <br>

        <div>
            <strong>Ao</strong>
            <br>
            <strong>Exmo. Des. {{ ucfirst($data['requeriment']->destinatario) }}</strong>
            <br>
            <strong>{{ ucfirst($data['requeriment']->office) }}</strong>
            <br>
            <strong>João Pessoa/PB</strong>
        </div>
        <br>
        <div>
            <strong>Assunto: </strong>
            <strong style="text-align: left; margin: 1rem">{{ ucfirst($data['requeriment']->subject) }}</strong>
        </div>
        <br>
        <div>
            {!! $data['requeriment']->description !!}
        </div>
    </div>

    <br>
@endsection

{{-- <img src="data:image/png;base64,{{ $data['imagemBase64'] }}" width="40px" alt=""> --}}
@extends('admin.requeriments.pdf.template')

@section('content')
    <div class="content">
        <br>
        <br>
        <div>
            <span>Oficio D.A. n°. {{ $data['requeriment']->oficio_num }}/2023-<strong>SINDJUF/PB</strong></span>
            <span style="position: absolute; margin-left: 10rem;">J. Pessoa/PB, {{ $data['localDate'] }}</span>
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
        <div style="text-align: center;">
            <h4 style="text-decoration: underline; margin:0;">{{ $data['requeriment']->coord_1 }}</h4>
            <span>{{ $data['requeriment']->coord_office_1 }} - SINDJUF/PB</span>
        </div>

        @if ($data['requeriment']->coord_2 != null)
            <div style="text-align: left; margin-top:3rem;">
                <h4 style="text-decoration: underline; margin:0; margin-left:3rem;">{{ $data['requeriment']->coord_2 }}</h4>
                <span>{{ $data['requeriment']->coord_office_2 }} - SINDJUF/PB</span>
            </div>
        @else
        @endif

        @if ($data['requeriment']->coord_3 != null)
            <div style="text-align: right; margin-top:-3rem; margin-right: 1.5rem;">
                <h4 style="text-decoration: underline; margin:0; margin-right:2rem;">{{ $data['requeriment']->coord_3 }}</h4>
                <span style="margin-right:-2rem;">{{ $data['requeriment']->coord_office_3 }} - SINDJUF/PB</span>
            </div>
        @else
        @endif
    </div>

    <br>
@endsection

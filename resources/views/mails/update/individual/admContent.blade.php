<div style="text-align: center;">
    <div>
        <img src="{{ $message->embed(public_path('assets/img/logoSind.png')) }}" alt="" width="110px">
    </div>
    <p style="margin-top: .5rem;">
        <strong>SGP - Sistema de Gestão Processual</strong>
    </p>
</div>

<div>
    <h2 style="text-align: center; color: #06be06;">
        Processo Atualizado com sucesso!
    </h2>

    <p>Processo <strong>{{ $data['subject'] }}</strong> foi atualizado com sucesso.</p>
    <a href="{{ 'https://sindjufpb.com.br/system/public/administrative_individual/' . $data['id']}}">Clique aqui para ir para
        o
        processo.</a>
</div>

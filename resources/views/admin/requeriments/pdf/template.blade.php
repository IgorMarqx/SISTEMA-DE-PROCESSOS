<!DOCTYPE html>
<html>

<head>
    <style>
        /* Defina estilos para o cabeçalho e o rodapé */
        @page {
            margin: 200px 50px 80px 75px;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            /* height: 40px; */
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="data:image/png;base64,{{ $data['imagemBase64'] }}" width="120px" alt="" style=" margin-top: -11rem;">
        <p
            style="color: #fd7f7f;width: 20rem; font-size: .8rem; margin-left: 11rem; margin-top: -5.5rem; font-weight: bold;">
            SINDICATO DOS TRABALHADORES DO PODER
            JUDICIÁRIO FEDERAL NO ESTADO DA PARAÍBA
        </p>
    </div>

    <div class="footer">
        <p style="color:#fd7f7f; text-align:center; font-weight: bold; border-top:1px solid #ccc; font-size: .9rem; margin-top:4rem;">
            Rua Heráclito Cavalcante, 48, Centro. João Pessoa/PB. CEP 58.013-340. Fone/WA: 83.99634-4664
            E-mail <a href="sindjuf@tre-pb.jus.br" target="_blank">sindjuf@tre-pb.jus.br</a> - Homepage
            sindjufpb.com.br
            CNPJ
            24.507.816/0001-74
        </p>
    </div>

    @yield('content')
</body>

</html>

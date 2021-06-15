@include('header')
<body >

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <a style="margin-top: 10px; margin-bottom: 10px" id="abre-modal-jogo" class="btn btn-success btn-xs text-right">Novo Jogador</a>
                <a href="/" style="margin-top: 10px; margin-bottom: 10px" class="btn btn-danger btn-xs text-right">Voltar</a>

                <div class="panel panel-default">
                    <div class="panel-heading">Jogos Marcados</div>
                        <div class="panel-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Nível</th>
                                        <th>Goleiro</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jogadores as $jogador)
                                    <tr>
                                        <td>{{ $jogador->id }}</td>
                                        <td>{{ $jogador->nome }}</td>
                                        <td>{{ $jogador->nivel }}</td>
                                        <td>{{ ($jogador->goleiro == "nao")?"Não":"Sim" }}</td>
                                        <td style="width: 12%">
                                            <a href="/jogadores/edit" data-id="{{ $jogador->id }}" class="btn btn-editar btn-primary btn-xs">Editar</a>
                                            <a href="/jogadores/delete/{{ $jogador->id }}" class="excluirjogo btn btn-danger btn-xs">Excluir</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>


            </div>

        </div>

        @include('jsglobal')
        @include("jsjogadores")

    </body>

    @include('modaisjogadores')
    @include('errormodal')

</html>
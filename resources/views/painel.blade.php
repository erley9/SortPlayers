@include('header')
<body >

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <a style="margin-top: 10px;margin-bottom: 10px" id="abre-modal-jogo" class="btn btn-success btn-xs text-right">Novo Jogo</a>

                <a href="/jogadores" style="margin-top: 10px;margin-bottom: 10px" class="btn btn-primary btn-xs text-right">Jogadores</a>

                <div class="panel panel-default">
                    <div class="panel-heading">Jogos Marcados</div>
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Titulo</th>
                                        <th>Data</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jogos as $jogo)
                                    <tr>
                                        <td>{{ $jogo->id }}</td>
                                        <td>{{ $jogo->titulo }}</td>
                                        <td style="width: 13%">{{ date( 'd/m/Y H:i',strtotime( $jogo->data)) }}</td>
                                        <td style="width: 13%">
                                            <a href="/jogos/detail/{{ $jogo->id }}" class="btn btn-warning btn-xs">Ver dados</a>
                                            <a href="/jogos/delete/{{ $jogo->id }}" class="excluirjogo btn btn-danger btn-xs">Excluir</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
            </div>

        </div>

        @include('jsglobal')
        @include('modaisjogo')
        
    </body>

    <div class="modal" id="modalConfirmarParticipacao" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Confirmar Participação</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             
                      <div class="row">

                          <form action="/jogos/salvarParticipacao" id="cadastroJogo">

                              <div class="col-md-12">

                                  <div class="form-group">
                                      <label for="jogador">Jogador</label>
                                      
                                  </div>

                                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                  <input type="hidden" name="idJogo" value="{{$jogo->id}}" />

                                  <div class="form-group">

                                      <button type="submit" class="btn btn-primary">Salvar</button>

                                  </div>

                              </div>

                          </form>

                      </div>

                  </div>

              </div>

          </div>

      </div>

    @include('jsjogo')
    @include('errormodal')

</html>
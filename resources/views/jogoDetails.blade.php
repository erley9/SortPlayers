@include('header')
<body >

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <a style="margin-top: 10px;margin-bottom: 10px" id="abre-modal-confirmar" class="btn btn-success btn-xs text-right">Confirmar Jogador</a>
                <a  style="margin-top: 10px;margin-bottom: 10px" class="btn btn-warning btn-xs text-right btn-sort">Sortear</a>
                <a href="/" style="margin-top: 10px;margin-bottom: 10px" class="btn btn-danger btn-xs text-right">Voltar</a>

                <div class="panel panel-default">
                    <div class="panel-heading">Dados Gerais</div>
                    <div class="panel-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Local</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <th>{{ $jogo->id }}</th>
                                    <th>{{ $jogo->titulo }}</th>
                                    <th>{{ $jogo->local }}</th>
                                    <td>{{ date( 'd/m/Y H:i',strtotime( $jogo->data)) }}</td>
                                </tr>
                              
                            </tbody>

                        </table>
                        
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Jogadores Confirmados</div>
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
                                @foreach ($jogadoresConfirmados as $jc)
                                    <tr>
                                        <th>{{ $jc->jogador->id }}</th>
                                        <th>{{ $jc->jogador->nome }}</th>
                                        <th>{{ $jc->jogador->nivel }}</th>
                                        <td>{{ ($jc->jogador->goleiro == "nao")?"Não":"Sim" }}</td>
                                        <td style="width: 12%"><a href="/jogos/deleteConfirmation/{{ $jc->id }}" class="excluirprensenca btn btn-danger btn-xs">Retirar</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"> <strong>Qtd. Jogadores : {{count($jogadoresConfirmados)}}</strong></td>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>

                <div class="panel panel-default" id="paneltTimes" style="display: none">

                    <div class="panel-heading">Times </div>
                    
                    <div class="panel-body">

                        <div class="row" id="container-times">

                        </div>
                    </div>
                </div>

            </div>

        </div>

        @include('jsglobal')
        
    <script type="text/javascript">
        $("document").ready(function($) {

            $("#abre-modal-confirmar").on("click",function(e){

                $("#modal-confirmar").modal("show");

            });

            $(".excluirprensenca").on("click",function(e){
                e.preventDefault();

                jQuery.ajax({
                  url: $(this).attr('href'),
                  type: 'GET',
                  dataType: 'json',
                  complete: function(xhr, textStatus) {
                    //called when complete
                  },
                  success: function(data, textStatus, xhr) {
                    alertModal("Sucesso","Registro excluido com sucesso");
                    setTimeout(function(){location.reload();},1500);
                  },
                  error: function(xhr, textStatus, errorThrown) {
                     alertModal("Erro","Não foi possivel excluir no momento, tente novamente mais tarde.");
                  }
                });
                

            });

            $("#cadastraPresenca").on("submit",function(e){

                e.preventDefault();

                jQuery.ajax({
                  url: $(this).attr('action'),
                  type: 'POST',
                  dataType: 'json',
                  data: $(this).serialize(),
                  complete: function(xhr, textStatus) {
                    //called when complete
                  },
                  success: function(data, textStatus, xhr) {
                    
                    if(data.status == "success"){
                        $("#modal-confirmar").modal("hide");
                        alertModal("Sucesso","Cadastro Efetuado com sucesso");
                        setTimeout(function(){location.reload();},1500);
                    }else{
                        $("#modal-confirmar").modal("hide");
                        alertModal("Erro","Não foi possivel efetuar o cadastro no momento, tente novamente mais tarde.");
                    }

                  },
                  error: function(xhr, textStatus, errorThrown) {
                    $("#modal-confirmar").modal("hide");
                    alertModal("Erro","Não foi possivel efetuar o cadastro no momento, tente novamente mais tarde.");
                  }
                });
                
            });

            $(".btn-sort").on("click",function(e){

                $("#form-sortear")[0].reset();
                $("#modal-sortear").modal("show");

            });

            $("#form-sortear").on("submit",function(e){

                e.preventDefault();

                $("#modal-sortear").modal("hide");
                alertModal("Aguarde ...","O sistema está relizando o sorteio ...",false);

                jQuery.ajax({
                  url: $(this).attr('action'),
                  type: 'POST',
                  dataType: 'json',
                  data: $(this).serialize(),
                  complete: function(xhr, textStatus) {
                    //called when complete
                  },
                  success: function(data, textStatus, xhr) {

                    $("#modal-sortear").modal("hide");
                   

                    if(data.status == "success"){

                        $("#alert-modal").modal("hide");

                        $("#container-times").html('');

                        for(time in data.times){

                            $("#container-times").append(montaTime(data.times[time]));

                        }

                        $("#paneltTimes").css({
                            display: 'block'
                        });

                        $('html,body').animate({
                                scrollTop: $("#paneltTimes").offset().top
                            }, 'slow');




                    }else{

                        $("#modal-sortear").modal("hide");
                        alertModal("Erro",data.message,false);
                    }

                  },
                  error: function(xhr, textStatus, errorThrown) {
                    
                    alertModal("Erro",textStatus+" - "+errorThrown,false);
                  }
                });
                

            });
            
        });

    </script>
    </body>

    <div class="modal" id="modal-confirmar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Confirmar Presença</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                      <div class="row">
                          <form action="/jogos/confirmPresence" id="cadastraPresenca">

                              <div class="col-md-12">

                                  <div class="form-group" required>
                                      <label for="data">Selecione o jogador</label>
                                      <select name="jogador" class="form-control">
                                          <option value=''>Selecione o jogador</option>
                                          @foreach ($listaJogadores as $item)
                                            <option value='{{$item->id}}'>{{$item->nome}}</option>
                                          @endforeach
                                      </select>
                                  </div>

                                  <input type="hidden" name="id" value="{{ $jogo->id }}" />
                                  <input type="hidden" name="_token" value="{{ csrf_token() }}" />

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

      <div class="modal" id="modal-sortear" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Iniciar Sorteio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                        <div class="row">
                            <form action="/jogos/sort" id="form-sortear">

                                <div class="col-md-5">

                                    <div class="form-group" required>
                                        <label for="qtd">Qtd de pessoas por time</label>
                                        <input type="number" min="1" required name="qtd">
                                    </div>

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                     <input type="hidden" name="id" value="{{ $jogo->id }}" />

                                    <div class="form-group">

                                        <button type="submit" class="btn btn-primary">Sortear</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @include('errormodal')

</html>
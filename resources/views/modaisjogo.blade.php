  <div class="modal" id="modalCadastroJogos" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novo Jogo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
           
                    <div class="row">

                        <form action="/jogos/create" id="cadastroJogo">

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="titulo">Titulo</label>
                                    <input type="text" name="titulo" required class="form-control" id="titulo" aria-describedby="Digite o titulo" placeholder="Digite o titulo">
                                </div>

                                <div class="form-group">
                                    <label for="data">Data/Hora</label>
                                    <input type="datetime-local" name="data" required class="form-control" id="data" placeholder="Selecione a data">
                                </div>

                                <div class="form-group">
                                    <label for="local">Local</label>
                                    <textarea name="local" id="local" required="" class="form-control"></textarea>
                                </div>

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
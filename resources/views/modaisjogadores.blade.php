  <div class="modal" id="modalCadastroJogos" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novo Jogador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
           
                    <div class="row">

                        <form action="/jogadores/create" id="cadastroJogo">

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="titulo">Nome</label>
                                    <input type="text" name="nome" required class="form-control" id="titulo" aria-describedby="Digite o nome" placeholder="Digite o titulo">
                                </div>

                                <div class="form-group" required>
                                    <label for="data">Nível (1 a 5)</label>
                                    <select name="nivel" class="form-control">
                                        <option value=''>Selecione o nível do jogador</option>
                                        <option value='1'>1 - (Perna de Pau)</option>
                                        <option value='2'>2 - (Ruím)</option>
                                        <option value='3'>3 - (Bom)</option>
                                        <option value='4'>4 - (Ótimo)</option>
                                        <option value='5'>5 - (Craque, já pode deixar de ser programador)</option>    
                                    </select>
                                </div>

                                 <div class="form-group">
                                    <label for="data">Goleiro?</label>
                                    <div class="form-check">
                                      <input class="form-check-input" name="goleiro" type="radio" value="sim" id="flexCheckDefault">
                                      <label class="form-check-label" for="flexCheckDefault">
                                        Sim
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" name="goleiro" type="radio" value="nao" id="flexCheckChecked" checked>
                                      <label class="form-check-label" for="flexCheckChecked">
                                        Não
                                      </label>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="" />
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
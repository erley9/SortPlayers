<script type="text/javascript">

    $(document).ready(function($) {

        $("#abre-modal-jogo").on("click",function(e){

        	$("#cadastroJogo")[0].reset();
            $("#cadastroJogo").attr('action', "/jogadores/create");
            $("#modalCadastroJogos").modal("show");    

        });

        $("#cadastroJogo").on("submit",function(e){

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
		            	$("#modalCadastroJogos").modal("hide");
		                alertModal("Sucesso","Cadastro Efetuado com sucesso");
		                setTimeout(function(){location.reload();},1500);
		            }else{
		            	$("#modalCadastroJogos").modal("hide");
		                alertModal("Erro","Não foi possivel efetuar o cadastro no momento, tente novamente mais tarde.");
		            }

		        },
		        error: function(xhr, textStatus, errorThrown) {
		        	$("#modalCadastroJogos").modal("hide");
		            alertModal("Erro","Não foi possivel efetuar o cadastro no momento tente novamente mais tarde.");
		        }
		    });

        });

        $(".excluirjogo").on("click",function(e){

        	e.preventDefault();

        	let selflink = $(this).attr('href');

        	bootbox.confirm({
        	    message: "Deseja realmente excluir esse jogador?",
        	    buttons: {
        	    	cancel: {
        	    	    label: 'Não',
        	    	    className: 'btn-danger'
        	    	},
        	        confirm: {
        	            label: 'Sim',
        	            className: 'btn-success'
        	        }
        	    },
        	    callback: function (result) {

        	    	if(result == true){

        	    		jQuery.ajax({
        	    		  url: selflink,
        	    		  type: 'GET',
        	    		  dataType: 'json',
        	    		  complete: function(xhr, textStatus) {
        	    		    //called when complete
        	    		  },
        	    		  success: function(data, textStatus, xhr) {
        	    		  	if(data.status == "success"){
        	    		  		alertModal("Sucesso","Registro deletado com sucesso");
        	    		    	setTimeout(function(){location.reload();},1500);
        	    			}else{
        	    				alertModal("Erro","Não foi possivel excluir tente novamente mais tarde.");
        	    			}
        	    		  },
        	    		  error: function(xhr, textStatus, errorThrown) {
        	    		     alertModal("Erro","Não foi possivel excluir tente novamente mais tarde.");
        	    		  }
        	    		});
        	    		

        	    	}

        	    }
        	});

        });

        $(".btn-editar").on("click",function(e){

            e.preventDefault();

            $("#cadastroJogo")[0].reset();

            let id = $(this).data('id');

            let self = $(this);

            jQuery.ajax({
              url: '/jogadores/find/'+id,
              type: 'GET',
              dataType: 'json',
              complete: function(xhr, textStatus) {
                //called when complete
              },
              success: function(data, textStatus, xhr) {

                let link = $(self).attr('href');
                $("#cadastroJogo").attr('action',link);
                $("#cadastroJogo input[name=nome]").val(data.jogador.nome);
                $("#cadastroJogo select[name=nivel]").val(data.jogador.nivel);
                $("#cadastroJogo input[name=goleiro][value='"+data.jogador.goleiro+"']").prop("checked",true);
                $("#cadastroJogo input[name=id]").val(data.jogador.id);
                $("#modalCadastroJogos").modal("show"); 

              },
              error: function(xhr, textStatus, errorThrown) {
                //called when there is an error
              }
            });
            
        });

    });

</script>
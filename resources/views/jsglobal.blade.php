<script type="text/javascript">
	
	function alertModal(title, body,timeout=true) {
	  $('#alert-modal-title').html(title);
	  $('#alert-modal-body').html(body);
	  $('#alert-modal').modal('show');

	  	if(timeout == true){

	  		setTimeout(function(){ $('#alert-modal').modal('hide'); }, 3000);

		}
	}

	function montaTime(time){

		 let html = '<div class="col-md-12">'+
					'<h4>'+time.nome+'</h4>'+
					'<table class="table">'+
		        '<thead>'+
		            '<tr>'+
		                '<th>Nome</th>'+
		                '<th>Nivel</th>'+
		                '<th>Goleiro</th>'+
		            '</tr>'+
		        '</thead>'+
		        '<tbody>';

		        for(jogador in time.jogadores){
		        	html += geraTr(time.jogadores[jogador]);
		        }
		           
		html += '</tbody>'+
		        '<tfoot>'+
		            '<tr>'+
		                '<td>Média Time:</td>'+
		                '<td>'+time.media+'</td>'+
		                '<td></td>'+
		            '</tr>'+
		        '</tfoot>'+
		    '</table>'+ 
		'</div>';

		return html;


	}

	function geraTr(jogador){

		let goleiro = (jogador.goleiro == "nao") ? "Não" : "Sim";

		$html =
		'<tr>'+
		    '<td>'+jogador.nome+'</td>'+
		    '<td>'+jogador.nivel+'</td>'+
		    '<td>'+goleiro+'</td>'+
		'</tr>';

		return $html;

	}


</script>
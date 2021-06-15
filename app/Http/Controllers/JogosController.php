<?php

namespace App\Http\Controllers;
use App\Confirmados;
use App\Jogos;
use App\Jogadores;
use Illuminate\Http\Request;

class JogosController extends Controller
{
 
    public function index()
    {
        $jogos = Jogos::orderBy("id","desc")->get();
            
        return view('painel',['jogos' => $jogos]);
    }

    
    public function create(Request $request){

        $Jogo = new Jogos;

        $Jogo->titulo = $request->titulo;
        
        $Jogo->data = $request->data;

        $Jogo->local = $request->local;

        $Jogo->save();

        return array("status"=>"success");

    }

    public function delete($id){

        $Jogo = Jogos::find($id);

        $Jogo->delete();
       
        return array("status"=>"success");

    }


    public function detail($id){

        $jogo = Jogos::find($id);

        $confirmados = Confirmados::with("jogador","jogo")->where('idJogo', $id)->get();

        $listaJogadores = Jogadores::orderBy("nome","asc")->get();

        $listaJogadoresFiltrada = array();

        foreach ($listaJogadores as $l) {
            
             $verificaEstaNaLista = Confirmados::with("jogador","jogo")->where('idJogador', $l->id)->get();

             if(count($verificaEstaNaLista) == 0){
                $listaJogadoresFiltrada[] = $l;
             }

        }

        return view('jogoDetails',['jogo' => $jogo, 'jogadoresConfirmados' => $confirmados, "listaJogadores" => $listaJogadoresFiltrada]);

    }

    public function deleteConfirmation($id){

        $Confirmado = Confirmados::find($id);

        $Confirmado->delete();
        
        return array("status"=>"success");

    }

    public function confirmPresence(Request $request){

        $Confirmacao = new Confirmados;

        $Confirmacao->idJogador = $request->jogador;
        
        $Confirmacao->idJogo = $request->id;

        $Confirmacao->save();

        return array("status"=>"success");

    }

    public function sort(Request $request){

        $confirmados = Confirmados::with("jogador","jogo")->where('idJogo', $request->id)->get();

        $quantidadeDeJogadoresPorTime = $request->qtd;

        if(count($confirmados) <  ($quantidadeDeJogadoresPorTime * 2)){
            return array("status"=>"error","message" => "O sorteio não pode ser realizado, pois não tem jogadores confirmados suficientes. Obs: minimo ". ($quantidadeDeJogadoresPorTime * 2));
        }

        $goleiros = array();

        $jogadores = array();

        foreach ($confirmados as $participante) {
            
            if($participante->jogador->goleiro == "sim"){

                $goleiros[] = array(
                    "nome" => $participante->jogador->nome,
                    "nivel" => $participante->jogador->nivel,
                    "goleiro" => $participante->jogador->goleiro
                ); 

            }else{

                $jogadores[] = array(
                        "nome" => $participante->jogador->nome,
                        "nivel" => $participante->jogador->nivel,
                        "goleiro" => $participante->jogador->goleiro
                );

            }

        }

        $quantidadeTimesPossiveis = ceil(count($confirmados) / $quantidadeDeJogadoresPorTime);

        if(count($goleiros) < 2){
            return array("status"=>"error","message" => "Precisamos no mínimo de dois goleiros para formar dois times");
        }

        if((count($confirmados) == $quantidadeDeJogadoresPorTime * 2) && count($goleiros) > 2){
            return array("status"=>"error","message" => "Temos jogadores suficientes para dois times, a quantidade de goleiros é superior a quantidade de times possíveis, não podemos ter dois goleiros em um mesmo time");
        }


        if(count($goleiros) < $quantidadeTimesPossiveis){
            return array("status"=>"error","message" => "Pela quantidade de jogadores ({$quantidadeDeJogadoresPorTime}) por time, da um total de ({$quantidadeTimesPossiveis}) times possíveis, então ({$quantidadeTimesPossiveis}) jogadores tem que ser goleiros");
        }

        usort(
            $goleiros,
            function( $a, $b ) {

                if( $a["nivel"] == $b["nivel"]){
                 
                   return 0;
                   
                } 

               return ( ( $a["nivel"] < $b["nivel"] ) ? 1 : -1 );
            }
        );

        usort(
             $jogadores,
             function( $a, $b ) {

                 if( $a["nivel"] == $b["nivel"]){
                  
                    return 0;
                    
                 } 

                return ( ( $a["nivel"] < $b["nivel"] ) ? 1 : -1 );
             }
        );


       

        $times = array();


        for ($i=1; $i <= $quantidadeTimesPossiveis ; $i++) { 
            
            $times["time".$i]["jogadores"] = array(); 

        }

        $contagem = 1;

        foreach ($goleiros as $item) {


            if(count($times["time".$contagem]["jogadores"]) == 0){

                $times["time".$contagem]["jogadores"][] = $item; 

            }

            $contagem++;

            if($contagem > $quantidadeTimesPossiveis){
                $contagem = 1;
            }
           
        }

        $contagem = 1;

        $timesCompletos = 0;

        foreach ($jogadores as $item) {

       
            if(count($times["time".$contagem]["jogadores"]) < $quantidadeDeJogadoresPorTime){

                 $times["time".$contagem]["jogadores"][] = $item; 

            }

            if(count($times["time".$contagem]["jogadores"]) == $quantidadeDeJogadoresPorTime){

                $timesCompletos = $timesCompletos + 1;

            }


    


            if($timesCompletos >= 2){


                $contagem++;

                if($contagem > $quantidadeTimesPossiveis){
                    $contagem = 3;
                }

            }else{


                $contagem++;

                if($contagem > 2){
                    $contagem = 1;
                }
              

            }



        }

        $timesFinais = array();


        foreach ($times as $key => $time) {

            $quantidade = count($time);

            $somaMedia = 0;

            foreach ($time["jogadores"] as $jogadores) {
                
                $somaMedia = $somaMedia + $jogadores["nivel"];
            }

            $media = $somaMedia / $quantidade;

            $time["nome"] = $key;

            $time["media"] = $media; 

            $timesFinais[] = $time;

        }
    
        return array("status"=>"success","message" => "sorteio efetuado com sucesso","times" => $timesFinais);
    }

}

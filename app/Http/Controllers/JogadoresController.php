<?php

namespace App\Http\Controllers;

use App\Jogadores;
use Illuminate\Http\Request;

class JogadoresController extends Controller
{


    public function index()
    {
        $jogadores = Jogadores::orderBy("id","desc")->get();
            
        return view('jogadores',['jogadores' => $jogadores]);
    }

    public function create(Request $request)
    {
        $Jogador = new Jogadores;

        $Jogador->nome = $request->nome;
        
        $Jogador->nivel = $request->nivel;

        $Jogador->goleiro = $request->goleiro;

        $Jogador->save();

        return array("status"=>"success");
    }

    public function edit(Request $request)
    {
        $Jogador = Jogadores::find($request->id);

        $Jogador->nome = $request->nome;
        
        $Jogador->nivel = $request->nivel;

        $Jogador->goleiro = $request->goleiro;

        $Jogador->save();

        return array("status"=>"success");
    }


    public function delete($id){

        $Jogador = Jogadores::find($id);

        $Jogador->delete();
       
        return array("status"=>"success");

    }


    public function find($id){

        $Jogador = Jogadores::find($id);
       
        return array("status"=>"success","jogador"=>$Jogador);

    }
}

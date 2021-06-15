<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmados extends Model{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idJogador', 'idJogo'
    ];


    public function jogador(){
        return $this->hasOne('App\Jogadores', 'id', 'idJogador');
    }

    public function jogo(){
    	return $this->hasOne('App\Jogos','id', 'idJogo');
    }

}

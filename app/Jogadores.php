<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jogadores extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",'nome', 'nivel', 'goleiro',
    ];

    public function confirmacao(){
    	return $this->hasOne('App\Jogadores','id','idJogador');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
    protected $fillable = ['cliente_id'];

    public function produtos(){
        return $this->belongsToMany('App\Item', 'pedido_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'created_at', 'updated_at', 'qtd');

        /**
         * 1 - Modelo do relacionamento NxN
         * 2 - Tabela auxiliar de relacionamento
         * 3 - FK da tabela mapeada desse model.
         * 4 - FK da tabela do model do primeiro parâmetro.
         * 
         */
    }
}
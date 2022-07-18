<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $table = 'produtos';
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    // 1 pra 1 Eloquent ORM
    public function produtoDetalhe(){
        //return $this->hasOne('Model', 'foreign_key', 'primary_key');
        return $this->hasOne('App\ItemDetalhe', 'produto_id', 'id');
    }

    // 1 pra N Eloquent ORM
    public function fornecedor(){
        return $this->belongsTo('App\Fornecedor');
    }

    // N pra N Eloquent ORM
    public function pedidos(){
        return $this->belongsToMany('App\Pedido', 'pedido_produtos', 'produto_id', 'pedido_id');
    }
}

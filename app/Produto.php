<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    // 1 pra 1 Eloquent ORM
    public function produtoDetalhe(){
        return $this->hasOne('App\ProdutoDetalhe');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes;

    //Forçar nome de table ao instanciar a classe 
    protected $table = 'fornecedores';

    //Liberar campos para serem preenchidos através de métodos estáticos
    protected $fillable = ['nome', 'site', 'uf', 'email']; 

    public function produtos(){
        //return $this->hasMany('Model', 'foreign_key', 'primary_key');
        return $this->hasMany('App\Item', 'fornecedor_id', 'id');
    }
}

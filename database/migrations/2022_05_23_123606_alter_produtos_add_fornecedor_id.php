<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProdutosAddFornecedorId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Criar coluna de relacionamento fornecedores

        Schema::table('produtos', function(Blueprint $table){

            //Inserir um registro de fornecedor para estabelecer relacionamento
            $fornecedor_id = DB::table('fornecedores')->insertGetId(array(
                'nome' => 'Fornecedor Padrão SG',
                'site' => 'fornecedorpadrao.com.br',
                'uf' => 'SP',
                'email' => 'fornecedorpadrao@hotmail.com'
            ));

            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id)->after('descricao');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('produtos', function(Blueprint $table){
            $table->dropForeign('produtos_fornecedor_id_foreign');
            $table->dropColumn('fornecedor_id');
        });
    }
}

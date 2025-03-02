<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('unidade_id')->after('estoque_maximo');

            $table->foreign('unidade_id')->references('id')->on('unidades');
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
        Schema::table('produtos', function (Blueprint $table) {
            //remover a foreign key
            $table->dropForeign('produtos_unidade_id_foreign');

            //remover coluna
            $table->dropColumn('unidade_id');
        });
    }
}

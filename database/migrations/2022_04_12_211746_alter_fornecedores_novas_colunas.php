<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFornecedoresNovasColunas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->string('uf', 2)->after('nome');
            $table->string('email', 150)->after('uf');
            $table->string('site', 150)->after('email');
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
        Schema::table('fornecedores', function (Blueprint $table) {
            //para remover colunas
            $table->dropColumn(array('uf', 'email'));
        });
    }
}

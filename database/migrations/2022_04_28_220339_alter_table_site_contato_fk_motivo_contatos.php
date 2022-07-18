<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableSiteContatoFkMotivoContatos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Adicionando coluna
        
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->unsignedBigInteger('motivo_contatos_id')->after('mensagem');
        });

        //Atribuindo valor à coluna criada
        DB::statement('update site_contatos set motivo_contatos_id = motivo_contato');

        //Criação da FK
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->foreign('motivo_contatos_id')->references('id')->on('motivo_contatos');
            $table->dropColumn('motivo_contato');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Adicionando coluna
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->integer('motivo_contato')->after('mensagem');
            $table->dropForeign('site_contatos_motivo_contatos_id_foreign');
        });

        //Atribuindo valor à coluna criada
        DB::statement('update site_contatos set motivo_contato = motivo_contato_id');

        //Criação da FK
        Schema::table('site_contatos', function (Blueprint $table) {
            $table->dropColumn('motivo_contatos_id');
        });
        
    }
}

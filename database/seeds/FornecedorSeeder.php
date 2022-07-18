<?php

use Illuminate\Database\Seeder;
use App\Fornecedor as Forn;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SAVE()
        $f = new Forn();
        $f->nome = 'Denis Cury';
        $f->site = 'denis.com';
        $f->uf = 'SP';
        $f->email = 'denis.ortiz@hndlabs.com';

        $f->save();

        //MÉTODOS ESTÁTICOS
        Forn::create(array(
            'nome' => 'Denis Ortiz',
            'site' => 'ortiz.com',
            'uf' => 'RJ',
            'email' => 'ortiz@gmail.com'
        ));

        //INSERT() -- Não salva as datas de criação e alteração.
        DB::table('fornecedores')->insert(array(
            'nome' => 'Denis Augusto',
            'site' => 'augusto.com',
            'uf' => 'ES',
            'email' => 'augusto@mail.com'
        ));

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato as Contato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(){
        $motivo_contatos = MotivoContato::all();

        return view('site.contato', array(
            'titulo' => 'Super Gestão - Contato',
            'motivo_contatos' => $motivo_contatos
        ));
    }

    public function salvar(Request $request){
        //Validação de campos
        $regras = array(
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email|unique:site_contatos',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000',
        );
        $feedback = array(
            'required' => 'O campo :attribute é obrigatório',
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'email.email' => 'O email informado precisa ser válido',
            'email.unique' => 'O email informado já foi cadastrado',
            'mensagem.max' => 'O campo mensagem deve ter no máximo 2000 caracteres'
        );

        $request->validate($regras, $feedback);

        
        //$request->all() -> request inteiro
        //$request->input([NAME]) -> parâmetro específico

        /** 
         * $contato = new Contato();
         *$contato->nome = $request->input('nome');
         *$contato->telefone = $request->input('telefone');
         *$contato->email = $request->input('email');
         *$contato->motivo_contato = $request->input('motivo_contato');
         *$contato->mensagem = $request->input('mensagem');

         *$contato->save();
        */

        Contato::create($request->all());
        return redirect()->route('site.index');
    }
}

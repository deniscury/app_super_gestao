<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index(){
        return view('app.fornecedor.index', array(
            'titulo' => 'Fornecedor'
        ));
    }

    public function listar(Request $request){

        $fornecedores = Fornecedor::with(['produtos'])
                            ->where('nome', 'like', '%'.$request->input('nome').'%')
                            ->where('site', 'like', '%'.$request->input('site').'%')
                            ->where('uf', 'like', '%'.$request->input('uf').'%')
                            ->where('email', 'like', '%'.$request->input('email').'%')
                            ->paginate(3);

        return view('app.fornecedor.listar', array(
            'titulo' => 'Fornecedor - Listar',
            'fornecedores' => $fornecedores,
            'request' => $request->all()
        ));
    }

    public function adicionar(Request $request){

        $msg = '';

        if ($request->input('_token') != '' ){
            //Validação
            $regras = array(
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'.($request->input('id')==''?'|unique:fornecedores':''),
            );
            $feedback = array(
                'required' => 'O campo :attribute é obrigatório',
                'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo uf precisa ter no mínimo 2 caracteres',
                'uf.max' => 'O campo uf deve ter no máximo 2 caracteres',
                'email.email' => 'O email informado precisa ser válido',
                'email.unique' => 'O email informado já foi cadastrado'
            );

            $request->validate($regras, $feedback);

            //Cadastro
            if ($request->input('id') == ''){
                Fornecedor::create($request->all());
                
                $msg = 'Cadastro realizado com sucesso!';
            }
            else{
                $fornecedor = Fornecedor::find($request->input('id'));

                $update = $fornecedor->update($request->all());

                if($update){
                    $msg = 'Cadastro atualizado com sucesso!';
                }
                else{
                    $msg = 'Cadastro não pôde ser atualizado!+.';
                }

                return redirect()->route('app.fornecedor.editar', array(
                    'titulo' => 'Fornecedor - Adicionar',
                    'msg' => $msg,
                    'id' => $request->input('id')
                ));
            }
        }

        return view('app.fornecedor.adicionar', array(
            'titulo' => 'Fornecedor - Adicionar',
            'msg' => $msg
        ));
    }

    public function editar($id, $msg = ''){
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', array(
            'titulo' => 'Fornecedor - Editar',
            'msg' => $msg,
            'fornecedor' => $fornecedor
        ));
    }

    public function excluir($id){
        
        $delete = Fornecedor::find($id)->delete();

        //$delete = Fornecedor::find($id)->forceDelete(); -- Força delete da tabela

        return redirect()->route('app.fornecedor');
    }

}

<?php

namespace App\Http\Controllers;

use App\Unidade;
use App\Fornecedor;
use App\Item as Produto;
use App\ItemDetalhe as ProdutoDetalhe;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $produtos = Produto::with(['produtoDetalhe', 'fornecedor'])->paginate(10);
        /*
        SEM ELOQUENT ORM
        foreach($produtos as $key  => $produto){
            $produto_detalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();

            if (isset($produto_detalhe)){
                $produtos[$key]['comprimento'] = $produto_detalhe->comprimento;
                $produtos[$key]['largura'] = $produto_detalhe->largura;
                $produtos[$key]['altura'] = $produto_detalhe->altura;
            }
        }
        */

        return view('app.produto.index', array(
            'titulo' => 'Produto - Listar',
            'produtos' => $produtos,
            'request' => $request->all()
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.create', array(
            'titulo' => 'Produto - Adicionar',
            'unidades' => $unidades,
            'fornecedores' => $fornecedores
        ));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validação
        $regras = array(
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',
        );
        $feedback = array(
            'required' => 'O campo :attribute é obrigatório',
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'descricao.min' => 'O campo descrição precisa ter no mínimo 3 caracteres',
            'descricao.max' => 'O campo udescriçãof deve ter no máximo 2000 caracteres',
            'peso.integer' => 'O campo peso deve ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe.',
            'fornecedor_id.exists' => 'O fornecedor informado não existe.'
        );

        $request->validate($regras, $feedback);

        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
        return view('app.produto.show', array(
            'titulo' => 'Produto - Visualizar',
            'produto' => $produto
        ));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.edit', array(
            'titulo' => 'Produto - Editar',
            'produto' => $produto,
            'unidades' => $unidades,
            'fornecedores' => $fornecedores
        )); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        //
        //Validação
        $regras = array(
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',
        );
        $feedback = array(
            'required' => 'O campo :attribute é obrigatório',
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'descricao.min' => 'O campo descrição precisa ter no mínimo 3 caracteres',
            'descricao.max' => 'O campo udescriçãof deve ter no máximo 2000 caracteres',
            'peso.integer' => 'O campo peso deve ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe.',
            'fornecedor_id.exists' => 'O fornecedor informado não existe.'
        );
        $request->validate($regras, $feedback);
        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
        $delete = Produto::find($produto->id)->delete();
        return redirect()->route('produto.index');
    }
}

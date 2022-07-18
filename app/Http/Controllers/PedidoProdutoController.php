<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        //
        $produtos = Produto::all();
        return view('app.pedidoproduto.create', array(
            'titulo' => 'Carrinho - Adicionar',
            'pedido' => $pedido,
            'produtos' => $produtos
        ));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        //
        $regras = array(
            'produto_id' => 'exists:produtos,id',
            'pedido_id' => 'exists:pedidos,id',
            'qtd' => 'required'
        );

        $feedback = array(
            'produto_id.exists' => 'O produto informado não existe.',
            'pedido_id.exists' => 'O pedido informado não existe.',
            'required' => "O campo :attribute é obrigatório."
        );

        $request->validate($regras, $feedback);

        /*
        $pedidoProduto = new PedidoProduto();

        $pedidoProduto->pedido_id = $pedido->id;
        $pedidoProduto->produto_id = $request->get('produto_id');
        $pedidoProduto->qtd = $request->get('qtd');

        $pedidoProduto->save();
        */
        //$pedido->produtos; // eager loading

        $pedido->produtos()
            ->attach(
                $request->get('produto_id'),
                array(
                    'qtd' => $request->get('qtd')
                )
            );

            /**
             * Vários de uma vez
             *  $pedido->produtos()
             *       ->attach(
             *           $request->get('produto_id') =>
             *              array(
             *                  'qtd' => $request->get('qtd')
             *              )
             *            $request->get('produto_id') =>
             *              array(
             *                  'qtd' => $request->get('qtd')
             *              )
             *          [....]  
             *       );
             */

        return redirect()->route('pedidoproduto.create', 
            array(
                'pedido' => $pedido->id
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Pedido $pedido, Produto $produto)
    public function destroy(PedidoProduto $pedido_produto)
    {
        // Convencional
        /*
        $delete = PedidoProduto::where(
            array(
                'produto_id' => $produto->id,
                'pedido_id' => $pedido->id
            )
        )->delete();
        */

        // Detach
        /*
        $pedido->produtos()->detach($produto->id);
        */

        // Via PK
        $pedido_produto->delete();

        return redirect()->route('pedidoproduto.create', array(
            'pedido' => $pedido_produto->pedido_id
        ));
    }
}

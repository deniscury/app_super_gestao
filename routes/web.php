<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PrincipalController@principal')
    ->name("site.index");

Route::get('/sobre-nos', 'SobreNosController@sobrenos')
    ->name("site.sobrenos");

Route::get('/contato', 'ContatoController@contato')
    ->name("site.contato");

Route::post('/contato', 'ContatoController@salvar')
    ->name("site.contato");

Route::get('/login/{erro?}', 'LoginController@index')
    ->name('site.login');

Route::post('/login', 'LoginController@autenticar')
    ->name('site.login');

Route::middleware('autenticacao:padrao')
    ->prefix('/app')
    ->group(
        function(){
            Route::get('/home', 'HomeController@index')
                ->name("app.home");

            Route::get('/sair', 'LoginController@sair')
                ->name("app.sair");

            // Ínicio - Rotas Cliente
            Route::resource('cliente', 'ClienteController'); // Quando a controller é criada com -r ou --resource
            // Fim - Rotas Cliente

            // Ínicio - Rotas Fornecedor
            Route::get('/fornecedor', 'FornecedorController@index')
                ->name("app.fornecedor");

            Route::get('/fornecedor/listar', 'FornecedorController@listar')
                ->name("app.fornecedor.listar");

            Route::post('/fornecedor/listar', 'FornecedorController@listar')
                ->name("app.fornecedor.listar");

            Route::get('/fornecedor/adicionar', 'FornecedorController@adicionar')
                ->name("app.fornecedor.adicionar");

            Route::post('/fornecedor/adicionar', 'FornecedorController@adicionar')
                ->name("app.fornecedor.adicionar");

            Route::get('/fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')
                ->name("app.fornecedor.editar");

            Route::get('/fornecedor/excluir/{id}', 'FornecedorController@excluir')
                ->name("app.fornecedor.excluir");
            // Fim - Rotas Fornecedor

            // Ínicio - Rotas Produto
            Route::resource('produto', 'ProdutoController'); // Quando a controller é criada com -r ou --resource

            Route::resource('produto-detalhe', 'ProdutoDetalheController'); // Quando a controller é criada com -r ou --resource
            // Fim - Rotas Produto

            // Ínicio - Rotas Pedido
            Route::resource('pedido', 'PedidoController'); // Quando a controller é criada com -r ou --resource
            
            Route::get('pedido-produto/create/{pedido}', 'PedidoProdutoController@create')
                ->name('pedidoproduto.create');

            Route::post('pedido-produto/store/{pedido}', 'PedidoProdutoController@store')
                ->name('pedidoproduto.store');

            Route::delete('pedido-produto/destroy/{pedido_produto}', 'PedidoProdutoController@destroy')
                ->name('pedidoproduto.destroy');

            /*
            Route::delete('pedido-produto/destroy/{pedido}/{produto}', 'PedidoProdutoController@destroy')
                ->name('pedidoproduto.destroy');
            */
            // Fim - Rotas Pedido

        }
    );

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('teste');

Route::fallback(function(){
    echo "A rota acessada não existe. </br>Para retornar ao ínicio clique <a href='".route("site.index")."'>aqui</a>.";
});
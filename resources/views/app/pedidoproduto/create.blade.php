@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('container')
    <div class="conteudo-pagina">

        <div class='titulo-pagina'>
            <p>{{$titulo}}</p>
        </div>

        
        <div class='menu'>
            <ul>
                <li><a href='{{route('pedido.index')}}'>Voltar</a></li>
            </ul>
        </div>

        <div class='informacao-pagina'>
            <h4>Detalhes do pedido</h4>
            <p>Pedido: {{$pedido->id}}</p>
            <p>Cliente: {{$pedido->cliente_id}}</p>
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <h4>Itens do Pedido</h4>
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Data de Inclusão</th>
                            <th>Data de Atualização</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedido->produtos as $produto)
                            <tr>
                                <td>{{$produto->id}}</td>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->pivot->qtd}}</td>
                                <td>{{$produto->pivot->created_at->format('d/m/Y')}}</td>
                                <td>{{$produto->pivot->updated_at->format('d/m/Y')}}</td>
                                <td>
                                    <form method="post" id="frm_{{$produto->pivot->id}}" action="{{route('pedidoproduto.destroy', ['pedido_produto' => $produto->pivot->id])}}">
                                        @method('delete')
                                        @csrf
                                        <a href="#" onclick="document.getElementById('frm_{{$produto->pivot->id}}').submit();">
                                            Excluir
                                        </a> 
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @component('app.pedidoproduto._components.form_pedidoproduto',
                    array(
                        'pedido' => $pedido,
                        'produtos' => $produtos
                    ))
                @endcomponent
            </div>
        </div>
    </div>
@endsection
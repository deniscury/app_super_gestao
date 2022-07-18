@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('container')
    <div class="conteudo-pagina">

        <div class='titulo-pagina'>
            <p>{{$titulo}}</p>
        </div>

        
        <div class='menu'>
            <ul>
                <li><a href='{{route('pedido.create')}}'>Novo</a></li>
                <li><a href='{{route('pedido.index')}}'>Consulta</a></li>
            </ul>
        </div>

        <div class='informacao-pagina'>
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border style="border: 1px solid black; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Cliente</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->id}}</td>
                                <td>{{$pedido->cliente_id}}</td>
                                
                                <td>
                                    <a href="{{route('pedidoproduto.create', ['pedido' => $pedido->id])}}">Adicionar Produtos</a>
                                </td>
                                <td>
                                    <a href="{{route('pedido.show', ['pedido' => $pedido->id])}}">Visualizar</a>
                                </td>
                                <td>
                                    <a href="{{route('pedido.edit', ['pedido' => $pedido->id])}}">Editar</a>
                                </td>
                                <td>
                                    <form method="post" id="frm_{{$pedido->id}}" action="{{route('pedido.destroy', ['pedido' => $pedido->id])}}">
                                        @method('delete')
                                        @csrf
                                        <a href="#" onclick="document.getElementById('frm_{{$pedido->id}}').submit();">
                                            Excluir
                                        </a> 
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$pedidos->appends($request)->links()}} <!-- Paginação-->
                <!--
                <br/>
                {{$pedidos->count()}} - Total de registros por página
                <br/>
                {{$pedidos->total()}} - Total de registros
                <br/>
                {{$pedidos->firstItem()}} - Número do primeiro registro da página
                <br/>
                {{$pedidos->firstItem()}} - Número do último registro da página
                -->
                <br/>
                Exibindo {{$pedidos->count()}} pedidos de {{$pedidos->total()}} (de {{$pedidos->firstItem()}} a {{$pedidos->lastItem()}})
            </div>
        </div>
    </div>
@endsection
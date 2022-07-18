@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('container')
    <div class="conteudo-pagina">

        <div class='titulo-pagina'>
            <p>{{$titulo}}</p>
        </div>

        
        <div class='menu'>
            <ul>
                <li><a href='{{route('produto.create')}}'>Novo</a></li>
                <li><a href='{{route('produto.index')}}'>Consulta</a></li>
            </ul>
        </div>

        <div class='informacao-pagina'>
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border style="border: 1px solid black; width: 100%;">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th colspan="2">Fornecedor</th>
                            <th>Peso</th>
                            <th>Unidade</th>
                            <th>Comprimento</th>
                            <th>Altura</th>
                            <th>Largura</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->descricao}}</td>
                                <td>{{$produto->fornecedor->nome}}</td>
                                <td>{{$produto->fornecedor->site}}</td>
                                <td>{{$produto->peso}}</td>
                                <td>{{$produto->unidade_id}}</td>
                                <td>{{$produto->produtoDetalhe->comprimento ?? ''}}</td>
                                <td>{{$produto->produtoDetalhe->altura ?? ''}}</td>
                                <td>{{$produto->produtoDetalhe->largura ?? ''}}</td>
                                <td>
                                    <a href="{{route('produto.show', ['produto' => $produto->id])}}">Visualizar</a>
                                </td>
                                <td>
                                    <a href="{{route('produto.edit', ['produto' => $produto->id])}}">Editar</a>
                                </td>
                                <td>
                                    <form method="post" id="frm_{{$produto->id}}" action="{{route('produto.destroy', ['produto' => $produto->id])}}">
                                        @method('delete')
                                        @csrf
                                        <a href="#" onclick="document.getElementById('frm_{{$produto->id}}').submit();">
                                            Excluir
                                        </a> 
                                    </form>
                                </td>
                            </tr>

                            <tr>
                                <td colspan=12>
                                    <p>Exibir Pedidos</p>
                                    @foreach($produto->pedidos as $pedido)
                                        <a href="{{route('pedidoproduto.create', 
                                                    array(
                                                        'pedido' => $pedido->id
                                                    ))}}">{{$pedido->id}}</a>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$produtos->appends($request)->links()}} <!-- Paginação-->
                <!--
                <br/>
                {{$produtos->count()}} - Total de registros por página
                <br/>
                {{$produtos->total()}} - Total de registros
                <br/>
                {{$produtos->firstItem()}} - Número do primeiro registro da página
                <br/>
                {{$produtos->firstItem()}} - Número do último registro da página
                -->
                <br/>
                Exibindo {{$produtos->count()}} produtos de {{$produtos->total()}} (de {{$produtos->firstItem()}} a {{$produtos->lastItem()}})
            </div>
        </div>
    </div>
@endsection
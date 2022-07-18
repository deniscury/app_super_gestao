@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('container')
    <div class="conteudo-pagina">

        <div class='titulo-pagina'>
            <p>{{$titulo}}</p>
        </div>

        
        <div class='menu'>
            <ul>
                <li><a href='{{route('cliente.create')}}'>Novo</a></li>
                <li><a href='{{route('cliente.index')}}'>Consulta</a></li>
            </ul>
        </div>

        <div class='informacao-pagina'>
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border style="border: 1px solid black; width: 100%;">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{$cliente->nome}}</td>
                                
                                <td>
                                    <a href="{{route('cliente.show', ['cliente' => $cliente->id])}}">Visualizar</a>
                                </td>
                                <td>
                                    <a href="{{route('cliente.edit', ['cliente' => $cliente->id])}}">Editar</a>
                                </td>
                                <td>
                                    <form method="post" id="frm_{{$cliente->id}}" action="{{route('cliente.destroy', ['cliente' => $cliente->id])}}">
                                        @method('delete')
                                        @csrf
                                        <a href="#" onclick="document.getElementById('frm_{{$cliente->id}}').submit();">
                                            Excluir
                                        </a> 
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$clientes->appends($request)->links()}} <!-- Paginação-->
                <!--
                <br/>
                {{$clientes->count()}} - Total de registros por página
                <br/>
                {{$clientes->total()}} - Total de registros
                <br/>
                {{$clientes->firstItem()}} - Número do primeiro registro da página
                <br/>
                {{$clientes->firstItem()}} - Número do último registro da página
                -->
                <br/>
                Exibindo {{$clientes->count()}} clientes de {{$clientes->total()}} (de {{$clientes->firstItem()}} a {{$clientes->lastItem()}})
            </div>
        </div>
    </div>
@endsection
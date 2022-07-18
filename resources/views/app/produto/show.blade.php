@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('container')
    <div class="conteudo-pagina">

        <div class='titulo-pagina'>
            <p>{{$titulo}}</p>
        </div>

        
        <div class='menu'>
            <ul>
                <li><a href='{{route('produto.index')}}'>Voltar</a></li>
            </ul>
        </div>

        <div class='informacao-pagina'>
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <table border style="border: 1px solid black; width: 100%;">
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td>{{$produto->id}}</td>
                        </tr>
                        <tr>
                            <td>Nome</td>
                            <td style="text-align:left">{{$produto->nome}}</td>
                        </tr>
                        <tr>
                            <td>Descrição</td>
                            <td style="text-align:left">{{$produto->descricao}}</td>
                        </tr>
                        <tr>
                            <td>Peso</td>
                            <td>{{$produto->peso}} kg</td>
                        </tr>
                        <tr>
                            <td>Unidade de Medida</td>
                            <td style="text-align:left">{{$produto->unidade_id}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
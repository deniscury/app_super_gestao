@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('container')
    <div class="conteudo-pagina">

        <div class='titulo-pagina'>
            <p>{{$titulo}}</p>
        </div>

        
        <div class='menu'>
            <ul>
                <li><a href='#'>Voltar</a></li>
            </ul>
        </div>

        <div class='informacao-pagina'>
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component('app.produto_detalhe._components.form_produto_detalhe',
                    array(
                        'unidades' => $unidades
                    )
                )
                @endcomponent
            </div>
        </div>
    </div>
@endsection
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
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component('app.pedido._components.form_pedido',
                    array(
                        'clientes' => $clientes
                    ))
                @endcomponent
            </div>
        </div>
    </div>
@endsection
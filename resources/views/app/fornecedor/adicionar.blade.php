@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('container')
    <div class="conteudo-pagina">

        <div class='titulo-pagina'>
            <p>{{$titulo}}</p>
        </div>

        
        <div class='menu'>
            <ul>
                <li><a href='{{route('app.fornecedor.adicionar')}}'>Novo</a></li>
                <li><a href='{{route('app.fornecedor')}}'>Consulta</a></li>
            </ul>
        </div>

        <div class='informacao-pagina'>
            {{$msg}}
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form method="post" action="{{route('app.fornecedor.adicionar')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$fornecedor->id ?? ''}}">

                    <input type="text" name="nome" placeholder="Nome" value="{{$fornecedor->nome ?? old('nome')}}" class="borda-preta"/>
                    {{$errors->has('nome')?$errors->first('nome'):''}}

                    <input type="text" name="site" placeholder="Site" value="{{$fornecedor->site ?? old('site')}}" class="borda-preta"/>
                    {{$errors->has('site')?$errors->first('site'):''}}

                    <input type="text" name="uf" placeholder="UF" value="{{$fornecedor->uf ?? old('uf')}}" class="borda-preta"/>
                    {{$errors->has('uf')?$errors->first('uf'):''}}

                    <input type="text" name="email" placeholder="Email" value="{{$fornecedor->email ?? old('email')}}" class="borda-preta"/>
                    {{$errors->has('email')?$errors->first('email'):''}}

                    <button type="submit" class="borda-preta">
                        Cadastrar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
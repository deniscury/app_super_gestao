@if(isset($cliente->id))
    <form method="post" action="{{route('pedido.update', ['pedido' => $pedido->id])}}">
        @csrf
        @method("PUT")
@else
    <form method="post" action="{{route('pedido.store')}}">
        @csrf
@endif
    <input type="hidden" name="id" value="{{$pedido->id ?? ''}}">

    <select class="borda-preta" name="cliente_id">
        <option value="">-- Selecione um Cliente</option>
        @foreach($clientes as $cliente)
            <option value="{{$cliente->id}}" {{($produto->cliente_id ?? old('cliente_id'))==$cliente->id ?'selected':''}}>{{$cliente->nome}}</option>
        @endforeach
    </select>
    {{$errors->has('cliente_id')?$errors->first('cliente_id'):''}}

    <button type="submit" class="borda-preta">
        {{isset($pedido->id)?'Editar':'Cadastrar'}}
    </button>
</form>

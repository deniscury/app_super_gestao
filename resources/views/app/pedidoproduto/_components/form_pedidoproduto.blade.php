
<form method="post" action="{{route('pedidoproduto.store', ['pedido' => $pedido])}}">
    @csrf

    <select class="borda-preta" name="produto_id">
        <option value="">-- Selecione um Produto</option>
        @foreach($produtos as $produto)
            <option value="{{$produto->id}}" {{old('produto_id')==$produto->id ?'selected':''}}>{{$produto->nome}}</option>
        @endforeach
    </select>
    {{$errors->has('produto_id')?$errors->first('produto_id'):''}}

    <input type="number" name="qtd" value="{{old('qtd') ? old('qtd') : ''}}" placeholder="Quantidade" class="borda-preta"/>
    {{$errors->has('qtd')?$errors->first('qtd'):''}}
    
    <button type="submit" class="borda-preta">
        {{'Cadastrar'}}
    </button>
</form>

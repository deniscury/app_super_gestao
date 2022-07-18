{{$slot}}
<form action="{{route('site.contato')}}" method="POST">
    @csrf
    <input type="text" value='{{old('nome')}}' name="nome" placeholder="Nome" class="{{$borda}}">
    {{$errors->has('nome')?$errors->first('nome'):''}}
    <br>
    <input type="text" value='{{old('telefone')}}' name="telefone" placeholder="Telefone" class="{{$borda}}">
    {{$errors->has('telefone')?$errors->first('telefone'):''}}
    <br>
    <input type="text" value='{{old('email')}}' name="email" placeholder="E-mail" class="{{$borda}}">
    {{$errors->has('email')?$errors->first('email'):''}}
    <br>
    <select class="{{$borda}}" name="motivo_contatos_id">
        <option value="">Qual o motivo do contato?</option>
        @foreach($motivo_contatos as $linhas)
            <option value="{{$linhas->id}}" {{old('motivo_contatos_id')==$linhas->id?'selected':''}}>{{$linhas->motivo_contato}}</option>
        @endforeach
    </select>
    {{$errors->has('motivo_contatos_id')?$errors->first('motivo_contatos_id'):''}}
    <br>
    <textarea class="{{$borda}}"  name="mensagem">{{ (old('mensagem') != '') ? old('mensagem') : 'Preencha aqui a sua mensagem'}}</textarea>
    {{$errors->has('mensagem')?$errors->first('mensagem'):''}}
    <br>
    <button type="submit" class="{{$borda}}">ENVIAR</button>
</form>

@if($errors->any())
    <div>
        <pre style="position:absolute; top:0px; left:0px; width:100%; background-color:red;">
            @foreach($errors->all() as $erro) 
                {{$erro}}
            @endforeach
        </pre>
    </div>
@endif
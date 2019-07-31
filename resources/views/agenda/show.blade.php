@extends('layouts.default')

@section('content')
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
}

</script>


    <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-users">Compromisso : {{ $agenda->nome }}</h1>

    <div class="ls-box">
    <div class="ls-float-right ls-regroup">
        <a href="" class="ls-btn-primary" target="_blank">Ações</a>
        <div data-ls-module="dropdown" class="ls-dropdown ls-pos-right">
        <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
        <ul class="ls-dropdown-nav" aria-hidden="true">
            <li>
            <a href="/agenda/{{$agenda->id}}" data-ls-fields-enable="#domain-form" data-toggle-class="ls-display-none" data-target=".domain-actions" class="domain-actions" role="option">Editar</a>
            </li>
           
            <li><a href="/agenda/delete/{{$agenda->id}}" class="ls-color-danger"  onclick="return confirm('tem certeza que quer excluir?')" role="option">Excluir</a></li>
        </ul>
        </div>
    </div>


    <form action="/agenda/update/{{$agenda->id}}" method="post" class="ls-form row" data-ls-module="form">
        @method('PUT')

        @csrf
        <fieldset id="domain-form" class="ls-form-disable ls-form-text">
        <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Nome:</b>
            <input type="text" name="nome" value="{{ $agenda->nome }}" required="" disabled="disabled" class="ls-form-text">
        </label>
        
        <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Horas:</b>
            <input type="text"  maxlength="5" autocomplete="off" OnKeyPress="formatar('##:##', this)" name="hora" value="{{$agenda->hora}}" required="" disabled="disabled" class="ls-form-text">
        </label>
        <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Data:</b>
            <input name="data" type="text" value="{{$agenda->data}}" required="" disabled="disabled" class="ls-form-text datepicker">
        </label>
        <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Descrição:</b>
            <textarea name="descricao" id="" cols="30" rows="5" disabled="disabled" class="ls-form-text">{{ $agenda->descricao}}</textarea>
        </label>
        </fieldset>
        <div class="domain-actions ls-display-none">
        <button type="submit" class="ls-btn-primary">Salvar</button>
        <button class="ls-btn" data-ls-fields-enable="#domain-form" data-toggle-class="ls-display-none" data-target=".domain-actions">Cancelar</button>
        </div>
    </form>
    </div>

    </div>


@stop
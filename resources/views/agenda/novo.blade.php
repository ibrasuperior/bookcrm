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
        <h1 class="ls-title-intro ls-ico-calendar-check">Novo compromisso</h1>

    <form action="/agenda/add" class="ls-form" method="post" >
        @csrf

        <legend class="ls-title-2">Identificação</legend>
        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Nome do Compromisso</span>
            <input autocomplete="off" type="text" name="nome">
            </label>
        </div>
        <div class="row">
        <label class="ls-label col-md-6">
            <div class="ls-prefix-group">
            <b class="ls-label-text">Data</b>
            <input autocomplete="off" type="text" name="data" class="datepicker" id="datepickerExample" placeholder="dd/mm/aaaa">
            </div>
        </label>
        </div>

        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Hora do compromisso</span>
            <input autocomplete="off" type="text" name="hora" maxlength="5" OnKeyPress="formatar('##:##', this)">
            </label>
        </div>
        
        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Descrição</span>
            <textarea rows="4" name="descricao" ></textarea>
            <p class="ls-helper-text">Descreva o conteúdo do seu compromisso.</p>
            </label>
        </div>

        <hr>
        
        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/leads" class="ls-btn">Voltar</a>
    </form>


    </div>

@stop
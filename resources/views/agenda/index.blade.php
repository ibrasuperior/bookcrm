@extends('layouts.default')

@section('content')

<div class="container-fluid">
      <h1 class="ls-title-intro ls-ico-calendar-check">Agenda</h1>

      @if( session('success') )
        <div class="ls-alert-success ls-dismissable">
          <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
          {{ session('success') }}
        </div>
      @endif

<div class="ls-box-filter">
  <form action="" class="ls-form ls-form-inline">
    <input type="hidden" name="status" value="">
    <label class="ls-label col-md-4 col-sm-4">
      <b class="ls-label-text">Compromisso</b>
      <div class="ls-custom-select">
        <select name="period" id="select_period" class="ls-select">
            <option>Hoje</option>
            <option>amanhã</option>
            <option>Essa semana</option>
            <option>Esse mês</option>
        </select>
      </div>
    </label>

    <label class="ls-label col-md-3 col-sm-3">
      <input type="text" placeholder="Nome do compromisso" >
    </label>

    <label class="ls-label col-md-1 col-sm-1">
      <input type="submit" class="ls-btn-primary" value="Filtrar">
    </label>
   </form>
</div>

<?php
$now = date('d/m/20y'); ?>

@foreach($agendas as $agenda)

<div class="ls-list" style="-webkit-box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.45);
-moz-box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.45);
box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.15);">
  <header class="ls-list-header">
    <div class="ls-list-title col-md-9">
      <a href="/agenda/show/{{$agenda->id}}" >{{$agenda->nome}}</a>
      <small> {{$agenda->data}} | {{$agenda->hora }} @if( $agenda->data == $now )<span class="ls-tag-danger">Hoje!</span> @endif </small>
    </div>
    <div class="col-md-3 ls-txt-right">
      <a href="/agenda/show/{{$agenda->id}}" class="ls-btn-primary">Visualizar</a>
      <a href="/agenda/delete/{{$agenda->id}}" onclick="return confirm('Tem certeza que quer arquivar ?')" class="ls-btn-success">Arquivar</a>
    </div>

  </header>

</div>
@endforeach


<div class="ls-modal" id="modalSmall">
  <div class="ls-modal-small">
    <div class="ls-modal-header">
      <button data-dismiss="modal">&times;</button>
      <h4>Novo Compromisso</h4>
    </div>
    <div class="ls-modal-body">
      <form action="/agenda/add" class="ls-form" method="post" data-ls-module="form" >
          @csrf
          <div class="row">
            <label class="ls-label col-md-12">
            <span class="ls-label-text">Descrição do agendamento</span>
            <input autocomplete="off" required type="text" name="nome">
            </label>
        </div>
        <div class="row">
        <label class="ls-label col-md-12">
            <div class="ls-prefix-group">
            <b class="ls-label-text">Data</b>
            <input autocomplete="off" required type="text" name="data" class=" datepicker" id="datepickerExample" placeholder="dd/mm/aaaa">
            </div>
        </label>
        </div>

        <div class="row">
            <label class="ls-label col-md-12">
            <span class="ls-label-text">Hora do compromisso</span>
            <input class="ls-mask-time" required placeholder="00:00" autocomplete="off" type="text" name="hora" >
            </label>
        </div>

        <div class="row">
            <label class="ls-label col-md-12">
            <span class="ls-label-text"> Notas sobre a conversa</span>
            <textarea rows="4" required name="descricao" ></textarea>
            <p class="ls-helper-text">Descreva aqui quais são as dores do seu cliente.</p>
            </label>
        </div>

    </div>
    <div class="ls-modal-footer">
          <button type="submit" class="ls-btn-block ls-btn-primary">Adicionar</button>
    </div>
    </form>
  </div>
</div>
</div>
<button data-ls-module="modal" data-target="#modalSmall" class="ls-btn-lg ls-btn-primary ls-ico-plus"
style="-webkit-box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.45);
-moz-box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.45);
box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.45);
font-size:110%;width:60px; height:60px;border-radius:35px; z-index:999;position:fixed;right:50px; bottom:110px;">
</button>
@stop


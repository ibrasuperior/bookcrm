@extends('layouts.default')

@section('content')

<div class="container-fluid">
<h1 class="ls-title-intro ls-ico-users">Resultado da Pesquisa</h1>

<div class="ls-box-filter" style="-webkit-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
-moz-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.15);">
  <form action="" class="ls-form ls-form-inline ls-float-left">
    <label class="ls-label col-md-6 col-sm-8">
      <b class="ls-label-text">Status</b>
      <div class="ls-custom-select ls-field-sm">
        <select name="" class="ls-select">
          <option>Todos</option>
          <option>Matriculados</option>
          <option>Defeituosos</option>
        </select>
      </div>
    </label>
  </form>

  <form action="/leads/search" method="GET" class="ls-form ls-form-inline ls-float-right">
    <label class="ls-label" role="search">
      <input type="text" name="order" autocomplete="off" aria-label="Faça sua busca por cliente" placeholder="Nome do lead" required="" class="ls-field-sm">
    </label>
    <div class="ls-actions-btn">
      <input type="submit" value="Buscar" class="ls-btn ls-btn-sm" title="Buscar">
    </div>
  </form>
</div>

<table class="ls-table">
  <thead>
    <tr>
      <th class="ls-txt-center" >Lead</th>
      <th class="ls-txt-center">E-mail</th>
      <th class="ls-txt-center">Telefone</th>
      <th class="ls-txt-center">Mídia</th>
      <th class="ls-txt-center">Colaborador</th>
      <th class="ls-txt-center">Ações</th>
      
      
    </tr>
  </thead>
  <tbody>
    @foreach( $leads as $lead )
      <tr>
        <td class="ls-txt-center"> 
          <a href="/leads/show/{{$lead->id}}">{{ $lead->nome}}</a>
          @if( $lead->matriculado  == true )
          </br><span class="ls-tag-success">Matriculado</span>
          @endif
        </td>
        <td class="ls-txt-center">{{$lead->email}}</td>
        <td class="ls-txt-center">{{$lead->telefone}}</td>
        <td class="ls-txt-center">
          {{$lead->canal->nome}}
        </td>
        <td class="ls-txt-center" >{{ $lead->colaborador->name }}</td>

        <td class="ls-txt-center ls-regroup">
        @if( $lead->colaborador_id == \Auth::user()->id )
            <div data-ls-module="dropdown" class="ls-dropdown">
                <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
                <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li><a href="/leads/show/{{$lead->id}}" class="" role="option">Visualizar</a></li>
                    <li><a href="/leads/delete/{{$lead->id}}" onclick="return confirm('tem certeza que quer excluir?')" class="ls-color-danger" role="option">Excluir</a></li>
                </ul>
            </div>
            @endif
        </td>
    
      </tr>
      
       @endforeach

  </tbody>
</table>

</div>

@stop
@extends('layouts.default')

@section('content')

<div class="container-fluid">
      <h1 class="ls-title-intro ls-ico-users">Contatos</h1>

@if( session('success') )
  <div class="ls-alert-success ls-dismissable">
    <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
    {{ session('success') }}
  </div>
@endif

@if( session('info') )
  <div class="ls-alert-info ls-dismissable">
    <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
    {{ session('info') }}
  </div>
@endif

@if( session('danger') )
  <div class="ls-alert-danger ls-dismissable">
    <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
    {{ session('danger') }}
  </div>
@endif

<style>
.shadow:hover{
border-radius: 5px;
-webkit-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
-moz-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.15);
}

</style>


<a class="ls-btn-primary ls-ico-spinner" onclick="return location.reload()" >Recarregar</a>

<div class="ls-box-filter" style="-webkit-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
-moz-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.15);">
  <form action="/leads/filter" class="ls-form ls-form-inline ls-float-left">
    <label class="ls-label col-md-6 col-sm-8">
      <b class="ls-label-text">Status</b>
      <div class="ls-custom-select ls-field-sm">
        <select name="order" class="ls-select">
          <option>Todos</option>
          <option value="2" >Oportunidades </option>
          <option value="4" >Desqualificados </option>
        </select>
      </div>
    </label>
    <button class="submit ls-btn-primary">Filtrar</button>
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

<table class="ls-table  ls-bg-header ">
  <thead>
    <tr>
      <th class="ls-txt-center ls-data-descending" > <a> Lead</a> </th>
      <th class="ls-txt-center ls-data-descending"> <a>E-mail </a></th>
      <th class="ls-txt-center ls-data-descending"><a>Telefone </a></th>
      <th class="ls-txt-center ls-data-descending"><a>Mídia </a></th>
      <th class="ls-txt-center ls-data-descending"><a>Responsável </a></th>
      <th class="ls-txt-center ls-data-descending"><a>Ações </a></th>
    </tr>
  </thead>
  <tbody>
    @foreach( $leads as $lead )
      <tr class="shadow" >
        <td class="ls-txt-center">
          <a href="/leads/show/{{$lead->id}}">{{ $lead->nome}}</a>
          @if( $lead->matriculado  == true )
          </br><span class="ls-tag-success">Matriculado</span>
          @endif
          @if( $lead->open  == false )
          </br><span class="ls-tag-danger">Novo</span>
          @endif
        </td>
        <td class="ls-txt-center">{{$lead->email}}</td>
        <td class="ls-txt-center">{{$lead->telefone}}</td>
        <td class="ls-txt-center">
          {{$lead->canal->nome}}
        </td>
        <td class="ls-txt-center">
          <?php if($lead->colaborador_id == 0 )
            {
                echo 'Sem operador';
            }else{
                echo $lead->colaborador->name;
            }  ?>
        </td>

        <td class="ls-txt-center ls-regroup">
            <div data-ls-module="dropdown" class="ls-dropdown">
                <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
                <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li><a href="/leads/show/{{$lead->id}}" class="" role="option">Visualizar</a></li>
                    <li><a href="/leads/delete/{{$lead->id}}" onclick="return confirm('tem certeza que quer excluir?')" class="ls-color-danger" role="option">Excluir</a></li>
                </ul>
            </div>
        </td>

      </tr>

       @endforeach

  </tbody>
</table>

{{ $leads->links() }}

</div>

<button data-ls-module="modal" data-target="#modalSmall" class="ls-btn-lg ls-btn-primary ls-ico-user-add"
 style="-webkit-box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.45);
-moz-box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.45);
box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.45);
font-size:110%;width:60px; height:60px;border-radius:35px; z-index:999;position:fixed;right:50px; bottom:110px;">
</button>


<div class="ls-modal" id="modalSmall">
<?php $canais = \App\Canal::get(); ?>

  <div class="ls-modal-small">
    <div class="ls-modal-header">
      <button data-dismiss="modal">&times;</button>
      <h4>Novo contato</h4>
    </div>
    <div class="ls-modal-body">
      <form action="/leads/add" class="ls-form" method="post" data-ls-module="form" >
          @csrf
          <div class="row">
              <label class="ls-label col-md-12">
              <span class="ls-label-text">Nome</span>
              <input autocomplete="off" type="text" name="nome" required>
              </label>
          </div>
          <div class="row">
              <label class="ls-label col-md-12">
              <span class="ls-label-text">Email</span>
              <input autocomplete="off" type="text" name="email" required>
              </label>
          </div>

          <div class="row">
              <label class="ls-label col-md-12">
              <span class="ls-label-text">Telefone</span>
              <input type="text" name="telefone" class="ls-mask-phone9_with_ddd" placeholder="(99) 9999-9999" >
              </label>
          </div>

          <div class="row">
          <label class="ls-label col-md-12 col-sm-12">
              <b class="ls-label-text">Canal</b>
              <div class="ls-custom-select">
                  <select name="canal_id" class="ls-select">
                    <option value="0"> Outros </option>
                    <option value="7"> Indicação </option>
                  </select>
              </div>
          </label>
          </div>

          <div class="row">
              <label class="ls-label col-md-12">
              <span class="ls-label-text">Observação</span>
              <textarea rows="2" name="obs" ></textarea>
              </label>
          </div>


    </div>
    <div class="ls-modal-footer">
          <button type="submit" class="ls-btn-block ls-btn-primary">Adicionar</button>
    </div>
    </form>
  </div>
</div>


@stop

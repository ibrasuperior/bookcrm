@extends('layouts.default')

@section('content')

<div class="container-fluid">
      <h1 class="ls-title-intro ls-ico-users">Estagios</h1>

@if( session('success') ) 
  <div class="ls-alert-success ls-dismissable">
    <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
    {{ session('success') }}
  </div>
@endif

<a href="/estagio/novo" class="ls-btn-primary">Cadastrar novo</a>

<table class="ls-table  ls-bg-header ">
  <thead>
    <tr>
      <th class="ls-txt-center" >id</th>
      <th class="ls-txt-center" >Nome</th>
      <th>  </th>
    </tr>
  </thead>
  <tbody>
    @foreach( $estagios as $estagio )
      <tr>
        <td class="ls-txt-center"> 
          {{ $estagio->id}}
        </td>

        <td class="ls-txt-center"> 
          <a href="/estagio/{{$estagio->id}}">{{ $estagio->nome}}</a>
        </td>

        <td class="ls-txt-center ls-regroup">
            <div data-ls-module="dropdown" class="ls-dropdown">
                <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
                <ul class="ls-dropdown-nav" aria-hidden="true">
                    <li><a href="/estagio/{{ $estagio->id }}" role="option">Editar</a></li>
                    
                    @if( $estagio->id > 4 )
                    <li><a href="/estagio/delete/{{$estagio->id}}" onclick="return confirm('tem certeza que quer excluir?')" class="ls-color-danger" role="option">Excluir</a></li>
                    @endif
                    
                </ul>
            </div>
        </td>
    
      </tr>
      
       @endforeach

  </tbody>
</table>


</div>

@stop
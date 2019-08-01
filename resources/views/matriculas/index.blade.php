@extends('layouts.default')

@section('content')

<div class="container-fluid">
      <h1 class="ls-title-intro ls-ico-users">Matrículas</h1>

@if( session('success') ) 
  <div class="ls-alert-success ls-dismissable">
    <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
    {{ session('success') }}
  </div>
@endif

<div class="ls-box-filter">
  <form action="" class="ls-form ls-form-inline ls-float-left">
    <label class="ls-label col-md-6 col-sm-8">
      <b class="ls-label-text">Status</b>
      <div class="ls-custom-select ls-field-sm">
        <select name="" class="ls-select">
          <option>Esse mês</option>
          <option>Todas</option>
        </select>
      </div>
    </label>
  </form>

  <form action="/matriculas/search" class="ls-form ls-form-inline ls-float-right">
    <label class="ls-label" role="search">
      <b class="ls-label-text ls-hidden-accessible">Nome do cliente</b>
      <input type="text" autocomplete="off" name="order" aria-label="Faça sua busca por cliente" placeholder="Nome do cliente" required="" class="ls-field-sm">
    </label>
    <div class="ls-actions-btn">
      <input type="submit" value="Buscar" class="ls-btn ls-btn-sm" title="Buscar">
    </div>
  </form>
</div>

<table class="ls-table  ls-bg-header ">
  <thead>
    <tr>
      <th class="ls-txt-center" >Quant</th>
      <th class="ls-txt-center" >Nome</th>
      <th class="ls-txt-center">Canal</th>
      <th class="ls-txt-center">Valor</th>
      <th class="ls-txt-center">Vencimento</th>
      <th class="ls-txt-center">Produto</th>
      <th class="ls-txt-center">Ações</th>
      
      
    </tr>
  </thead>
  <tbody>
    @foreach( $matriculas as $matricula )
      <tr>
      <td class="ls-txt-center"><strong>{{$matricula->quant}}</strong></td>
        <td class="ls-txt-center"> 
          {{ $matricula->nome}}
          @if( $matricula->pago  == true )
          </br><span class="ls-tag-success ls-ico-checkmark">Pago</span>
          @endif
          
        </td>
        <td class="ls-txt-center">{{$matricula->canal}}</td>
        <td class="ls-txt-center">{{$matricula->valor}}</td>
        <td class="ls-txt-center">{{$matricula->vencimento}}</td>

        <td class="ls-txt-center" >{{ $matricula->produto }}</td>

        <td class="ls-txt-center ls-regroup">
            <div data-ls-module="dropdown" class="ls-dropdown">
                <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
                <ul class="ls-dropdown-nav" aria-hidden="true">
                @if( $matricula->pago  == false )
                <li><a href="/matriculas/pagamento-in/{{ $matricula->id }}" style="cursor:pointer;" data-ls-module="modal" data-target="#modalSmall" role="option">Informar Pagamento</a></li>
                @else
                <li><a href="/matriculas/pagamento-out/{{ $matricula->id }}" style="cursor:pointer;" data-ls-module="modal" data-target="#modalSmall" role="option">Cancelar Pagamento</a></li>
                @endif
                <li><a onclick="return confirm('Tem certeza que quer apagar ?')" href="/matriculas/delete/{{$matricula->id}}" class="ls-color-danger" role="option">Excluir</a></li>

                </ul>
            </div>
        </td>
    
      </tr>
      
       @endforeach

  </tbody>
</table>

{{ $matriculas->links() }}

</div>




@stop
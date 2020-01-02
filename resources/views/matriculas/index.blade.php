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


<div data-ls-module="collapse" data-target="#0" class="shadow ls-collapse ">
    <a href="#" class="ls-collapse-header">
      <h2 style="padding:5px;" class="ls-collapse-title">Filtros</h2>
    </a>
    <div class="ls-collapse-body" id="0">
    <div class="ls-box-filter">

    <form action="" class="ls-form ls-form-horizontal row">
    <fieldset>

    <label class="ls-label col-md-4 col-xs-12">
      <b class="ls-label-text">Nome</b>
      <input autocomplete="off" type="text" name="nome" placeholder="Primeiro nome" class="ls-field" required>
    </label>

    <label class="ls-label col-md-4 col-xs-12">
      <b class="ls-label-text">Origem</b>
      <div class="ls-custom-select">
      <?php $canais = \App\Canal::get(); ?>
        <select name="canal" class="ls-select">
          @foreach($canais as $canal)
            <option>{{$canal->nome}}</option>
          @endforeach
        </select>
      </div>
    </label>

    <label class="ls-label col-md-4 col-xs-12">
      <b class="ls-label-text">Produto:</b>
      <div class="ls-custom-select">
        <select name="produto" class="ls-select">
          <option>Todos</option>
          <option>Pós-Graduação	</option>
          <option>Complementação</option>
          <option>Capacitação</option>
        </select>
      </div>
    </label>

    <HR/>

    <h3 style="padding-left:20px;padding-top:10px;">Data de Matrícula:</h3>


    <label class="ls-label col-md-4 col-xs-12">
        <b class="ls-label-text">De: </b>
        <input type="text" name="cel2" class="datepicker"  placeholder="dd/mm/aaaa">
    </label>


    <label class="ls-label col-md-4 col-xs-12">
        <b class="ls-label-text">Até: </b>
        <input type="text" name="cel2" class="datepicker"  placeholder="dd/mm/aaaa">
    </label>

  </fieldset>
  <button class="ls-ico-list ls-btn ls-btn-primary">Filtrar</button>
    </form>


</div>
    </div>
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



<style>
.shadow{
-webkit-box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.18);
-moz-box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.18);
box-shadow: 0px 2px 4px 1px rgba(0,0,0,0.18);
}
</style>


@stop

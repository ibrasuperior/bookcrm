@extends('layouts.default')

@section('content')

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Avisos</h1>
    @if( session('success') )
    <div class="ls-alert-success ls-dismissable">
        <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
        {{ session('success') }}
    </div>
    @endif
    <a href="/avisos/novo" class="ls-btn-primary">Novo Aviso</a>
    <div data-ls-module="collapse" data-target="#0" style="margin-top: 20px; background-color: #EEE; -webkit-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
-moz-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.15);" class="ls-collapse ">
        <a class="ls-collapse-header">
            <h3 class="ls-collapse-title">Filtros</h3>
        </a>
        <div class="ls-collapse-body">
            <form action="/avisos" class="ls-form ">
                <fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="ls-label ">
                                <b class="ls-label-text">Título</b>
                                <input type="text" name="titulo" placeholder="Título do Aviso">
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="ls-label">
                                <b class="ls-label-text">Vigência De:</b>
                                <input onchange="fieldLock()" type="datetime-local" name="dateStart" >
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="ls-label">
                                <b class="ls-label-text">Até:</b>
                                <input id="dataEnd" type="datetime-local" name="dateEnd" >
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="ls-label"> 
                                <b class="ls-label-text">Autor</b>
                                <input name="autor" type="text" placeholder="Nome do Autor">
                            </label>
                        </div>
                    </div>
                </fieldset>
                <button class="ls-btn-primary ls-ico-search">Filtrar</button>
            </form>
        </div>
    </div>
    <table class="ls-table ls-bg-header ">
        <thead>
            <tr>
                <th class="ls-txt-center">id</th>
                <th class="ls-txt-center">Titulo</th>
                <th class="ls-txt-center">Autor</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $avisos as $aviso )
            <tr>
                <td class="ls-txt-center">
                    {{ $aviso->id}}
                </td>
                <td class="ls-txt-center">
                    <a href="/avisos/{{ $aviso->id }}">{{$aviso->titulo}}</a>
                </td>
                <td class="ls-txt-center">
                    <a href="/avisos/{{ $aviso->id }}">{{$aviso->autor}}</a>
                </td>
                <td class="ls-txt-center ls-regroup">
                    <div data-ls-module="dropdown" class="ls-dropdown">
                        <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
                        <ul class="ls-dropdown-nav" aria-hidden="true">
                            <li><a href="/avisos/delete/{{$aviso->id}}" onclick="return confirm('tem certeza que quer excluir?')" class="ls-color-danger" role="option">Excluir</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    function fieldLock(){

        $inputDateEnd = document.getElementById('dataEnd');
        $inputDateEnd.property = 'require'

    }
</script>

@stop
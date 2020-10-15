@extends('layouts.default')

@section('content')

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-home">Publicidade</h1>

    @if( session('success') )

    <div class="ls-alert-success ls-dismissable">

        <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>

        {{ session('success') }}

    </div>

    @endif

    @if( session('danger') )

    <div class="ls-alert-danger ls-dismissable">

        <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>

        {{ session('danger') }}

    </div>

    @endif
    @if( \Auth::user()->permissoes == 1 )
    <a href="/artes/nova" class="ls-btn-primary">Cadastrar Nova</a>
    @endif
    <div data-ls-module="collapse" data-target="#0" style="margin-top: 20px; background-color: #EEE; -webkit-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
    -moz-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
    box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.15);" class="ls-collapse ">
        <a class="ls-collapse-header">
            <h3 class="ls-collapse-title">Filtros</h3>
        </a>
        <div class="ls-collapse-body">
            <form action="/artes" class="ls-form ">
                <fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="ls-label ">
                                <b class="ls-label-text">Nome</b>
                                <input type="text" name="nome" placeholder="Nome da Peça">
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="ls-label ">
                                <b class="ls-label-text">Personalizavel</b>
                                <select class="ls-custom-select" name="personalizavel">
                                    <option value="">Todos</option>
                                    <option value="true">Sim</option>
                                    <option value="false">Não</option>
                                </select>
                            </label>
                        </div>
                    </div>
                </fieldset>
                <button class="ls-btn-primary ls-ico-search">Filtrar</button>
            </form>
        </div>
    </div>


    <div class="row">
        @foreach($artes as $arte)
        <!-- FOREACH -->
        <div class="col-md-3">
            <div class="box-card">
                <img style="max-width:100%;" src="/storage/thumbnail/{{$arte->img}}" />
                <div style="display: flex;justify-content: space-between;">
                    <h4 class="text-box">{{$arte->nome}} </h4>
                    <div data-ls-module="dropdown" class="ls-dropdown">
                        <button class="ls-btn"></button>
                        <ul class="ls-dropdown-nav">
                            <li><a href="/artes/download?file={{$arte->img}}" class=" ls-ico-download">Baixar</a></li>
                            @if( \Auth::user()->permissoes == 1 )
                            <li><a onclick="return confirm('Tem certeza?')" href="/artes/destroy/{{$arte->id}}"
                                    class="ls-ico-remove ls-color-danger">Excluir</a></li>
                            @endif
                            @if( $arte->personalizavel == 1 )
                            <li><a href="/artes/pecas?img={{$arte->img}}" class="ls-ico-pencil">Personalizar</a></li>
                            @endif
                            @if( \Auth::user()->permissoes == 1 )
                            <li><a href="/artes/edit/{{$arte->id}}" class="ls-ico-pencil">Editar</a></li>
                            @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOREACH -->
        @endforeach

        <nav class="text-center">
            {{ $artes->appends(Request::except('page'))->links() }}
        </nav>
    </div>

</div>


<style>
.text-box {
    padding-top: 10px;
    padding-bottom: 10px;
}

.box-card {
    margin-top: 20px;
    border-radius: 10px;
    padding: 10px;
    -webkit-box-shadow: 0px 3px 5px 2px rgba(0, 0, 0, 0.26);
    -moz-box-shadow: 0px 3px 5px 2px rgba(0, 0, 0, 0.26);
    box-shadow: 0px 3px 5px 2px rgba(0, 0, 0, 0.26);
}

.box-card img {
    min-width: 100%;
    height: 200px;
    object-fit: cover;
}

</sty le>< !-- CONTEÚDO -->@stop
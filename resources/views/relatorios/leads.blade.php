@extends('layouts.default')

@section('content')

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Relatório de Leads</h1>

    @if( session('info') )
    <div class="ls-alert-info ls-dismissable">
        <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
        {{ session('info') }}
    </div>
    @endif

    <div data-ls-module="collapse" data-target="#0" style="margin-top: 20px; background-color: #EEE; -webkit-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
-moz-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.15);" class="ls-collapse ">
        <a class="ls-collapse-header">
            <h3 class="ls-collapse-title">Filtros</h3>
        </a>
        <div class="ls-collapse-body">
            <form action="/relatorios/leads/filter" class="ls-form ">
                <fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="ls-label ">
                                <b class="ls-label-text">Nome</b>
                                <input type="text" name="nome" placeholder="Nome do lead">
                            </label>
                        </div>

                        <div class="col-md-4">
                            <label class="ls-label ">
                                <b class="ls-label-text">De:</b>
                                <input type="date" name="dateStart">
                            </label>
                        </div>

                        <div class="col-md-4">
                            <label class="ls-label ">
                                <b class="ls-label-text">Até:</b>
                                <input type="date" name="dateEnd">
                            </label>
                        </div>

                        <div class="col-md-4">
                            <label class="ls-label">
                                <b class="ls-label-text">E-mail</b>
                                <input type="text" name="email" placeholder="Escreva o Email">
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="ls-label">
                                <b class="ls-label-text">Telefone</b>
                                <input type="text" name="telefone" class="ls-mask-phone9_with_ddd"
                                    placeholder="Número de Telefone">
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="ls-label">
                                <b class="ls-label-text">Situação</b>
                                <div class="ls-custom-select">
                                    <select name="situacao" class="ls-select">
                                        <option value="">
                                            (Selecione)
                                        </option>
                                        <option @if( Request::input('situacao')=='Matriculado' ) selected="selected"
                                            @endif>
                                            Matriculado
                                        </option>
                                        <option @if( Request::input('situacao')=='Não Matriculado' ) selected="selected"
                                            @endif>
                                            Não Matriculado
                                        </option>
                                        <option @if( Request::input('situacao')=='Defeituoso' ) selected="selected"
                                            @endif>
                                            Lead Defeituoso
                                        </option>
                                        <option @if( Request::input('situacao')=='Novos' ) selected="selected" @endif>
                                            Novos
                                        </option>
                                    </select>
                                </div>
                            </label>
                        </div>

                        <div class="col-md-4">
                            <label class="ls-label">
                                <b class="ls-label-text">Canal</b>
                                <div class="ls-custom-select">
                                    <select name="canal_id" class="ls-select">
                                        <option value="">(Selecione)</option>
                                        <?php $canais = \App\Canal::get(); ?>
                                        @foreach($canais as $canal)
                                        <option value="{{ $canal->id }}">{{ $canal->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>

                        <div class="col-md-4">
                            <label class="ls-label">
                                <b class="ls-label-text">Usuário</b>
                                <div class="ls-custom-select">
                                    <select name="user" class="ls-select">
                                        <option value="">
                                            Usuário
                                        </option>

                                        <?php $users = \App\User::where('permissoes', 2)->orderBy('name', 'asc')->get(); ?>

                                        @foreach($users as $user)
                                        <option value="{{$user->id}}" @if( Request::input('user')==$user->id )
                                            selected="selected" @endif >
                                            {{$user->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="ls-label ">
                                <b class="ls-label-text">Leads sem operador</b>
                                <input autocomplete="off" list="listColaborador" type="text" name="semOperador">
                                <datalist id="listColaborador">
                                    <option>Sim</option>
                                    <option>Não</option>
                                </datalist>
                            </label>
                        </div>
                    </div>
                </fieldset>
                <button class="ls-btn-primary ls-ico-search">Filtrar</button>
                <?php $url =  \Request::fullUrl(); ?>
                @if( strstr($url, 'filter') == true )
                <a href="<?php echo str_replace('filter', 'report',$url); ?>" class="ls-btn">
                    Exportar
                </a>
                @endif
            </form>
        </div>
    </div>

    <div class="ls-alert-info ls-dismissable">

        <span>
            {{ $leads->total() }} Leads Encontrados
        </span>

    </div>

    <table class="ls-table  ls-bg-header ">
        <thead>
            <tr>
                <th class="ls-txt-center">Nome</th>
                <th class="ls-txt-center">email</th>
                <th class="ls-txt-center">Canal</th>
                <th class="ls-txt-center">Responsável</th>
                <th class="ls-txt-center">Data de cadastro</th>
                <th class="ls-txt-center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $leads as $lead )
            <tr>
                <td class="ls-txt-center">
                    <a href="/leads/show/{{ $lead->id}}">
                        {{ $lead->nome}}
                        @if( $lead->matriculado == true )
                        </br><span class="ls-tag-success ls-ico-checkmark">matriculado</span>
                        @endif
                    </a>
                </td>
                <td class="ls-txt-center">{{$lead->email}}</td>
                <td class="ls-txt-center">
                    @if($lead->canal_id !== null)
                    {{$lead->canal->nome}}
                    @endif
                </td>
                <td class="ls-txt-center">
                    @if( !empty($lead->colaborador->name) )
                    {{$lead->colaborador->name}}</td>
                @endif
                <td class="ls-txt-center">{{ $lead->created_at }}</td>
                <td class="ls-txt-center ls-regroup">
                    <div data-ls-module="dropdown" class="ls-dropdown">
                        <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
                        <ul class="ls-dropdown-nav" aria-hidden="true">
                            <li><a href="#">Sem ações</a></li>
                        </ul>
                    </div>
                </td>

            </tr>


            @endforeach

        </tbody>
    </table>

    {{  $leads->appends(Request::except('page'))->links() }}

</div>




@stop
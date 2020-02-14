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

    <div class="ls-box-filter">

        <form action="/relatorios/leads/filter" class="ls-form ls-form-inline  ">
            <label class="ls-label col-md-3">
                <b class="ls-label-text">De:</b>
                <input autocomplete="off" type="text" name="dateStart" class="datepicker" placeholder="dd/mm/aaaa">
            </label>

            <label class="ls-label col-md-3">
                <b class="ls-label-text">Até:</b>
                <input autocomplete="off" type="text" name="dateEnd" class="datepicker" placeholder="dd/mm/aaaa">
            </label>

            <label class="ls-label" role="search">
                <div class="ls-custom-select">
                    <select name="canal" class="ls-select">
                        <option value="">Canal</option>
                        <?php $canais = \App\Canal::get(); ?>
                        @foreach($canais as $canal)
                        <option value="{{$canal->id}}">{{$canal->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </label>

            <label class="ls-label" role="search">
                <div class="ls-custom-select">
                    <select name="situacao" class="ls-select">
                        <option value="">Situação</option>
                        <option>Matriculado</option>
                        <option>Não Matriculado</option>
                        <option>Lead Defeituoso</option>
                        <option>Novos</option>
                    </select>
                </div>
            </label>

            <label class="ls-label" role="search" style="margin-top:10px;">
                <div class="ls-custom-select">
                    <select name="user" class="ls-select">
                        <option value="">Usuário</option>
                        <?php $users = \App\User::where('permissoes', 2)->get(); ?>
                        @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </label>

            <div class="ls-actions-btn" style="margin-top:10px;">
                <button type="submit" class="ls-btn ls-btn-primary">Buscar</button>
                <?php $url =  \Request::fullUrl(); ?>

                @if( strstr($url, 'filter') == true )
                <a href="<?php echo str_replace('filter', 'report',$url); ?>" class="ls-btn">
                    Exportar
                </a>
                @endif
            </div>
        </form>
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
                <td class="ls-txt-center">{{$lead->canal->nome}}</td>
                <td class="ls-txt-center">
                    @if( !empty($lead->colaborador->name) )
                    {{$lead->colaborador->name}}</td>
                @endif
                <td class="ls-txt-center">{{ $lead->created_at }}</td>
                <td class="ls-txt-center ls-regroup">
                    <div data-ls-module="dropdown" class="ls-dropdown">
                        <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
                        <ul class="ls-dropdown-nav" aria-hidden="true">
                            <li><a onclick="return confirm('Tem certeza que quer apagar ?')"
                                    href="/leads/delete/{{$lead->id}}" class="ls-color-danger" role="option">Excluir</a>
                            </li>

                        </ul>
                    </div>
                </td>

            </tr>

            @endforeach

        </tbody>
    </table>

    {{ $leads->links() }}

</div>




@stop
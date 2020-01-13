@extends('layouts.default')

@section('content')

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Matrículas</h1>

    @if( session('info') )
    <div class="ls-alert-info ls-dismissable">
        <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
        {{ session('info') }}
    </div>
    @endif

    <div class="ls-box-filter">

        <form action="/matriculas" class="ls-form ls-form-inline  ">
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
                    <select name="produto" class="ls-select">
                        <option value="">Produtos</option>
                        <option>Pós-Graduação</option>
                        <option>Segunda Licenciatura</option>
                        <option>R2</option>
                        <option>Capacitação</option>
                    </select>
                </div>
            </label>

            @if( \Auth::user()->permissoes == 1 )
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
            @endif

            <div class="ls-actions-btn" style="margin-top:10px;">
                <button type="submit" class="ls-btn ls-btn-primary">Buscar</button>
                <?php $url =  \Request::fullUrl(); ?>

                @if( strstr($url, 'dateStart') == true )
                <a href="<?php echo str_replace('matriculas', 'matriculas/report',$url); ?>" class="ls-btn">
                    Exportar
                </a>
                @endif
            </div>
        </form>
    </div>





    <table class="ls-table  ls-bg-header ">
        <thead>
            <tr>
                <th class="ls-txt-center">Nome</th>
                <th class="ls-txt-center">Canal</th>
                <th class="ls-txt-center">Valor</th>
                <th class="ls-txt-center">Data</th>
                <th class="ls-txt-center">Vencimento</th>
                <th class="ls-txt-center">Produto</th>
                <th class="ls-txt-center">Ações</th>


            </tr>
        </thead>
        <tbody>
            @foreach( $matriculas as $matricula )
            <tr>
                <td class="ls-txt-center">
                    {{ $matricula->nome}}
                    @if( $matricula->pago == true )
                    </br><span class="ls-tag-success ls-ico-checkmark">Pago</span>
                    @endif
                </td>
                <td class="ls-txt-center">{{$matricula->canal}}</td>
                <td class="ls-txt-center">{{$matricula->valor}}</td>
                <td class="ls-txt-center">{{$matricula->created_at}}</td>

                <td class="ls-txt-center">{{$matricula->vencimento}}</td>

                <td class="ls-txt-center">{{ $matricula->produto }}</td>

                <td class="ls-txt-center ls-regroup">
                    <div data-ls-module="dropdown" class="ls-dropdown">
                        <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
                        <ul class="ls-dropdown-nav" aria-hidden="true">
                            @if( $matricula->pago == false )
                            <li><a href="/matriculas/pagamento-in/{{ $matricula->id }}" style="cursor:pointer;"
                                    data-ls-module="modal" data-target="#modalSmall" role="option">Informar
                                    Pagamento</a></li>
                            @else
                            <li><a href="/matriculas/pagamento-out/{{ $matricula->id }}" style="cursor:pointer;"
                                    data-ls-module="modal" data-target="#modalSmall" role="option">Cancelar
                                    Pagamento</a></li>
                            @endif
                            <li><a onclick="return confirm('Tem certeza que quer apagar ?')"
                                    href="/matriculas/delete/{{$matricula->id}}" class="ls-color-danger"
                                    role="option">Excluir</a></li>

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
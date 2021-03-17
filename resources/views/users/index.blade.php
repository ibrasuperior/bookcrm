@extends('layouts.default')

@section('content')

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Usuários</h1>

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


    <a href="/users/novo" class="ls-btn-primary">Cadastrar novo</a>

    <div class="ls-box-filter">

        <form action="/users" class="ls-form ls-form-inline  ">
            <label class="ls-label" role="search">
                <div class="ls-custom-select">
                    <select name="leads" class="ls-select">
                        <option value="">
                            Status do Usuário
                        </option>
                        <option value="1" @if( Request::input('leads')==1 ) selected="selected" @endif>
                            ATIVO / Recebe Leads
                        </option>
                        <option value="2" @if( Request::input('leads')==2 ) selected="selected" @endif>
                            ATIVO / Não recebe Leads
                        </option>
                        <option value="3" @if( Request::input('leads')==3 ) selected="selected" @endif>
                            INATIVO
                        </option>
                    </select>
                </div>
            </label>


            <label class="ls-label" role="search">
                <div class="ls-custom-select">
                    <select name="permissoes" class="ls-select">
                        <option value="">
                            Permissões
                        </option>
                        <option value="1" @if( Request::input('permissoes')==1 ) selected="selected" @endif>
                            Administrador
                        </option>
                        <option value="2" @if( Request::input('permissoes')==2 ) selected="selected" @endif>
                            Operador
                        </option>
                    </select>
                </div>
            </label>

            <label class="ls-label" role="search">
                <div class="ls-custom-select">
                    <select name="equipe" class="ls-select">
                        <option value="">Equipe</option>
                        <?php $equipes = \App\Equipe::get(); ?>
                        @foreach($equipes as $equipe)
                        <option value="{{$equipe->id}}" @if( Request::input('equipe')==$equipe->id )
                            selected="selected"
                            @endif>
                            {{$equipe->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </label>

            <label class="ls-label" role="search">
                <input type="text" name="name" class="ls-input" placeholder="Nome" />
            </label>
            <button type="submit" class="ls-btn ls-btn-primary">Filtrar</button>

        </form>
    </div>

    <span>
        {{ $users->total() }} Usuários Encontrados
    </span>


    <table class="ls-table  ls-bg-header ">
        <thead>
            <tr>
                <th class="ls-txt-center">id</th>
                <th class="ls-txt-center">Nome</th>
                <th class="ls-txt-center">Equipe</th>
                <th class="ls-txt-center">Permissões</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
            @foreach( $users as $user )
            <tr>
                <td class="ls-txt-center">
                    {{ $user->id}}
                </td>

                <td class="ls-txt-center">
                    <a href="/users/{{$user->id}}">{{ $user->name}}</a>
                </td>
                <td class="ls-txt-center">
                    <a href="/users/{{$user->id}}">
                        @if($user->equipe_id !== 0)
                        {{ $user->equipe->nome}}
                        @endif
                    </a>
                </td>
                <td class="ls-txt-center">
                    @if($user->permissoes === 1)
                    Administrador

                    @else
                    Operador
                    @endif
                </td>
                <td class="ls-txt-center ls-regroup">
                    <div data-ls-module="dropdown" class="ls-dropdown">
                        <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
                        <ul class="ls-dropdown-nav" aria-hidden="true">
                            <li><a href="/users/{{ $user->id }}" role="option">Editar</a></li>
                            <li><a href="/users/delete/{{$user->id}}"
                                    onclick="return confirm('tem certeza que quer excluir?')" class="ls-color-danger"
                                    role="option">Excluir</a></li>
                        </ul>
                    </div>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

    {{  $users->appends(Request::except('page'))->links() }}

</div>

@stop
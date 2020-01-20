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



    <a href="/users/novo" class="ls-btn-primary">Cadastrar novo</a>


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
                        @if($user->equipe_id !== null)
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


</div>

@stop
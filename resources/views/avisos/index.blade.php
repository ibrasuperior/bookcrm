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
    <table class="ls-table ls-bg-header ">
        <thead>
            <tr>
                <th class="ls-txt-center">id</th>
                <th class="ls-txt-center">Titulo</th>
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

@stop
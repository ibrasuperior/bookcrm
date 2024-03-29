@extends('layouts.default')

@section('content')

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Editar Equipe</h1>

    <form action="/equipe/update/{{$equipe->id}}" class="ls-form" method="post">
        @method('PUT')

        @csrf

        <legend class="ls-title-2">Alterar Equipe</legend>
        <div class="row">
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Nome</span>
                <input type="text" name="nome" autocomplete="off" value="{{ $equipe->nome  }}">
            </label>

            <label class="ls-label col-md-6">
                <span class="ls-label-text">Meta</span>
                <input type="number" name="meta" autocomplete="off" value="{{ $equipe->meta  }}">
            </label>

            <label class="ls-label col-md-6">
                <span class="ls-label-text">Supervisor</span>
                <input autocomplete="off" type="text" value="{{$equipe->supervisor}}" required name="supervisor">
            </label>



            <label class="ls-label col-md-6">
                <span class="ls-label-text">Gerente</span>
                <input autocomplete="off" type="text" value="{{$equipe->gerente}}" required name="gerente">
            </label>
        </div>

        <hr>

        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/equipes" class="ls-btn">Voltar</a>
    </form>


</div>


@stop
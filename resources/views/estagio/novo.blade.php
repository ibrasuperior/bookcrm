@extends('layouts.default')

@section('content')

    <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-users">Cadastrar Canal</h1>

    <form action="/estagio/add" class="ls-form" method="post" >
        @csrf

        <legend class="ls-title-2">Novo Estagio</legend>
        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Nome</span>
            <input autocomplete="off" type="text" name="nome">
            </label>
        </div>
    
        <hr>
        
        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/estagio" class="ls-btn">Voltar</a>
    </form>

    </div>


@stop
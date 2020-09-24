@extends('layouts.default')

@section('content')

<script src="//cdn.ckeditor.com/4.15.0/basic/ckeditor.js"></script>

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Cadastrar Avisos</h1>

    <form action="/avisos/add" class="ls-form" method="post">
        @csrf

        <legend class="ls-title-2">Novo Aviso</legend>
        <div class="row">
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Autor</span>
                <input name="autor" autocomplete="off" type="text" value="{{ \Auth::user()->name}}" >
            </label>
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Titulo</span>
                <input name="titulo" autocomplete="off" type="text" >
            </label>
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Descrição</span>
                <textarea name="editor1"></textarea>
            </label>
        </div>

        <hr>

        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/avisos" class="ls-btn">Voltar</a>
    </form>

</div>

<script>
    CKEDITOR.replace( 'editor1' );
</script>

@stop
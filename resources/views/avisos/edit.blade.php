@extends('layouts.default')

@section('content')

<script src="//cdn.ckeditor.com/4.15.0/basic/ckeditor.js"></script>

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Editar Equipe</h1>

    <form action="/avisos/update/{{$aviso->id}}" class="ls-form" method="post">
        @method('PUT')

        @csrf

        <legend class="ls-title-2">Alterar Equipe</legend>
        <div class="row">
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Autor</span>
                <input name="autor" autocomplete="off" type="text" value="{{ \Auth::user()->name}}" >
            </label>
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Titulo</span>
                <input type="text" name="titulo" autocomplete="off" value="{{ $aviso->titulo  }}">
            </label>

            <label class="ls-label col-md-6">
                <span class="ls-label-text">Descrição</span>
                <textarea name="editor1" autocomplete="off">{{ $aviso->descricao }}</textarea>
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
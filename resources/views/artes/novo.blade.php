@extends('layouts.default')

@section('content')



<h1 class="ls-title-intro ls-ico-users">Cadastrar Arte</h1>



<form action="/artes/store" class="ls-form" enctype="multipart/form-data" method="post">

    @csrf

    <legend class="ls-title-2">Nova Arte</legend>
    <div class="row">
        <label class="ls-label col-md-6">
            <span class="ls-label-text">Nome</span>
            <input autocomplete="off" type="text" name="nome" required>
        </label>
    </div>
    <div class="row">
        <label class="ls-label col-md-6">
            <b class="ls-label-text">Editavel</b>
            <div class="ls-custom-select ls-field-sm">
                <select name="personalizavel" class="ls-select">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
        </label>
    </div>
    <div class="row"><br><br>
        <label class="ls-label col-md-6">
            <span class="ls-label-text">Imagem</span><br>
            <input class='ls-btn-primary' style="padding:30px;" autocomplete="off" type="file" name="img" required>
        </label>
    </div>
    <button type="submit" class="ls-btn-primary"> Cadastrar</button>
    <a href="/artes" class="ls-btn">Voltar</a>
</form>



@stop

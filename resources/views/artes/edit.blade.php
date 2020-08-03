@extends('layouts.default')

@section('content')



<h1 class="ls-title-intro ls-ico-users">Editar Arte</h1>



<form action="/artes/update/{{$artes->id}}" class="ls-form" enctype="multipart/form-data" method="post">

    @csrf

    <legend class="ls-title-2">Editar Arte</legend>
    <div class="row">
        <label class="ls-label col-md-6">
            <span class="ls-label-text">Nome</span>
            <input autocomplete="off" type="text" name="nome" value="{{ $artes->nome  }}" required>
        </label>
    </div>
    <div class="row">
        <label class="ls-label col-md-6">
            <b class="ls-label-text">Editavel</b>
            <div class="ls-custom-select ls-field-sm">
                <select name="personalizavel" class="ls-select">
                    <option value="1" @if($artes->personalizavel == 1) selected="selected" @endif > Sim </option>
                    <option value="0" @if($artes->personalizavel == 0) selected="selected" @endif> Não </option>
                </select>
            </div>
        </label>
    </div>

    <button type="submit" class="ls-btn-primary">Alterar</button>
    <a href="/artes" class="ls-btn">Voltar</a>
</form>




@stop

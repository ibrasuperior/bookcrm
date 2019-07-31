@extends('layouts.default')

@section('content')

    <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-users">Editar Canal</h1>

    <form action="/canal/update/{{$canal->id}}" class="ls-form" method="post" >
        @method('PUT')

        @csrf

        <legend class="ls-title-2">Alterar Canal</legend>
        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Nome</span>
            <input type="text" name="nome" autocomplete="off" value="{{ $canal->nome  }}" >
            </label>
        </div>
  
        <hr>
        
        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/canal" class="ls-btn">Voltar</a>
    </form>


    </div>


@stop
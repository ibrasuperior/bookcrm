@extends('layouts.default')

@section('content')

    <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-users">Editar Estagio</h1>

    <form action="/estagio/update/{{$estagio->id}}" class="ls-form" method="post" >
        @method('PUT')

        @csrf

        <legend class="ls-title-2">Alterar Estagio</legend>
        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Nome</span>
            <input type="text" name="nome" autocomplete="off" value="{{ $estagio->nome  }}" >
            </label>
        </div>
  
        <hr>
        
        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/estagio" class="ls-btn">Voltar</a>
    </form>


    </div>


@stop
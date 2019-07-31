@extends('layouts.default')

@section('content')

    <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-users">Cadastrar Lead</h1>

    <form action="/leads/add" class="ls-form" method="post" >
        @csrf

        <legend class="ls-title-2">Identificação</legend>
        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Nome</span>
            <input autocomplete="off" type="text" name="nome" required>
            </label>
        </div>
        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Email</span>
            <input autocomplete="off" type="text" name="email" required>
            </label>
        </div>

        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Telefone</span>
            <input autocomplete="off" type="text" name="telefone" required>
            </label>
        </div>

        <div class="row">
        <label class="ls-label col-md-6 col-sm-6">
            <b class="ls-label-text">Canal</b>
            <div class="ls-custom-select">
                <select name="canal_id" class="ls-select">
                @foreach($canais as $canal)
                <option value="{{$canal->id}}"> {{$canal->nome}}</option>
                @endforeach
                </select>
            </div>
        </label>
        </div>
        
        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Observação</span>
            <textarea rows="4" name="obs" required ></textarea>
            <p class="ls-helper-text">Preencha informações adicionais do seu cliente. Ex.: Dados de contato, endereço, etc.</p>
            </label>
        </div>

        <hr>
        
        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/leads" class="ls-btn">Voltar</a>
    </form>

    </div>


@stop
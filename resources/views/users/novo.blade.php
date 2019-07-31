@extends('layouts.default')

@section('content')

    <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-users">Cadastrar Usuário</h1>

    <form method="POST" action="/users/add" class="ls-form">
        @csrf

        <legend class="ls-title-2">Novo Usuário</legend>
        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Nome</span>
            <input autocomplete="off" type="text" required name="name">
            </label>
        </div>

        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">E-mail</span>
            <input autocomplete="off" type="email" required name="email">
            </label>
        </div>

        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Senha</span>
            <input autocomplete="off" type="password" required name="password">
            </label>
        </div>

        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Permissões</span>
            <div class="ls-custom-select">
                <select name="permissoes" class="ls-select">
                    <option value="1" >Administrador</option>
                    <option value="2" >Colaborador</option>
                </select>
            </div>
            
            </label>
        </div>
    
        <hr>
        
        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/users" class="ls-btn">Voltar</a>
    </form>

    </div>


@stop
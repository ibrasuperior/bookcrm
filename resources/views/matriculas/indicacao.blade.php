@extends('layouts.default')

@section('content')

    <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-users">Solicitar Indicação</h1>

    @if( session('info') )
    <div class="ls-alert-info ls-dismissable">
        <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
        {{ session('info') }}
    </div>
    @endif


    <form action="/leads/add" class="ls-form" method="post" data-ls-module="form" >
        @csrf
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
            <input  autocomplete="off" type="text" name="telefone" required class="ls-mask-phone9_with_ddd" placeholder="(99) 9999-9999" >
            </label>
        </div>


        <div class="row">
        <label class="ls-label col-md-6 col-sm-6">
            <b class="ls-label-text">Canal</b>
            <div class="ls-custom-select">
                <select name="canal_id" class="ls-select">
                    <option value="7">Indicação</option>
                </select>
            </div>
        </label>
        </div>

        <div class="row">
            <label class="ls-label col-md-6">
            <span class="ls-label-text">Observação</span>
            <textarea rows="4" name="obs" ></textarea>
            <p class="ls-helper-text">Preencha informações adicionais do seu cliente. Ex.: Dados de contato, endereço, etc.</p>
            </label>
        </div>

        <hr>

        <button type="submit" class="ls-btn-primary">Cadastrar Indicação</button>

    </form>

    </div>


@stop

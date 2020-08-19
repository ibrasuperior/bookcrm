@extends('layouts.default')

@section('content')

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Editar Lead</h1>

    <form action="/leads/update/{{$lead->id}}" class="ls-form" method="post">
        @method('PUT')

        @csrf
        <input type="hidden" value="{{$lead->idate}}">
        <legend class="ls-title-2">Identificação</legend>
        <div class="row">
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Nome</span>
                <input type="text" name="nome" value="{{ $lead->nome  }}">
            </label>
        </div>
        <div class="row">
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Email</span>
                <input type="text" name="email" value="{{ $lead->email  }}">
            </label>
        </div>

        <div class="row">
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Telefone</span>
                <input type="text" name="telefone" value="{{ $lead->telefone  }}">
            </label>
        </div>

        <div class="row">
            <label class="ls-label col-md-6 col-lg-">
                <b class="ls-label-text">Estado</b>
                <div class="ls-custom-select">
                    <select name="estado" class="ls-select">
                        <option value="{{$lead->estado}}"> {{$lead->estado}}</option>
                    </select>
                </div>
            </label>
        </div>


        <div class="row">
            <label class="ls-label col-md-6 col-lg-">
                <b class="ls-label-text">Canal</b>
                <div class="ls-custom-select">
                    <select name="canal_id" class="ls-select">
                        @if($lead->canal_id !== null)
                        <option value="{{$lead->canal->id}}"> {{$lead->canal->nome}}</option>
                        @endif
                    </select>
                </div>
            </label>
        </div>


        <div class="row">
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Observação</span>
                <textarea rows="4" name="obs"> {{ $lead->obs  }}</textarea>
                <p class="ls-helper-text">Preencha informações adicionais do seu cliente. Ex.: Dados de contato,
                    endereço, etc.</p>
            </label>
        </div>

        <hr>

        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/leads" class="ls-btn">Voltar</a>
    </form>


</div>



@stop
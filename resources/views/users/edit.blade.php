@extends('layouts.default')

@section('content')

    <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-users">Editar Usuário</h1>

    <form action="/users/update/{{$user->id}}" class="ls-form" method="post" >
        @method('PUT')

        @csrf

        <legend class="ls-title-2">Alterar Usuário</legend>
        <div class="row">
        
            <label class="ls-label col-md-6">
                <b class="ls-label-text">Recebe Leads ?</b>
                <div class="ls-custom-select">
                    <select name="active" class="ls-select">
                        <option value="1" <?php if( $user->active == true ){ echo 'selected'; } ?> > Sim </option>
                        <option value="0" <?php if( $user->active == false ){ echo 'selected'; } ?> > Não </option>
                    </select>
                </div>
            </label>

            <label class="ls-label col-md-6">
            <span class="ls-label-text">Nome</span>
            <input type="text" name="name" autocomplete="off" value="{{ $user->name  }}" >
            </label>

            <label class="ls-label col-md-6">
            <span class="ls-label-text">E-mail</span>
            <input type="text" name="email" autocomplete="off" value="{{ $user->email  }}" >
            </label>

            <label class="ls-label col-md-6">
            <span class="ls-label-text">Senha</span>
            <input type="text" name="password" autocomplete="off" >
            </label>

        </div>
  
        <hr>
        
        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/users" class="ls-btn">Voltar</a>
    </form>


    </div>


@stop
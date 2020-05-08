@extends('layouts.default')

@section('content')

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Editar Usuário</h1>

    <form action="/users/update/{{$user->id}}" class="ls-form" method="post">
        @method('PUT')

        @csrf

        <legend class="ls-title-2">Alterar Usuário</legend>
        <div class="row">

            <label class="ls-label col-md-6">
                <b class="ls-label-text">Usuário Ativo</b>
                <div class="ls-custom-select">
                    <select name="active" class="ls-select">
                        <option value="1"
                            <?php if( $user->active == true &&  $user->leads_active == false ){ echo 'selected'; } ?>>
                            ATIVO / Não recebe Leads
                        </option>
                        <option value="2"
                            <?php if( $user->active == true &&  $user->leads_active == true ){ echo 'selected'; } ?>>
                            ATIVO / Recebe Leads
                        </option>
                        <option value="3"
                            <?php if( $user->active == false &&  $user->leads_active == false ){ echo 'selected'; } ?>>
                            INATIVO
                        </option>
                    </select>
                </div>
            </label>

            <label class="ls-label col-md-6">
                <b class="ls-label-text">Permissões</b>
                <div class="ls-custom-select">
                    <select name="permissoes" class="ls-select">
                        <option value="1" <?php if( $user->permissoes == 1 ){ echo 'selected'; } ?>> Administrador
                        </option>
                        <option value="2" <?php if( $user->permissoes == 2 ){ echo 'selected'; } ?>> Operador </option>
                    </select>
                </div>
            </label>

            <label class="ls-label col-md-6">
                <b class="ls-label-text">Equipe</b>
                <div class="ls-custom-select">
                    <select name="equipe" class="ls-select">
                        <?php $equipes = \App\Equipe::get(); ?>
                        <option value="">Sem Equipe</option>

                        @foreach($equipes as $equipe)
                        <option value="{{$equipe->id}}"
                            <?php if( $user->equipe_id == $equipe->id ){ echo 'selected'; } ?>>
                            {{ $equipe->nome}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </label>

            <label class="ls-label col-md-6">
                <span class="ls-label-text">Nome</span>
                <input type="text" name="name" autocomplete="off" value="{{ $user->name  }}">
            </label>

            <label class="ls-label col-md-6">
                <span class="ls-label-text">E-mail</span>
                <input type="text" name="email" autocomplete="off" value="{{ $user->email  }}">
            </label>

            <label class="ls-label col-md-6">
                <span class="ls-label-text">Senha</span>
                <input type="text" name="password" autocomplete="off">
            </label>

        </div>

        <hr>

        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/users" class="ls-btn">Voltar</a>
    </form>


</div>


@stop
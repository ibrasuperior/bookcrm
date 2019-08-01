<html class="ls-theme-gray  ls-browser-chrome ls-window-sm ls-screen-lg"><head>
<meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="Insira aqui a descrição da página.">
    <link href="http://assets.locaweb.com.br/locastyle/3.10.1/stylesheets/locastyle.css" rel="stylesheet" type="text/css">
    <link rel="icon" sizes="192x192" href="/locawebstyle/assets/images/ico-boilerplate.png">
    <link rel="apple-touch-icon" href="/locawebstyle/assets/images/ico-boilerplate.png">
</head>
<body class="documentacao documentacao_exemplos documentacao_exemplos_login-screen documentacao_exemplos_login-screen_index">

@if ($errors->has('email'))

<div class="ls-alert-danger ls-alert-fixed-top ls-dismissable" role="alert"><span data-ls-module="dismiss" class="ls-dismiss">×</span>
    {{ $errors->first('email') }}
</div>

@endif

@if ($errors->has('password'))
<div class="ls-alert-danger ls-alert-fixed-top ls-dismissable" role="alert"><span data-ls-module="dismiss" class="ls-dismiss">×</span>
    {{ $errors->first('password') }}
</div>
@endif


<div class="ls-login-parent">
  <div class="ls-login-inner">
    <div class="ls-login-container">
      <div class="ls-login-box">
  <h1 class="ls-login-logo">
    <img src="img/login.png" />
  </h1>
    
    <!-- FORMULÁRIO DE LOGIN -->
    <form method="post" role="form" class="ls-form ls-login-form" action="{{ route('login')}}">
        <fieldset>
        @csrf
        <label class="ls-label">
            <b class="ls-label-text ls-hidden-accessible">Usuário</b>
            <input name="email" class="ls-login-bg-user ls-field-lg" type="text" placeholder="Usuário" required="" autofocus="">
        </label>

        <label class="ls-label">
            <b class="ls-label-text ls-hidden-accessible">Senha</b>
            <div class="ls-prefix-group ls-field-lg">
            <input name="password" id="password_field" class="ls-login-bg-password" type="password" placeholder="Senha" required="">
            <a class="ls-label-text-prefix ls-toggle-pass ls-ico-eye" data-toggle-class="ls-ico-eye, ls-ico-eye-blocked" data-target="#password_field" href="#"></a>
            </div>
        </label>

        <input type="submit" value="Entrar" class="ls-btn-primary ls-btn-block ls-btn-lg">
        <p class="ls-txt-center ls-login-signup"> Digite suas credenciais para acesso ao sistema . </p>

        </fieldset>
    </form>


</div>

<div class="ls-login-adv"><img title="Exemplo banner" src="img/cover.jpg" width="500"></div>

    </div>
  </div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="http://assets.locaweb.com.br/locastyle/3.10.1/javascripts/locastyle.js" type="text/javascript"></script>



</body></html>
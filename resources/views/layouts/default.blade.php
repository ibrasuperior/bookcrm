<!DOCTYPE html>
<html class="ls-theme-light-green">

<head>
  <title>BOOK STATION CRM</title>

  <meta charset="utf-8">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="description" content="Insira aqui a descrição da página.">

  <script src="https://js.pusher.com/6.0/pusher.min.js"></script>


  <link href="https://assets.locaweb.com.br/locastyle/3.10.1/stylesheets/locastyle.css" rel="stylesheet"
    type="text/css">
  <link rel="icon" sizes="192x192" href="/locawebstyle/assets/images/ico-boilerplate.png">
  <link rel="apple-touch-icon" href="/locawebstyle/assets/images/ico-boilerplate.png">

  <!-- JQUERY -->

  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Signika:300,400,600,700&display=swap" rel="stylesheet">

</head>

<body>
  <div class="ls-topbar ">

    <!-- Barra de Notificações -->
    <div class="ls-notification-topbar">

      <!-- Links de apoio -->
      <div class="ls-alerts-list">
        <a href="#" class="ls-ico-bell-o" data-counter="8" data-ls-module="topbarCurtain"
          data-target="#ls-notification-curtain"><span>Notificações</span></a>

      </div>

      <!-- Dropdown com detalhes da conta de usuário -->
      <div data-ls-module="dropdown" class="ls-dropdown ls-user-account">
        <a href="#" class="ls-ico-user">
          <span class="ls-name"><?php $nome= \Auth::user()->name; ?> {{$nome}}</span>

        </a>

        <nav class="ls-dropdown-nav ls-user-menu">
          <ul>
            <li><a href="/profile/<?php echo \Auth::user()->id; ?>">Meus dados</a></li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                Sair
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>

          </ul>
        </nav>
      </div>
    </div>

    <span class="ls-show-sidebar ls-ico-menu"></span>

    <a href="javascript:history.back()" class="ls-go-next"><span class="ls-text">Voltar à lista de serviços</span></a>

    <!-- Nome do produto/marca com sidebar -->
    <h1 class="ls-brand-name">
      <a href="/">
        <img src="/img/logo.png" alt="">
      </a>
    </h1>

    <!-- Nome do produto/marca sem sidebar quando for o pre-painel  -->
  </div>


  <aside class="ls-sidebar">

    <div class="ls-sidebar-inner">
      <a href="/" class="ls-go-prev"><span class="ls-text">Voltar à
          lista de serviços</span></a>

      <nav class="ls-menu">
        <ul>
          <li><a href="/" class="ls-ico-dashboard" title="Dashboard">Dashboard</a></li>
          <li><a href="/leads" class="ls-ico-users" title="Leads">Leads</a></li>
          <!-- <li><a href="https://loja.ibraeducacional.com.br/register-students?id={{\Auth::user()->id}}&name={{\Auth::user()->name}}"
              class="ls-ico-users" title="Leads">Registro Loja</a></li> -->
          <li><a href="/agenda" class="ls-ico-calendar-check" title="Agenda">Agenda</a></li>
          <li><a href="/matriculas" class="ls-ico-checkmark" title="Matrículas">Matrículas</a></li>
          <li><a href="/artes" class="ls-ico-images">Publicidade</a></li>

          <li>
            <a href="/documentos" class="ls-ico-book"> Documentos Oficiais </a>
          </li>

          <li><a href="http://ramais.ibraeducacional.com.br/" target="_blank" class="ls-ico-link">Ramais</a>
          <li><a
              href="https://docs.google.com/spreadsheets/d/1Oz-hqDmjEd0IOaaRzaEyznfSandw2B19DCIvg6NuEBE/edit?usp=sharing"
              target="_blank" class="ls-ico-link">Planilha Documentação</a>
          </li>

          @if( \Auth::user()->permissoes == 1 )
          <li class="ls-submenu-parent" aria-expanded="false" aria-hidden="true">
            <a href="#" class="ls-ico-stats" title="Configurações" role="menuitem">Relatórios</a>
            <ul class="ls-submenu" role="menu">
              <li><a href="/relatorios/leads">Leads</a></li>
              <li><a href="/relatorios/matriculas">Matrículas</a></li>
              <li><a href="/relatorios/analise">Análise de Canais</a></li>
            </ul>
          </li>
          @endif

          @if( \Auth::user()->permissoes == 1 )
          <li class="ls-submenu-parent" aria-expanded="false" aria-hidden="true">
            <a href="#" class="ls-ico-cog" title="Configurações" role="menuitem">Configurações</a>
            <ul class="ls-submenu" role="menu">
              @if( \Auth::user()->permissoes == 1 )<li><a href="/equipes">Equipes</a></li>@endif
              @if( \Auth::user()->permissoes == 1 )<li><a href="/canal">Canais</a></li>@endif
              @if( \Auth::user()->permissoes == 1 ) <li><a href="/users">Usuários</a></li>@endif
              @if( \Auth::user()->permissoes == 1 ) <li><a href="/estagio">Estágios</a></li>@endif
              @if( \Auth::user()->permissoes == 1 ) <li><a href="/avisos">Avisos</a></li>@endif
            </ul>
          </li>
          @endif

        </ul>
      </nav>


    </div>
  </aside>

  <main class="ls-main">
    @yield('content')
    <footer class="ls-footer" role="contentinfo">
      <nav class="ls-footer-menu">
        <h2 class="ls-title-footer">suporte e ajuda</h2>
        <ul class="ls-footer-list">
          <li>
            <a href="#" target="_blank" class="bg-customer-support">
              <span class="visible-lg">Atendimento</span>
            </a>
          </li>
          <li>
            <a href="#" target="_blank" class="bg-my-tickets">
              <span class="visible-lg">Meus Chamados</span>
            </a>
          </li>
          <li>
            <a href="#" target="_blank" class="bg-help-desk">
              <span class="visible-lg">Central de Ajuda (Wiki)</span>
            </a>
          </li>
          <li>
            <a href="#" target="_blank" class="bg-statusblog">
              <span class="visible-lg">Statusblog</span>
            </a>
          </li>
        </ul>
      </nav>
      <div class="ls-footer-info">
        <p class="ls-copy-right">Copyright © 2018-2019 Grupo IBRA.</p>
      </div>
    </footer>


  </main>

  <?php
$now = date('d/m/20y');
$agendas = \App\Agenda::where('colaborador_id', \Auth::user()->id )->get();
?>

  <aside class="ls-notification">
    <nav class="ls-notification-list" id="ls-notification-curtain" style="left: 1716px;">
      <h3 class="ls-title-2">Notificações</h3>
      <ul>
        @foreach($agendas as $agenda)
        @if( $agenda->data == $now )
        <li class="ls-dismissable">
          <a href="/agenda/show/{{ $agenda->id }}"> <span style="color:#fff;font-size:110%;font-weight:bold;">
              {{$agenda->nome}}
              <span class="ls-tag-danger">Hoje!</span> <br></a>
          <a href="#" data-ls-module="dismiss" class="ls-ico-close ls-close-notification"></a>
        </li>
        @endif
        @endforeach

      </ul>
    </nav>

    <nav class="ls-notification-list" id="ls-help-curtain" style="left: 1756px;">
      <h3 class="ls-title-2">Feedback</h3>
      <ul>
        <li><a href="#">&gt; quo fugiat facilis nulla perspiciatis consequatur</a></li>
        <li><a href="#">&gt; enim et labore repellat enim debitis</a></li>
      </ul>
    </nav>

    <nav class="ls-notification-list" id="ls-feedback-curtain" style="left: 1796px;">
      <h3 class="ls-title-2">Ajuda</h3>
      <ul>
        <li class="ls-txt-center hidden-xs">
          <a href="#" class="ls-btn-dark ls-btn-tour">Fazer um Tour</a>
        </li>
        <li><a href="#">&gt; Guia</a></li>
        <li><a href="#">&gt; Wiki</a></li>
      </ul>
    </nav>
  </aside>
  <style>
  body {
    font-family: 'Signika', sans-serif !important;
    font-weight: 600;
    color: #666;
  }
  </style>

  <!-- PUSHER NOTIFICATION -->
  <?php $current_user = \Auth::user()->id; ?>

  <script>
  // request permission on page load
  document.addEventListener('DOMContentLoaded', function() {
    if (!Notification) {
      alert('Desktop notifications not available in your browser. Try Chromium.');
      return;
    }

    if (Notification.permission !== 'granted')
      Notification.requestPermission();
  });

  var current_user = "<?php echo $current_user;  ?>"

  // Enable pusher logging - don't include this in production
  //Pusher.logToConsole = true;

  var pusher = new Pusher('f79d2982653448dfc962', {
    cluster: 'us2'
  });

  var channel = pusher.subscribe('lead-push');
  channel.bind('lead-push', function(data) {
    if (data.user == current_user) {
      new Notification('Book CRM', {
        body: 'Olá, você acaba de receber um novo lead!',
        icon: "http://ibraeducacional.com.br/images/book.png"
      });
    }
  });
  </script>

  <!-- PUSHER NOTIFICATION -->

  <footer>
    <!-- JQUERY -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- Coloque o JS no seu FOOTER, logo depois da jQuery -->
    <script src="/js/locastyle.js"></script>

  </footer>
</body>

</html>

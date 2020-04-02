@extends('layouts.default')

@section('content')


<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Análise de Canais</h1>

    @if( session('success') )
    <div class="ls-alert-success ls-dismissable">
        <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
        {{ session('success') }}
    </div>
    @endif

    <div id="analise">
        <div class="spinner-border" style="position:relative;left:50%;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

</div>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
    integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

<!-- Adicione nosso componente React. -->
<script src="/js/components/analytics.js" type="text/babel"></script>


<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<!-- Nota: ao fazer o deploy, substitua "development.js" por "production.min.js". -->
<script src="https://unpkg.com/react@16/umd/react.production.min.js" crossorigin></script>
<script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js" crossorigin></script>
<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>


@stop
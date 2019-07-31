@extends('layouts.default')

@section('content')

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-stats">Relatórios</h1>

    @if( session('success') ) 
    <div class="ls-alert-success ls-dismissable">
        <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
        {{ session('success') }}
    </div>
    @endif


<div class="ls-box-filter">

<!-- ... REACTJS ...  -->
<div id="report">

  <div class="spinner-border" style="position:relative;left:45%;top:40%;" role="status">
    <span class="sr-only">Loading...</span>
  </div>

 </div>

</div>


</div>


<!-- Adicionar o React. -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <!-- Nota: ao fazer o deploy, substitua "development.js" por "production.min.js". -->
  <script src="https://unpkg.com/react@16/umd/react.development.js" crossorigin></script>
  <script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js" crossorigin></script>
  <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>

  <!-- Adicione nosso componente React. -->
  <script src="components/report.js" type="text/babel"></script>
@stop
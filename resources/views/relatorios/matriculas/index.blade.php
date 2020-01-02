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


@stop

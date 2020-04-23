@extends('layouts.default')

@section('content')
<?php
 $connect = mysqli_connect('localhost','nzkbevgkvh',
 'tRFv9GWCvX', 'nzkbevgkvh');

  $artes = mysqli_query($connect, 'select * from artes ORDER BY id DESC' );
?>


<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-calendar-check">Publicidade</h1>

    @if( session('success') )
    <div class="ls-alert-success ls-dismissable">
        <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
        {{ session('success') }}
    </div>
    @endif

    <div class="ls-box-filter">
        <form action="" class="ls-form ls-form-inline">

            <label class="ls-label col-md-3 col-sm-3">
                <input type="text" placeholder="Nome da arte">
            </label>

            <label class="ls-label col-md-1 col-sm-1">
                <input type="submit" class="ls-btn-primary" value="Filtrar">
            </label>
        </form>


    </div>

    <div class="row">
        @foreach($artes as $arte)
        <!-- FOREACH -->
        <div class="col-md-3">
            <div class="box-card">
                <img src="https://admin.ibraeducacional.com.br/storage/documents/<?php echo $arte['img']; ?>"
                    style="max-width:100%;" alt="">
                <h4 class="text-box"> <?php echo $arte['nome']; ?> </h4>
                <div>
                    <a href="https://admin.ibraeducacional.com.br/files/download?file=<?php echo $arte['img']; ?>"
                        class="ls-btn ls-btn-lg ls-btn-block ls-ico-download">
                        Baixar
                    </a>
                </div>
            </div>
        </div>
        <!-- FOREACH -->
        @endforeach

    </div>

</div>


<style>
.text-box {
    padding-top: 10px;
    padding-bottom: 10px;
}

.box-card {
    margin-top: 20px;
    border-radius: 10px;
    padding: 10px;
    -webkit-box-shadow: 0px 3px 5px 2px rgba(0, 0, 0, 0.26);
    -moz-box-shadow: 0px 3px 5px 2px rgba(0, 0, 0, 0.26);
    box-shadow: 0px 3px 5px 2px rgba(0, 0, 0, 0.26);
}
</style>
<!-- CONTEÚDO -->



@stop
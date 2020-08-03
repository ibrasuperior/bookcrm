@extends('layouts.default')

@section('content')
<?php
 $connect = mysqli_connect('localhost','root',
 '', 'nzkbevgkvh');

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

    <div data-ls-module="collapse" data-target="#0" style="margin-top: 20px; background-color: #EEE; -webkit-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
    -moz-box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.45);
    box-shadow: 0px 1px 3px 1px rgba(0,0,0,0.15);" class="ls-collapse ">
        <a class="ls-collapse-header">
            <h3 class="ls-collapse-title">Filtros</h3>
        </a>
        <div class="ls-collapse-body">
            <form action="/arte" class="ls-form ">
                <fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="ls-label ">
                                <b class="ls-label-text">Nome</b>
                                <input type="text" name="nome" placeholder="Nome da Peça">
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="ls-label">
                                <b class="ls-label-text">Personalizavel</b>
                                <div class="ls-custom-select">
                                    <select name="personalizavel" class="ls-select">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                </div>
                            </label>
                        </div>
                    </div>
                </fieldset>
                <button class="ls-btn-primary ls-ico-search">Filtrar</button>
            </form>
        </div>
    </div>

    <div class="row">
        @foreach($artes as $arte)
        <!-- FOREACH -->
        <div class="col-md-3">
            <div class="box-card">
                <img src="https://admin.ibraeducacional.com.br/storage/documents/<?php echo $arte['img']; ?>"
                    style="max-width:100%;" alt="">
                <h4 class="text-box"> <?php echo $arte['nome']; ?> </h4>
                <div style="display: flex;flex-direction: row;align-items: center;justify-content: space-between;">
                    <a href="https://admin.ibraeducacional.com.br/files/download?file=<?php echo $arte['img']; ?>"
                        class="ls-btn ls-btn-block ls-ico-download">
                        Baixar
                    </a>
                    @if($arte['personalizavel'] == 1)
                    <a href="/pecas?img=<?php echo $arte['img']; ?>" class="ls-btn ls-ico-pencil"></a>
                    @endif
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

.box-card img {
    min-width: 100%;
    height: 200px;
    object-fit: cover;
}
</style>
<!-- CONTEÚDO -->




@stop
@extends('layouts.default')

@section('content')

<script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Cadastrar Avisos</h1>

    <form action="/avisos/add" class="ls-form" method="post" enctype="multipart/form-data">
        @csrf

        <legend class="ls-title-2">Novo Aviso</legend>
        <div class="row">
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Autor</span>
                <input name="autor" autocomplete="off" type="text" value="{{ \Auth::user()->name}}">
            </label>
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Titulo</span>
                <input name="titulo" autocomplete="off" type="text">
            </label>
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Tipo do Aviso</span>
                <div class="ls-custom-select">
                    <select id="selectType" onchange="typeSelect()" class="ls-select" name="typeNotice">
                        <option value="aviso">Aviso</option>
                        <option value="campanha">Campanha</option>
                    </select>
                </div>
            </label>
            <label id="dataValidity" style="display: none;" class="ls-label col-md-6">
                <span class="ls-label-text">Data de Vigência</span>
                <div style="display: flex; align-items: center;">
                    <div style="margin-right: 15px">
                        <span>De:</span>
                        <input id="dateStart" type="datetime-local" name="dateStart">
                    </div>
                    <div>
                        <span>Até:</span>
                        <input id="dateEnd" type="datetime-local" name="dateEnd">
                    </div>
                </div>
            </label>
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Descrição</span>
                <textarea name="editor1"></textarea>
            </label>
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Anexo</span>
                <button type="button" class="ls-btn-primary" onClick="chooseArchive()"
                    style="padding:25px 50px;">Escolha um
                    arquivo</button>
                <input id="archive" onchange="loadFile(event)" class="ls-btn-primary" style="display:none;"
                    autocomplete="off" type="file" name="anexo">
                <img id="output" style="max-width: 50%; margin-left: 0px; padding-left: 50px;">
            </label>
        </div>

        <hr>

        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/avisos" class="ls-btn">Voltar</a>
    </form>

</div>

<script>
addEventListener('load', typeSelect);

function typeSelect() {

    $selectType = document.getElementById('selectType');
    $dateStart = document.getElementById('dateStart');
    $dateEnd = document.getElementById('dateEnd');
    $dataValidity = document.getElementById('dataValidity');

    if ($selectType.value == "aviso") {
        $dateStart.value = "";
        $dateEnd.value = "";
        $dataValidity.style.display = "none";
    } else {
        $dateStart.value = "";
        $dateEnd.value = "";
        $dataValidity.style.display = "inherit";
    }

}


var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src)
    }
};

CKEDITOR.replace('editor1');

function chooseArchive() {
    document.getElementById("archive").click();
}
</script>

@stop
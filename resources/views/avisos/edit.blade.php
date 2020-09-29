@extends('layouts.default')

@section('content')

<script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-users">Editar Equipe</h1>

    <form action="/avisos/update/{{$aviso->id}}" class="ls-form" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <legend class="ls-title-2">Alterar Equipe</legend>
        <div class="row">
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Autor</span>
                <input name="autor" autocomplete="off" type="text" value="{{ \Auth::user()->name}}" >
            </label>
            <label class="ls-label col-md-6">
                <span class="ls-label-text">Titulo</span>
                <input type="text" name="titulo" autocomplete="off" value="{{ $aviso->titulo  }}">
            </label>

            <label class="ls-label col-md-6">
                <span class="ls-label-text">Descrição</span>
                <textarea name="editor1" autocomplete="off">{{ $aviso->descricao }}</textarea>
            </label>
            
            <label class="ls-label col-md-6">
                <button type="button" class="ls-btn-primary" style="padding:25px 50px;"
                onClick="chooseArchive()">Escolha um anexo</button>
                <input type="file" onchange="loadFile(event)" style="display: none;" id="archive" name="anexo">
                <img id="output" style="max-width: 50%; margin-left: 0px; padding-left: 50px;">
            </label>

        </div>

        <hr>

        <button type="submit" class="ls-btn-primary">Salvar</button>
        <a href="/avisos" class="ls-btn">Voltar</a>
    </form>

</div>

<script>
    addEventListener('load', imgPreView);
    
    function start(){
        console.log('https://book.ibraeducacional.com.br/storage/artes/{{$aviso->anexo}}');
    }

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };

    function imgPreView(event){
        let src = 'https://book.ibraeducacional.com.br/storage/artes/{{$aviso->anexo}}';
        let img = document.getElementById('output');
        output.src = src;
    }

    CKEDITOR.replace( 'editor1' );

    function chooseArchive() {
        document.getElementById("archive").click();
    }

</script>

@stop
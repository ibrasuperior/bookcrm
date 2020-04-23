@extends('layouts.default')

@section('content')
<?php
  $id = $_GET['id'];
  $connect = mysqli_connect('localhost','nzkbevgkvh',
  'tRFv9GWCvX', 'nzkbevgkvh');

  $documentos = mysqli_query($connect, 'select * from files where documento_id=' . $id  );
?>

<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-book">Documentos</h1>

    <table class="ls-table">
        <thead>
            <tr>
                <th class="ls-txt-center"> # </th>
                <th class="ls-txt-center"> Nome</th>
                <th class="ls-txt-center"> Download</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($documentos as $documento) { ?>

            <tr>
                <td class="ls-txt-center">
                    <?php echo $documento['id']; ?>
                </td>
                <td class="ls-txt-center">
                    <?php echo  utf8_decode($documento['nome']); ?>
                </td>

                <td class="ls-txt-center ls-regroup ">
                    <a href="http://admin.ibraeducacional.com.br/files/download?file=<?php echo $documento['url']; ?>"
                        class="ls-btn ls-btn-primary ls-ico-download ">Baixar</a>
                </td>
            </tr>

            <?php } ?>

        </tbody>
    </table>
    <center>
        <a href="/documentos" class="ls-txt-center ls-btn">Voltar</a>

    </center>


    @stop
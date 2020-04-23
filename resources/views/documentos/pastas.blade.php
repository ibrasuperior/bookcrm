@extends('layouts.default')

@section('content')
<?php
 $connect = mysqli_connect('localhost','nzkbevgkvh',
 'tRFv9GWCvX', 'nzkbevgkvh');

  $documentos = mysqli_query($connect, 'select * from documentos' );
?>
<div class="container-fluid">
    <h1 class="ls-title-intro ls-ico-book">Pastas de Documentos</h1>

    <table class="ls-table">

        <thead>
            <tr>
                <th class="ls-txt-center"> # </th>
                <th class="ls-txt-center"> Nome</th>
                <th class="ls-txt-center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($documentos as $documento)
            <tr>
                <td class="ls-txt-center">
                    <?php echo $documento['id']; ?>
                </td>
                <td class="ls-txt-center">
                    <a href="/documento/pasta?id=<?php echo $documento['id']; ?>">
                        <?php echo  utf8_decode($documento['nome']); ?>
                    </a>
                </td>
                <td></td>
            </tr>
            @endforeach

        </tbody>
    </table>

    @stop
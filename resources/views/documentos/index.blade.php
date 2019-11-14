@extends('layouts.default')

@section('content')
<?php
  $connect = mysqli_connect('localhost','nzkbevgkvh',
  'tRFv9GWCvX', 'nzkbevgkvh');

  $documentos = mysqli_query($connect, 'select * from files' );
?>
<div class="container-fluid">
<h1 class="ls-title-intro ls-ico-book">Documentos</h1>

<div class="ls-box-filter">


  <form action="" class="ls-form ls-form-inline ls-float-left">
    <label class="ls-label" role="search">
      <b class="ls-label-text ls-hidden-accessible">Nome do documento</b>
      <input type="text" id="q" name="q" aria-label="Faça sua busca por documento" placeholder="Nome do documento" required="" class="ls-field-sm">
    </label>
    <div class="ls-actions-btn">
      <input type="submit" value="Buscar" class="ls-btn ls-btn-sm" title="Buscar">
    </div>
  </form>
</div>

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
            <td class="ls-txt-center" >
              <?php echo  utf8_decode($documento['nome']); ?>
            </td>
            
            <td class="ls-txt-center ls-regroup ">
              <a href="http://admin.ibraeducacional.com.br/files/download?file=<?php echo $documento['url']; ?>"  class="ls-btn ls-btn-primary ls-ico-download ">Baixar</a>
            </td>
      </tr>
    
    <?php } ?>

  </tbody>
</table>

@stop
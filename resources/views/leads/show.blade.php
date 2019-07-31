@extends('layouts.default')

@section('content')
<script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/78b1a1af-93a2-4578-80be-7a2ed67e0e28-loader.js" ></script>

<!--POP UP PARA CADASTRO DE ALUNO -->

<div class="ls-modal" id="myAwesomeModal">
  <div class="ls-modal-box">
    <div class="ls-modal-header">
      <button data-dismiss="modal">&times;</button>
      <h4 class="ls-modal-title"> Insira os dados da matrícula</h4>
    </div>
    <div class="ls-modal-body" id="myModalBody">
    
    <form action="/matriculas/add" method="post" class="ls-form row">
        @csrf
        <input type="hidden" value="{{$lead->id}}" name="id_lead">
        <input type="hidden" value="{{$lead->nome}}" name="nome">
        <input type="hidden" value="{{$lead->canal->nome}}" name="canal">
        <input type="hidden" value="{{$lead->colaborador_id}}" name="colaborador_id">

        <fieldset>
          <label class="ls-label col-md-12">
            <b class="ls-label-text">Email</b>
            <input type="email" name="email" autocomplete="off" value="{{$lead->email}}" required >
            </label>

            <label class="ls-label col-md-12">
            <b class="ls-label-text">Valor da matrícula</b>
            <p class="ls-label-info">Digite o valor da matrícula</p>
            <input type="text" id="valor" name="valor"autocomplete="off"  placeholder="000,00" required maxlength="10" onkeyup="formatarMoeda();" >
            </label>

            <label class="ls-label col-md-12">
              <b class="ls-label-text">Vencimento</b>
              <input type="text" name="vencimento" class="datepicker" placeholder="dd/mm/aaaa">
            </label>

            <label class="ls-label col-md-12">
            <b class="ls-label-text">Qual o número de matrículas</b>
            <p class="ls-label-info">Digite a quantidade</p>
            <input type="number" name="quant"autocomplete="off"  placeholder="quant" required maxlength="1" >
            </label>

            <label class="ls-label col-md-12">
              <b class="ls-label-text">Produto</b>
              <div class="ls-custom-select">
                  <select name="produto" class="ls-select">
                    <option> Pós-Graduação </option>
                    <option> Capacitação </option>
                    <option> Segunda Licenciatura </option>
                    <option> R2 </option>
                  </select>
              </div>
            </label>

            <label class="ls-label col-md-12">
              <b class="ls-label-text">Estado</b>
              <div class="ls-custom-select">
                  <select name="estado" class="ls-select">
                  <option value="AC">Acre</option>
                  <option value="AL">Alagoas</option>
                  <option value="AP">Amapá</option>
                  <option value="AM">Amazonas</option>
                  <option value="BA">Bahia</option>
                  <option value="CE">Ceará</option>
                  <option value="DF">Distrito Federal</option>
                  <option value="ES">Espírito Santo</option>
                  <option value="GO">Goiás</option>
                  <option value="MA">Maranhão</option>
                  <option value="MT">Mato Grosso</option>
                  <option value="MS">Mato Grosso do Sul</option>
                  <option value="MG">Minas Gerais</option>
                  <option value="PA">Pará</option>
                  <option value="PB">Paraíba</option>
                  <option value="PR">Paraná</option>
                  <option value="PE">Pernambuco</option>
                  <option value="PI">Piauí</option>
                  <option value="RJ">Rio de Janeiro</option>
                  <option value="RN">Rio Grande do Norte</option>
                  <option value="RS">Rio Grande do Sul</option>
                  <option value="RO">Rondônia</option>
                  <option value="RR">Roraima</option>
                  <option value="SC">Santa Catarina</option>
                  <option value="SP">São Paulo</option>
                  <option value="SE">Sergipe</option>
                  <option value="TO">Tocantins</option>
                  <option value="EX">Estrangeiro</option>
                  </select>
              </div>
            </label>

            <label class="ls-label col-md-12">
              <b class="ls-label-text">Pagamento</b>
              <div class="ls-custom-select">
                  <select name="pagamento" class="ls-select">
                    <option> Parcelado </option>
                    <option> Á Vista </option>
                  </select>
              </div>
            </label>

        </fieldset>
    
        <div class="ls-actions-btn">
            <button type="submit" class="ls-btn-block ls-btn-primary">Salvar</button>
        </div>
    </form>

    </div>
   
  </div>
</div>

<!-- /.modal -->


<!--POP UP PARA ESTÁGIO DO LEAD -->
<div class="ls-modal" id="leadEstado">
  <div class="ls-modal-box">

        <div class="ls-modal-header">
          <button data-dismiss="modal">&times;</button>
          <h4 class="ls-modal-title">Selecione o estado que esse Lead se encontra.</h4>
        </div>

        <div class="ls-modal-body" id="myModalBody">
        <div class="ls-list">
          <header class="ls-list-header">
              <div class="ls-list-title col-md-9">
                <a href="#" > <span class="ls-ico-target" style="color:#f8b500;"> </span> Lead Frio</a>
                <small>Primeiros contatos com o Lead</small>
              </div>
              <div class="col-md-3 ls-txt-right">
              <form action="/leads/updateEstagio/{{$lead->id}}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" value="{{$lead->id}}" name="id">
                <input type="hidden" value="1" name="estagio">
                <button type="submit" class="ls-btn-primary">Selecionar</button>
                </form>
              </div>
          </header>

        </div>

        <div class="ls-list">
          <header class="ls-list-header">
            <div class="ls-list-title col-md-9">
              <a href="#" > <span class="ls-ico-star" style="color:#f8b500;"> </span> Oportunidade de Negócio</a>
              <small>O lead tem interesse na proposta</small>
            </div>
            <div class="col-md-3 ls-txt-right">
            <form action="/leads/updateEstagio/{{$lead->id}}" method="POST">
              @method('PUT')
              @csrf
              <input type="hidden" value="{{$lead->id}}" name="id">
              <input type="hidden" value="2" name="estagio">
                <button type="submit" class="ls-btn-primary">Selecionar</button>
            </form>
            </div>
          </header>

        </div>

        <div class="ls-list">
          <header class="ls-list-header">
            <div class="ls-list-title col-md-9">
              <a href="#" > <span class="ls-ico-close" style="color:#f8b500;"> </span> Desistente</a>
              <small>O lead não tem interesse na proposta</small>
            </div>
            <div class="col-md-3 ls-txt-right">
               <form action="/leads/updateEstagio/{{$lead->id}}" method="POST">
                @method('PUT')
                @csrf
              <input type="hidden" value="{{$lead->id}}" name="id">
              <input type="hidden" value="4" name="estagio">
                <button type="submit" class="ls-btn-primary">Selecionar</button>
            </form>
            </div>
          </header>

        </div>
    </div>
    <div class="ls-modal-footer">
    </div>
  </div>
</div>

<!-- /.modal -->


<!--POP UP PARA AGENDA  -->
<div class="ls-modal" id="agenda">
  <div class="ls-modal-box">

        <div class="ls-modal-header">
          <button data-dismiss="modal">&times;</button>
          <h4 class="ls-modal-title">Agende um contato com o Lead.</h4>
        </div>
 <div class="ls-modal-body" id="myModalBody">
    
    <form action="/agenda/add" method="post" class="ls-form row">
          @csrf
        <fieldset>

            <label class="ls-label col-md-12">
            <span class="ls-label-text">Nome do Compromisso</span>
            <input required autocomplete="off" type="text" value="Entrar em contato com : {{$lead->nome}}" name="nome">
            </label>

           <label class="ls-label col-md-12">
            <div class="ls-prefix-group">
            <b class="ls-label-text">Data</b>
            <input required autocomplete="off" type="text" name="data" class="datepicker" id="datepickerExample" placeholder="dd/mm/aaaa">
            </div>
            </label>
            
            <label class="ls-label col-md-12">
            <span class="ls-label-text">Hora do compromisso</span>
            <input class="ls-mask-time" required autocomplete="off" type="text"  name="hora" placeholder="00:00">
            </label>

            <label class="ls-label col-md-12">
            <span class="ls-label-text">Descrição</span>
            <textarea rows="4" name="descricao" required > Telefone para contato : {{$lead->telefone}}
            </textarea>
            <p class="ls-helper-text">Descreva o conteúdo do seu compromisso.</p>
            </label>

        </fieldset>
    
        <div class="ls-actions-btn">
            <button type="submit" class="ls-btn-block ls-btn-primary">Agendar</button>
        </div>
    </form>

    </div>
  </div>
</div>

<!-- /.modal -->




    <div class="container-fluid" onload="ClickBotao()">
        <h1 class="ls-title-intro ls-ico-users">Lead : <strong>{{ $lead->nome }}</strong></h1>

       <h3>
       @if( $lead->matriculado == true)
       <a href="#" class="ls-tag-success">Matriculado</a>
       @endif
       </h3>
    
    
    <!-- BOX INFORMATIVO -->
      
        <div class="container">
           @if( $lead->estagio_id == 2 )
            <span><img src="/img/star.png" style="max-width: 50px;"></span> <h3>Oportunidade de Negócio</h3>
          @endif

           @if( $lead->estagio_id == 4 )
              <span><img src="/img/x.png" style="max-width: 30px;"></span><h3>Desistente</h3>
          @endif 
        </div>
     

      <div class="ls-box ls-board-box">
      <header class="ls-info-header">
      <h2 class="ls-title-3">Propriedades do Lead</h2>
      <p class="ls-float-right ls-float-none-xs ls-small-info"></p>
      </header>

      @if( !empty($lead->origem) )
      <div class="ls-alert-info"><strong>Converteu no evento:</strong>
      <?php echo html_entity_decode($lead->origem, ENT_QUOTES | ENT_XML1, 'UTF-8'); ?>

      </div>
      @endif

      <br/>
      <div id="sending-stats" class="row">
      <div class="col-sm-6 col-md-3">
        <div class="ls-box">
          <div class="ls-box-head">
            <h6 class="ls-title-4">Matricular</h6>
          </div>
          <div class="ls-box-body">
          <strong class="ls-ico-checkmark"></strong>
            <small>Fazer a matrícula do aluno</small>
          </div>
          <div class="ls-box-footer">
            <button data-target="#myAwesomeModal" data-ls-module="modal" class="@if($lead->matriculado==true)ls-disabled @endif ls-btn-primary ls-btn-block ls-btn-sm">Matricular</button>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3">
        <div class="ls-box">
          <div class="ls-box-head">
            <h6 class="ls-title-4">Estágio do Lead</h6>
          </div>
          <div class="ls-box-body">
            <strong class="ls-ico-star"></strong>
            <small>Quão estágio o lead se encontra?</small>
          </div>
          <div class="ls-box-footer">
            <button data-ls-module="modal" data-target="#leadEstado" class="ls-btn-block ls-btn-sm">Mudar estado</button>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-3">
          <div class="ls-box">
              <div class="ls-box-head">
              <h6 class="ls-title-4">Marcar um compromisso</h6>
              </div>
              <div class="ls-box-body">
              <strong class="ls-ico-month"></strong>
              <small>Marcar um compromisso com este Lead</small>
              </div>
              <div class="ls-box-footer">
              <button data-target="#agenda" data-ls-module="modal" class="ls-btn-block ls-btn-primary ls-btn-sm">Agendar</button>
          </div>
      </div> </div>

      <div class="col-sm-6 col-md-3">
        <div class="ls-box">
          <div class="ls-box-head">
            <h6 class="ls-title-4">DATA DE CADASTRO</h6>
          </div>
          <div class="ls-box-body">
             {{$lead->created_at}}
            </div>
          </div>
        </div>
      </div>
      </div>

    <div class="ls-box">
    <div class="ls-float-right ls-regroup">
        <a href="" class="ls-btn-primary" target="_blank">Ações</a>
        <div data-ls-module="dropdown" class="ls-dropdown ls-pos-right">
        <a href="#" class="ls-btn" role="combobox" aria-expanded="false"></a>
        <ul class="ls-dropdown-nav" aria-hidden="true">
            <li>
            <a href="/leads/{{$lead->id}}" data-ls-fields-enable="#domain-form" data-toggle-class="ls-display-none" data-target=".domain-actions" class="domain-actions" role="option">Editar</a>
            </li>
           
            <li><a href="/leads/delete/{{$lead->id}}" class="ls-color-danger"  onclick="return confirm('tem certeza que quer excluir?')" role="option">Excluir</a></li>
        </ul>
        </div>
    </div>

    <form action="/leads/update/{{$lead->id}}" method="post" class="ls-form row" data-ls-module="form">
        @method('PUT')

        @csrf
        <fieldset id="domain-form" class="ls-form-disable ls-form-text">
        <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Nome</b>
            <input type="text" name="nome" value="{{ $lead->nome }}" required="" disabled="disabled" class="ls-form-text">
        </label>
        <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">E-mail:</b>
            <input type="text" name="email" value="{{$lead->email}}" required="" disabled="disabled" class="ls-form-text">
        </label>
        <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Telefone:</b>
            <input type="text" name="telefone" value="{{$lead->telefone}}" required="" disabled="disabled" class="ls-form-text">
        </label>

        <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Canal</b>
            <div class="ls-custom-select">
                <select name="canal_id" class="ls-select">
                <option value="{{$lead->canal->id}}"> {{$lead->canal->nome}}</option>
                </select>
            </div>
        </label>
        
        <label class="ls-label col-md-6 col-lg-8">
            <b class="ls-label-text">Informações:</b>
            <textarea name="obs" id="" cols="30" rows="5" disabled="disabled" class="ls-form-text">{{ $lead->obs}}</textarea>
        </label>
        </fieldset>
        <div class="domain-actions ls-display-none">
        <button type="submit" class="ls-btn-primary">Salvar</button>
        <button class="ls-btn" data-ls-fields-enable="#domain-form" data-toggle-class="ls-display-none" data-target=".domain-actions">Cancelar</button>
        </div>
    </form>
    
    </div>
    
    </div>

<script type="text/javascript">
function formatarMoeda() {
  var elemento = document.getElementById('valor');
  var valor = elemento.value;
  
  valor = valor + '';
  valor = parseInt(valor.replace(/[\D]+/g,''));
  valor = valor + '';
  valor = valor.replace(/([0-9]{2})$/g, ",$1");

  if (valor.length > 6) {
    valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
  }

  elemento.value = valor;
}

</script>


@stop
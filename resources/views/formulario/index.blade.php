@extends('layouts.default')

@section('content')
<script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/78b1a1af-93a2-4578-80be-7a2ed67e0e28-loader.js" ></script>

    <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-users">Formulário de Matrícula</h1>

    <form action="/formulario/envia" id="formMy" class="ls-form" method="post" >
        @csrf
        <legend class="ls-title-2">Nova Matrícula</legend>
        <?php $nome= \Auth::user()->name; ?> 
        <input type="hidden" required value="{{$nome}}" name="operador">

        <div style="margin-top:20px;">

            <label class="ls-label col-md-6">
            <p> Comercial</p>
            <div class="ls-custom-select">
                <select name="comercial" class="ls-select">
                    <option value="1">Comercial 1</option>
                    <option value="2">Comercial 2</option>
                    <option value="3">Comercial 3</option>
                </select>
            </div>
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off " required placeholder="Nome Completo"  type="text" name="nome">
            </label>

            <label class="ls-label col-md-6">
            <p> Sexo:</p>
            <div class="ls-custom-select">
                <select name="sexo" class="ls-select">
                    <option>Masculino</option>
                    <option>Feminino</option>
                </select>
            </div>
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required id="telefone" placeholder="Celular DD - XXXXX-XXXX"  type="text" name="celular">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="E-mail" type="email" name="email">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="Curso matriculado"  type="text" name="curso">
            </label>

            <label class="ls-label col-md-6">
            <p>Tipo do curso</p>
            <div class="ls-custom-select">
                <select id="tipo" name="tipo" class="ls-select">
                    <option>Pós-Graduação</option>
                    <option>Capacitação</option>
                    <option>Complementação</option>
                    <option>Eja</option>

                </select>
            </div>
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="Carga Horária"  type="text" name="cargaHoraria">
            </label>


            <label class="ls-label col-md-6">
            <p> Faculdade Certificadora</p>
            <div class="ls-custom-select">
                <select name="faculdade" class="ls-select">
                    <option>FAMEV</option>
                    <option>UNIMAIS</option>
                    <option>IDEAL</option>
                    <option>CEPED</option>
                    <option>FAMART</option>
                </select>
            </div>
            </label>

            <label class="ls-label col-md-6">
            <p> Mídia</p>
            <div class="ls-custom-select">
                <select name="midia" class="ls-select">
                    <option>Social</option>
                    <option>Site</option>
                    <option>Actual Sales</option>
                    <option>Google Ads</option>
                    <option>Indicação</option>
                    <option>Outros</option>
                </select>
            </div>
            </label>

            <label class="ls-label col-md-6">
            <p>Melhor Horário para contato</p>
            <div class="ls-custom-select">
                <select name="horarioContato" class="ls-select">
                    <option> 8:00</option>
                    <option> 9:00</option>
                    <option> 10:00</option>
                    <option> 11:00</option>
                    <option> 12:00</option>
                    <option> 13:00</option>
                    <option> 14:00</option>
                    <option> 15:00</option>
                    <option> 16:00</option>
                    <option> 17:00</option>
                    <option> 18:00</option>
                    <option> 19:00</option>
                </select>
            </div>
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="Graduação"  type="text" name="graduacao">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="Estado"  type="text" name="estado">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required  placeholder="Cidade"  type="text" name="cidade">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="Rua"  type="text" name="rua">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="Número"  type="number" name="numero">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="Bairro"  type="text" name="bairro">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="Cep"  type="text" name="cep">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="País"  type="text" name="pais">
            </label>

            <label class="ls-label col-md-6">
            <input OnKeyUp="mascaraData(this, 'dd');" maxlength="10" required id="dd" autocomplete="off" placeholder="Data de Nascimento"  type="text" name="dataNasc">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="CPF"  type="text" name="cpf">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="Nome da Mãe"  type="text" name="nomeMae">
            </label>

            <label class="ls-label col-md-6">
            <input autocomplete="off" required placeholder="Nome do Pai"  type="text" name="nomePai">
            </label>

            <label class="ls-label col-md-6">
            <p> TCC: </p>
            <div class="ls-custom-select">
                <select name="tcc" class="ls-select">
                    <option>SIM</option>
                    <option>NÃO</option>
                </select>
            </div>
            </label>

            <label class="ls-label col-md-6">
            <h4 style="padding-bottom:20px;">Plano Financeiro</h4>
            <input autocomplete="off" required id="valor2" maxlength="10" onkeyup="formatarMoeda('valor2');" placeholder="Valor da Matrícula"  type="text" name="valorMatricula">
            </label>

            <label class="ls-label col-md-6">
            <input OnKeyUp="mascaraData(this, 'ddd');" required maxlength="10" id="ddd" autocomplete="off" placeholder="Vencimento da Matrícula"  type="text" name="vencimentoMatricula">
            </label>
            
            <label class="ls-label col-md-6">
            <input autocomplete="off" id="valor3" required maxlength="10" onkeyup="formatarMoeda('valor3');" placeholder="Valor da Mensalidade"  type="text" name="valorMensalidade">
            </label>

            <label class="ls-label col-md-6">
            <input OnKeyUp="mascaraData(this, 'dd2');" required maxlength="10" id="dd2" autocomplete="off" placeholder="Vencimento da Mensalidade"  type="text" name="vencimentoMensalidade">
            </label>

            <label class="ls-label col-md-6">
            <p> Método de Pagamento:</p>
            <div class="ls-custom-select">
                <select name="pagamento" class="ls-select">
                    <option>Boleto</option>
                    <option>Cartão</option>
                    <option>Link</option>
                </select>
            </div>
            </label>

            <label class="ls-label col-md-6">
            <p> Parcelas: </p>
            <div class="ls-custom-select">
                <select name="parcelas" class="ls-select">
                    <option>1x</option>
                    <option>2x</option>
                    <option>3x</option>
                    <option>4x</option>
                    <option>5x</option>
                    <option>6x</option>
                    <option>7x</option>
                    <option>8x</option>
                    <option>9x</option>
                    <option>10x</option>
                    <option>11x</option>
                    <option>12x</option>
                    <option>13x</option>
                    <option>14x</option>
                    <option>15x</option>
                    <option>16x</option>
                    <option>17x</option>
                    <option>18x</option>
                </select>
            </div>
            </label>
            
            <label class="ls-label col-md-6">
            <input  id="valorTotal" required maxlength="10" onkeyup="formatarMoeda('valorTotal')"  autocomplete="off" placeholder="Valor Total do curso (sem matrícula)"  type="text" name="valorTotal">
            </label>

            <label class="ls-label col-md-6">
            <p>Observações:</p>
            <textarea name="obs"  id="" cols="30"></textarea>
            </label>

        </div>
        
        <hr>
        <button type="submit" class="col-md-6 ls-btn-primary">Enviar</button>
    </form>

    </div>


    <div class="ls-modal" id="myAwesomeModal">
    <div class="ls-modal-box">
        <div class="ls-modal-header">
        <button data-dismiss="modal">&times;</button>
        <h4 class="ls-modal-title">O valor total do curso não está de acordo!</h4>
        </div>
            <div class="ls-modal-body" id="myModalBody">
                <p>Por favor digite a senha do Gerente!</p>
                <label class="ls-label col-md-6">
                <form autocomplete="off">
                <input id="senha" autocomplete="off" placeholder="Senha"  type="password" />
                </label>
                </form>
            </div>
        <div class="ls-modal-footer">
        <a type="button" class="btn-block ls-btn-primary" onclick="check()" >Liberar Venda!</a>
        </div>
    </div>
    </div><!-- /.modal -->


    <script type="text/javascript">

            document.getElementById('formMy').onsubmit = function(){

            var tipo = document.getElementById('tipo').value;
            var valor = document.getElementById('valorTotal').value;

            if( valor < 1499.00 && tipo == 'Pós-Graduação' ){
                locastyle.modal.open("#myAwesomeModal");
                return false;
                
            }else{
                return true;
            }
            
            };


        function check(){
            var senha = 'ibra@gerencia4039';
            var check = document.getElementById('senha').value;
            
            if( check == senha  ){
                document.getElementById('formMy').submit();
            }else{
                window.alert('Senha errada!');
            }
        }
        
    </script>

<!-- MÁSCARA TELEFONE  -->


<script type="text/javascript">
			/* Máscaras ER */
			function mascara(o,f){
			    v_obj=o
			    v_fun=f
			    setTimeout("execmascara()",1)
			}
			function execmascara(){
			    v_obj.value=v_fun(v_obj.value)
			}
			function mtel(v){
			    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
			    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
			    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
			    return v;
            }
            
            function id( el ){
                return document.getElementById( el );
            }
            window.onload = function(){
                id('telefone').onkeypress = function(){
                    mascara( this, mtel );
                }
            }

			</script>
<!-- MÁSCARA TELEFONE  -->

<script language="JavaScript" type="text/javascript">
   function mascaraData(campoData,id){
              var data = campoData.value;
              
              if (data.length == 2){
                  data = data + '/';
                  document.getElementById(id).value = data;
      return true;              
              }
              if (data.length == 5){
                  data = data + '/';
                  document.getElementById(id).value = data;
                  return true;
              }
         }
</script>

    <script type="text/javascript">
        function formatarMoeda(id) {
        var elemento = document.getElementById(id);
        var valor = elemento.value;
        
        valor = valor + '';
        valor = parseInt(valor.replace(/[\D]+/g,''));
        valor = valor + '';
        valor = valor.replace(/([0-9]{2})$/g, ".$1");

        elemento.value = valor;
    }

    </script>

@stop
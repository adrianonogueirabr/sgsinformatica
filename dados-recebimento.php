<?php 
include "conexao.php";
    if($_POST['valor']== ""){
      $valor = $_GET['valor'];
      $criterio = $_GET['criterio'];
    }else{
      $valor = $_POST['valor'];
      $criterio = $_POST['criterio'];
    } 

//RECEBIMENTO DE OS
if($criterio == 'OS'){

      $valor = $_GET['os'];

			$sql = $con->prepare("SELECT C.TXT_RAZAO_CLI,C.VAL_SALDO_CLI, REC.VAL_VALOR_REC

       FROM TBL_RECEBIMENTO_REC REC

       LEFT JOIN TBL_CLIENTE_CLI C
     
       ON C.NUM_ID_CLI = TBL_CLIENTE_CLI_NUM_ID_CLI

       WHERE TXT_STATUS_REC = 'ABERTO' AND TXT_REFERENTE_REC = 'OS' AND NUM_DOCUMENTO_REC = '$valor'"); 

			if(! $sql->execute() ) { die('Houve um erro no processamento da transação: ' . mysqli_error()); }

			if($sql->rowCount() == 0){			
		    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=recebimento.php'><script type=\"text/javascript\">alert(\"Verifique Ordem de Servico informada!\");</script>";	
			}
      
      while($row = $sql->fetch(PDO::FETCH_OBJ))
      {      
          $valorReceber =     $row->VAL_VALOR_REC;
          $saldoCLiente =     $row->VAL_SALDO_CLI;
          $razaoCLiente = 		$row->TXT_RAZAO_CLI;	
      }	
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <body>
    <form name="faturamento" action="processa-recebimento.php?criterio=<?php echo $criterio ?>&id=<?php echo $valor ?>" method="post" onSubmit="return validaForm()">
    <table width="100%" class="table responsive">
          <tr>
              <td><?php include "inicial.php" ?></td>
          </tr>
          <tr>
              <td><legend class="p-4 table-primary">Dados de Recebimentos<legend></td>		
          </td>
        </tr>
        <tr>
          <td>
          <table class="table">
              <tr>
                  <td>
                      <div class="form-row"> 
                      <div class="form-group  col-md-8 col-sm-6"><label for="cliente">Cliente</label>
                          <input class="form-control" name="razao"  type="real" id="razao" readonly="true" title="CLIENTE DO DA ORDEM DE SERVIÇO" value="<?php echo $razaoCLiente ?>" />
                      </div>

                      <div class="form-group  col-md-4 col-sm-6"><label for="saldo">Saldo</label>
                          <input name="saldo" type="real" readonly="readonly" class="form-control"  title="SALDO DO CLIENTE" value="R$<?php echo number_format($saldoCLiente,2)?>" />
                      </div>

                      <div class="form-group col-md-6"><label for="formapagamento">Forma Pagamento</label>
                          <select name="formapagamento" class="form-control"> 
                            <?php
                                include "conexao.php"; 
                                $sqlFP=$con->prepare("SELECT NUM_ID_FP, TXT_NOME_FP FROM TBL_FORMA_PAGAMENTO_FP WHERE TXT_ATIVO_FP = 'SIM'");
                                  if(!$sqlFP->execute()){die ('Houve um erro na transacao ' . mysqli_error());}
                                    while($sqlResultFim = $sqlFP->fetch(PDO::FETCH_OBJ))
                                    {?>
                                      <option value="<?php echo $sqlResultFim->NUM_ID_FP ?>"> <?php echo $sqlResultFim->TXT_NOME_FP ?></option>
                                    <?php } ?>
                          </select> 
                      </div> 

                        <div class="form-group col-md-6 col-sm-6"><label for="total_os">Valor a Receber</label>
                          <input name="totalreceber" type="text" readonly="readonly" class="form-control" id="totalreceber" title="VALOR TOTAL DA ORDEM DE SERVICO" value="<?php echo $valorReceber?>" />
                        </div>

                        <div class="form-group col-md-6 col-sm-6"><label for="total_os">Desconto</label>
                          <input name="desconto" class="form-control" type="real" id="desconto" readonly="true" TITLE="INFORME O VALOR DO DESCONTO SE HOUVER" value="0"/>
                        </div>

                        <div class="form-group col-md-6 col-sm-6"><label for="total_os">Valor Recebido</label>
                            <input name="valorrecebido" id="valorrecebido" type="real" class="form-control" required="required"  title="INFORME VALOR RECEBIDO"/>
                        </div>

                        <div class="form-group col-md-2">
                            <input type="submit" name="registrar"  value="Registrar Dados" class="btn  btn-outline-primary" onclick="return confirm('Confirma os dados informados?')" />
                          </div>
                        </div>                   
        
                  </td>
              </tr>
          </table>
    </form>
    </body>
    </html>

    <?php }
//RECEBIMENTO DE TITULO -----------------------------------------------------------------------------------------------------------------------------------
if($criterio == 'TR'){

            $sqlTr = $con->prepare("SELECT C.TXT_RAZAO_CLI, C.VAL_SALDO_CLI,
            TR.VAL_VALOR_TR, TR.VAL_FINAL_TR, TR.VAL_JUROS_TR, TR.VAL_MULTA_TR, TR.TBL_CLIENTE_CLI_NUM_ID_CLI, TR.TXT_REFERENTE_TR, TR.DTA_VENCIMENTO_TR
      
            FROM TBL_TITULORECEBER_TR TR
      
            LEFT JOIN TBL_CLIENTE_CLI C
            ON C.NUM_ID_CLI = TBL_CLIENTE_CLI_NUM_ID_CLI
      
            WHERE NUM_ID_TR = '$valor' AND TXT_STATUS_TR = 'ABERTO'"); 

            if(! $sqlTr->execute() )
            {
              die('Houve um erro no processamento da transação: ' . mysqli_error());
            }
            
          if($sqlTr->rowCount() == 0){  		
              echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=financeiro.php'><script type=\"text/javascript\">alert(\"Verifique o codigo do titulo informado!\");</script>";	
            }

      ?>

      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">

      <body>

      <form name="recebimento" action="processa-recebimento.php?criterio=<?php echo $criterio ?>&id=<?php echo $valor ?>" method="post" onSubmit="return validaForm()">
      <table class="table">
          <tr>
              <td> <?php include "inicial.php"?> </td>
          </tr>
          <tr>
              <td><legend class="p-4 table-primary">Recebimento de Titulo<legend></td>
          </tr>
          <tr>
              <td>
              <?php                 							
                    while($row = $sqlTr->fetch(PDO::FETCH_OBJ)){
                          $valtotal =         $row->VAL_VALOR_TR;
                          $id_cliente =       $row->TBL_CLIENTE_CLI_NUM_ID_CLI;
                          $razaoCLiente = 		$row->TXT_RAZAO_CLI;
                          $saldoCLiente =     $row->VAL_SALDO_CLI;
                          $idOs =             $row->TXT_REFERENTE_TR;
                          $valJurosMulta =    $row->VAL_JUROS_TR + $row->VAL_MULTA_TR;
                          $valFinal =         $row->VAL_FINAL_TR;
                          $vencimento =       $row->DTA_VENCIMENTO_TR;	
                    }							
                ?>

                <div class="form-row"> 
                  <div class="form-group col-md-6 col-sm-6">
                    <label for="razao">Cliente</label>
                    <input name="razao" class="form-control" type="real" id="razao" readonly="true" value="<?php echo $razaoCLiente ?>"/>
                  </div>

                  <div class="form-group col-md-3 col-sm-6">
                  <label>Saldo</label>
                    <input name="saldo" class="form-control" type="real" id="saldo" readonly="true" value="<?php echo 'R$' . number_format($saldoCLiente,2) ?>"/>
                  </div>


                  <div class="form-group col-md-3 col-sm-6">
                  <label>Valor</label>
                      <input name="totalreceber" class="form-control" type="text" readonly="true" id="totalreceber" title="Valor total do documento" value="<?php echo $valtotal ?>" />
                  </DIV>

                  <div class="form-group col-md-6 col-sm-6">
                      <label>Dias em Aberto</label>
                      <?php 
                      //calcular dias em aberto
                          $diferenca =  strtotime(date("Y-m-d")) - strtotime($vencimento);
                          $diasAberto = floor($diferenca / (60 * 60 * 24));
                          if($diasAberto <= 0){
                            $diasAberto=0;
                          }
                      ?>
                      <input name="saldo" class="form-control" type="real" id="diasaberto" readonly="true" value="<?php echo $diasAberto ?>"/>
                  </div>

                  <div class="form-group col-md-6 col-sm-6">
                      <label>Juros e Multa</label>
                      <input name="razao" class="form-control" type="real" id="jurosmulta" readonly="true" value="<?php echo $valJurosMulta ?>"/>
                  </div>

                  <div class="form-group col-md-6 col-sm-6">
                      <label for="saldo">Desconto</label>
                      <input name="desconto" class="form-control" type="float" id="desconto" value="0" readonly onblur="aplicaDescontoCaixa()" />
                  </div>

                  <div class="form-group col-md-6 col-sm-6">
                  <label>Valor Total</label>
                      <input name="valorFinal" class="form-control" type="float" readonly="true" id="valorFinal" title="VALOR FINAL DO TITULO" value="<?php echo $valFinal ?>" />
                      <input type="hidden" name="idcliente" value="<?php echo $id_cliente ?>">          
                      <input type="hidden" name="titulo" value="<?php echo $valor ?>">
                      <input type="hidden" name="idOs" value="<?php echo $idOs ?>">
                  </DIV>
                  
                  <div class="form-group col-md-6 col-sm-6">
                    <label for="saldo">Valor Recebido</label>
                    <input name="valorrecebido" type="real" class="form-control" required="required"  id="valorrecebido" title="INFORME VALOR RECEBIDO"/>
                  </div>

                  <div class="form-group col-md-6">
                      <label for="saldo">Forma de Pagamento</label>
                      <select name="formapagamento" class="form-control"> 
                        <?php
                            include "conexao.php"; 
                            $sqlFP=$con->prepare("SELECT NUM_ID_FP, TXT_NOME_FP FROM TBL_FORMA_PAGAMENTO_FP WHERE TXT_ATIVO_FP = 'SIM'");
                              if(!$sqlFP->execute()){die ('Houve um erro na transacao ' . mysqli_error());}
                                while($sqlResultFim = $sqlFP->fetch(PDO::FETCH_OBJ)){?>
                                    <option value="<?php echo $sqlResultFim->NUM_ID_FP ?>"> <?php echo $sqlResultFim->TXT_NOME_FP ?></option>
                                <?php } ?>
                      </select>
                  </div>          

                  <div class="form-group col-md-2">                   
                      <input type="submit" name="registrar"  value="Registrar Dados" class="btn btn-outline-primary" onclick="return confirm('Confirma os dados informados?')" />
                  </div>

                  </div>         
            
        </td>    
        </tr>
      </table>
      </form>      
      </body>
      <script type="text/javascript" src="javascript/faturamento.js"></script>
      </html>

<?php } 

if($criterio == 'AD'){ //RECEBIMENTO DE ADIANTAMENTO 

          $sqlCli = $con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$valor' AND TXT_ATIVO_CLI = 'SIM'"); 
          if(! $sqlCli->execute() ){
              die('Houve um erro no processamento da transação: ' . mysqli_error());
          }

          if($sqlCli->rowCount() == 0){  		
              echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-clientes.php'><script type=\"text/javascript\">alert(\"Verifique o codigo do Cliente informado!\");</script>";	
          }
                                        
          while($row = $sqlCli->fetch(PDO::FETCH_OBJ)){
              $nomeCliente = $row->TXT_RAZAO_CLI;
              $cpfCnpjCliente = $row->TXT_CPF_CNPJ_CLI;	
              $id_cliente = $row->NUM_ID_CLI;
              $saldoCLiente = $row->VAL_SALDO_CLI;
          }		
          ?>

          <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml">

          <body>
              <form name="faturamento" action="processa-recebimento.php?criterio=<?php echo $criterio ?>&id=<?php echo $valor ?>" method="post" onSubmit="return validaForm()">
                  <table width="100%" class="table responsive">
                      <tr>
                          <td><?php include "inicial.php" ?></td>
                      </tr>
                      <tr>
                          <td><legend class="p-4 table-primary">Adiantamento de Cliente</legend></td>
                          <input type="hidden" name="idcliente" value="<?php echo $id_cliente ?>">
                          <input type="hidden" name="saldoCliente" value="<?php echo $saldoCLiente ?>">
                      </tr>
                  </table>
                  <table class="table">
                      <tr>
                          <td>
                              <div class="form-row">
                                  <div class="form-group  col-md-6 col-sm-6"><label for="razao">Cliente</label>
                                      <input name="razao" class="form-control" type="real" id="razao" readonly="true" value="<?php echo $nomeCliente ?>"/>
                                  </div>

                                  <div class="form-group  col-md-3 col-sm-6"><label for="cpfcnpj">CPF/CNPJ</label>
                                      <input name="cpfcnpj" class="form-control" type="real" id="saldo" readonly="true" value="<?php echo $cpfCnpjCliente ?>"/>
                                  </div> 

                                  <div class="form-group  col-md-3 col-sm-6"><label for="saldoCLiente">Saldo Atual</label>
                                      <input name="saldoCLiente" class="form-control" type="real" id="saldo" readonly="true" value="<?php echo  'R$' . number_format($saldoCLiente,2) ?>"/>
                                  </div> 

                                  <div class="form-group  col-md-4 col-sm-6"><label for="formapagamento">Forma Pagamento</label>                                      
                                      <select name="formapagamento" class="form-control"> 
                                          <?php
                                              include "conexao.php"; 
                                              $sqlFP=$con->prepare("SELECT NUM_ID_FP, TXT_NOME_FP FROM TBL_FORMA_PAGAMENTO_FP WHERE TXT_ATIVO_FP = 'SIM'");
                                                  if(!$sqlFP->execute()){die ('Houve um erro na transacao ' . mysqli_error());}
                                                      while($sqlResultFim = $sqlFP->fetch(PDO::FETCH_OBJ)){?>
                                                          <option value="<?php echo $sqlResultFim->NUM_ID_FP ?>"> <?php echo $sqlResultFim->TXT_NOME_FP ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>

                                  <div class="form-group  col-md-4 col-sm-6"><label for="valorrecebido">Valor Recebido</label>
                                      <input name="valorrecebido" type="real" class="form-control" required="required"  id="valor" title="INFORME VALOR RECEBIDO"/>
                                  </div>

                                  <div class="form-group col-md-4 col-sm-6"><label for="descricao">Descricao</label>
                                      <select name="descricao" id="descricao" class="form-control" title='SELECIONE DESCRICAO DO ADIANTAMENTO'">
                                          <option value="ORDEM DE SERVICO">ORDEM DE SERVICO</option>
                                          <option value="PECAS">PECAS</option>                   
                                          <option value="SERVICOS">SERVICOS</option>
                                      </select>
                                  </div>

                                  <div class="form-group col-md-2">
                                    <input type="submit" name="registrar"  value="Registrar Dados" class="btn btn-outline-primary" onclick="return confirm('Confirma os dados informados?')" />
                                  </div>
                              </div>
                          </td>    
                      </tr>
                </table>
            </form>
        </body>
        </html>

<?php } 
//BAIXA DE TITULO COM SALDO DE CLIENTE -----------------------------------------------------------------------------------------------------------------------------------
        if($criterio == 'TRAD'){

              $sqlTr = $con->prepare("SELECT C.TXT_RAZAO_CLI, C.VAL_SALDO_CLI,
              TR.VAL_VALOR_TR, TR.TBL_CLIENTE_CLI_NUM_ID_CLI, TR.TXT_REFERENTE_TR, TR.VAL_FINAL_TR, TR.VAL_JUROS_TR, TR.VAL_MULTA_TR, TR.DTA_VENCIMENTO_TR
        
              FROM TBL_TITULORECEBER_TR TR
        
              LEFT JOIN TBL_CLIENTE_CLI C
              ON C.NUM_ID_CLI = TBL_CLIENTE_CLI_NUM_ID_CLI
        
              WHERE NUM_ID_TR = '$valor' AND TXT_STATUS_TR = 'ABERTO'"); 

              if(! $sqlTr->execute() ){
                  die('Houve um erro no processamento da transação: ' . mysqli_error());
              }

              if($sqlTr->rowCount() == 0){  		
                echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=financeiro.php'><script type=\"text/javascript\">alert(\"Verifique o codigo do titulo informado!\");</script>";	
              }
                                      
              while($row = $sqlTr->fetch(PDO::FETCH_OBJ)){
          
                $valtotal =         $row->VAL_VALOR_TR;
                $id_cliente =       $row->TBL_CLIENTE_CLI_NUM_ID_CLI;
                $razaoCLiente = 		$row->TXT_RAZAO_CLI;
                $saldoCLiente =     $row->VAL_SALDO_CLI;
                $idOs =             $row->TXT_REFERENTE_TR;		
                $valFinal =         $row->VAL_FINAL_TR;
                $valJurosMulta =    $row->VAL_JUROS_TR + $row->VAL_MULTA_TR;
                $vencimento =       $row->DTA_VENCIMENTO_TR;			
              }

              if($saldoCLiente < $valtotal){
                echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=financeiro.php'><script type=\"text/javascript\">alert(\"Cliente nao possui saldo suficiente!\");</script>";	
              }	             

        ?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <body>

        <form name="faturamento" action="processa-recebimento.php?criterio=<?php echo $criterio ?>&id=<?php echo $valor ?>" method="post" onSubmit="return validaForm()">
        <table class="table">
          <tr>
              <td> <?php include "inicial.php"?> </td>
          </tr>
          <tr>
              <td><legend class="p-4 table-primary">Baixar de Titulo com Saldo<legend></td>
          </tr>
          <tr>
              <td>
            <div class="form-row"> 
                <div class="form-group col-md-6 col-sm-6">
                    <label for="razao">Cliente</label>
                    <input name="razao" class="form-control" type="real" id="razao" readonly="true" value="<?php echo $razaoCLiente ?>"/>
                </div>

                <div class="form-group col-md-6 col-sm-6">
                    <label>Saldo</label>
                    <input name="saldo" class="form-control" type="real" id="saldo" readonly="true" value="<?php echo 'R$' . number_format($saldoCLiente,2) ?>"/>
                </div>


              <div class="form-group col-md-6 col-sm-6">
                  <label>Valor</label>
                  <input name="totalreceber" class="form-control" type="text" readonly="true" id="totalreceber" title="Valor total do documento" value="<?php echo $valtotal ?>" />
                  <input type="hidden" name="idcliente" value="<?php echo $id_cliente ?>">          
                  <input type="hidden" name="titulo" value="<?php echo $valor ?>">
                  <input type="hidden" name="idOs" value="<?php echo $idOs ?>">
                  <input type="hidden" name="desconto" value="0">
                  <input type="hidden" name="formapagamento" value="3">
                  <input type="hidden" name="saldoCliente" value="<?php echo $saldoCLiente ?>">
              </DIV>
              

              <div class="form-group col-md-6 col-sm-6">
                      <label>Dias em Aberto</label>
                      <?php 
                      //calcular dias em aberto
                          $diferenca =  strtotime(date("Y-m-d")) - strtotime($vencimento);
                          $diasAberto = floor($diferenca / (60 * 60 * 24));
                          if($diasAberto <= 0){
                            $diasAberto=0;
                          }
                      ?>
                      <input name="saldo" class="form-control" type="real" id="diasaberto" readonly="true" value="<?php echo $diasAberto ?>"/>
                  </div>

                  <div class="form-group col-md-6 col-sm-6">
                      <label>Juros e Multa</label>
                <input name="razao" class="form-control" type="real" id="jurosmulta" readonly="true" value="<?php echo 'R$' . number_format($valJurosMulta, 2, ',', '.'); ?>"/>
              </div>

              <div class="form-group col-md-6 col-sm-6">
                  <label>Valor Total</label>
                  <input name="valorFinal" class="form-control" type="real" readonly="true" id="valorFinal" title="Valor total do documento" value="<?php echo $valFinal ?>" />
              </DIV>

              <div class="form-group col-md-6 col-sm-6">
                    <label>Desconto</label>
              <input name="desconto" class="form-control" type="real" id="desconto" value="0" readonly onblur="aplicaDescontoCaixa()" />
              </div>
              
              <div class="form-group col-md-6 col-sm-6">
                    <label for="saldo">Valor Recebido</label>
                    <input name="valorrecebido" type="real" class="form-control" required="required"  id="valorrecebido" title="INFORME VALOR RECEBIDO"/>
              </div>
            

              <div class="form-group col-md-2">
                  <input type="submit" name="registrar"  value="Registrar Dados" class="btn btn-outline-primary" onclick="return confirm('Confirma os dados informados?')" />
              </div>
              </div>

            
              
          </td>    
          </tr>
        </table>
        </form>
        </body>
        </html>

<?php } ?>



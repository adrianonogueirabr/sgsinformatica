<?php 
    //LIBERACAO TECNICO PARA APROVAR E EXECUTAR SERVICO DAS OS
    
    include "conexao.php";
    include "verifica.php";
    
    $valor = $_GET['id'];	
    $totalServicos = 0;
    $totalProdutos = 0;
    $totalFinal = 0;
    $totalDescontos = 0;
    $total = 0;
    $condicaoPagamento;
    $sqlOs = $con->prepare("SELECT * FROM TBL_ORCAMENTO_ORC WHERE NUM_ID_ORC = '$valor'");		
    $sqlOs->execute();
    //caso a os esteja com status nao permitido
    if($sqlOs->rowCount() <=0){	
        echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-apontamento.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";		
    }else{
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Adriano Nogueira - Desenvolvedor">
    <meta content= "SGOFIC - SISTEMA DE GESTÃO DE OFICINAS" name="description">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-icons.css">
    
    <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script></head>
<body>
<table width="100%" class="table"> 
    <tr>
        <td width="50%">
            <img src="imagens/logo_ofc.png" width="50%" height="80" />     
        </td>
        <td align="right">
            <?php	while ($rowOs = $sqlOs->fetch(PDO::FETCH_OBJ)){	?> 
                <?php 
                    //selecao da empresa para cabecalho do relatorio
                    $empresa = $rowOs->TBL_EMPRESA_EMP_NUM_ID_EMP;
                    $sql_empresa = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = $empresa");
                    $sql_empresa->execute();
                    while ($row_empresa = $sql_empresa->fetch(PDO::FETCH_OBJ)){?>
                        <label><?php echo $row_empresa->TXT_FANTASIA_EMP ?></label></br>
                        <label><?php echo $row_empresa->TXT_LOGRADOURO_EMP ?> N<?php echo $row_empresa->NUM_NUMERO_EMP ?>, <?php echo $row_empresa->TXT_BAIRRO_EMP ?>,<?php echo $row_empresa->TXT_CIDADE_EMP ?>-<?php echo $row_empresa->TXT_ESTADO_EMP ?></label></br>
                        <label><?php echo $row_empresa->TXT_TELEFONE_EMP ?> - <?php echo $row_empresa->TXT_EMAIL_EMP ?><label></br>
                    <?php } ?> 
        </td>          
    </tr>
    <tr>
        <td colspan="2" align="center">
            <h3>Impressao do Orcamento</h3>
        </td>
    </tr>
    <tr>
        <td colspan="2"><h4>Dados de Cliente</h4>             
                <?php	//seleciona nome e telefone do cliente da ordem de servico
                  $cli = $rowOs->TBL_CLIENTE_CLI_NUM_ID_CLI;
                  $sql_nome = $con->prepare("SELECT TXT_RAZAO_CLI,TXT_TELEFONE_CLI, TXT_EMAIL_CLI  FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$cli'");
                  $sql_nome->execute();
                  while($row_nome = $sql_nome->fetch(PDO::FETCH_OBJ)){
                ?>                       
                    <div class="form-row">
                        <div class="form-group col-md-2 input-group-sm mb-3 ">
                          <label for="id">ID</label>              
                          <input name="id"value="<?php echo $rowOs->TBL_CLIENTE_CLI_NUM_ID_CLI; ?>" readonly="readonly" class="form-control"  />        
                        </div> 
                        <div class="form-group input-group-sm col-md-5 ">
                            <label for="Nome">Nome</label>
                            <input name="Nome" value="<?php echo $row_nome->TXT_RAZAO_CLI; ?>" readonly="readonly" class="form-control"  />   		      
                        </div> 
                        <div class="form-group input-group-sm col-md-2 ">
                            <label for="telefone">Telefone</label>
                            <input name="telefone" value="<?php echo $row_nome->TXT_TELEFONE_CLI; ?>" readonly="readonly" class="form-control"  />    		      
                        </div> 
                        <div class="form-group input-group-sm col-md-3 ">
                            <label for="tipo">Email</label>
                            <input name="Email" value="<?php echo $row_nome->TXT_EMAIL_CLI; ?>" readonly="readonly" class="form-control"  />   		      
                        </div> 
                    </div>
                <?php }//fim nome e telefone do cliente ?> 
            </td>
        </tr>
        <tr>       
            <td colspan="4"><h4>Dados da Frota</h4>         
              <?php 
                $equipamento = $rowOs->TBL_FROTA_FR_NUM_ID_FR;
                //select para pegar tipo de equipamento e serial
                 $sql_frota = $con->prepare("SELECT C.TXT_RAZAO_CLI,F.TBL_CLIENTE_CLI_NUM_ID_CLI , F.NUM_ID_FR, F.TXT_ATIVO_FR, T.TXT_NOME_TIP, M.TXT_NOME_MAR, MO.TXT_NOME_MOD, 
                 
                      F.TXT_PLACA_FR, F.TXT_CHASSI_FR, F.DTH_REGISTRO_FR,F.DTH_ALTERACAO_FR, CO.TXT_NOME_COR 

                      FROM tbl_frota_fr F 

                      LEFT JOIN TBL_CLIENTE_CLI C ON C.NUM_ID_CLI = F.TBL_CLIENTE_CLI_NUM_ID_CLI 
                      LEFT JOIN TBL_TIPO_TIP T ON T.NUM_ID_TIP = F.TBL_TIPO_TIP_NUM_ID_TIP 
                      LEFT JOIN TBL_MARCA_MAR M ON M.NUM_ID_MAR = F.TBL_MARCA_MAR_NUM_ID_MAR
                      LEFT JOIN TBL_MODELO_MOD MO ON MO.NUM_ID_MOD = F.TBL_MODELO_MOD_NUM_ID_MOD
                      LEFT JOIN TBL_COR_COR CO ON CO.NUM_ID_COR = F.TBL_COR_COR_NUM_ID_COR
            
                      WHERE F.NUM_ID_FR = $rowOs->TBL_FROTA_FR_NUM_ID_FR");

                 $sql_frota->execute();
    
                while($row_frota = $sql_frota->fetch(PDO::FETCH_OBJ)){?>

                    <div class="form-row" >
                        <div class="form-group input-group-sm col-md-3 "><label for="Nome">ID</label>
                            <input name="Nome" value="<?php echo $rowOs->TBL_FROTA_FR_NUM_ID_FR; ?>" readonly="readonly" class="form-control"  />   		      
                        </div>
                        <div class="form-group input-group-sm col-md-3 "><label for="Tipo">Tipo</label>
                            <input name="Tipo" value="<?php echo $row_frota->TXT_NOME_TIP; ?>" readonly="readonly" class="form-control"  />   		      
                        </div> 
                        <div class="form-group input-group-sm col-md-3 "><label for="Marca">Marca</label>
                            <input name="Marca" value="<?php echo $row_frota->TXT_NOME_MAR; ?>" readonly="readonly" class="form-control"  />   		      
                        </div>                        
                        <div class="form-group input-group-sm col-md-3 "><label for="Modelo">Modelo</label>
                            <input name="Modelo" value="<?php echo $row_frota->TXT_NOME_MOD; ?>" readonly="readonly" class="form-control"  />   		      
                        </div>                        
                        <div class="form-group input-group-sm col-md-4 "><label for="Placa">Placa</label>
                            <input name="Placa" value="<?php echo $row_frota->TXT_PLACA_FR; ?>" readonly="readonly" class="form-control"  />   		      
                        </div>                        
                        <div class="form-group input-group-sm col-md-4 "><label for="Chassi">Chassi</label>
                            <input name="Chassi" value="<?php echo $row_frota->TXT_CHASSI_FR; ?>" readonly="readonly" class="form-control"  />   		      
                        </div>                        
                        <div class="form-group input-group-sm col-md-4 "><label for="Cor">Cor</label>
                            <input name="Cor" value="<?php echo $row_frota->TXT_NOME_COR; ?>" readonly="readonly" class="form-control"  />   		      
                        </div>                        
                    </div>
                <?php }//fim select pegar dados do equipamento ?>
            </td>
        </tr>       
        <tr>        
            <td colspan="4"><h4>Dados do Orcamento</h4>              
                <div class="form-row">
                    <div class="form-group input-group-sm col-md-3 ">
                        <label for="ID">Numero</label>
                        <input name="ID" value="<?php echo $rowOs->NUM_ID_ORC; ?>" readonly="readonly" class="form-control"  />   		      
                    </div>
                    <div class="form-group input-group-sm col-md-9 ">
                        <label for="Consultor">Consultor</label>
                            <?php   //selecionar o login do usuario que executou a ordem de servico
                                $usu = $rowOs->TBL_USUARIO_USU_NUM_ID_USU;
                                $sql_login = $con->prepare("SELECT TXT_NOME_USU FROM TBL_USUARIO_USU WHERE NUM_ID_USU = '$usu'");
                                $sql_login->execute();
                                $nomeTecnico = $sql_login->fetchColumn();
                            ?>
                            <input name="Consultor" value="<?php echo $nomeTecnico; ?>" readonly="readonly" class="form-control"  />   		      
                    </div>

                    <div class="form-group col-md-3 input-group-sm"><label>Valor Total</label>
                        <input title="VALOR TOTAL DE SERVICOS E PECAS" value="R$<?php $total = $rowOs->VAL_TOTAL_ORC; echo $rowOs->VAL_TOTAL_ORC ?>" readonly="readonly" class="form-control" readonly /> </div> 

                        <div class="form-group col-md-3 input-group-sm"><label>Total Desconto</label>
                        <input title="VALOR TOTAL DE DESCONTOS" value="R$<?php $totalDescontos = $rowOs->VAL_DESCONTO_ORC; echo $rowOs->VAL_DESCONTO_ORC ?>" readonly="readonly" class="form-control" readonly /> </div> 

                        <div class="form-group col-md-3 input-group-sm"><label>Valor Final</label>
                        <input title="VALOR FINAL A SER PAGO" value="R$<?php $totalFinal = $rowOs->VAL_FINAL_ORC; echo $rowOs->VAL_FINAL_ORC ?>" readonly="readonly" class="form-control" readonly /> </div> 
                        
                        <div class="form-group col-md-3 input-group-sm"><label>Condicao de Pagamento</label>
                        <input title="CONDICAO DE PAGAMENTO" value="<?php $condicaoPagamento = $rowOs->TXT_CONDICAO_PAGAMENTO_ORC; echo $rowOs->TXT_CONDICAO_PAGAMENTO_ORC ?>" readonly="readonly" class="form-control" readonly /> </div>  
                        
                        <?php  } ?>
    
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <div class="table-responsive">      
                <table class=" table table-striped table-bordered table-sm">               
                        <thead class="thead-dark">      
                            <tr align="center">
                                    <th>Servico</td>
                                    <th>Valor</td>                   
                                    <th>Desconto</td>
                                    <th>Total</td>                     
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include "conexao.php";
                            $sqlItem = $con->prepare("SELECT * FROM TBL_ITEM_SERVICO_ORC WHERE TBL_ORCAMENTO_ORC_NUM_ID_ORC = '$valor'");
                            $sqlItem->execute();
                                while ($rowItem = $sqlItem->fetch(PDO::FETCH_OBJ)){
                        ?>        
                            <tr align="center">          
                                <td align="left">
                                    <?php
                                        $id = $rowItem->TBL_SERVICO_SER_NUM_ID_SER;
                                        $sqlItemNome = $con->prepare("SELECT TXT_NOME_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$id'");
                                        $sqlItemNome->execute();
                                        echo $nomeServico = $sqlItemNome->fetchColumn()
                                    ?>
                                </td>
                                    <td>R$ <?php echo number_format($rowItem->VAL_VALOR_SERVICO_ORC,2) ?></td>
                                    <td>R$ <?php echo number_format($rowItem->VAL_DESCONTO_SERVICO_ORC,2) ?></td>
                                    <td>R$ <?php echo number_format($rowItem->VAL_FINAL_SERVICO_ORC,2) ?></td>
                                    <?php $totalServicos = $totalServicos + $rowItem->VAL_FINAL_SERVICO_ORC ?>
                                    
                            </tr>
                        </tbody>
                        <?php }  ?> 
              </table>
                                </div>            
            </td>
        </tr>
        <tr>
            <td colspan="2">
            <div class="table-responsive">     
              <table width="100%" class=" table table-striped table-bordered table-sm ">                  
                  <thead class="thead-dark">        
                  <tr align="center">
                        <th>Peca</td>
                        <th>Unitario</td>
                        <th>QTD</td>
                        <th>Valor</td>                   
                        <th>Desconto</td>
                        <th>Total</td>
                              
                  </tr>
                  </thead>
                  <?php
                      include "conexao.php";
                      $sqlItem = $con->prepare("SELECT * FROM TBL_ITEM_PECA_ORC WHERE TBL_ORCAMENTO_ORC_NUM_ID_ORC = '$valor'");
                      $sqlItem->execute();
                          while ($rowItem = $sqlItem->fetch(PDO::FETCH_OBJ)){
                  ?>  
                  <tbody>      
                  <tr align="center">          
                      <td align="left">
                          <?php
                            $id = $rowItem->TBL_PECA_PEC_NUM_ID_PEC;
                            $sqlItemNome = $con->prepare("SELECT TXT_NOME_PEC FROM TBL_PECA_PEC WHERE NUM_ID_PEC = '$id'");
                            $sqlItemNome->execute();
                            echo $nomePeca = $sqlItemNome->fetchColumn()
                          ?>
                      </td>
                            <td>R$ <?php echo number_format($rowItem->VAL_VALOR_PECA_ORC / $rowItem->NUM_QUANTIDADE_PECA_ORC,2) ?></td>
                            <td><?php echo $rowItem->NUM_QUANTIDADE_PECA_ORC ?></td>
                            <td>R$ <?php echo number_format($rowItem->VAL_VALOR_PECA_ORC,2) ?></td>
                            <td>R$ <?php echo number_format($rowItem->VAL_DESCONTO_PECA_ORC,2) ?></td>
                            <td>R$ <?php echo number_format($rowItem->VAL_FINAL_PECA_ORC,2) ?></td>
                            <?php $totalProdutos = $totalProdutos + $rowItem->VAL_FINAL_PECA_ORC ?>
                  </tr>
                  <?php }  ?> 
                   </tbody>
              </table>            
                          </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <p><b>Produtos:</b> R$<?php echo number_format($totalProdutos,2) ?><br> 
                <b>Servicos:</b> R$<?php echo number_format($totalServicos,2) ?><br> 
                <b>Descontos:</b> R$<?php echo number_format($totalDescontos,2) ?><br> 
                <b>Total:</b> R$<?php echo number_format($total,2) ?><br> 
                <b>Final:</b> R$<?php echo number_format($totalFinal,2) ?><br> 
                <b>Condicao Pagamento:</b> <?php echo $condicaoPagamento; ?></p>               
               
            </td>
        </tr>
</table>
</body>
</html>

<?php
	}//fim status de os nao permitido//
?>
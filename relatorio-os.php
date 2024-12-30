<?php 
    //LIBERACAO TECNICO PARA APROVAR E EXECUTAR SERVICO DAS OS
    
    include "conexao.php";
    
    $valor = base64_decode($_GET['id']);	
    
    $sqlOs = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$valor'");		
    $sqlOs->execute();
    //caso a os esteja com status nao permitido
    if($sqlOs->rowCount() <=0){	
        echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-apontamento.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";		
    }else{
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 
 <title>SGINFO - Sistema de Gestao de Informatica </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="author" content="Adriano Nogueira - Desenvolvedor">
  <meta content= "SGinfo - Sistema de Gestao de Informatica" name="description">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">
   <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
   <link rel="stylesheet" href="bootstrap/bootstrap-icons.css">
   
   <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
   <script src="bootstrap/popper.min.js"></script>
   <script src="bootstrap/bootstrap.min.js"></script>
   
 </head>
<body>
<table width="100%" class="table"> 
    <tr>
        <td width="50%">
            <img src="imagens/logo techfy.png" width="40%" height="90" />     
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
</table>
<table width="100%" class="table-responsive"> 
    <tr>
        <td>            
        <legend align="center"><h3>Impressao de Ordem de Servico</h3></legend>
            <h4>Dados de Cliente</h4>             
                <?php	//seleciona nome e telefone do cliente da ordem de servico
                  $cli = $rowOs->TBL_CLIENTE_CLI_NUM_ID_CLI;
                  $sql_nome = $con->prepare("SELECT TXT_RAZAO_CLI,TXT_TELEFONE_CLI, TXT_EMAIL_CLI  FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$cli'");
                  $sql_nome->execute();
                  while($row_nome = $sql_nome->fetch(PDO::FETCH_OBJ)){
                ?>                       
                    <div class="form-row ">
                        <div class="form-group col-md-2 input-group-sm mb-3 ">
                          <label for="id"><strong>ID</strong></label>              
                          <input name="id"value="<?php echo $rowOs->TBL_CLIENTE_CLI_NUM_ID_CLI; ?>" readonly="readonly" class="form-control"  />        
                        </div> 
                        <div class="form-group input-group-sm col-md-5 ">
                            <label for="Nome"><strong>Nome</strong></label>
                            <input name="Nome" value="<?php echo $row_nome->TXT_RAZAO_CLI; ?>" readonly="readonly" class="form-control"  />   		      
                        </div> 
                        <div class="form-group input-group-sm col-md-2 ">
                            <label for="telefone"><strong>Telefone</strong></label>
                            <input name="telefone" value="<?php echo $row_nome->TXT_TELEFONE_CLI; ?>" readonly="readonly" class="form-control"  />    		      
                        </div> 
                        <div class="form-group input-group-sm col-md-3 ">
                            <label for="tipo"><strong>Email</strong></label>
                            <input name="Email" value="<?php echo $row_nome->TXT_EMAIL_CLI; ?>" readonly="readonly" class="form-control"  />   		      
                        </div> 
                    </div>
                <?php }//fim nome e telefone do cliente ?> 
            <h4>Dados de  Equipamento</h4>         
              <?php 
                $equipamento = $rowOs->TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP;
                //select para pegar tipo de equipamento e serial E.TXT_TIPO_EQUIP, E.TXT_MODELO_EQUIP,E.TXT_SERIAL_EQUIP,
                 $sql_equipamento = $con->prepare("SELECT NUM_ID_EQUIP, TXT_TIPO_EQUIP, TXT_MODELO_EQUIP, TXT_MARCA_EQUIP, TXT_SERIAL_EQUIP

                      FROM tbl_equipamento_equip 
           
                      WHERE NUM_ID_EQUIP = $rowOs->TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP");

                 $sql_equipamento->execute();
    
                while($row_equipamento = $sql_equipamento->fetch(PDO::FETCH_OBJ)){?>

                    <div class="form-row ">
                        <div class="form-group input-group-sm col-md-2 "><label for="Nome"><strong>ID</strong></label>
                            <input name="Nome" value="<?php echo $rowOs->TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP; ?>" readonly="readonly" class="form-control"  />   		      
                        </div>
                        <div class="form-group input-group-sm col-md-3 "><label for="Tipo"><strong>Tipo</strong></label>
                            <input name="Tipo" value="<?php echo $row_equipamento->TXT_TIPO_EQUIP; ?>" readonly="readonly" class="form-control"  />   		      
                        </div> 
                        <div class="form-group input-group-sm col-md-2 "><label for="Marca"><strong>Modelo</strong></label>
                            <input name="Marca" value="<?php echo $row_equipamento->TXT_MODELO_EQUIP ?>" readonly="readonly" class="form-control" />   		      
                        </div>                        
                        <div class="form-group input-group-sm col-md-2 "><label for="Modelo"><strong>Marca</strong></label>
                            <input name="Modelo" value="<?php echo $row_equipamento->TXT_MARCA_EQUIP ?>" readonly="readonly" class="form-control"  />   		      
                        </div>                        
                        <div class="form-group input-group-sm col-md-3 "><label for="Placa"><strong>Serial</strong></label>
                            <input name="Placa" value="<?php echo $row_equipamento->TXT_SERIAL_EQUIP; ?>" readonly="readonly" class="form-control"  />   		      
                        </div>                        
                      
                    </div>
                <?php }//fim select pegar dados do equipamento ?>
                <h4>Dados e Solicitacoes</h4>              
                <div class="form-row ">
                    <div class="form-group input-group-sm col-md-3 ">
                        <label for="ID"><strong>ID</strong></label>
                        <input name="ID" value="<?php echo $rowOs->NUM_ID_OS; ?>" readonly="readonly" class="form-control"  />   		      
                    </div>
                    <div class="form-group input-group-sm col-md-3 ">
                        <label for="Tipo"><strong>Tipo</strong></label>
                        <input name="Tipo" value="<?php echo $rowOs->TXT_TIPO_OS; ?>" readonly="readonly" class="form-control"  />   		      
                    </div>
                    <div class="form-group input-group-sm col-md-6 ">
                        <label for="Consultor"><strong>Consultor</strong></label>
                            <?php   //selecionar o login do usuario que executou a ordem de servico
                                $usu = $rowOs->TBL_USUARIO_USU_NUM_ID_USU;
                                $sql_login = $con->prepare("SELECT TXT_NOME_USU FROM TBL_USUARIO_USU WHERE NUM_ID_USU = '$usu'");
                                $sql_login->execute();
                                $nomeConsultor = $sql_login->fetchColumn();
                            ?>
                            <input name="Consultor" value="<?php echo $nomeConsultor; ?>" readonly="readonly" class="form-control"  />   		      
                    </div>
                    <div class="form-group input-group-sm col-md-12 "><label for="DadosGerais"><strong>Dados Gerais</strong></label>
                        <input name="DadosGerais" value="<?php echo $rowOs->TXT_DADOSGERAIS_OS; ?>" readonly="readonly" class="form-control"  />   		      
                    </div> 
                    <div class="form-group input-group-sm col-md-12 "><label for="Solicitacoes"><strong>Solicitacoes</strong></label>
                        <input name="Solicitacoes" value="<?php echo $rowOs->TXT_RECLAMACAO_OS; ?>" readonly="readonly" class="form-control"  />   		      
                    </div> 

                    <div class="form-group input-group-sm col-md-12"><label><strong>Defeito Constatado pelo Tecnico</strong></label>
                        <textarea name="textarea" class="form-control"  disabled="disabled" id="textarea"><?php echo $rowOs->TXT_DEFEITO_OS ?></textarea>
                    </div>

                        <div class="form-group input-group-sm col-md-12"><label><strong>Solucao Efetuada pelo tecnico</strong></label>
                        <textarea name="textarea" class="form-control"  disabled="disabled" id="textarea"><?php echo $rowOs->TXT_RESOLUCAO_OS ?></textarea>
                    </div>

                    <div class="form-group col-md-4 input-group-sm"><label>Valor Total</label>
                        <input title="VALOR TOTAL DE SERVICOS E PECAS" value="R$<?php echo number_format($rowOs->VAL_TOTAL_OS,2) ?>" readonly="readonly" class="form-control" readonly /> </div> 

                        <div class="form-group col-md-4 input-group-sm"><label>Total Desconto</label>
                        <input title="VALOR TOTAL DE DESCONTOS" value="R$<?php echo number_format($rowOs->VAL_DESCONTO_OS,2) ?>" readonly="readonly" class="form-control" readonly /> </div> 

                        <div class="form-group col-md-4 input-group-sm"><label>Valor Final</label>
                        <input title="VALOR FINAL A SER PAGO" value="R$<?php echo number_format($rowOs->VAL_FINAL_OS,2) ?>" readonly="readonly" class="form-control" readonly /> </div> 
                    <?php	//CAPTURA DATA INICIO E ENCERRAMENTO DA ORDEM DE SERVICO
                    $data_inicio = $rowOs->DTH_ABERTURA_OS; $data_final =  $rowOs->DTH_ENCERRAMENTO_OS; $fimgarantia = $rowOs->DTA_FIMGARANTIA_OS; } ?>    
                   </td>          
    </tr>
</table>
            <div class="table-responsive">      
                <table class=" table table-striped table-bordered table-sm">               
                        <thead class="thead-dark">      
                            <tr align="center">
                                    <th>Servico</td>
                                    <th>Valor</td>                   
                                    <th>Desconto</td>
                                    <th>Total</td>
                                    <th>Inicio</td>
                                    <th>Termino</td>                        
                                    <th>Mecanico</td>      
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include "conexao.php";
                            $sqlItem = $con->prepare("SELECT * FROM TBL_ITEM_SERVICO_OS WHERE TBL_ORDEMSERVICO_OS_NUM_ID_OS = '$valor'");
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
                                    <td>R$ <?php echo number_format($rowItem->VAL_VALOR_SERVICO_OS,2) ?></td>
                                    <td>R$ <?php echo number_format($rowItem->VAL_DESCONTO_SERVICO_OS,2) ?></td>
                                    <td>R$ <?php echo number_format($rowItem->VAL_VALOR_FINAL_SERVICO_OS,2) ?></td>
                                    <td><?php echo date("d/m/Y  H:i:s",strtotime($rowItem->DTH_INICIO_SERVICO_OS)) ?></td>					
                                    <td><?php echo date("d/m/Y  H:i:s",strtotime($rowItem->DTH_TERMINO_SERVICO_OS)) ?></td>
                                    <!--Buscar nome do mecanico-->
                                    <?php
                                        $idTecnico = $rowItem->TBL_TECNICO_TEC_NUM_ID_TEC;
                                        $sqlNomeTecnico = $con->prepare("SELECT TXT_CODIGO_TEC FROM TBL_TECNICO_TEC WHERE NUM_ID_TEC = '$idTecnico'");
                                        $sqlNomeTecnico->execute();
                                        $nomeTecnico = $sqlNomeTecnico->fetchColumn()
                                    ?>
                                    <td><?php echo $nomeTecnico ?></td>                                    
                                    <!--<td><?php echo $rowItem->TXT_STATUS_SERVICO_OS ?></td> RETIRADO EM 04/09/2023 POIS ESTA DESALINHANDO O RELATORIO-->
                            </tr>
                        </tbody>
                        <?php }  ?> 
              </table>
                                </div>            
           
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
                      $sqlItem = $con->prepare("SELECT * FROM TBL_ITEM_PECA_OS WHERE TBL_ORDEMSERVICO_OS_NUM_ID_OS = '$valor'");
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
                            <td>R$ <?php echo number_format($rowItem->VAL_VALOR_PECA_OS / $rowItem->NUM_QUANTIDADE_PECA_OS,2) ?></td>
                            <td><?php echo $rowItem->NUM_QUANTIDADE_PECA_OS ?></td>
                            <td>R$ <?php echo number_format($rowItem->VAL_VALOR_PECA_OS,2) ?></td>
                            <td>R$ <?php echo number_format($rowItem->VAL_DESCONTO_PECA_OS,2) ?></td>
                            <td>R$ <?php echo number_format($rowItem->VAL_FINAL_PECA_OS,2) ?></td>					
                            <!--<td><?php echo $rowItem->TXT_STATUS_PECA_OS ?></td> RETIRADO EM 04/09/2023 POIS ESTA DESALINHANDO O RELATORIO-->
                  </tr>
                  <?php }  ?> 
                   </tbody>
              </table>            
                          </div>

                <p class="lead sm">**Confirmo realização dos servicos acima listados tendo inicio no dia (<?php echo date("d/m/Y",strtotime($data_inicio)) ?>) e encerramento ao dia (<?php if($data_final<>""){echo date("d/m/Y",strtotime($data_final)) ;}?>).
            
                Informo que no dia (<?php if($fimgarantia<>""){echo date("d/m/Y",strtotime($fimgarantia)) ;}?>) ocorrerá termino da garantia de servico.
            
                Nossa garantia nao cobre mau uso, ou alterações indevidas no equipamento**</p>
                
                <img src="imagens/assinaturas.png" width="100%" height="80" />

</body>
</html>

<?php
	}//fim status de os nao permitido//
?>
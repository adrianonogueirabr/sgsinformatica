<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

include "conexao.php";
include "verifica.php";
  $id_os = base64_decode($_GET['id']);
  $res = $con->prepare("SELECT C.TXT_RAZAO_CLI ,C.TXT_TELEFONE_CLI, C.TXT_EMAIL_CLI, E.TXT_TIPO_EQUIP, E.TXT_MODELO_EQUIP,E.TXT_SERIAL_EQUIP,                       

                        OS.DTH_ABERTURA_OS, OS.TXT_DADOSGERAIS_OS, OS.TXT_RECLAMACAO_OS, OS.TXT_CANCELAMENTO_OS,OS.VAL_TOTAL_OS, VAL_DESCONTO_OS, VAL_FINAL_OS,
                        OS.DTH_ABERTURA_OS, OS.DTA_PREVISAO_OS, OS.DTH_ENCERRAMENTO_OS, OS.TXT_STATUS_OS   

                        FROM	TBL_ORDEMSERVICO_OS OS

                        LEFT JOIN TBL_CLIENTE_CLI C
                        ON C.NUM_ID_CLI = OS.TBL_CLIENTE_CLI_NUM_ID_CLI

                        LEFT JOIN TBL_EQUIPAMENTO_EQUIP E
                        ON E.NUM_ID_EQUIP = OS.TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP

                        WHERE NUM_ID_OS = ?");

  $res->bindParam(1,$id_os);
  $res->execute();

  while ($row = $res->fetch(PDO::FETCH_OBJ)){	  

?>
<table width="100%" class="table responsive">
    <tr>
        <td><?php include "inicial.php" ?></td>
    </tr>
    <tr>
        <td><legend class="p-4 table-primary">Detalhes da Ordem de Servico<legend></td>		
    </tr>
    <tr>
        <td> 
            <div class="form-row"> 
            <div class="form-group col-md-6 col-sm-6">
                <label for="tipo">Cliente</label><input  class="form-control" readonly="true" value="<?php echo $row->TXT_RAZAO_CLI ?>" />          
            </div> 

            <div class="form-group col-md-3 col-sm-6">
                <label for="tipo">Email</label><input  class="form-control" readonly="true" value="<?php echo $row->TXT_EMAIL_CLI ?>" />           
            </div> 

            <div class="form-group col-md-3 col-sm-6">
                <label for="tipo">Telefone</label><input  class="form-control" readonly="true" value="<?php echo $row->TXT_TELEFONE_CLI ?>" />           
            </div> 

            <div class="form-group col-md-6 col-sm-12">
                <label for="tipo">Situacao do Equipamento</label><input  class="form-control" readonly="true" value="<?php echo $row->TXT_DADOSGERAIS_OS ?>" />                           
            </div>

            <div class="form-group col-md-2 col-sm-12">              
                <label for="tipo">Tipo</label><input  class="form-control" readonly="true" value="<?php echo $row->TXT_TIPO_EQUIP ?>" />                                          
            </div>

            <div class="form-group col-md-2 col-sm-12">              
                <label for="tipo">Modelo</label><input  class="form-control" readonly="true" value="<?php echo $row->TXT_MODELO_EQUIP ?>" />                                                        
            </div>

            <div class="form-group col-md-2 col-sm-12">              
                <label for="tipo">Serial</label><input  class="form-control" readonly="true" value="<?php echo $row->TXT_SERIAL_EQUIP ?>" />                                                        
            </div>
            
            <div class="form-group col-md-12 col-sm-12">              
                <label for="tipo">Reclamacao</label><textarea  class="form-control" readonly="true"><?php echo $row->TXT_RECLAMACAO_OS ?>"</textarea>                                
            </div>

            <div class="form-group col-md-4 col-sm-6"><label>Valor Total</label>
                <input title="VALOR TOTAL DE SERVICOS E PECAS" value="R$ <?php echo number_format($row->VAL_TOTAL_OS,2) ?>" readonly="readonly" class="form-control" readonly /> 
            </div> 
            
            <div class="form-group col-md-4 col-sm-6"><label>Total Desconto</label>
                <input title="VALOR TOTAL DE DESCONTOS" value="R$ <?php echo number_format($row->VAL_DESCONTO_OS,2) ?>" readonly="readonly" class="form-control" readonly /> 
            </div> 

            <div class="form-group col-md-4 col-sm-6"><label>Valor Final</label>
                <input title="VALOR FINAL A SER PAGO" value="R$ <?php echo number_format($row->VAL_FINAL_OS,2) ?>" readonly="readonly" class="form-control" readonly /> 
            </div> 
            
            <?php if($row->TXT_CANCELAMENTO_OS<>""){?>
                <div class="form-group col-md-12 col-sm-12">              
                    <label for="tipo">Motivo do Cancelamento</label><input  class="form-control" readonly="true" value="<?php echo $row->TXT_CANCELAMENTO_OS ?>" />                 
                </div>
            <?php } ?>

            <div class="form-group col-md-3 col-sm-6">              
                <label for="tipo">Data Abertura</label><input  class="form-control" readonly="true" value="<?php echo date("d/m/Y H:i:s",strtotime($row->DTH_ABERTURA_OS)) ?>" />                 
            </div>

            <div class="form-group col-md-3 col-sm-6">              
                <label for="tipo">Data Previsao</label><input  class="form-control" readonly="true" value="<?php echo  date("d/m/Y",strtotime($row->DTA_PREVISAO_OS)) ?>" />                
            </div>

            <div class="form-group col-md-3 col-sm-6">              
                <label for="tipo">Data Encerramento</label><input  class="form-control" readonly="true" value="<?php if($row->DTH_ENCERRAMENTO_OS<>""){ echo date("d/m/Y H:i:s",strtotime($row->DTH_ENCERRAMENTO_OS));}else{ echo "S/D";} ?>" /> 
            </div>            

            <div class="form-group col-md-3 col-sm-6">               
                <label for="tipo">Status</label><input  class="form-control" readonly="true" value="<?php echo $row->TXT_STATUS_OS ?>" />       
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <table class=" table table-striped table-bordered table-sm">               
                        <thead>      
                            <tr align="center">
                                    <th>Servico</td>
                                    <th>Valor</td>                   
                                    <th>Desconto</td>
                                    <th>Total</td>
                                    <th>Inicio</td>
                                    <th>Termino</td>                        
                                    <th>Tecnico</td>      
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include "conexao.php";
                            $sqlItem = $con->prepare("SELECT * FROM TBL_ITEM_SERVICO_OS WHERE TBL_ORDEMSERVICO_OS_NUM_ID_OS = '$id_os'");
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
                                        $idMecanico = $rowItem->TBL_TECNICO_TEC_NUM_ID_TEC;
                                        $sqlNomeMecanico = $con->prepare("SELECT TXT_CODIGO_TEC FROM TBL_TECNICO_TEC WHERE NUM_ID_TEC = '$idMecanico'");
                                        $sqlNomeMecanico->execute();
                                        $nomeMecanico = $sqlNomeMecanico->fetchColumn()
                                    ?>
                                    <td><?php echo $nomeMecanico ?></td>                                    
                                    <!--<td><?php echo $rowItem->TXT_STATUS_SERVICO_OS ?></td> RETIRADO EM 04/09/2023 POIS ESTA DESALINHANDO O RELATORIO-->
                            </tr>
                        </tbody>
                        <?php }  ?> 
              </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" class=" table table-striped table-bordered table-sm ">                  
                  <thead>        
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
                      $sqlItem = $con->prepare("SELECT * FROM TBL_ITEM_PECA_OS WHERE TBL_ORDEMSERVICO_OS_NUM_ID_OS = '$id_os'");
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
        </td>
    </tr>
</table>
</body>
<?php
		}
?>
</html>
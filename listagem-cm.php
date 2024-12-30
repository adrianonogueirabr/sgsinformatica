<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>

<form name="listagem" method="post">
<table  class="table responsive">
    <tr>
        <td><?php include "inicial.php" ?></td>
    </tr>
    <tr>
        <td><legend class="p-4 table-primary">Listagem de Contratos<legend></td>		    
    </tr>
    <tr>
        <td>
            <table width="100%" class="table-hover table table-condensed table-bordered table-striped table-sm">
                <tr  class="table-success" align="center">			  
                    <th>ID</th>
                    <th>ATIVO</th>
                    <th align="left">CLIENTE</th>
                    <th>DATA INICIO</th>
                    <th>DATA TERMINO</th>
                    <th>VALOR</th>
                    <th>VENCIMENTO</th>
                    <th>USUARIO</th>
                    <th align="center">OPCOES</th>
                </tr>      
                
                <?php
                require_once 'contratoManutencaoDao.php';
                require_once 'conexao.php';

                $listagemContratos = new contratoManutencaoDao();        
                
                foreach($listagemContratos->ListarContratos() as $contrato):			
                ?> 
                <tr align="center"> 
                  <td><?php echo $contrato['NUM_ID_CM'];?></td>
                  <td><?php echo $contrato['TXT_ATIVO_CM'];?></td>
                  <td align="left"><?php echo $contrato['TXT_RAZAO_CLI']; $nc=$contrato['TXT_RAZAO_CLI']?></div></td>
                  <td><?php echo date("d/m/Y",strtotime($contrato['DTA_INICIO_CM']));?></td>
                  <td><?php echo date("d/m/Y",strtotime($contrato['DTA_TERMINO_CM']));?></td>
                  <td><?php echo $contrato['VAL_VALOR_CM'];?></td>
                  <td><?php echo $contrato['NUM_DIAPAGAMENTO_CM'];?></td>
                  <td><?php echo $contrato['TXT_LOGIN_USU'];?></td>
                  <td>
                      <a href="alterar-cm.php?id=<?php echo base64_encode($contrato['NUM_ID_CM'])?>&nc=<?php echo base64_encode($nc)?>"><img src="imagens/alterar.png" title="Clique para Alterar" width="26" height="25" /></a>
                            
                      <a href="gerar-fatura-cm.php?idContrato=<?php echo $contrato['NUM_ID_CM'];?>&idCliente=<?php echo $contrato['NUM_ID_CLI'];?>&valorCM=<?php echo $contrato['VAL_VALOR_CM'];?>&diaPag=<?php echo $contrato['NUM_DIAPAGAMENTO_CM'];?>"><img src="imagens/recibo.jpg" title="Clique para Gerar Fatura" width="26" height="25" onclick="return confirm('Confirma gerar fatura para pagamento em nome de <?php echo $contrato['TXT_RAZAO_CLI'];?>?')" /></a>
                  </td>
                </tr>
                <?php
                endforeach;
                ?>
              </table>
    </td>
    </tr>
  </table>
</form>
</body>
</html>
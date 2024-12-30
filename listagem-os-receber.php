<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
	include "conexao.php";
  $valorAcumulado = 0;	
	
	
	$sqlOs = $con->prepare("SELECT REC.NUM_ID_REC, C.TXT_RAZAO_CLI,C.VAL_SALDO_CLI, REC.VAL_VALOR_REC, REC.NUM_DOCUMENTO_REC 
    
                            FROM TBL_RECEBIMENTO_REC REC 
                            
                            LEFT JOIN TBL_CLIENTE_CLI C ON C.NUM_ID_CLI = TBL_CLIENTE_CLI_NUM_ID_CLI 
                            
                            WHERE TXT_STATUS_REC = 'ABERTO' AND TXT_REFERENTE_REC = 'OS' 
                            
                            order by NUM_ID_REC desc");

    if(!$sqlOs->execute()){ echo "Houve um erro no processamento da transacao " . mysqli_error();}

	if($sqlOs->rowCount()==0){
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=financeiro.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";
    }		

	
?>

<form name="listagem" method="post">
<table width="100%" class="table responsive">
      <tr>
          <td><?php include "inicial.php" ?></td>
      </tr>
      <tr>
          <td><legend class="p-4 table-primary">Listagem Recebimentos<legend></td>		
      </td>
    </tr>
    <tr>
        <td>
            <table  class="table-hover table  table-bordered responsive">
              <tr class="table-success" align="center">
                <th>ID</th>  	
                <th>Cliente</th>
                <th>Valor</th>
                <th>Ordem de Servico</th>
                <th></th>
              </tr>
            
              <?php
              while ($row = $sqlOs->fetch(PDO::FETCH_OBJ)){			
              ?>       	
              <tr align="center">
                  <td><?php echo $row->NUM_ID_REC ?></td>
                  <td align="left"><?php echo $row->TXT_RAZAO_CLI?></td>
                  <td>R$<?php echo number_format($row->VAL_VALOR_REC, 2) ?></td><?PHP $valorAcumulado = $valorAcumulado + $row->VAL_VALOR_REC ?>
                  <td><?php echo $row->NUM_DOCUMENTO_REC?></td>
                  <td><a href="dados-recebimento.php?os=<?php echo $row->NUM_DOCUMENTO_REC ?>&criterio=OS" class="btn btn-outline-primary btn-sm" role="button" aria-pressed="true">Receber</a></td>                
              </tr>
              <?php
              }
              ?>            
            </table>          
        </td>
    </tr>
    <tr>
        <td><legend align="right">Total a Receber R$<?php echo number_format($valorAcumulado, 2);?></legend></td>		      
    </tr>
</table>
</form>
</body>
</html>
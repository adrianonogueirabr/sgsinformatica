<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
	
	include "conexao.php";
  include "verifica.php";

    $criterio = $_POST["criterio"];
    $valorAcumulado = 0;
	
	if($criterio == "P"){
        $dtInicial = $_POST["dtInicial"];
        $dtFinal = $_POST["dtFinal"];

        $sqlRecebimento = $con->prepare("SELECT R.NUM_ID_REC, F.TXT_NOME_FP , U.TXT_LOGIN_USU ,  C.TXT_CPF_CNPJ_CLI , C.TXT_RAZAO_CLI , R.TXT_REFERENTE_REC , R.NUM_DOCUMENTO_REC , R.VAL_VALOR_REC , 
        DATE_FORMAT( R.DTH_RECEBIMENTO_REC, '%d/%c/%Y %H:%i:%s' ) AS DATE_RECEBIMENTO, R.TXT_STATUS_REC  

        FROM TBL_RECEBIMENTO_REC R

        LEFT JOIN TBL_CLIENTE_CLI C
        ON C.NUM_ID_CLI = TBL_CLIENTE_CLI_NUM_ID_CLI

        LEFT JOIN TBL_FORMA_PAGAMENTO_FP F
        ON F.NUM_ID_FP = TBL_FORMA_PAGAMENTO_FP_NUM_ID_FP

        LEFT JOIN TBL_USUARIO_USU U
        ON U.NUM_ID_USU = R.TBL_USUARIO_USU_NUM_ID_USU

        WHERE DATE(R.DTH_RECEBIMENTO_REC) BETWEEN '$dtInicial' AND '$dtFinal' ORDER BY NUM_ID_REC DESC");

		$sqlRecebimento->execute();
		  if($sqlRecebimento->rowCount()<=0){
	   	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-relatorio.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
	    }else if($criterio = ""){	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-relatorio.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";		
  }

?>

<table width="100%" class="table responsive">
      <tr>
          <td><?php include "inicial.php" ?></td>
      </tr>
      <tr>
          <td><legend class="p-4 table-primary">Listagem de Recebimentos<legend></td>		
      </td>
    </tr>
    <tr>
        <td>
            <table  class="table-hover table  table-bordered responsive table-sm">
            <tr  class="table-success" align="center">
            <th>ID</th>
            <th>FORMA PAGTO</th>            
            <th>CPF/CNPJ</th>
            <th>NOME</th>
            <th>REFERENTE</th>
            <th>DOCUMENTO</th>
            <th>VALOR</th>
            <th>DATA</th>
            <th>USUARIO</th>            
          </tr>
          <?php while ($row = $sqlRecebimento->fetch(PDO::FETCH_OBJ)){		?>                        
            <tr align="center">
            <td><?php echo $row->NUM_ID_REC ?></td>
            <td ><?php echo $row->TXT_NOME_FP ?></td>
            <td><?php echo $row->TXT_CPF_CNPJ_CLI ?></td>
            <td align="left"><?php echo $row->TXT_RAZAO_CLI ?></td>
            <td><?php echo $row->TXT_REFERENTE_REC ?></td>
            <td><?php echo $row->NUM_DOCUMENTO_REC ?></td>
            <td>R$<?php echo number_format($row->VAL_VALOR_REC,2); ?></td>  
            <?php $valorAcumulado = $valorAcumulado + $row->VAL_VALOR_REC; ?>         
            <td><?php echo $row->DATE_RECEBIMENTO ?> </td>
            <td><?php echo $row->TXT_LOGIN_USU ?></td>
            
          </tr>
          <?php	} ?>
          
          <legend align="right">Periodo <?php echo date("d/m/Y",strtotime($dtInicial)) ?> e <?php echo date("d/m/Y",strtotime($dtFinal))?> <br>
          <legend align="right">Total Recebido: R$<?php echo number_format($valorAcumulado, 2); }//fim while ?>
      </table>
      </td>
    </tr>
  </table>
  </body>
</html>
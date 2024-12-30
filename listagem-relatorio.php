<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Relatorios Financeiros</title>
</head>

<body>
<?php 
	
	include "conexao.php";

    $criterio = $_POST["criterio"];
    $valorAcumulado = 0;
	
	if($criterio == "P"){
        $dtInicial = $_POST["dtInicial"];
        $dtFinal = $_POST["dtFinal"];

        $sql = $con->prepare("SELECT R.NUM_ID_REC, F.TXT_NOME_FP , U.TXT_LOGIN_USU ,  C.TXT_CPF_CNPJ_CLI , C.TXT_RAZAO_CLI , R.TXT_REFERENTE_REC , R.NUM_DOCUMENTO_REC , R.VAL_VALOR_REC , 
        R.DTA_RECEBIMENTO_REC , R.TXT_STATUS_REC  

        FROM TBL_RECEBIMENTO_REC R

        LEFT JOIN TBL_CLIENTE_CLI C
        ON C.NUM_ID_CLI = TBL_CLIENTE_CLI_NUM_ID_CLI

        LEFT JOIN TBL_FORMAPAGAMENTO_FP F
        ON F.NUM_ID_FP = TBL_FORMA_PAGAMENTO_FP_NUM_ID_FP

        LEFT JOIN TBL_USUARIO_USU U
        ON U.NUM_ID_USU = R.TBL_USUARIO_USU_NUM_ID_USU

        WHERE R.DTA_RECEBIMENTO_REC BETWEEN '$dtInicial' AND '$dtFinal'");

		$sql->execute();
		  if($sql->rowCount()<=0){
	   	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-relatorio.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
	    }else if($criterio = ""){	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-relatorio.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";		
  }

?>

  <table width="100%" border="0">
    <tr>
      <td><legend><h3>
        <a href="consulta-relatorio.php"><img src="imagens/voltar.png" width="30" alt="" height="30" title="CLIQUE AQUI PARA VOLTAR CONSULTA" /></a>
      </h3></legend>
    </td>      
    </tr>   
    <tr>
    <td> 
          
		<table width="100%" class="table-hover table-condensed table-bordered">
          <tr class="p-3 mb-2 bg-info">
            <th><label>ID</label></th>
            <th><label>FORMA PAGTO</label></th>            
            <th><label>CPF/CNPJ</label></th>
            <th><label>NOME</label></th>
            <th><label>REFERENTE</label></th>
            <th><label>DOCUMENTO</label></th>
            <th><label>VALOR</label></th>
            <th><label>DATA</label></th>
            <th><label>USUARIO</label></th>
            <th><label>STATUS</label></th>
          </tr>
          <?php while ($row = $sql->fetch(PDO::FETCH_OBJ)){		?>                        
            <tr>
            <td><?php echo $row->NUM_ID_REC ?></td>
            <td><?php echo $row->TXT_NOME_FP ?></td>
            <td><?php echo $row->TXT_CPF_CNPJ_CLI ?></td>
            <td><?php echo $row->TXT_RAZAO_CLI ?></td>
            <td><?php echo $row->TXT_REFERENTE_REC ?></td>
            <td><?php echo $row->NUM_DOCUMENTO_REC ?></td>
            <td><?php echo $row->VAL_VALOR_REC ?></td>  
            <?php $valorAcumulado = $valorAcumulado + $row->VAL_VALOR_REC; ?>         
            <td><?php echo  date("d/m/Y",strtotime($row->DTA_RECEBIMENTO_REC)); ?> </td>
            <td><?php echo $row->TXT_LOGIN_USU ?></td>
            <td><?php echo $row->TXT_STATUS_REC ?></td>
          </tr>
          <?php	} ?>
          
          <h3>Recebimentos no Periodo <?php echo date("d/m/Y",strtotime($dtInicial)) ?> e <?php echo date("d/m/Y",strtotime($dtFinal))?> <br>
          <h3>Valor Total Recebido: R$<?php echo number_format($valorAcumulado, 1); }//fim while ?>
      </table>
      </td>
    </tr>
  </table>
  </body>
</html>
<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listagem de Recibos</title>
</head>

<body>
<?php 
	include "conexao.php";

	if($_POST['criterio']==""){
      $criterio = $_GET['criterio'];
      $valor = $_GET['valor'];
  }else{
    $criterio = $_POST['criterio'];
    $valor = $_POST['valor'];
  }

	$data1 = $_POST['data1'];
  $data2 = $_POST['data2'];
  
	
  
	
	if($criterio == "D"){
		$sqlRecibo = $con->prepare("SELECT * FROM `TBL_RECEBIMENTO_REC` WHERE DATE(DTH_RECEBIMENTO_REC) BETWEEN '$data1' and '$data2' AND TXT_STATUS_REC = 'RECEBIDO' order by NUM_ID_REC desc");
		if(!$sqlRecibo->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}
		if($sqlRecibo->rowCount() <= 0){
      
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-recibo.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
	}
	}else if($criterio == "I"){
		$sqlRecibo = $con->prepare("SELECT * FROM `TBL_RECEBIMENTO_REC` WHERE `TBL_CLIENTE_CLI_NUM_ID_CLI` = '$valor' and TXT_STATUS_REC = 'RECEBIDO' order by NUM_ID_REC desc");
    if(!$sqlRecibo->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}
    if($sqlRecibo->rowCount() <= 0){
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-recibo.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
	}
	}else if($criterio = ""){	
		  echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-recibo.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";		
	}	
?>

<form name="listagem" method="post">

<table width="100%" class="table responsive">
  <tr>
      <td><?php include "inicial.php" ?></td>
  <tr>
		  <td><legend class="p-4 table-primary">Listagem de Recibos<legend></td>
	</tr>
  </tr>
  <tr>
      <td>
      <table class="table-hover table table-bordered  responsive table-sm">
          <tr class="table-success" align="center">		 
          <th><label>NUMERO</label></th>
          <th><label>REFERENTE</label></th>
          <th><label>DATA EMISSAO</label></th>
          <th><label>USUARIO</label></th>
          <th><label>CLIENTE</label></th>
          <th><label>VALOR</label></th>
          <th><label>OPCOES</label></th>
        </tr>       
       	<?php
		while ($row = $sqlRecibo->fetch(PDO::FETCH_OBJ)){	
      	
		?>       	
        <tr align="center">
          <td><?php echo $row->NUM_ID_REC ?></td>
          <td><?php echo $row->TXT_REFERENTE_REC ?> - <?php echo $row->NUM_DOCUMENTO_REC ?></td>
          <td><?php echo date("d/m/Y H:i:s",strtotime($row->DTH_RECEBIMENTO_REC ));?></td>         
          
            <?php //capturar nome do USAURIO
            $id_usuario_recibo = $row->TBL_USUARIO_USU_NUM_ID_USU;
            $sql_nome_usuario = $con->prepare("SELECT * FROM TBL_USUARIO_USU WHERE NUM_ID_USU = $id_usuario_recibo");
            if(!$sql_nome_usuario->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}
            while ($row_nome_usuario = $sql_nome_usuario->fetch(PDO::FETCH_OBJ)){
            ?>
            <td><?php echo $row_nome_usuario->TXT_LOGIN_USU ?></td>
            <?php } ?>          
          
            <?php //capturar nome do cliente
            $id_cliente_recibo = $row->TBL_CLIENTE_CLI_NUM_ID_CLI;
            $sql_nome_cliente = $con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = $id_cliente_recibo");
            if(!$sql_nome_cliente->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}
            while ($row_nome_cliente = $sql_nome_cliente->fetch(PDO::FETCH_OBJ)){
            ?>
          <td align="left"><?php echo $row_nome_cliente->TXT_RAZAO_CLI ?></td>
          <?php } ?>
          <td>R$ <?php echo number_format($row->VAL_VALOR_REC,2) ?></td>
          <td>
          	<img src="imagens/cancelar.jpg" width="26" height="26" />
          	<a href="impressao-recibo.php?id=<?php echo $row->NUM_ID_REC ?>" target="_blank"><img src="imagens/imprimir.png" width="26" height="25" /></a>
          </td>
              
        </tr>
     
        <?php
		}
		?>
      
      </table>
      </td>
    </tr>
</table>
</form>
</body>
</html>
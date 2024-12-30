<?php
include "verifica.php";
	
$titulo	=	$_POST['codigo'];		
$novadata	=$_POST['novadata'];

include "conexao.php";

if($titulo==""){
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-titulo-receber.php'><script type=\"text/javascript\">alert(\"Problemas ao processar sua informação!\");</script>";

}else{	
	
		//buscar valor inicial do titulo

		$sqlTitulo = $con->prepare("SELECT VAL_VALOR_TR FROM `TBL_TITULORECEBER_TR` WHERE TXT_STATUS_TR = 'ABERTO' AND NUM_ID_TR = '$titulo'");
		if(!$sqlTitulo->execute()){echo 'Houve um erro no processamento da transacao ' . mysqli_error();}

		$valorInicial = $sqlTitulo->fetchColumn();
		
		//atualizar data de vencimento do titulo
		$sqlUpdate = $con->prepare("UPDATE TBL_TITULORECEBER_TR SET DTA_VENCIMENTO_TR = ?, VAL_JUROS_TR = 0, VAL_MULTA_TR = 0, VAL_FINAL_TR = ? WHERE NUM_ID_TR = ?");
		$sqlUpdate->bindParam(1,$novadata);
		$sqlUpdate->bindParam(2,$valorInicial);
		$sqlUpdate->bindParam(3,$titulo);


		$novadataConv = date("d/m/Y", strtotime($novadata));		
		
		if(! $sqlUpdate->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error());
		}
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-titulo-receber.php'><script type=\"text/javascript\">alert(\"Nova data aplicada com sucesso: $novadataConv !\");</script>";
		}
		
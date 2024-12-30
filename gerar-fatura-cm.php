<?php
include "verifica.php";

		$idContrato							=$_GET["idContrato"];
		$idCliente							=$_GET["idCliente"];
		$valorCM 	 						=str_replace(",",".",$_GET["valorCM"]);
		//$diaPag								=$_GET['diaPag'];
		
		
		//calcular proximo mes para vencimento da fatura
		$d = $_GET['diaPag']; $mes = date('m', strtotime('+1 months', strtotime(date('Y-m-d')))); $ano = date('Y');
		$novaDataPag = date($ano."-".$mes."-".$d);	


include "conexao.php";
		

	//TITULO A VISTA
				
			//REGISTRANDO O TITULO A RECEBER
			$sql = $con->prepare("INSERT INTO TBL_TITULORECEBER_TR VALUES (NULL,$empresa_usuario,'$id_usuario','$idCliente', now(), '$novaDataPag','CM$idContrato','$valorCM',0,0,0,'$valorCM',0,'$valorCM',NULL,'ABERTO')"); 
			if(! $sql->execute() ){
			  	die('Houve um erro no processamento da transação: ' . mysqli_error());
			}
			
			//ATUALIZANDO STATUS DE CLIENTE TITULO ABERTO
			$sql = $con->prepare("UPDATE TBL_CLIENTE_CLI SET TXT_TITULOABERTO_CLI='SIM' WHERE NUM_ID_CLI = $idCliente"); 
			if(! $sql->execute() ){
			  	die('Houve um erro no processamento da transação: ' . mysqli_error());
			}
			
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-cm.php'><script type=\"text/javascript\">alert(\"Fatura gerada com sucesso!\");</script>";	

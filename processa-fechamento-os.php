<?php
include "verifica.php";

		$cp							=$_POST["condicaopagamento"];
		$id_os						=$_POST["id_os"];
		$id_cliente					=$_POST["id_cliente"];
		$datavencimento1			=$_POST["datavencimento1"];
		$valorfinal 				=$_POST["valorfinal"];


	

include "conexao.php";
		
	if($cp == 'VISTA'){
	//A VISTA
			$sqlRecebimento = $con->prepare("INSERT INTO TBL_RECEBIMENTO_REC (`NUM_ID_REC`, `TBL_EMPRESA_EMP_NUM_ID_EMP`, `TBL_FORMA_PAGAMENTO_FP_NUM_ID_FP`, `TBL_USUARIO_USU_NUM_ID_USU`, 
			
											`TBL_CLIENTE_CLI_NUM_ID_CLI`, `TXT_REFERENTE_REC`, `NUM_DOCUMENTO_REC`, `VAL_VALOR_REC`, `VAL_DESCONTO_REC`, `VAL_RECEBIDO_REC`, `DTH_RECEBIMENTO_REC`, 
											
											`TXT_STATUS_REC`) VALUES (NULL,'$empresa_usuario',0,0,'$id_cliente','OS',$id_os,$valorfinal,0,0,NULL,'ABERTO')"); 
		
			if(! $sqlRecebimento->execute() ){
			  	die('Houve um erro no processamento da transação: ' . mysqli_error());
			}
			
			$sqlAtualizaOs = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_CONDICAO_PAGAMENTO_OS = '$cp', TXT_STATUS_OS = 'FATURADA'  WHERE NUM_ID_OS = '$id_os'"); 
			if(! $sqlAtualizaOs->execute() ){
			  	die('Houve um erro no processamento da transação: ' . mysqli_error());
			}
			
		    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=fechamento-os.php'><script type=\"text/javascript\">alert(\"Fechamento executado com sucesso!\");</script>";	
	//fim cp == 1		
	}else if($cp == 3){
		////INTERNO
	
			$sql = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_CONDICAO_PAGAMENTO_OS = '$cp', DTA_ENCERRAMENTO_OS = now(), HOR_ENCERRAMENTO_OS = current_time() ,TXT_STATUS_OS = 'PG'  WHERE NUM_ID_OS = '$id_os'"); 
			if(! $sql->execute() )
			{
			  die('Houve um erro no processamento da transação: ' . mysqli_error());
			}
			
		    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=fechamento-os.php'><script type=\"text/javascript\">alert(\"Fechamento executado com sucesso!\");</script>";	
	//fim cp == 3		
	}else if($cp == 'TITULO'){
	//TITULO A 1X
		//ATUALIZANDO STATUS DA TABELA ORDEM DE SERVICO
			$sql = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_CONDICAO_PAGAMENTO_OS = '$cp', TXT_STATUS_OS = 'FATURADA'  WHERE NUM_ID_OS = '$id_os'"); 
			if(! $sql->execute() )
			{
			  die('Houve um erro no processamento da transação: ' . mysqli_error());
			}
			
			//REGISTRANDO O TITULO A RECEBER
			$sql = $con->prepare("INSERT INTO TBL_TITULORECEBER_TR VALUES (NULL,$empresa_usuario,'$id_usuario','$id_cliente', now(), '$datavencimento1','$id_os','$valorfinal',0,0,0,'$valorfinal',0,'$valorfinal',NULL,'ABERTO')"); 
			if(! $sql->execute() )
			{
			  die('Houve um erro no processamento da transação: ' . mysqli_error());
			}
			
			//ATUALIZANDO STATUS DE CLIENTE TITULO ABERTO
			$sql = $con->prepare("UPDATE TBL_CLIENTE_CLI SET TXT_TITULOABERTO_CLI='SIM' WHERE NUM_ID_CLI = $id_cliente"); 
			if(! $sql->execute() )
			{
			  die('Houve um erro no processamento da transação: ' . mysqli_error());
			}
			
		    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=fechamento-os.php'><script type=\"text/javascript\">alert(\"Fechamento executado com sucesso!\");</script>";	
	//fim cp == 4		
	}
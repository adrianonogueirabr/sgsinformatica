<?php
//incluida em 17/11/2020 para que retire o OS da frente do identificador do documento no titulo a receber pois vem OS246
function soNumero($str) {
	return preg_replace("/[^0-9]/", "", $str);
  }

include "verifica.php";
		
		$idOs 						=$_POST["idOs"];
		$totalreceber 				=$_POST["totalreceber"];
		$fp							=$_POST["formapagamento"];
		$valorrecebido				=$_POST["valorrecebido"];
		$id							=$_GET["id"];
		$criterio					=$_GET["criterio"];
		$idcliente					=$_POST["idcliente"];
		$titulo						=$_POST["titulo"];
		$desconto					=$_POST["desconto"];
		$saldoAtual					=$_POST["saldoCliente"];
		$descricao 					=strtoupper($_POST["descricao"]);
		$valorFinal 				=$_POST['valorFinal'];
 
include "conexao.php";
		
if($criterio == "OS"){

	if($valorrecebido == $totalreceber){	
	
			$sql = $con->prepare("UPDATE TBL_RECEBIMENTO_REC SET TBL_EMPRESA_EMP_NUM_ID_EMP = '$empresa_usuario', TBL_FORMA_PAGAMENTO_FP_NUM_ID_FP = '$fp', TBL_USUARIO_USU_NUM_ID_USU = '$id_usuario',VAL_DESCONTO_REC = '$desconto', VAL_RECEBIDO_REC = '$valorrecebido', DTH_RECEBIMENTO_REC = now(), TXT_STATUS_REC = 'RECEBIDO' WHERE NUM_DOCUMENTO_REC = '$id' AND TXT_REFERENTE_REC = '$criterio'"); 
		
			if(! $sql->execute() )
			{
			  	die('Houve um erro no processamento da transação: ' . mysqli_error());
			}
			
			$sql = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'PAGO'  WHERE NUM_ID_OS = '$id'"); 
			if(! $sql->execute() )
			{
			  	die('Houve um erro no processamento da transação: ' . mysqli_error());
			}
			
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=financeiro.php'><script type=\"text/javascript\">alert(\"Pagamento recebido com sucesso!\");</script>";
		}else{
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=dados-recebimento.php?os=$id&criterio=OS'><script type=\"text/javascript\">alert(\"Os valores precisam ser iguais,Total: $totalreceber e Informado: $valorrecebido!\");</script>";			
		}
	
			//fim se documento Ordem Servico		
}if($criterio == "TR"){

	if($valorrecebido == $valorFinal){

			$con->beginTransaction();			
			
			$sql = $con->prepare("UPDATE TBL_TITULORECEBER_TR SET VAL_PAGO_TR = '$valorrecebido',VAL_DESCONTO_TR = '$desconto' ,DTH_RECEBIDO_TR = now(),TXT_STATUS_TR = 'PAGO'  WHERE NUM_ID_TR = '$titulo'"); 
			if(! $sql->execute() ){
			  	die('Houve um erro no processamento da transação: ' . mysqli_error());
			  	$con->rollBack();
			}
			
			//ATUALIZANDO STATUS DE CLIENTE TITULO ABERTO
				$sqlTituloAberto = $con->prepare("SELECT * FROM TBL_TITULORECEBER_TR WHERE TBL_CLIENTE_CLI_NUM_ID_CLI = $idcliente AND TXT_STATUS_TR = 'ABERTO'");
				if(!$sqlTituloAberto->execute()){
					die('Houve um erro no processamento da transação: ' . mysqli_error());
			  		$con->rollBack();
				}else{
							if($sqlTituloAberto->rowCount()==0){
								$sql = $con->prepare("UPDATE TBL_CLIENTE_CLI SET TXT_TITULOABERTO_CLI='NAO' WHERE NUM_ID_CLI = $idcliente"); 
								if(! $sql->execute() ){
			  						die('Houve um erro no processamento da transação: ' . mysqli_error());
									  $con->rollBack();
								}
							}
				}

			//ATUALIZANDO STATUS DA OS PARA PG
			$idOs = soNumero($idOs);
			$sql1 = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'PAGO'  WHERE NUM_ID_OS = '$idOs'"); 
			if(! $sql1->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error());
				$con->rollBack();
			}

			$sql = $con->prepare("INSERT INTO TBL_RECEBIMENTO_REC VALUES(NULL,'$empresa_usuario','$fp','$id_usuario', '$idcliente', 'TR','$titulo','$valorFinal','$desconto','$valorrecebido',now(),'RECEBIDO')"); 
		
			if(! $sql->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error());
				$con->rollBack();
			}
			
			$con->commit();
			
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-titulo-receber.php'><script type=\"text/javascript\">alert(\"Pagamento realizado com sucesso!\");</script>";
			
		}else{
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=dados-recebimento.php?valor=$id&criterio=TR'><script type=\"text/javascript\">alert(\"Os valores precisam ser iguais,Total: $valorFinal e Informado: $valorrecebido!\");</script>";			
		}
		
	
}if($criterio == "AD"){

		//atualiza horario para o fuso Manaus
		$horafuso = new DateTime("now", new DateTimeZone("America/Manaus"));
		$horafuso = $horafuso->format("H:i:s ");	

		$con->beginTransaction();

		//REGSTRANDO DADOS NA TABELA RECEBIMENTO
		$sqlRecebimento = $con->prepare("INSERT INTO TBL_RECEBIMENTO_REC VALUES(NULL,'$empresa_usuario','$fp','$id_usuario', '$idcliente', 'AD',0,'$valorrecebido',0,'$valorrecebido',now(),'RECEBIDO')"); 
	
		if(! $sqlRecebimento->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error());
			$con->rollBack();
		}
		
		//REGSTRANDO DADOS NA TABELA MOVIMENTO		
		$sqlMovimento = $con->prepare("INSERT INTO TBL_MOVIMENTACAO_MOV VALUES(NULL,$empresa_usuario,'$fp','$id_usuario','$idcliente','$valorrecebido','$descricao',now(),'ENTRADA')"); 
	
		if(! $sqlMovimento->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error());
			$con->rollBack();
		}
		
		//ATUALIZANDO SALDO DE ADIANTAMENTO DO CLIENTE
		$novosaldo = $saldoAtual + $valorrecebido; 
		$sqlSaldo = $con->prepare("UPDATE TBL_CLIENTE_CLI SET VAL_SALDO_CLI='$novosaldo' WHERE NUM_ID_CLI = $idcliente"); 
		if(! $sqlSaldo->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error());
			$con->rollBack();
		}
						
		$con->commit();

		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=financeiro.php'><script type=\"text/javascript\">alert(\"Adiantamento realizado com sucesso!\");</script>";
		//echo $novosaldo;
	

}if($criterio == "TRAD"){

	if($valorrecebido == $valorFinal){

			//atualiza horario para o fuso Manaus
			$horafuso = new DateTime("now", new DateTimeZone("America/Manaus"));
			$horafuso = $horafuso->format("H:i:s");	

			$con->beginTransaction();

			//ATUALIZANDO STATUS DO TITULO PARA PG
			$sql = $con->prepare("UPDATE TBL_TITULORECEBER_TR SET VAL_PAGO_TR = '$valorrecebido', VAL_DESCONTO_TR = '$desconto',DTH_RECEBIDO_TR = now(),TXT_STATUS_TR = 'PAGO'  WHERE NUM_ID_TR = '$titulo'"); 
			if(! $sql->execute() )
			{
			  die('Houve um erro no processamento da transação: ' . mysqli_error());
			  $con->rollBack();
			}
			
			//ATUALIZANDO STATUS DE CLIENTE TITULO ABERTO
				$sqlTituloAberto = $con->prepare("SELECT * FROM TBL_TITULORECEBER_TR WHERE TBL_CLIENTE_CLI_NUM_ID_CLI = $idcliente AND TXT_STATUS_TR = 'ABERTO'");
				if(!$sqlTituloAberto->execute()){
					die('Houve um erro no processamento da transação: ' . mysqli_error());
			  		$con->rollBack();
				}else{
							
							if($sqlTituloAberto->rowCount()==0){
								$sql = $con->prepare("UPDATE TBL_CLIENTE_CLI SET TXT_TITULOABERTO_CLI='NAO' WHERE NUM_ID_CLI = $idcliente"); 
								if(! $sql->execute() ){
			  						die('Houve um erro no processamento da transação: ' . mysqli_error());
									  $con->rollBack();
								}
							}
				}

			//REGSTRANDO DADOS NA TABELA MOVIMENTO		
			$sql = $con->prepare("INSERT INTO TBL_MOVIMENTACAO_MOV VALUES(NULL,$empresa_usuario,$fp,'$id_usuario','$idcliente','$valorrecebido', 'BAIXA TITULO $titulo',now(),'SAIDA')"); 
	
			if(! $sql->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error());
				$con->rollBack();
			}
	
			//ATUALIZANDO SALDO DO CLIENTE
			$novosaldo = $saldoAtual - $valorrecebido;
			$sql = $con->prepare("UPDATE TBL_CLIENTE_CLI SET VAL_SALDO_CLI='$novosaldo' WHERE NUM_ID_CLI = $idcliente"); 
				if(! $sql->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error());
				$con->rollBack();
			}
				//ATUALIZANDO STATUS DA OS PARA PG
				$idOs = soNumero($idOs);
				$sql1 = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'PAGO'  WHERE NUM_ID_OS = '$idOs'"); 
				if(! $sql1->execute() ){
					die('Houve um erro no processamento da transação: ' . mysqli_error());
					$con->rollBack();
				}
					
			$con->commit();

			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=financeiro.php'><script type=\"text/javascript\">alert(\"Baixa realizado com sucesso!\");</script>";

		}else{
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=dados-recebimento.php?valor=$id&criterio=TRAD'><script type=\"text/javascript\">alert(\"Os valores precisam ser iguais,Total: $valorFinal e Informado: $valorrecebido!\");</script>";			
		}
		
}

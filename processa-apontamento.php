<?php
date_default_timezone_set('America/Manaus');
include "verifica.php";


		$id_os						=$_POST["id_os"];
		$id_servico					=$_POST["id_servico"];
		$tipo_os 	 				=$_POST["tipo_os"];
		$servico					=$_POST["servico"];
		$id_cliente					=$_POST["id_cliente"];
		$pessoa_cliente				=$_POST["pessoa_cliente"];
		$id_os_apontamento			=$_POST["id_os_apontamento"];
		$id_servico_apontamento		=$_POST["id_servico_apontamento"];
		$data1						=$_POST["data1"];
		$hora1						=$_POST["hora1"];
		$datahoraInicio = $data1 .' ' .  $hora1;
		$data2						=$_POST["data2"];
		$hora2						=$_POST["hora2"];
		$datahoraTermino = $data2 .' ' .  $hora2;
		$id_item_os					=$_POST["id_item_os"];
		
include "conexao.php";

$acao = $_GET['acao'];

if($acao == "adcionar"){
		
				$status_os = 'AP';
				if($tipo_os == "P"){

								switch($pessoa_cliente){
									case "F":						
										$sql_valor = $con->prepare("SELECT VAL_FISICA_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$servico'");
										if(! $sql_valor->execute()){die('Houve um erro ao buscar valor do servico: ' . mysqli_error());	}
										$valor = $sql_valor->fetchColumn();
									break;
									case "J":
										$sql_valor = $con->prepare("SELECT VAL_JURIDICA_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$servico'");
										if(! $sql_valor->execute()){die('Houve um erro ao buscar valor do servico: ' . mysqli_error());	}
										$valor = $sql_valor->fetchColumn();
									break;
								}											
				}else if($tipo_os == "A"){
						$sql_valor = $con->prepare("SELECT VAL_FISICA_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$servico'");
						if(! $sql_valor->execute()){die('Houve um erro ao buscar valor do servico: ' . mysqli_error());	}
						$valor = $sql_valor->fetchColumn();
						$status_os = 'AP';						
										
				}else if($tipo_os == "C"){
						$sql_valor = $con->prepare("SELECT VAL_CONTRATO_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$servico'");
						if(! $sql_valor->execute()){die('Houve um erro ao buscar valor do servico: ' . mysqli_error());	}
						$valor = $sql_valor->fetchColumn();
									
				}else if($tipo_os == "G"){
						$sql_valor = $con->prepare("SELECT VAL_GARANTIA_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$servico'");
						if(! $sql_valor->execute()){die('Houve um erro ao buscar valor do servico: ' . mysqli_error());	}
						$valor = $sql_valor->fetchColumn();						
				}else{					
					echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Erro ao capturar tipo de Ordem de Serviço\");</script>";	
				}				
				
				$sqlInserir = $con->prepare("INSERT INTO TBL_ITEMOS_ITOS(`NUM_ID_ITOS`, `TBL_USUARIO_USU_NUM_ID_USU`, `TBL_SERVICO_SER_NUM_ID_SER`, `TBL_ORDEMSERVICO_OS_NUM_ID_OS`, `DTA_INICIO_ITOS`, `HOR_INICIO_ITOS`, `DTA_TERMINO_ITOS`, `HOR_TERMINO_ITOS`, `VAL_VALOR_ITOS`, `TXT_STATUS_ITOS`)
					VALUES (NULL,?,?,?,null,null,null,null,?,?)"); 	

					$sqlInserir->bindParam(1,$id_usuario);
					$sqlInserir->bindParam(2,$servico);
					$sqlInserir->bindParam(3,$id_os);
					$sqlInserir->bindParam(4,$valor);
					$sqlInserir->bindParam(5,$status_os);
				
				if(! $sqlInserir->execute()){ die('Houve um erro no processamento da transação: ' . mysqli_error());}

				echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico registrado com sucesso!\");</script>";					

}else if($acao == "iniciar"){
	
		$id = $_GET['id'];
		$id_os = $_GET['os'];
				
			$sql_iniciar = $con->prepare("SELECT TXT_STATUS_ITOS FROM TBL_ITEMOS_ITOS WHERE NUM_ID_ITOS = $id");
			if(! $sql_iniciar->execute()){die('Houve um erro no processamento da transação: ' . mysqli_error());}
					
				$row_iniciar = $sql_iniciar->fetchColumn();
									
					switch($row_iniciar){
						
						case 'AP':
							$sql_atualiza_os = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'AN' WHERE NUM_ID_OS = '$id_os'");
							if(! $sql_atualiza_os->execute()){die('Houve um erro no processamento da transação: ' . mysqli_error());}

							//atualiza horario para o fuso Manaus
							$horafuso = new DateTime("now", new DateTimeZone("America/Manaus"));
							$horafuso = $horafuso->format("H:i:s");		
							
							$sql_atualiza_item = $con->prepare("UPDATE TBL_ITEMOS_ITOS SET DTA_INICIO_ITOS = now(), HOR_INICIO_ITOS = '$horafuso' ,TXT_STATUS_ITOS = 'AN' WHERE NUM_ID_ITOS = '$id'");
							if(! $sql_atualiza_item->execute()){die('Houve um erro no processamento da transação: ' . mysqli_error());}
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">lert(\"Servico iniciado com sucesso!\");</script>";
						break;							
						default:
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico nao iniciado, favor verificar status!\");</script>";
						break;
					}
	
}else if($acao == "terminar"){
	
		$id = $_GET['id'];
		$id_os = $_GET['os'];
				
			$sql_terminar = $con->prepare("SELECT TXT_STATUS_ITOS FROM TBL_ITEMOS_ITOS WHERE NUM_ID_ITOS = $id");
			if(! $sql_terminar->execute()){die('Houve um erro no processamento da transação: ' . mysqli_error());}
					
			$row_terminar = $sql_terminar->fetchColumn();				
					
					switch($row_terminar){
						
						case 'AN':							
							$horafuso = new DateTime("now", new DateTimeZone("America/Manaus"));
							$horafuso = $horafuso->format("H:i:s");	

							$sql_atualiza_item = $con->prepare("UPDATE TBL_ITEMOS_ITOS SET DTA_TERMINO_ITOS = now(), HOR_TERMINO_ITOS = '$horafuso' ,TXT_STATUS_ITOS = 'TE' WHERE NUM_ID_ITOS = '$id'");
							if(! $sql_atualiza_item->execute()){die('Houve um erro no processamento da transação: ' . mysqli_error());}


							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico terminado com sucesso!\");</script>";
						break;							
						default:
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico nao terminado, favor verificar status!\");</script>";
						break;
					}
}else if($acao == "encerraros"){
	
			$id_os = $_GET['idos'];
			$servicos_terminados = 'a';

				$sql_status_os = $con->prepare("SELECT TXT_STATUS_OS FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = $id_os");
				if(! $sql_status_os->execute()){die('Houve um erro no processamento da transação: ' . mysqli_error());}
				
					$status_os = $sql_status_os->fetchColumn();
					
					switch($status_os){						
						case 'AN':
								$sql_status_item_os = $con->prepare("SELECT * FROM `TBL_ITEMOS_ITOS` WHERE `TXT_STATUS_ITOS` <> 'TE' AND `TBL_ORDEMSERVICO_OS_NUM_ID_OS` = $id_os");
								if(! $sql_status_item_os->execute()){die('Houve um erro no processamento da transacao: ' . mysqli_error());}
								$row_status =$sql_status_item_os->rowCount();
								
									if($row_status > 0){
										echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Ordem de Servico possui item am aberto!\");</script>";										
									}else{
										$sql_update_status_os = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'TERMINADO',DTA_ENCERRAMENTO_OS = now() , HOR_ENCERRAMENTO_OS = current_time(), DTA_FIMGARANTIA_OS = DATE_ADD(CURDATE(), INTERVAL 90 DAY) WHERE NUM_ID_OS = '$id_os'");
										if(! $sql_update_status_os->execute()){die('Houve um erro no processamento da transacao: ' . mysqli_error());}

										$sql_atualiza_status_os_contrato_pg = $con->prepare("SELECT TXT_TIPO_OS FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = $id_os");
										if(! $sql_atualiza_status_os_contrato_pg->execute()){die('Houve um erro no processamento da transação: ' . mysqli_error());}
													
												$status_os_contrato = $sql_atualiza_status_os_contrato_pg->fetchColumn();
														if($status_os_contrato=='C' || $status_os_contrato=='G'){
															$sql_update_status_os_contrato_pg = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'PAGO' WHERE NUM_ID_OS = '$id_os'");
															$sql_update_status_os_contrato_pg->execute();
														}
											
											echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-apontamento.php'><script type=\"text/javascript\">alert(\"Ordem de Servico encerrada com sucesso!\");</script>";										
									}									
									
						break;							
						default:
								echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'>
								<script type=\"text/javascript\">alert(\"Ordem de Servico precisa estar  ANDAMENTO, atualmente: $status_os!\");</script>";
						break;						
					}
	
}else if($acao == "excluir"){
	//excluir apontamento
	
	$id = $_GET['id'];
	$id_os = $_GET['os'];
	
		$sqlDelete = $con->prepare("DELETE FROM TBL_ITEMOS_ITOS WHERE NUM_ID_ITOS = '$id'");	
			if(! $sqlDelete->execute() ){die('Houve um erro no processamento da transação: ' . mysqli_error());}
				echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico excluido com sucesso!\");</script>";	
	
}else if($acao == "corrigeapontamento"){
	//corrigir dados de apontamento apontamento

	$sql_atualiza_item = $con->prepare("UPDATE TBL_ITEM_SERVICO_OS SET DTH_INICIO_SERVICO_OS = ?, DTH_TERMINO_SERVICO_OS = ?  where `NUM_ID_SERVICO_OS`=?");

	$sql_atualiza_item->bindParam(1,$datahoraInicio);
	$sql_atualiza_item->bindParam(2,$datahoraTermino);
	$sql_atualiza_item->bindParam(3,$id_item_os);

	if(! $sql_atualiza_item->execute()){die('Houve um erro no processamento da transação: ' . mysqli_error());}

	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=corrigir-apontamento.php'><script type=\"text/javascript\">alert(\"Apontamento alterado com sucesso!\");</script>";	
	
}

?>

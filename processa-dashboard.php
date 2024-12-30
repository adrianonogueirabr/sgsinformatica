<?php
date_default_timezone_set('America/Manaus');
include "verifica.php";

	
include "conexao.php";

$acao = $_GET['acao'];

if($acao == "atualizar_dash_mensal"){
		
				$1 = ''
				if($tipo_os == "P"){
						/*desativado em 21/01/2020 pois o tipo de pessoa do cliente ja é capturado no formulario anterior
						$sql_pessoal_cliente = mysql_query("SELECT TXT_PESSOA_CLI FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$id_cliente'");
						if(! $sql_pessoal_cliente){die('Houve um erro ao buscar tipo de pessoa cliente: ' . mysql_error());	}
							$row_pessoa_cliente = mysql_fetch_row($sql_pessoal_cliente);
							$pessoa_cliente = $row_pessoa_cliente[0];*/
								switch($pessoa_cliente){
									case "F":						
										$sql_valor = mysql_query("SELECT VAL_FISICA_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$servico'");
										if(! $sql_valor){die('Houve um erro ao buscar valor do servico: ' . mysql_error());	}
										$row = mysql_fetch_row($sql_valor);
										$valor = $row[0];
									break;
									case "J":
										$sql_valor = mysql_query("SELECT VAL_JURIDICA_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$servico'");
										if(! $sql_valor){die('Houve um erro ao buscar valor do servico: ' . mysql_error());	}
										$row = mysql_fetch_row($sql_valor);
										$valor = $row[0];
									break;
								}											
				}else if($tipo_os == "A"){
					$sql_valor = mysql_query("SELECT VAL_FISICA_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$servico'");
						if(! $sql_valor){die('Houve um erro ao buscar valor do servico: ' . mysql_error());	}
						$row = mysql_fetch_row($sql_valor);
						$valor = $row[0];
						$status_os = 'AP';						
										
				}else if($tipo_os == "C"){
					$sql_valor = mysql_query("SELECT VAL_CONTRATO_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$servico'");
						if(! $sql_valor){die('Houve um erro ao buscar valor do servico: ' . mysql_error());	}
						$row = mysql_fetch_row($sql_valor);
						$valor = $row[0];	
									
				}else if($tipo_os == "G"){
					$sql_valor = mysql_query("SELECT VAL_GARANTIA_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$servico'");
						if(! $sql_valor){die('Houve um erro ao buscar valor do servico: ' . mysql_error());	}
						$row = mysql_fetch_row($sql_valor);
						$valor = $row[0];							
				}else{					
					echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Erro ao capturar tipo de Ordem de Serviço\");</script>";	
				}				
				$sql = mysql_query("INSERT INTO TBL_ITEMOS_ITOS VALUES (NULL,$id_usuario,'$servico','$id_os',null,null,null,null,'$valor','$status_os')"); 		
					if(! $sql ){ die('Houve um erro no processamento da transação: ' . mysql_error());	}		
				$sql = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'AP' WHERE NUM_ID_OS = '$id_os'"); 		
					if(! $sql )	{ die('Houve um erro no processamento da transação: ' . mysql_error());	}				
				echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico registrado com sucesso!\");</script>";					

}else if($acao == "aprovar"){	
	
		$id = $_GET['id'];
		$id_os = $_GET['os'];
				
			$sql_status = mysql_query("SELECT TXT_STATUS_ITOS FROM TBL_ITEMOS_ITOS WHERE NUM_ID_ITOS = $id");
			if(! $sql_status){die('Houve um erro no processamento da transação: ' . mysql_error());}
					
				$row_status = mysql_fetch_row($sql_status);
				$status = $row_status[0];
					
					switch($status){						
						case 'AO':							
							$sql_atualiza_item = mysql_query("UPDATE TBL_ITEMOS_ITOS SET TXT_STATUS_ITOS = 'AP' WHERE NUM_ID_ITOS = '$id'");
							if(! $sql_atualiza_item){die('Houve um erro no processamento da transação: ' . mysql_error());}
							
							$sql_status_os = mysql_query("SELECT * FROM TBL_ITEMOS_ITOS WHERE TBL_ORDEMSERVICO_OS_NUM_ID_OS = '$id_os' AND TXT_STATUS_ITOS = 'AO'"); 
									if(mysql_num_rows($sql_status_os)<>""){
										echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Existem servicos a serem aprovados ainda!\");</script>";	
									}else{
										$sql_update_status_os = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'AP' WHERE NUM_ID_OS = '$id_os'");
										echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico aprovado com sucesso!\");</script>";	
									}
						break;						
						case 'NA':							
							$sql_atualiza_item = mysql_query("UPDATE TBL_ITEMOS_ITOS SET TXT_STATUS_ITOS = 'AP' WHERE NUM_ID_ITOS = '$id'");
							if(! $sql_atualiza_item){die('Houve um erro no processamento da transação: ' . mysql_error());}
							
							$sql_status_os = mysql_query("SELECT * FROM TBL_ITEMOS_ITOS WHERE TBL_ORDEMSERVICO_OS_NUM_ID_OS = '$id_os' AND TXT_STATUS_ITOS = 'AO'"); 
									if(mysql_num_rows($sql_status_os)<>""){
										echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Existem servicos a serem aprovados ainda!\");</script>";	
									}else{
										$sql_update_status_os = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'AP' WHERE NUM_ID_OS = '$id_os'");
										echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico aprovado com sucesso!\");</script>";	
									}
						break;							
						default:
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico nao aprovado, favor verificar status!\");</script>";
						break;
					}
	
}else if($acao == "desaprovar"){	
			
		$id = $_GET['id'];
		$id_os = $_GET['os'];
				
			$sql_status = mysql_query("SELECT TXT_STATUS_ITOS FROM TBL_ITEMOS_ITOS WHERE NUM_ID_ITOS = $id");
			if(! $sql_status){die('Houve um erro no processamento da transação: ' . mysql_error());}
					
				$row_status = mysql_fetch_row($sql_status);
				$status = $row_status[0];
					
					switch($status){						
						case 'AO':							
							$sql_atualiza_item = mysql_query("UPDATE TBL_ITEMOS_ITOS SET TXT_STATUS_ITOS = 'NA' WHERE NUM_ID_ITOS = '$id'");
							if(! $sql_atualiza_item){die('Houve um erro no processamento da transação: ' . mysql_error());}
							
							$sql_zeravalor_item = mysql_query("UPDATE TBL_ITEMOS_ITOS SET VAL_VALOR_ITOS = 0 WHERE NUM_ID_ITOS = '$id'");
							if(! $sql_zeravalor_item){die('Houve um erro no processamento da transação: ' . mysql_error());}
							
							$sql_status_os = mysql_query("SELECT * FROM TBL_ITEMOS_ITOS WHERE TBL_ORDEMSERVICO_OS_NUM_ID_OS = $id_os AND TXT_STATUS_ITOS <> 'NA'"); 
								if(! $sql_status_os ){ die('Houve um erro no processamento da transação: ' . mysql_error());}
									if(mysql_num_rows($sql_status_os)<>""){
										echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico nao aprovado com sucesso!\");</script>";	
										$sql_update_status_os = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'PA' WHERE NUM_ID_OS = '$id_os'");if(! $sql_status_os ){ die('Houve um erro no atualizar status da OS: ' . mysql_error());}
									}else{
										$sql_update_status_os = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'NA' WHERE NUM_ID_OS = '$id_os'");
										echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"OS nao tem servicos aprovados, favor verificar!\");</script>";	
									}
						break;
						case 'AP':							
							$sql_atualiza_item = mysql_query("UPDATE TBL_ITEMOS_ITOS SET TXT_STATUS_ITOS = 'NA' WHERE NUM_ID_ITOS = '$id'");
							if(! $sql_atualiza_item){die('Houve um erro no processamento da transação: ' . mysql_error());}
							
							$sql_zeravalor_item = mysql_query("UPDATE TBL_ITEMOS_ITOS SET VAL_VALOR_ITOS = 0 WHERE NUM_ID_ITOS = '$id'");
							if(! $sql_zeravalor_item){die('Houve um erro no processamento da transação: ' . mysql_error());}
							
							$sql_status_os = mysql_query("SELECT * FROM TBL_ITEMOS_ITOS WHERE TBL_ORDEMSERVICO_OS_NUM_ID_OS = $id_os AND TXT_STATUS_ITOS <> 'NA'"); 
								if(! $sql_status_os ){ die('Houve um erro no processamento da transação: ' . mysql_error());}
									if(mysql_num_rows($sql_status_os)<>""){
										echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico nao aprovado com sucesso!\");</script>";	
									}else{
										$sql_update_status_os = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'NA' WHERE NUM_ID_OS = '$id_os'");
										echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"OS nao tem servicos aprovados, favor verificar!\");</script>";	
									}
						break;							
						default:
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico nao desaprovado, favor verificar status!\");</script>";
						break;
					}					
	
}else if($acao == "iniciar"){
	
		$id = $_GET['id'];
		$id_os = $_GET['os'];
				
			$sql_status = mysql_query("SELECT TXT_STATUS_ITOS FROM TBL_ITEMOS_ITOS WHERE NUM_ID_ITOS = $id");
			if(! $sql_status){die('Houve um erro no processamento da transação: ' . mysql_error());}
					
				$row_status = mysql_fetch_row($sql_status);
				$status = $row_status[0];
					
					switch($status){
						
						case 'AP':
							$sql_atualiza_os = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'AN' WHERE NUM_ID_OS = '$id_os'");
							if(! $sql_atualiza_os){die('Houve um erro no processamento da transação: ' . mysql_error());}	
							//atualiza horario para o fuso Manaus
							$horafuso = new DateTime("now", new DateTimeZone("America/Manaus"));
							$horafuso = $horafuso->format("H:i:s");		
							$sql_atualiza_item = mysql_query("UPDATE TBL_ITEMOS_ITOS SET DTA_INICIO_ITOS = now(), HOR_INICIO_ITOS = '$horafuso' ,TXT_STATUS_ITOS = 'AN' WHERE NUM_ID_ITOS = '$id'");
							if(! $sql_atualiza_item){die('Houve um erro no processamento da transação: ' . mysql_error());}
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">lert(\"Servico iniciado com sucesso!\");</script>";
						break;							
						default:
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico nao iniciado, favor verificar status!\");</script>";
						break;
					}
	
}else if($acao == "terminar"){
	
		$id = $_GET['id'];
		$id_os = $_GET['os'];
				
			$sql_status = mysql_query("SELECT TXT_STATUS_ITOS FROM TBL_ITEMOS_ITOS WHERE NUM_ID_ITOS = $id");
			if(! $sql_status){die('Houve um erro no processamento da transação: ' . mysql_error());}
					
				$row_status = mysql_fetch_row($sql_status);
				$status = $row_status[0];
					
					switch($status){
						
						case 'AN':
							$sql_atualiza_os = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'PA' WHERE NUM_ID_OS = '$id_os'");
							if(! $sql_atualiza_os){die('Houve um erro no processamento da transação: ' . mysql_error());}
							$horafuso = new DateTime("now", new DateTimeZone("America/Manaus"));
							$horafuso = $horafuso->format("H:i:s");	
							$sql_atualiza_item = mysql_query("UPDATE TBL_ITEMOS_ITOS SET DTA_TERMINO_ITOS = now(), HOR_TERMINO_ITOS = '$horafuso' ,TXT_STATUS_ITOS = 'TE' WHERE NUM_ID_ITOS = '$id'");
							if(! $sql_atualiza_item){die('Houve um erro no processamento da transação: ' . mysql_error());}
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico terminado com sucesso!\");</script>";
						break;							
						default:
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico nao terminado, favor verificar status!\");</script>";
						break;
					}
}else if($acao == "encerraros"){
	
			$id_os = $_GET['idos'];
			$servicos_terminados = 'a';

				$sql_status_os = mysql_query("SELECT TXT_STATUS_OS FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = $id_os");
				if(! $sql_status_os){die('Houve um erro no processamento da transação: ' . mysql_error());}
				
					$row_status = mysql_fetch_row($sql_status_os);
					$status_os = $row_status[0];
					
					switch($status_os){						
						case 'PA':
								$sql_status_item_os = mysql_query("SELECT * FROM `TBL_ITEMOS_ITOS` WHERE `TXT_STATUS_ITOS` <> 'TE' AND `TXT_STATUS_ITOS` <> 'NA'  AND `TBL_ORDEMSERVICO_OS_NUM_ID_OS` = $id_os");
								if(! $sql_status_item_os){die('House um erro no processamento da transacao: ' . mysql_error());}
								$row_status = mysql_num_rows($sql_status_item_os);
								
									if($row_status > 0){
											echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Ordem de Servico possui item am aberto!\");</script>";										
									}else{
											$sql_update_status_os = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'TE',DTA_ENCERRAMENTO_OS = now() , HOR_ENCERRAMENTO_OS = current_time(), DTA_FIMGARANTIA_OS = DATE_ADD(CURDATE(), INTERVAL 90 DAY) WHERE NUM_ID_OS = '$id_os'");
												
												//adcionado para encerrar e alterar stauts de OS de contrato para PG
												$sql_atualiza_status_os_contrato_pg = mysql_query("SELECT TXT_TIPO_OS FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = $id_os");
												if(! $sql_atualiza_status_os_contrato_pg){die('Houve um erro no processamento da transação: ' . mysql_error());}
													$row_os_contrato = mysql_fetch_row($sql_atualiza_status_os_contrato_pg);
													$status_os_contrato = $row_os_contrato[0];
														if($status_os_contrato=='C'){
															$sql_update_status_os_contrato_pg = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'PG' WHERE NUM_ID_OS = '$id_os'");
														}else if($status_os_contrato=='G'){
															$sql_update_status_os_contrato_pg = mysql_query("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'PG' WHERE NUM_ID_OS = '$id_os'");
														}
											
											echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-apontamento.php'><script type=\"text/javascript\">alert(\"Ordem de Servico encerrada com sucesso!\");</script>";										
									}

									
									
						break;							
						default:
								echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'>
								<script type=\"text/javascript\">alert(\"OS nao pode ser encerrada, favor verificar!\");</script>";
						break;						
					}
	
}else if($acao == "excluir"){
	//excluir apontamento
	
	$id = $_GET['id'];
	$id_os = $_GET['os'];
	
		$sql = mysql_query("DELETE FROM TBL_ITEMOS_ITOS WHERE NUM_ID_ITOS = '$id'");	
			if(! $sql ){die('Houve um erro no processamento da transação: ' . mysql_error());}
				echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico excluido com sucesso!\");</script>";	
	
}else if($acao == "corrigeapontamento"){
	//corrigir dados de apontamento apontamento
			
$sql_atualiza_item = mysql_query("UPDATE TBL_ITEMOS_ITOS SET DTA_INICIO_ITOS = '$data1', DTA_TERMINO_ITOS = '$data2', HOR_INICIO_ITOS = '$hora1',HOR_TERMINO_ITOS = '$hora2'  where `TBL_ORDEMSERVICO_OS_NUM_ID_OS` = '$id_os_apontamento' and `TBL_SERVICO_SER_NUM_ID_SER`='$id_servico_apontamento'");
if(! $sql_atualiza_item){die('Houve um erro no processamento da transação: ' . mysql_error());}

echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=corrigir-apontamento.php'><script type=\"text/javascript\">alert(\"Apontamento alterado com sucesso!\");</script>";	
	
}

?>

<?php

include "verifica.php";

	//funcao para atualizar valores na ordem de servico			
	function atualizaValorOS($numeroOrcamento){
		include "conexao.php";

		//if($tipoOperacao=='adciona'){

			//buscar valor total de servicos lancados
			$BuscarTotalServico = $con->prepare("SELECT SUM(VAL_VALOR_SERVICO_ORC) AS TOTALSERVICO, SUM(VAL_DESCONTO_SERVICO_ORC) AS TOTALDESCONTOSERVICO FROM TBL_ITEM_SERVICO_ORC WHERE TBL_ORCAMENTO_ORC_NUM_ID_ORC = $numeroOrcamento");
							
			if(!$BuscarTotalServico->execute()){
				return false;
			}else{	
				while ($rowItem = $BuscarTotalServico->fetch(PDO::FETCH_OBJ)){
					$valorServico = $rowItem->TOTALSERVICO;
					$valorDescontoServico = $rowItem->TOTALDESCONTOSERVICO;					
				}
			}
			
			//buscar valor total de pecas lancada
			$buscarTotalPeca = $con->prepare("SELECT SUM(VAL_VALOR_PECA_ORC) AS TOTALPECA, SUM(VAL_DESCONTO_PECA_ORC) AS TOTALDESCONTOPECA FROM TBL_ITEM_PECA_ORC WHERE TBL_ORCAMENTO_ORC_NUM_ID_ORC = $numeroOrcamento");

			if(!$buscarTotalPeca->execute()){
				return false;
			}else{
				while ($rowItem = $buscarTotalPeca->fetch(PDO::FETCH_OBJ)){
					$valorPeca = $rowItem->TOTALPECA;
					$valorDescontoPeca = $rowItem->TOTALDESCONTOPECA;					
				}
			}

				//soma de totais
				$novoValor = $valorPeca + $valorServico;
				$novoDesconto = $valorDescontoPeca + $valorDescontoServico;
				$novoFinal = $novoValor - $novoDesconto;

				//ATUALIZA OS VALORES NA ORDEM DE SERVICO
				$sqlAtualizaValoresOS = $con->prepare("UPDATE TBL_ORCAMENTO_ORC SET VAL_TOTAL_ORC = ?, VAL_DESCONTO_ORC = ?, VAL_FINAL_ORC = ? WHERE NUM_ID_ORC = ?");
				$sqlAtualizaValoresOS->bindParam(1,$novoValor);
				$sqlAtualizaValoresOS->bindParam(2,$novoDesconto);
				$sqlAtualizaValoresOS->bindParam(3,$novoFinal);
				$sqlAtualizaValoresOS->bindParam(4,$numeroOrcamento);

					if(!$sqlAtualizaValoresOS->execute() ){						
						return false;
					}else{
						return true;
					}			

	}

include "conexao.php";

$acao = $_GET['acao'];

switch($acao){	
case "incluirservico":	

	$id_orcamento = $_POST['id'];
	$id_servico = $_POST['servico'];

		$buscarPreco = $con->prepare("SELECT VAL_VALOR_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = ?");
		$buscarPreco->bindParam(1,$id_servico);
							
			if(!$buscarPreco->execute()){				
				echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=cadastro-orcamento.php?orcamento=$id_orcamento'><script type=\"text/javascript\">alert(\"Erro ao incluir servico!\");</script>";				
			}else{	
				$precoServico = $buscarPreco->fetchColumn();
			}		

				$sqlIncluirServico = $con->prepare("INSERT INTO TBL_ITEM_SERVICO_ORC (`TBL_SERVICO_SER_NUM_ID_SER`, `TBL_ORCAMENTO_ORC_NUM_ID_ORC`, `VAL_VALOR_SERVICO_ORC`, `VAL_DESCONTO_SERVICO_ORC`, `VAL_FINAL_SERVICO_ORC`)
													
					VALUES (?, ?, ?,0, ?)");

				$sqlIncluirServico->bindParam(1,$id_servico);
				$sqlIncluirServico->bindParam(2,$id_orcamento);
				$sqlIncluirServico->bindParam(3,$precoServico);
				$sqlIncluirServico->bindParam(4,$precoServico);
			
			if(! $sqlIncluirServico->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error($con));				
			}	
			
			if(atualizaValorOS($id_orcamento )){				
				$_SESSION['msg'] = "<div class='alert alert-success'>Servico incluido com sucesso!</div>"; 
				header("Location: cadastro-orcamento.php?orcamento=$id_orcamento");
							
			}else{				
				$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao incluir o servico!</div>"; 
				header("Location: cadastro-orcamento.php?orcamento=$id_orcamento");
				
			}

break;
case "incluirpeca":
	
	$id_orcamento = $_POST['id'];
	$id_peca = $_POST['peca'];
	$quantidade = $_POST['quantidade'];

		
		$buscarPreco = $con->prepare("SELECT VAL_VALOR_VENDA_PEC FROM TBL_PECA_PEC WHERE NUM_ID_PEC = ?");
		$buscarPreco->bindParam(1,$id_peca);
							
			if(!$buscarPreco->execute()){								
				$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao incluir peca!</div>"; 
				header("Location: cadastro-orcamento.php?orcamento=$id_orcamento");
			}else{	
				$precoPeca = $buscarPreco->fetchColumn();
			}
			
			$novoPrecoPeca = $precoPeca * $quantidade;

			$sqlIncluirPeca = $con->prepare("INSERT INTO TBL_ITEM_PECA_ORC (`TBL_ORCAMENTO_ORC_NUM_ID_ORC`, `TBL_PECA_PEC_NUM_ID_PEC`, 
			
				`NUM_QUANTIDADE_PECA_ORC`, `VAL_VALOR_PECA_ORC`, `VAL_DESCONTO_PECA_ORC`, `VAL_FINAL_PECA_ORC`)
												
				VALUES (?, ?, ?, ?, 0, ?)");
			
			$sqlIncluirPeca->bindParam(1,$id_orcamento);
			$sqlIncluirPeca->bindParam(2,$id_peca);
			$sqlIncluirPeca->bindParam(3,$quantidade);
			$sqlIncluirPeca->bindParam(4,$novoPrecoPeca);
			$sqlIncluirPeca->bindParam(5,$novoPrecoPeca);
			
			if(! $sqlIncluirPeca->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error($con));				
			}

			if(atualizaValorOS($id_orcamento )){				
				$_SESSION['msg'] = "<div class='alert alert-success'>Peca incluido com sucesso!</div>"; 
				header("Location: cadastro-orcamento.php?orcamento=$id_orcamento");
			}else{				
				$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao incluir peca!</div>"; 
				header("Location: cadastro-orcamento.php?orcamento=$id_orcamento");
			}

break;
case "removerservico":
	
	$id_item_servico = $_GET['id_item_servico'];
	$id = $_GET['id'];
		
	$sql_itemservico = $con->prepare("DELETE FROM TBL_ITEM_SERVICO_ORC  WHERE NUM_ID_SERVICO_ORC = '$id_item_servico'");
		if(! $sql_itemservico->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}

		if(atualizaValorOS($id )){			
			$_SESSION['msg'] = "<div class='alert alert-success'>Servico excluido!</div>"; 
			header("Location: cadastro-orcamento.php?orcamento=$id");
		}else{			
			$_SESSION['msg'] = "<div class='alert alert-danger'>Servico excluido, porem erro ao atualizar tabela!</div>"; 
			header("Location: cadastro-orcamento.php?orcamento=$id");				
		}
		
break;
case "condicaopagamento":
	
	$condicaopagamento = $_POST['condicaopagamento'];
	$id_orc = $_POST['id_orc'];
		
	$sqlCondicaoPagamento = $con->prepare("UPDATE TBL_ORCAMENTO_ORC SET TXT_CONDICAO_PAGAMENTO_ORC = ?  WHERE NUM_ID_ORC = ?");
	$sqlCondicaoPagamento->bindParam(1,$condicaopagamento);
	$sqlCondicaoPagamento->bindParam(2,$id_orc);

		if(! $sqlCondicaoPagamento->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}else{
			$_SESSION['msg'] = "<div class='alert alert-danger'>Condicao de pagamento atualizada!</div>"; 
			header("Location: cadastro-orcamento.php?orcamento=$id_orc");
		}

break;
case "descontoservico":
	
	$id_item_servico = $_POST['item_servico'];
	$id = $_POST['id_os'];
	$val = $_POST['valor'];
	$fin = $_POST['total'];
	$desc = $_POST['desconto'];
	
	if($val<=$desc){
		//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Erro ao efetuar operacao!\");</script>";	
		$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao aplicar desconto!</div>"; 
		header("Location: listagem-apontamento.php?id=$id");	
	}else{

		$valFinal = $val - $desc;
	
			$sql_itemservico = $con->prepare("UPDATE TBL_ITEM_SERVICO_ORC SET VAL_VALOR_SERVICO_ORC=?, VAL_DESCONTO_SERVICO_ORC = ?, VAL_FINAL_SERVICO_ORC = ? WHERE NUM_ID_SERVICO_ORC = '$id_item_servico'");
			$sql_itemservico->bindParam(1,$val);
			$sql_itemservico->bindParam(2,$desc);
			$sql_itemservico->bindParam(3,$valFinal);
			if(! $sql_itemservico->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error($con));
			}
	
		if(atualizaValorOS($id)){			
			$_SESSION['msg'] = "<div class='alert alert-success'>Desconto aplicado com sucesso!</div>"; 
			header("Location: cadastro-orcamento.php?orcamento=$id");
		}else{			
			$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao aplicar desconto!</div>"; 
			header("Location: cadastro-orcamento.php?orcamento=$id");
		}
	}
		
break;

case "descontopeca":
	
	$id_item_peca = $_POST['id_item_peca'];
	$id = $_POST['id_os'];
	$val = $_POST['valor'];
	$fin = $_POST['total'];
	$desc = $_POST['desconto'];
	
	if($val<=$desc){
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Erro ao efetuar operacao!\");</script>";	
	}else{

		$valFinal = $val - $desc;
	
			$sql_itempeca = $con->prepare("UPDATE TBL_ITEM_PECA_ORC SET VAL_VALOR_PECA_ORC=?, VAL_DESCONTO_PECA_ORC = ?, VAL_FINAL_PECA_ORC = ? WHERE NUM_ID_PECA_ORC = '$id_item_peca'");
			$sql_itempeca->bindParam(1,$val);
			$sql_itempeca->bindParam(2,$desc);
			$sql_itempeca->bindParam(3,$valFinal);
			if(! $sql_itempeca->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error($con));
			}
	
		if(atualizaValorOS($id)){			
			$_SESSION['msg'] = "<div class='alert alert-success'>Desconto aplicado com sucesso!</div>"; 
			header("Location: cadastro-orcamento.php?orcamento=$id");					
		}else{			
			$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao aplicar desconto!</div>"; 
			header("Location: cadastro-orcamento.php?orcamento=$id");
		}
	}
		
break;
case "removerpeca":
	
	$id_item_peca = $_GET['id_item_peca'];
	$id = $_GET['id'];
		
	$sql_itempeca = $con->prepare("DELETE FROM TBL_ITEM_PECA_ORC  WHERE NUM_ID_PECA_ORC = '$id_item_peca'");
		if(! $sql_itempeca->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}

		if(atualizaValorOS($id )){			
			$_SESSION['msg'] = "<div class='alert alert-success'>Item removido com sucesso!</div>"; 
			header("Location: cadastro-orcamento.php?orcamento=$id");					
		}else{			
			$_SESSION['msg'] = "<div class='alert alert-danger'>Item removido, porem erro ao atualizar tabela!</div>"; 
			header("Location: cadastro-orcamento.php?orcamento=$id");					
		}
		
break;
case "encerraros":
	$id_os = $_GET['idos'];
	$statusOs = $_GET['statusOs'];

		if($statusOs == 'ANDAMENTO'){		
		
			//verificar se existem servicos em aberto
				$sqlStatusServicoOs = $con->prepare("SELECT * FROM `TBL_ITEM_SERVICO_OS` WHERE `TXT_STATUS_SERVICO_OS` <> 'REALIZADO' OR TBL_MECANICO_MEC_NUM_ID_MEC = 0 AND `TBL_ORDEMSERVICO_OS_NUM_ID_OS` = ?");
				$sqlStatusServicoOs->bindParam(1,$id_os);
				
				if(! $sqlStatusServicoOs->execute()){
					die('Houve um erro no processamento da transação: ' . mysqli_error($con));
				}else{
					if($sqlStatusServicoOs->rowCount()>0){
						echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Existem servicos ainda nao realizados ou sem mecanico!\");</script>";	
					}else{
						//verificar se existem pecas em aberto
						$sqlStatusPecaOs = $con->prepare("SELECT * FROM `TBL_ITEM_PECA_OS` WHERE `TXT_STATUS_PECA_OS` <> 'REALIZADO' AND `TBL_ORDEMSERVICO_OS_NUM_ID_OS` = ?");
						$sqlStatusPecaOs->bindParam(1,$id_os);
						
							if(! $sqlStatusPecaOs->execute()){
								die('Houve um erro no processamento da transação: ' . mysqli_error($con));
							}else{
								if($sqlStatusPecaOs->rowCount()>0){
									echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Existem pecas ainda nao realizados!\");</script>";	
								}else{
									$sqlEncerraOs = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'ENCERRADA',DTH_ENCERRAMENTO_OS = now() , DTA_FIMGARANTIA_OS = DATE_ADD(CURDATE(), INTERVAL 90 DAY) WHERE NUM_ID_OS = '$id_os'");
									if(! $sqlEncerraOs->execute()){
										die('Houve um erro no processamento da transacao: ' . mysqli_error($con));
									}else{
										echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-apontamento.php'><script type=\"text/javascript\">alert(\"Ordem de Servico encerrada com sucesso!\");</script>";										
									}//fim Ordem de servico encerrada
								}//fim Ordem de servico nao tem pecas em andamento
							}//fim sql de pecas executada com sucesso
					}//fim ordem de servico com servicos em andamento
				}//fim erro sql de servicos em aberto	
		}else{
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Ordem de Servico precisa estar em ANDAMENTO, atualmente: $statusOs!\");</script>";
		}
break;
default:
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Erro ao capturar acao!\");</script>";	
}
?>

<?php

include "verifica.php";

//echo $_POST['mecanico'];

		$id_cliente					=$_POST["id_cliente"];
		$tipo_atendimento			=$_POST["tipo_atendimento"];
		$id_e						=$_POST["id_e"];
		$tipo_os  					=$_POST["tipo_os"];
		$dadosgerais				=$_POST["dadosgerais"];
		$reclamacao					=$_POST["reclamacao"];
		$previsao					=$_POST['previsao'];	
		$km							=$_POST['km'];
		$cancelamento				=strtoupper($_POST["cancelamento"]);

	//funcao para atualizar valores na ordem de servico			
	function atualizaValorOS($numeroOS){
		include "conexao.php";

		//if($tipoOperacao=='adciona'){

			//buscar valor total de servicos lancados
			$BuscarTotalServico = $con->prepare("SELECT SUM(VAL_VALOR_SERVICO_OS) AS TOTALSERVICO, SUM(VAL_DESCONTO_SERVICO_OS) AS TOTALDESCONTOSERVICO FROM TBL_ITEM_SERVICO_OS WHERE TBL_ORDEMSERVICO_OS_NUM_ID_OS = $numeroOS");
							
			if(!$BuscarTotalServico->execute()){
				return false;
			}else{	
				while ($rowItem = $BuscarTotalServico->fetch(PDO::FETCH_OBJ)){
					$valorServico = $rowItem->TOTALSERVICO;
					$valorDescontoServico = $rowItem->TOTALDESCONTOSERVICO;					
				}
			}
			
			//buscar valor total de pecas lancada
			$buscarTotalPeca = $con->prepare("SELECT SUM(VAL_VALOR_PECA_OS) AS TOTALPECA, SUM(VAL_DESCONTO_PECA_OS) AS TOTALDESCONTOPECA FROM TBL_ITEM_PECA_OS WHERE TBL_ORDEMSERVICO_OS_NUM_ID_OS = $numeroOS");

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
				$sqlAtualizaValoresOS = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET VAL_TOTAL_OS = ?, VAL_DESCONTO_OS = ?, VAL_FINAL_OS = ? WHERE NUM_ID_OS = ?");
				$sqlAtualizaValoresOS->bindParam(1,$novoValor);
				$sqlAtualizaValoresOS->bindParam(2,$novoDesconto);
				$sqlAtualizaValoresOS->bindParam(3,$novoFinal);
				$sqlAtualizaValoresOS->bindParam(4,$numeroOS);

					if(!$sqlAtualizaValoresOS->execute() ){						
						return false;
					}else{
						return true;
					}			

	}

include "conexao.php";

$acao = $_GET['acao'];

switch($acao){	
case "cadastrar":
	if($_POST['tipo_os']=="S"){	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-frota.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";		
	}else{				
				
				$sqlCadastro = $con->prepare("INSERT INTO TBL_ORDEMSERVICO_OS (`TXT_TIPO_ATENDIMENTO_OS`,`TBL_CLIENTE_CLI_NUM_ID_CLI`,`TBL_EMPRESA_EMP_NUM_ID_EMP`,`TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP`, 
				
					`TBL_USUARIO_USU_NUM_ID_USU`,`TXT_TIPO_OS`, `TXT_CONDICAO_PAGAMENTO_OS`,`DTH_ABERTURA_OS`,`TXT_DADOSGERAIS_OS`, `TXT_RECLAMACAO_OS`,  `DTA_PREVISAO_OS`, `TXT_DEFEITO_OS`, `TXT_RESOLUCAO_OS`,
											
					`VAL_TOTAL_OS`, `VAL_DESCONTO_OS`, `VAL_FINAL_OS`, `DTH_ENCERRAMENTO_OS`, `DTA_FIMGARANTIA_OS`, `NUM_NFSE_OS`, `TXT_CANCELAMENTO_OS`, `NUM_KM_OS`,`TXT_STATUS_OS`)

					VALUES (?,?,?,?,?,?,null, now(),?,?,?,?,?,0,0,0,null,null,0,null,?,'ABERTA')"); 

				$sqlCadastro->bindParam(1,$tipo_atendimento);
				$sqlCadastro->bindParam(2,$id_cliente);
				$sqlCadastro->bindParam(3,$empresa_usuario);
				$sqlCadastro->bindParam(4,$id_e);								
				$sqlCadastro->bindParam(5,$id_usuario);
				$sqlCadastro->bindParam(6,$tipo_os);

				$sqlCadastro->bindParam(7,$dadosgerais);
				$sqlCadastro->bindParam(8,$reclamacao);
				$sqlCadastro->bindParam(9,$previsao);
				$sqlCadastro->bindParam(10,$defeito);
				$sqlCadastro->bindParam(11,$resolucao);

				$sqlCadastro->bindParam(12,$km);
				
		
				if(! $sqlCadastro->execute() ){
				  	die('Houve um erro no processamento da transação: ' . $sqlCadastro . mysqli_error($con));
				}				
				$result = $con->prepare("SELECT MAX(NUM_ID_OS) FROM TBL_ORDEMSERVICO_OS");
				
				if(!$result->execute()){
						echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Registro efetuado com sucesso, Porém erro ao capturar Numero!\");</script>";	
				}else{				
				
					$idosatual = $result->fetchColumn();echo $idosatual;
						echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Registro efetuado com sucesso, numero da Ordem de Serviço: $idosatual !\");</script>";
						$idosatual=base64_encode($idosatual);
				}		
}
break;
case "cancelaros":
	$id_os = base64_decode($_GET['os']);
	//ATUALIZA STATUS DE OS
		$sql_verifica_os = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$id_os' AND TXT_STATUS_OS <> 'PAGO' AND TXT_STATUS_OS <> 'FATURADA' AND $perfil_usuario = 1");
		$sql_verifica_os->execute();
		if($sql_verifica_os->rowCount()<=0){
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Ordem de Servico nao pode estar FATURADA ou PAGO!\");</script>";	
		}else{

			$sqlCancelar = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'CANCELADA', DTH_ENCERRAMENTO_OS = now(), TXT_CANCELAMENTO_OS = '$cancelamento'  WHERE NUM_ID_OS = '$id_os' AND TXT_STATUS_OS <> 'PAGO' AND TXT_STATUS_OS <> 'FATURADA'");	

			if($sqlCancelar->execute() ){
				echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Ordem de Servico cancelada com sucesso!\");</script>";	
			}else{
				die('Houve um erro no processamento da transação: ' . mysqli_error($con));
			}
		}			
				
break;	
case "salvar":
	
		$id = $_GET['id'];
		$sqlSalvar = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_TIPO_ATENDIMENTO_OS = ?,TXT_TIPO_OS = ?, DTA_PREVISAO_OS = ? WHERE NUM_ID_OS = ?");
		$sqlSalvar->bindParam(1,$tipo_atendimento);
		$sqlSalvar->bindParam(2,$tipo_os);
		$sqlSalvar->bindParam(3,$previsao);
		$sqlSalvar->bindParam(4,$id);


	if(! $sqlSalvar->execute() ){
		die('Houve um erro no processamento da transação: ' . mysqli_error($con));}
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Registro atualizado com sucesso!\");</script>";				

break;
case "incluirservico":	

	 $id_os = $_POST['id'];
	 $id_servico = $_POST['servico'];
	 $pessoa_cliente = $_POST['pessoa_cliente'];

	if($pessoa_cliente=='FISICA'){
		$buscarPreco = $con->prepare("SELECT VAL_FISICA_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = ?");
	}else{
		$buscarPreco = $con->prepare("SELECT VAL_JURIDICA_SER FROM TBL_SERVICO_SER WHERE NUM_ID_SER = ?");
	}
		
		$buscarPreco->bindParam(1,$id_servico);
							
			if(!$buscarPreco->execute()){				
				echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Erro ao incluir servico!\");</script>";				
			}else{	
				$precoServico = $buscarPreco->fetchColumn();
			}		

				$sqlIncluirServico = $con->prepare("INSERT INTO TBL_ITEM_SERVICO_OS (`TBL_TECNICO_TEC_NUM_ID_TEC`, `TBL_USUARIO_USU_NUM_ID_USU`, `TBL_SERVICO_SER_NUM_ID_SER`, `TBL_ORDEMSERVICO_OS_NUM_ID_OS`, 
				
					`DTH_INICIO_SERVICO_OS`, `DTH_TERMINO_SERVICO_OS`, `VAL_VALOR_SERVICO_OS`, `VAL_DESCONTO_SERVICO_OS`, `VAL_VALOR_FINAL_SERVICO_OS`, `TXT_STATUS_SERVICO_OS`)
													
					VALUES (0, ?, ?, ?, null, null, ?, 0, ?, 'AGUARDANDO APROVACAO')");

				$sqlIncluirServico->bindParam(1,$id_usuario);
				$sqlIncluirServico->bindParam(2,$id_servico);
				$sqlIncluirServico->bindParam(3,$id_os);
				$sqlIncluirServico->bindParam(4,$precoServico);
				$sqlIncluirServico->bindParam(5,$precoServico);
			
			if(! $sqlIncluirServico->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error($con));				
			}	
			
			$sqlAtualizaStatusOs = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'ANDAMENTO' WHERE NUM_ID_OS = '$id_os'");
				if(!$sqlAtualizaStatusOs->execute()){
					die('Houve um erro no processamento da transação: ' . mysqli_error($con));
				}
			
			if(atualizaValorOS($id_os )){
				//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Servico incluido com sucesso!\");</script>";
				$_SESSION['msg'] = "<div class='alert alert-success'>Servico incluido com sucesso!</div>"; 
				header("Location: listagem-apontamento.php?id=$id_os");
							
			}else{
				//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Erro ao incluir servico!\");</script>";
				$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao incluir o servico!</div>"; 
				header("Location: listagem-apontamento.php?id=$id_os");
				
			}

break;
case "incluirpeca":
	
	$id_os = $_POST['id'];
	$id_peca = $_POST['peca'];
	$quantidade = $_POST['quantidade'];

		
		$buscarPreco = $con->prepare("SELECT VAL_VALOR_VENDA_PEC FROM TBL_PECA_PEC WHERE NUM_ID_PEC = ?");
		$buscarPreco->bindParam(1,$id_peca);
							
			if(!$buscarPreco->execute()){				
				//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Erro ao incluir peca!\");</script>";				
				$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao incluir peca!</div>"; 
				header("Location: listagem-apontamento.php?id=$id_os");
			}else{	
				$precoPeca = $buscarPreco->fetchColumn();
			}
			
			$novoPrecoPeca = $precoPeca * $quantidade;

			$sqlIncluirPeca = $con->prepare("INSERT INTO TBL_ITEM_PECA_OS (`TBL_USUARIO_USU_NUM_ID_USU`, `TBL_ORDEMSERVICO_OS_NUM_ID_OS`, `TBL_PECA_PEC_NUM_ID_PEC`, 
			
				`NUM_QUANTIDADE_PECA_OS`, `VAL_VALOR_PECA_OS`, `VAL_DESCONTO_PECA_OS`, `VAL_FINAL_PECA_OS`, `TXT_STATUS_PECA_OS`)
												
				VALUES (?, ?, ?, ?, ?, 0, ?, 'AGUARDANDO APROVACAO')");

			$sqlIncluirPeca->bindParam(1,$id_usuario);
			$sqlIncluirPeca->bindParam(2,$id_os);
			$sqlIncluirPeca->bindParam(3,$id_peca);
			$sqlIncluirPeca->bindParam(4,$quantidade);
			$sqlIncluirPeca->bindParam(5,$novoPrecoPeca);
			$sqlIncluirPeca->bindParam(6,$novoPrecoPeca);
			
			if(! $sqlIncluirPeca->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error($con));				
			}

			$sqlAtualizaStatusOs = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'ANDAMENTO' WHERE NUM_ID_OS = '$id_os'");
				if(!$sqlAtualizaStatusOs->execute()){
					die('Houve um erro no processamento da transação: ' . mysqli_error($con));
				}

			if(atualizaValorOS($id_os )){
				//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Peca incluida com sucesso!\");</script>";					
				$_SESSION['msg'] = "<div class='alert alert-success'>Peca incluido com sucesso!</div>"; 
				header("Location: listagem-apontamento.php?id=$id_os");
			}else{
				//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id_os'><script type=\"text/javascript\">alert(\"Erro ao incluir Peca!\");</script>";				
				$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao incluir peca!</div>"; 
				header("Location: listagem-apontamento.php?id=$id_os");
			}

break;
case "aprovarservico":
	
	$id_item_servico = $_GET['id_item_servico'];
	$id = $_GET['id'];
		
	$sql_itemservico = $con->prepare("UPDATE TBL_ITEM_SERVICO_OS SET TXT_STATUS_SERVICO_OS = 'APROVADO' WHERE NUM_ID_SERVICO_OS = '$id_item_servico'");
		if(! $sql_itemservico->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}
		
		//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Item aprovado com sucesso!\");</script>";
		$_SESSION['msg'] = "<div class='alert alert-success'>Item aprovado com sucesso!</div>"; 
		header("Location: listagem-apontamento.php?id=$id");

break;
case "atribuirmecanico":
	
	$id_item_servico = $_POST['item_servico'];
	$id = $_POST['id_os'];
	$tecnico = $_POST['tecnico'];
		
	$sql_itemservico = $con->prepare("UPDATE TBL_ITEM_SERVICO_OS SET TBL_TECNICO_TEC_NUM_ID_TEC = ? WHERE NUM_ID_SERVICO_OS = '$id_item_servico'");
	$sql_itemservico->bindParam(1,$tecnico);
		if(! $sql_itemservico->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}		
		
		$_SESSION['msg'] = "<div class='alert alert-success'>Mecanico atribuido com sucesso!</div>"; 
		header("Location: listagem-apontamento.php?id=$id");

break;
case "iniciar":
	
	$id_item_servico = $_GET['id_item_servico'];
	$id = $_GET['id'];
		
	$sql_itemservico = $con->prepare("UPDATE TBL_ITEM_SERVICO_OS SET DTH_INICIO_SERVICO_OS = NOW(), TXT_STATUS_SERVICO_OS = 'ANDAMENTO' WHERE NUM_ID_SERVICO_OS = '$id_item_servico'");
		if(! $sql_itemservico->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}
	
	$sqlAtualizaStatusOs = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'ANDAMENTO' WHERE NUM_ID_OS = '$id'");
		if(!$sqlAtualizaStatusOs->execute()){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}
		
	//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Item atualizado com sucesso!\");</script>";
	$_SESSION['msg'] = "<div class='alert alert-success'>Servico iniciado com sucesso!</div>"; 
	header("Location: listagem-apontamento.php?id=$id");

break;
case "terminar":
	
	$id_item_servico = $_GET['id_item_servico'];
	$id = $_GET['id'];
		
	$sql_itemservico = $con->prepare("UPDATE TBL_ITEM_SERVICO_OS SET DTH_TERMINO_SERVICO_OS = NOW(), TXT_STATUS_SERVICO_OS = 'REALIZADO' WHERE NUM_ID_SERVICO_OS = '$id_item_servico'");
		if(! $sql_itemservico->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}
		
		//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Item atualizado com sucesso!\");</script>";
		$_SESSION['msg'] = "<div class='alert alert-success'>Servico encerrado com sucesso!</div>"; 
		header("Location: listagem-apontamento.php?id=$id");

break;

case "removerservico":
	
	$id_item_servico = $_GET['id_item_servico'];
	$id = $_GET['id'];
		
	$sql_itemservico = $con->prepare("DELETE FROM TBL_ITEM_SERVICO_OS  WHERE NUM_ID_SERVICO_OS = '$id_item_servico'");
		if(! $sql_itemservico->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}

		if(atualizaValorOS($id )){
			//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Operacao efetuada com sucesso!\");</script>";					
			$_SESSION['msg'] = "<div class='alert alert-success'>Servico excluido!</div>"; 
			header("Location: listagem-apontamento.php?id=$id");
		}else{
			//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Erro ao efetuar operacao!\");</script>";
			$_SESSION['msg'] = "<div class='alert alert-danger'>Servico excluido, porem erro ao atualizar tabela!</div>"; 
			header("Location: listagem-apontamento.php?id=$id");				
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
	
			$sql_itemservico = $con->prepare("UPDATE TBL_ITEM_SERVICO_OS SET VAL_VALOR_SERVICO_OS=?, VAL_DESCONTO_SERVICO_OS = ?, VAL_VALOR_FINAL_SERVICO_OS = ? WHERE NUM_ID_SERVICO_OS = '$id_item_servico'");
			$sql_itemservico->bindParam(1,$val);
			$sql_itemservico->bindParam(2,$desc);
			$sql_itemservico->bindParam(3,$valFinal);
			if(! $sql_itemservico->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error($con));
			}
	
		if(atualizaValorOS($id)){
			//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Operacao efetuada com sucesso!\");</script>";					
			$_SESSION['msg'] = "<div class='alert alert-success'>Desconto aplicado com sucesso!</div>"; 
			header("Location: listagem-apontamento.php?id=$id");
		}else{
			//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Erro ao efetuar operacao!\");</script>";				
			$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao aplicar desconto!</div>"; 
			header("Location: listagem-apontamento.php?id=$id");
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
	
			$sql_itempeca = $con->prepare("UPDATE TBL_ITEM_PECA_OS SET VAL_VALOR_PECA_OS=?, VAL_DESCONTO_PECA_OS = ?, VAL_FINAL_PECA_OS = ? WHERE NUM_ID_PECA_OS = '$id_item_peca'");
			$sql_itempeca->bindParam(1,$val);
			$sql_itempeca->bindParam(2,$desc);
			$sql_itempeca->bindParam(3,$valFinal);
			if(! $sql_itempeca->execute() ){
				die('Houve um erro no processamento da transação: ' . mysqli_error($con));
			}
	
		if(atualizaValorOS($id)){
			//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Operacao efetuada com sucesso!\");</script>";
			$_SESSION['msg'] = "<div class='alert alert-success'>Desconto aplicado com sucesso!</div>"; 
			header("Location: listagem-apontamento.php?id=$id");					
		}else{
			//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Erro ao efetuar operacao!\");</script>";				
			$_SESSION['msg'] = "<div class='alert alert-danger'>Erro ao aplicar desconto!</div>"; 
			header("Location: listagem-apontamento.php?id=$id");
		}
	}
		
break;

case "aprovarpeca":
	
	$id_item_peca = $_GET['id_item_peca'];
	$id = $_GET['id'];
		
	$sql_item_peca = $con->prepare("UPDATE TBL_ITEM_PECA_OS SET TXT_STATUS_PECA_OS = 'APROVADO' WHERE NUM_ID_PECA_OS = '$id_item_peca'");
		if(! $sql_item_peca->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}

		$sqlAtualizaStatusOs = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_STATUS_OS = 'ANDAMENTO' WHERE NUM_ID_OS = '$id'");
		if(!$sqlAtualizaStatusOs->execute()){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}

		$_SESSION['msg'] = "<div class='alert alert-success'>Item aprovado com sucesso!</div>"; 
		header("Location: listagem-apontamento.php?id=$id");	
		
		//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Item aprovado com sucesso!\");</script>";

break;

case "removerpeca":
	
	$id_item_peca = $_GET['id_item_peca'];
	$id = $_GET['id'];
		
	$sql_itempeca = $con->prepare("DELETE FROM TBL_ITEM_PECA_OS  WHERE NUM_ID_PECA_OS = '$id_item_peca'");
		if(! $sql_itempeca->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}

		if(atualizaValorOS($id )){
			//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Operacao efetuada com sucesso!\");</script>";
			$_SESSION['msg'] = "<div class='alert alert-success'>Item removido com sucesso!</div>"; 
			header("Location: listagem-apontamento.php?id=$id");						
		}else{
			//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Erro ao efetuar operacao!\");</script>";
			$_SESSION['msg'] = "<div class='alert alert-danger'>Item removido, porem erro ao atualizar tabela!</div>"; 
			header("Location: listagem-apontamento.php?id=$id");					
		}
		
break;

case "realizadopeca":
	
	$id_item_peca = $_GET['id_item_peca'];
	$id = $_GET['id'];
		
	$sql_item_peca = $con->prepare("UPDATE TBL_ITEM_PECA_OS SET TXT_STATUS_PECA_OS = 'REALIZADO' WHERE NUM_ID_PECA_OS = '$id_item_peca'");
		if(! $sql_item_peca->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}
		
		//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Item atualizado com sucesso!\");</script>";
		$_SESSION['msg'] = "<div class='alert alert-success'>Item realizado com sucesso!</div>"; 
		header("Location: listagem-apontamento.php?id=$id");	

break;
case "encerraros":
	$id_os = base64_decode($_GET['idos']);
	$statusOs = base64_decode($_GET['statusOs']);

		if($statusOs == 'ANDAMENTO'){		
		
			//verificar se existem servicos em aberto
				$sqlStatusServicoOs = $con->prepare("SELECT * FROM `TBL_ITEM_SERVICO_OS` WHERE `TXT_STATUS_SERVICO_OS` <> 'REALIZADO'  AND `TBL_ORDEMSERVICO_OS_NUM_ID_OS` = ? ");
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
case "cadastrar_defeito":
	
	$defeito = $_POST['defeito'];
	$id = $_POST['id_os'];
		
	$sqlAtualizarDefeito = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_DEFEITO_OS = ? WHERE NUM_ID_OS = ?");
	$sqlAtualizarDefeito->bindParam(1, $defeito);
	$sqlAtualizarDefeito->bindParam(2, $id);

		if(! $sqlAtualizarDefeito->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}
		
		//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Item aprovado com sucesso!\");</script>";
		$_SESSION['msg'] = "<div class='alert alert-success'>Registro de defeito realizado com sucesso!</div>"; 
		header("Location: listagem-apontamento.php?id=$id");

break;
case "cadastrar_solucao":
	
	$resolucao = $_POST['resolucao'];
	$id = $_POST['id_os'];
		
	$sqlAtualizarDefeito = $con->prepare("UPDATE TBL_ORDEMSERVICO_OS SET TXT_RESOLUCAO_OS = ? WHERE NUM_ID_OS = ?");
	$sqlAtualizarDefeito->bindParam(1, $resolucao);
	$sqlAtualizarDefeito->bindParam(2, $id);

		if(! $sqlAtualizarDefeito->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con));
		}
		
		//echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-apontamento.php?id=$id'><script type=\"text/javascript\">alert(\"Item aprovado com sucesso!\");</script>";
		$_SESSION['msg'] = "<div class='alert alert-success'>Registro de solucao realizado com sucesso!</div>"; 
		header("Location: listagem-apontamento.php?id=$id");

break;
case "corrigeapontamento":
	//corrigir dados de apontamento apontamento
	$data1						=$_POST["data1"];
	$hora1						=$_POST["hora1"];
	$datahoraInicio = new DateTime($data1 .  $hora1);
	$datahoraInicioConv = $datahoraInicio->format('Y-m-d H:i:s');

	$data2						=$_POST["data2"];
	$hora2						=$_POST["hora2"];
	$datahoraTermino = new DateTime($data2 .  $hora2);
	$datahoraTerminoConv = $datahoraTermino->format('Y-m-d H:i:s');

	 $id_item_os					=$_POST["id_item_os"];

	$sql_atualiza_item = $con->prepare("UPDATE TBL_ITEM_SERVICO_OS SET DTH_INICIO_SERVICO_OS = ?, DTH_TERMINO_SERVICO_OS = ?  where `NUM_ID_SERVICO_OS`=?");
	 $datahoraInicioConv; 
	 $datahoraTerminoConv;

	$sql_atualiza_item->bindParam(1,$datahoraInicioConv);
	$sql_atualiza_item->bindParam(2,$datahoraTerminoConv);
	$sql_atualiza_item->bindParam(3,$id_item_os);

	if(! $sql_atualiza_item->execute()){die('Houve um erro no processamento da transação: ' . mysqli_error());}

	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=corrigir-apontamento.php'><script type=\"text/javascript\">alert(\"Apontamento alterado com sucesso!\");</script>";	
	
break;
default:
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Erro ao capturar acao!\");</script>";	
}
?>

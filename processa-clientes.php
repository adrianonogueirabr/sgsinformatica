<?php
include "verifica.php";

		$pessoa		=$_POST["pessoa"];
		$cpfcnpj	=$_POST["cpfcnpj"];
		$razao		=strtoupper($_POST["razao"]);
		$fantasia	=strtoupper($_POST["fantasia"]);
		$nascimento	=$_POST['data_cadastro'];
		$telefone	=$_POST["telefone"];
		$email		=strtolower($_POST["email"]);
		$logradouro	=strtoupper($_POST["logradouro"]);
		$numero		=$_POST["numero"];
		$cep		=$_POST["cep"];
		$bairro		=strtoupper($_POST["bairro"]);
		$complemento=strtolower($_POST["complemento"]);
		$referencia	=strtolower($_POST["referencia"]);
		$cidade		=strtoupper($_POST["cidade"]);
		$estado		=$_POST["estado"];
		$im			=$_POST["im"];
		$ie			=$_POST["ie"];
		$rg			=$_POST["rg"];
		$contato	=strtoupper($_POST["contato"]);
		$observacao	=$_POST["observacao"]; 

include_once "conexao.php";

$acao = filter_input(INPUT_GET,"acao",FILTER_SANITIZE_STRING);

if($acao == "cadastrar"){

	if($_POST['cpfcnpj']==""){
	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=cadastro-clientes.php'><script type=\"text/javascript\">alert(\"Tente novamente!\");</script>";
		
	}else{		
	
		$res = $con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE TXT_CPF_CNPJ_CLI = ?");
		$res->bindParam(1,$cpfcnpj);
		$res->execute();
		
		if($res->rowCount() > 0){
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL='><script type=\"text/javascript\">alert(\"Esse CPF/CNPJ ja foi cadastrado!\");</script>";
			echo "<script language='javascript'>history.back()</script>";
			
		}else{	
		
				$res=$con->prepare("INSERT INTO TBL_CLIENTE_CLI (TBL_USUARIO_USU_NUM_ID_USU,TXT_PESSOA_CLI,TXT_CPF_CNPJ_CLI ,TXT_RAZAO_CLI ,TXT_FANTASIA_CLI,DTA_NASCIMENTO_CLI,TXT_TELEFONE_CLI,
				
									TXT_EMAIL_CLI,NUM_CEP_CLI,TXT_LOGRADOURO_CLI,NUM_NUMERO_CLI,TXT_COMPLEMENTO_CLI,TXT_REFERENCIA_CLI,TXT_BAIRRO_CLI,TXT_CIDADE_CLI,TXT_ESTADO_CLI,
									
									TXT_IM_CLI,TXT_IE_CLI,TXT_RG_CLI,TXT_CONTATO_CLI,TXT_OBSERVACAO_CLI,DTH_ALTERACAO_CLI,DTH_REGISTRO_CLI,VAL_SALDO_CLI,TXT_TITULOABERTO_CLI,TXT_ATIVO_CLI) 

									values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),now(),0.0,'NAO','SIM');");
				
					$res->bindParam(1,$id_usuario);
					$res->bindParam(2,$pessoa);
					$res->bindParam(3,$cpfcnpj);
					$res->bindParam(4,$razao);
					$res->bindParam(5,$fantasia);
					$res->bindParam(6,$nascimento);
					$res->bindParam(7,$telefone);
					$res->bindParam(8,$email);
					$res->bindParam(9,$cep);
					$res->bindParam(10,$logradouro);
					$res->bindParam(11,$numero);
					$res->bindParam(12,$complemento);
					$res->bindParam(13,$referencia);
					$res->bindParam(14,$bairro);
					$res->bindParam(15,$cidade);
					$res->bindParam(16,$estado);
					$res->bindParam(17,$im);
					$res->bindParam(18,$ie);
					$res->bindParam(19,$rg);
					$res->bindParam(20,$contato);
					$res->bindParam(21,$observacao);				

				if (!$res->execute()) {
      				echo "Error: " . $sql . "<br>" . mysqli_error($con);
				}else{

					$ultimo = $con->prepare("SELECT MAX(NUM_ID_CLI) FROM TBL_CLIENTE_CLI");				
						if(!$ultimo->execute()){
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-clientes.php'><script type=\"text/javascript\">
							alert(\"Registro de cliente efetuado com sucesso, Porém erro ao capturar ID do mesmo!\");</script>";	
						}else{				
							$numerocliente = $ultimo->fetchColumn();					
							echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-clientes.php'><script type=\"text/javascript\">
							alert(\"Registro efetuado com sucesso, Codigo do cliente: $numerocliente !\");</script>";
						}
				}
		}
}

}else if($acao == "salvar"){
	
	$ativo = $_POST['ativo'];
	$id = $_POST['id'];

		$stmt = $con->prepare("UPDATE TBL_CLIENTE_CLI SET TBL_USUARIO_USU_NUM_ID_USU = ?, TXT_RAZAO_CLI = ?, TXT_FANTASIA_CLI = ?, TXT_TELEFONE_CLI = ?, 
								
							TXT_EMAIL_CLI = ?, NUM_CEP_CLI = ?, TXT_LOGRADOURO_CLI = ?, NUM_NUMERO_CLI = ?, TXT_COMPLEMENTO_CLI = ?, TXT_REFERENCIA_CLI =?, TXT_BAIRRO_CLI = ?, 
							
							TXT_CIDADE_CLI = ?, TXT_ESTADO_CLI = ?, TXT_IM_CLI = ?, TXT_IE_CLI = ?, TXT_RG_CLI = ?, TXT_CONTATO_CLI = ?, TXT_OBSERVACAO_CLI = ?, DTH_ALTERACAO_CLI = now(),
							
							TXT_ATIVO_CLI = ?  WHERE NUM_ID_CLI = ?");

				$stmt->bindParam(1,$id_usuario);
				$stmt->bindParam(2,$razao);
				$stmt->bindParam(3,$fantasia);
				$stmt->bindParam(4,$telefone);
				$stmt->bindParam(5,$email);
				$stmt->bindParam(6,$cep);
				$stmt->bindParam(7,$logradouro);
				$stmt->bindParam(8,$numero);
				$stmt->bindParam(9,$complemento);
				$stmt->bindParam(10,$referencia);
				$stmt->bindParam(11,$bairro);
				$stmt->bindParam(12,$cidade);
				$stmt->bindParam(13,$estado);
				$stmt->bindParam(14,$im);
				$stmt->bindParam(15,$ie);
				$stmt->bindParam(16,$rg);
				$stmt->bindParam(17,$contato);
				$stmt->bindParam(18,$observacao);
				$stmt->bindParam(19,$ativo);
				$stmt->bindParam(20,$id);


		if ($stmt->execute()) {
     		 echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-clientes.php'><script type=\"text/javascript\">alert(\"Registro atualizado com sucesso!\");</script>";
		} else {
      		echo "Error: " . $sql . "<br>" . mysqli_error($con);
		}				
	
}else{
	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-clientes.php'><script type=\"text/javascript\">alert(\"Tente Novamente!\");</script>";	

}

?>

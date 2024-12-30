<?php
include "verifica.php";

		$pessoa		=$_POST["pessoa"];
		$cpfcnpj	=$_POST["cpfcnpj"];
		$razao		=strtoupper($_POST["razao"]);
		$fantasia	=strtoupper($_POST["fantasia"]);
		$nascimento	=$_POST['data_fundacao'];
		$telefone	=$_POST["telefone"];		
		$logo		=$_POST["logo"];	
		$email		=strtolower($_POST["email"]);
		$site		=strtolower($_POST["site"]);
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
		$multa		=$_POST["multa"];
		$juros		=$_POST["juros"];

include "conexao.php";

$acao = $_GET['acao'];

if($acao == "cadastrar"){

	if($_POST['cpfcnpj']==""){
	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=cadastro-filial.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";
		
	}else{		
	
		$sql = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE TXT_CPFCNPJ_EMP = '$cpfcnpj'");
		if(!$sql->execute()){die ('Houve um erro na transacao' . mysqli_error($con));}

		if($sql->rowCount()>0){

				echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL='><script type=\"text/javascript\">alert(\"CPF/CNPJ ja foi cadastrado!\");</script>";
				echo "<script language='javascript'>history.back()</script>";
			
		}else{	
		
				$sqlInsert = $con->prepare("INSERT INTO TBL_EMPRESA_EMP (`NUM_ID_EMP`, `TXT_PESSOA_EMP`, `TXT_CPFCNPJ_EMP`, `TXT_RAZAO_EMP`, `TXT_FANTASIA_EMP`, `DTA_FUNDACAO_EMP`, `TXT_TELEFONE_EMP`, `TXT_LOGO_EMP`, 
				
				`TXT_EMAIL_EMP`, `TXT_SITE_EMP`, `NUM_CEP_EMP`, `TXT_LOGRADOURO_EMP`, `NUM_NUMERO_EMP`, `TXT_COMPLEMENTO_EMP`, `TXT_BAIRRO_EMP`, `TXT_CIDADE_EMP`, `TXT_ESTADO_EMP`, `TXT_IM_EMP`, `TXT_IE_EMP`, 
				
				`TXT_RG_EMP`, `VAL_MULTA_EMP`, `VAL_JUROS_EMP`, `DTA_REGISTRO_EMP`, `DTA_ALTERACAO_EMP`, `TXT_ATIVO_EMP`) 
				
				VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),now(),'SIM')"); 
		
				$sqlInsert->bindParam(1,$pessoa);
				$sqlInsert->bindParam(2,$cpfcnpj);
				$sqlInsert->bindParam(3,$razao);
				$sqlInsert->bindParam(4,$fantasia);
				$sqlInsert->bindParam(5,$nascimento);
				$sqlInsert->bindParam(6,$telefone);
				$sqlInsert->bindParam(7,$logo);
				$sqlInsert->bindParam(8,$email);
				$sqlInsert->bindParam(9,$site);
				$sqlInsert->bindParam(10,$cep);
				$sqlInsert->bindParam(11,$logradouro);
				$sqlInsert->bindParam(12,$numero);
				$sqlInsert->bindParam(13,$complemento);
				$sqlInsert->bindParam(14,$bairro);
				$sqlInsert->bindParam(15,$cidade);
				$sqlInsert->bindParam(16,$estado);
				$sqlInsert->bindParam(17,$im);
				$sqlInsert->bindParam(18,$ie);
				$sqlInsert->bindParam(19,$rg);
				$sqlInsert->bindParam(20,$multa);
				$sqlInsert->bindParam(21,$juros);

















			
				if(! $sqlInsert->execute() ){
				 	die('Houve um erro no processamento da transação: ' . mysqli_error($con));
				}
		
				$result = $con->prepare("SELECT MAX(NUM_ID_EMP) FROM TBL_EMPRESA_EMP");

				if(!$result->execute()){
						echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-filial.php'><script type=\"text/javascript\">alert(\"Registro de Filial efetuado com sucesso, Porém erro ao capturar do mesmo!\");</script>";	
				}else{				
						
						$numerocliente = $result->fetchColumn();
						echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-filial.php'><script type=\"text/javascript\">alert(\"Registro efetuado com sucesso, Codigo da Filial: $numerocliente !\");</script>";
				}
		}
}

}else if($acao == "salvar"){
	
	$id = $_POST['id'];
	$ativo = $_POST['ativo'];

	$sqlUpdate = $con->prepare("UPDATE TBL_EMPRESA_EMP SET TXT_RAZAO_EMP = ?, TXT_FANTASIA_EMP = ?, TXT_TELEFONE_EMP = ?, TXT_LOGO_EMP = ?, TXT_EMAIL_EMP = ?, TXT_SITE_EMP = ?,
	
	NUM_CEP_EMP = ?, TXT_LOGRADOURO_EMP = ?, NUM_NUMERO_EMP = ?, TXT_COMPLEMENTO_EMP = ?, TXT_BAIRRO_EMP = ?,TXT_CIDADE_EMP = ?, TXT_ESTADO_EMP = ?, 
	
	TXT_IM_EMP = ?, TXT_IE_EMP = ?, TXT_RG_EMP = ?,  DTA_ALTERACAO_EMP = now(),VAL_JUROS_EMP = ?,VAL_MULTA_EMP = ?,TXT_ATIVO_EMP = ? WHERE NUM_ID_EMP = ?");

	$sqlUpdate->bindParam(1, $razao);
	$sqlUpdate->bindParam(2, $fantasia);
	$sqlUpdate->bindParam(3, $telefone);
	$sqlUpdate->bindParam(4, $logo);
	$sqlUpdate->bindParam(5, $email);
	$sqlUpdate->bindParam(6, $site);
	$sqlUpdate->bindParam(7, $cep);
	$sqlUpdate->bindParam(8, $logradouro);
	$sqlUpdate->bindParam(9, $numero);
	$sqlUpdate->bindParam(10, $complemento);
	$sqlUpdate->bindParam(11, $bairro);
	$sqlUpdate->bindParam(12, $cidade);
	$sqlUpdate->bindParam(13, $estado);
	$sqlUpdate->bindParam(14, $im);
	$sqlUpdate->bindParam(15, $ie);
	$sqlUpdate->bindParam(16, $rg);
	$sqlUpdate->bindParam(17, $juros);
	$sqlUpdate->bindParam(18, $multa);
	$sqlUpdate->bindParam(19, $ativo);
	$sqlUpdate->bindParam(20, $id);






	

	if(! $sqlUpdate->execute() ){
	die('Houve um erro no processamento da transação: ' . mysqli_error($con));
	}

	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-filial.php'><script type=\"text/javascript\">alert(\"Registro atualizado com sucesso!\");</script>";	
	
}else{
	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-filial.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";	

}

?>

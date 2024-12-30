<?php
include "verifica.php";

		$nome			=strtoupper($_POST["nome"]);
		$descricao		=strtoupper($_POST["descricao"]);
		$duracao		=$_POST["duracao"];
		$fisica			=$_POST["fisica"];
		$juridica		=$_POST["juridica"];
		$garantia		=0;	
		$interno		=0;	
		$contrato		=$_POST["contrato"];
		$ativo			=$_POST["ativo"];	


include "conexao.php";

$acao = $_GET['acao'];

if($acao == "cadastrar"){

	if($_POST['nome']==""){
	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=cadastro-servicos.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";
		
	}else{					
		$sql = $con->prepare("INSERT INTO TBL_SERVICO_SER (`NUM_ID_SER`, `TXT_NOME_SER`, `TXT_DESCRICAO_SER`, `NUM_DURACAO_SER`, `VAL_FISICA_SER`, `VAL_JURIDICA_SER`, `VAL_GARANTIA_SER`, `VAL_INTERNO_SER`, 
		
		`VAL_CONTRATO_SER`, `TXT_ATIVO_SER`) VALUES (NULL,?,?,?,?,?,0,0,?,'SIM')");

		$sql->bindParam(1,$nome);
		$sql->bindParam(2,$descricao);
		$sql->bindParam(3,$duracao);
		$sql->bindParam(4,$fisica);
		$sql->bindParam(5,$juridica);
		$sql->bindParam(6,$contrato);
		
		if(! $sql->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error());
		}else{			
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=cadastro-servicos.php'><script type=\"text/javascript\">alert(\"Registro realizado com sucesso!\");</script>";		
		}					
	}

}else if($acao == "salvar"){
	
	$id = $_POST['codigo'];
	$sql = $con->prepare("UPDATE TBL_SERVICO_SER SET TXT_NOME_SER = ?, TXT_DESCRICAO_SER = ?, NUM_DURACAO_SER = ?, VAL_FISICA_SER =?, VAL_JURIDICA_SER = ?, VAL_CONTRATO_SER = ?, TXT_ATIVO_SER = ? WHERE NUM_ID_SER = ?");
	
	$sql->bindParam(1,$nome);
	$sql->bindParam(2,$descricao);
	$sql->bindParam(3,$duracao);
	$sql->bindParam(4,$fisica);
	$sql->bindParam(5,$juridica);
	$sql->bindParam(6,$contrato);
	$sql->bindParam(7,$ativo);
	$sql->bindParam(8,$id);

	if(! $sql->execute() ){
		die('Houve um erro no processamento da transação: ' . mysqli_error());
	}
	
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-servicos.php'><script type=\"text/javascript\">alert(\"Registro atualizado com sucesso!\");</script>";	

}else{		
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-servicos.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";	
}

?>

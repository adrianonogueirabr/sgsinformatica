<?php
include "verifica.php";

		$codigo			=$_POST["codigo"];
		$nome			=strtoupper($_POST["nome"]);
		$telefone		=$_POST["telefone"];
		$email			=strtolower($_POST["email"]);
		$login			=strtoupper($_POST["login"]);
		$senha			=$_POST["senha"];
		$perfil			=$_POST["perfil"];
		$empresa 		=$_POST["empresa"];
		$ativo			=$_POST["ativo"];
		
include "conexao.php";

$acao = $_GET['acao'];

if($acao == "cadastrar"){

	if($_POST['nome']==null){
	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=cadastro-usuarios.php'><script type=\"text/javascript\">alert(\"Tente Novamente!\");</script>";
		
	}else{	
				
		$my_sql_insert = $con->prepare("
			INSERT INTO TBL_USUARIO_USU (TBL_PERFIL_PER_NUM_ID_PER, TBL_EMPRESA_EMP_NUM_ID_EMP, TXT_NOME_USU, TXT_TELEFONE_USU, TXT_EMAIL_USU, TXT_LOGIN_USU , TXT_SENHA_USU ,TXT_ATIVO_USU) 
			values (?,?,?,?,?,?,?, ?)");
			
			$my_sql_insert->bindParam(1,$perfil);
			$my_sql_insert->bindParam(2,$empresa);
			$my_sql_insert->bindParam(3,$nome);
			$my_sql_insert->bindParam(4,$telefone);
			$my_sql_insert->bindParam(5,$email);
			$my_sql_insert->bindParam(6, $login);
			$my_sql_insert->bindParam(7,$senha);
			$my_sql_insert->bindParam(8,$ativo);

		if (!$my_sql_insert->execute()) {
			die ('Houve um erro na transacao: ' . mysqli_error());
		} else {
  			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-usuarios.php'><script type=\"text/javascript\">alert(\"Registro realizado com sucesso!\");</script>";
		}			
	}	

}else if($acao == "salvar"){
	
	$id = $_POST['codigo'];
	$sql = $con->prepare("UPDATE TBL_USUARIO_USU SET TXT_NOME_USU = ?, TXT_TELEFONE_USU = ?, TXT_EMAIL_USU = ?,TXT_SENHA_USU = ?, TXT_ATIVO_USU = ? WHERE NUM_ID_USU = ?");
	$sql->bindParam(1,$nome);
	$sql->bindParam(2,$telefone);
	$sql->bindParam(3,$email);
	$sql->bindParam(4,$senha);
	$sql->bindParam(5,$ativo);
	$sql->bindParam(6,$id);

	if(! $sql->execute() ){
		die('Houve um erro no processamento da transação: ' . mysqli_error());
	}

	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-usuarios.php'><script type=\"text/javascript\">alert(\"Registro atualizado com sucesso!\");</script>";	
	
}else if($acao == "salvarnovafilial"){
	
	$id = $_POST['codigo'];
	$sql = $con->prepare("UPDATE TBL_USUARIO_USU SET TBL_EMPRESA_EMP_NUM_ID_EMP = '$empresa' WHERE NUM_ID_USU = '$id'");
	$sql->bindParam(1,$perfil);
	$sql->bindParam(2,$id);

	if(! $sql->execute() ){
	die('Houve um erro no processamento da transação: ' . mysqli_error());
	}

	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-usuarios.php'><script type=\"text/javascript\">alert(\"Usuario atualizado com sucesso!\");</script>";
	
	
}else if($acao == "salvarnovoperfil"){
	
	$id = $_POST['codigo'];
	
	$sql = $con->prepare("UPDATE TBL_USUARIO_USU SET TBL_PERFIL_PER_NUM_ID_PER = ? WHERE NUM_ID_USU = ?");
	$sql->bindParam(1,$empresa);
	$sql->bindParam(2,$id);

	if(! $sql->execute() ){
		die('Houve um erro no processamento da transação: ' . mysqli_error());
	}

	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-usuarios.php'><script type=\"text/javascript\">alert(\"Usuario atualizado com sucesso!\");</script>";	
	
}else{
	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-usuarios.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";	

}

?>

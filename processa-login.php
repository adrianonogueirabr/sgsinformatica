<?php 

if(isset($_POST["login"]) && empty($_POST["login"]) && isset($_POST["$senha"]) && empty($_POST["$senha"])){
	
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'><script type=\"text/javascript\">alert(\"Falha na captura dos dados, tente novamente!\");</script>";										
					
}else{

		require "conexao.php";
		require "usuario.class.php";

		$user = new usuario();
		
		$login = addslashes($_POST["login"]);
		$senha = addslashes($_POST["senha"]);

		if($user->login($login,$senha)==true)
		{
			if(isset($_SESSION['id_usu']))
			{
				header('location:inicial.php');
			}else{
				echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'><script type=\"text/javascript\">alert(\"Favor realizar login novamente!\");</script>";										
			}

		}else{
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'><script type=\"text/javascript\">alert(\"Verifique usuario e senha informados!\");</script>";										
		}	
	
}

?>
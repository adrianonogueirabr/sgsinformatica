<?php 
require_once 'conexao.php';

if((!isset ($_SESSION['login_usu']) == true) and (!isset ($_SESSION['senha_usu']) == true)) 
	{ 	
		unset($_SESSION['login_usu']); 
		unset($_SESSION['senha_usu']); 
		//header('location:index.php'); 
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'><script type=\"text/javascript\">alert(\"Favor realizar login novamente!\");</script>";	
	} 

require_once 'usuario.class.php';
$u = new usuario();

if($usulogged = $u->logged($_SESSION['login_usu'])==true){

$login_usuario = $_SESSION['login_usu'];
$perfil_usuario = $_SESSION['perfil_usu'];  
$id_usuario = $_SESSION['id_usu'];  
$empresa_usuario = $_SESSION['empresa_usu'];  

}else{
	unset($_SESSION['login_usu']); 
	unset($_SESSION['senha_usu']); 
	//header('location:index.php'); 
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php'><script type=\"text/javascript\">alert(\"Favor realizar login novamente!\");</script>";	
}

?>
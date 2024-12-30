<?php
session_start(); 

if((!isset ($_SESSION['login_usu']) == true) and (!isset ($_SESSION['senha_usu']) == true)) 
{ 
	unset($_SESSION['login_usu']); 
	unset($_SESSION['senha_usu']); 
	header('location:index.php'); 
}

$perfil_usu = $_SESSION['perfil_usu'];

switch ($perfil_usu){

	case '1':
	include "administrador.php";
	break;
	
	case '2':
	include "financeiro.php";
	break;
	
	case '3':
	include "consultor.php";
	break;
	
	case '4':
	include "tecnico-interno.php";
	break;
	
	case '5';
	include "tecnico-externo-novo.php";
	break;
	
	case '6';
	include "fiscal.php";
	break;

		
	case '7':
	include "recepcionista.php";
	break;


	default:
	include ("index.php");
	break;
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 
<title>SGINFO - Sistema de Gestao de Servicos em Informatica</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="author" content="Adriano Nogueira - Desenvolvedor">
   <meta content= "SGOFIC - SISTEMA DE GESTÃO DE OFICINAS" name="description">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="utf-8">
   <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
   <link rel="stylesheet" href="bootstrap/bootstrap-icons.css">
   
   <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
   <script src="bootstrap/popper.min.js"></script>
   <script src="bootstrap/bootstrap.min.js"></script>
 </head>

<body>
<form id="form1" name="form1" method="post" action="processa-login.php">
  <table width="350" border="0" align="center">
    <tr>
      <td  align="center"><img src="imagens/logo techfy.png" alt="" width="350" height="200" /></td>
    </tr>
    <tr>
      <td height="50"><legend><h6>Seja Bem Vindo<?php echo date('d/m/Y',strtotime('+2 Monday')); ?></legend></h6</td>
    </tr>
    <tr>
      <td height="50">
      <form class="form-inline">
   		<div class="input-group">
		<div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">@</span>
    </div>
      <input name="login" type="text" id="login"  maxlength="30" class="form-control" placeholder="Login" />
	  </div>    

   </td>
    </tr>
    <tr>                    
      <td height="50">
      <form class="form-inline">
   		<div class="input-group">
		    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">**</span>
    </div><input name="senha" type="password" class="form-control" id="senha"  maxlength="30" placeholder="Senha" />
    </div>  
      </td>
    </tr>
    <tr>
      <td height="50"><button type="button" class="btn btn-link">Esqueci minha senha</button></td>
    </tr>
    <tr>
      <td align="right" height="50"><input type="submit" name="button2" id="button2" class="btn btn-outline-primary btn-block" value="Entrar" class="botao" /></td>
    </tr>
  </table>
</form>
</body>
</html>
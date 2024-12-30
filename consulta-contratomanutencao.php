<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consulta de Contrato de Manutenção</title>
</head>

<body>
<form name="listagem" action="listagem-clientes.php" method="post" onSubmit="return validaForm()">
<table width="100%" border="0" align="left" cellpadding="3" cellspacing="0">
  <tr>
    <th height="30" class="bg-primary" scope="col"><h4>Módulo de Contrato de Manutenção</h4></th>
  </tr>
  <tr>
    <td>      
    <div class="radio">
	    <label><input type="radio" name="criterio" value="R" checked="checked">PESQUISAR PELO NOME</label>
  		<label><input type="radio" name="criterio" value="C">PESQUISAR PELO CPF/CNPJ</label>      
        <label><input type="radio" name="criterio" value="I">PESQUISAR PELO ID</label>

	<input type="text" class="form-group input-lg" required="required" placeholder="Informe Parametro" name="valor" id="valor" size="50%"/>
    <input type="submit" class="btn btn-success btn-lg" name="buscar"  value="Buscar Dados" />
    <a href="cadastro-clientes.php"><img src="imagens/contrato.png" width="41" height="40" alt="novo" title="Clique para um Novo Cliente" /></a>
    </div>
    </td>

  </tr>
</table>
</form>
</body>
</html>
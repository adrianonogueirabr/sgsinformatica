<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/formularios.css" rel="stylesheet" />

<script language="JavaScript">

	function validaForm(){
		d = document.listagem;
		
		if (d.id.value == ""){
			alert("O campo " + d.id.name + " deve ser preenchido!");
			d.id.focus();
			return false;
		}
		
		return true;
		
	}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consulta de Equipamentos Para OS</title>
</head>

<body>
<form name="listagem" action="detalhes-busca-equipamentos-os.php" method="post" onSubmit="return validaForm()">
<table width="700" border="0">
  <tr>
    <td height="30" bgcolor="#990000">
    <div id="imagemTitulo">
        	<a href="consulta-os.php"><img src="imagens/voltar.png" width="30" height="30" alt="voltar" /></a>
    </div>
   	<div id="tituloFormulario">Buscar Equipamento para Ordem de Servico</div>
    </td>
  </tr>
  <tr>
    <td height="52"><table width="680" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td width="188" height="31"><div id="nomeCriterio">INFORME O ID DO EQUIPAMENTO</div></td>
        <td width="69"><input name="id" type="text" id="id" size="10" /></td>
        <td width="140" align="center"><input type="submit" name="buscar"  value="Buscar Equipamento" /></td>
        <td width="259" colspan="3" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="40" bgcolor="#990000">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
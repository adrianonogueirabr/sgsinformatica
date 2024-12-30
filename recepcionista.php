<?php include "verifica.php" ?>

<?php 
// Leandro Alexandre 
// Colaboração para o Open Source para comunidade Linux do Brasil

// leitura das datas automaticamente
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$semana = date('w');
$cidade = "Manaus";

// configuração mes 

switch ($mes){

case 1: $mes = "Janeiro"; break;
case 2: $mes = "Fevereiro"; break;
case 3: $mes = "Março"; break;
case 4: $mes = "Abril"; break;
case 5: $mes = "Maio"; break;
case 6: $mes = "Junho"; break;
case 7: $mes = "Julho"; break;
case 8: $mes = "Agosto"; break;
case 9: $mes = "Setembro"; break;
case 10: $mes = "Outubro"; break;
case 11: $mes = "Novembro"; break;
case 12: $mes = "Dezembro"; break;

}


// configuração semana 

switch ($semana) {

case 0: $semana = "Domingo"; break;
case 1: $semana = "Segunda Feira"; break;
case 2: $semana = "Terça Feira"; break;
case 3: $semana = "Quarta Feira"; break;
case 4: $semana = "Quinta Feira"; break;
case 5: $semana = "Sexta Feira"; break;
case 6: $semana = "Sábado"; break;

}
//Agora basta imprimir na tela...
//echo ("$cidade, $semana, $dia de $mes de $ano");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />
<script type="text/javascript" src="javascript/cadastro_cliente.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Adriano Nogueira - Desenvolvedor">
<meta content= "SGADM - SISTEMA DE GESTÃO ADMINFOR SOLUCOES EM TI" name="description">
<title>SGAD - SISTEMA DE GESTÃO ADMINFOR SOLUCOES EM TI</title>
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td height="30" colspan="11" align="rigth" class="bg-primary">
    <h4>Usuario: <?php echo $login_usuario ?></h4>
    </td>
  </tr>
  <tr>
    <td width="68" align="center"><a href="consulta-clientes.php" target="new"><img src="imagens/novo.png" alt="" width="60" height="60" title="Módulo de Clientes" /></a></td>
    <td width="68" align="center"><a href="consulta-equipamentos.php" target="new"><img src="imagens/computador.png" alt="" width="60" height="60" title="Módulo de Equipamentos" /></a></td>
    <td width="68" align="center"><a href="consulta-os.php" target="new"><img src="imagens/os.png" alt="" width="60" height="60" title="Módulo de Ordem de Servicos" /></a></td>
    <!--
    <td width="68" align="center"><a href="consulta-apontamento.php" target="new"><img src="imagens/servicos.jpg" alt="" width="60" height="60" title="Módulo de Apontamento" /></a></td>
    <td width="68" align="center"><a href="corrigir-apontamento.php" target="new"><img src="imagens/alterar.png" title="Correção de Apontamentos" width="60" height="60" /></a></td>
	<td width="68" align="center"><a href="fechamento-os.php" target="new"><img src="imagens/faturar.jpg" alt="" width="60" height="60" title="Módulo Fechamento de OS" /></a></td>
-->
    <td width="68" align="center"><a href="logout.php"><img src="imagens/sair.png" alt="" width="60" height="60" title="Sair do Sistema" /></a></td>
    <td width="68" align="center">&nbsp;</td>
    <td width="68" align="center">&nbsp;</td>
    <td width="68" align="center">&nbsp;</td>
    <td width="236" align="center"><img src="imagens/logo techfy.png" alt="" width="145" height="100" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
    <td><h4><?php echo ("$cidade, $semana $dia de $mes de $ano");?></h4></td>
  </tr>
</table>
</body>
</html>
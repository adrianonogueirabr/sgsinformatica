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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.css" rel="stylesheet" />
<script type="text/javascript" src="javascript/cadastro_cliente.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Adriano Nogueira - Desenvolvedor">
<meta content= "SGADM - SISTEMA DE GESTÃO ADMINFOR SOLUCOES EM TI" name="description">
<title>SGAD - SISTEMA DE GESTÃO ADMINFOR SOLUCOES EM TI</title>
</head>

<body>
<table width="100%">
  <tr>
    <td height="30" colspan="9"  class="bg-primary">
    <h4>Usuario: <?php echo $login_usuario ?> | <?php echo ("$cidade, $semana $dia de $mes de $ano");?></h4>
    </td>
  </tr>
  <tr>
    <td><a href="consulta-clientes.php" ><img src="imagens/novo.png" width="50" height="50" title="Módulo de Clientes" /></a></td>
    <td><a href="consulta-equipamentos.php" ><img src="imagens/computador.png" width="50" height="50" title="Módulo de Equipamentos" /></a></td>
    <td><a href="consulta-os.php" ><img src="imagens/os.png" width="50" height="50" title="Módulo de Ordem de Servicos" /></a></td>
    <td><a href="consulta-apontamento.php" ><img src="imagens/servicos.jpg" width="50" height="50" title="Módulo de Apontamento" /></a></td>
    <td><a href="corrigir-apontamento.php" ><img src="imagens/alterar.png" title="Correção de Apontamentos" width="50" height="50" /></a></td>
	  <td><a href="fechamento-os.php" ><img src="imagens/faturar.jpg" width="50" height="50" title="Módulo Faturamento de OS" /></a></td>
    <td><a href="logout.php"><img src="imagens/sair.png" width="50" height="50" title="Sair do Sistema" /></a></td>
    <td width="236"><img src="imagens/logo techfy.png" alt="" width="145" height="100" /></td>
  </tr>

</table>
</body>
</html>
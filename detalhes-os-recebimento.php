<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/formularios.css" rel="stylesheet" />
<script type="text/javascript" src="javascript/listagem_os.js"></script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalhe de Ordem de Serviço</title>
</head>

<?php

	include "conexao.php";

	$id = $_GET['id'];

	$sql = "SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$id'";
	$res = mysql_query($sql);

?>

<body>
<form name="equipamento" method="post">
<table width="700" border="1">
  <tr>
    <td height="30" bgcolor="#990000">
    <div id="imagemTitulo">
        	<a href="consulta-os.php">
       	  <img src="imagens/voltar.png" width="29" height="29" alt="voltar" /></a>
        </div>
    	<div id="imagemTitulo">
        	<a href="alterar-os.php?id=<?php echo $id?>" onclick="return verificaStatusOs()">
       	    <img src="imagens/alterar.png" width="30" height="30" alt="alterar" /></a>
        </div>
        <div id="imagemTitulo">
        	    <a href="cancelamento-os.php?os=<?php echo $id ?>">
            	<img src="imagens/cancelar.jpg" width="30" height="30" title="CANCELAR OS"/></a></div>
        <div id="tituloFormulario">Detalhe da Ordem de Serviço</div>    
    </td>
  </tr>
  <tr>
    <td><table width="638" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td height="20"><div id="nomeCampoRegistro">NUMERO DA ORDEM DE SERVICO</div></td>
        <td height="20"><div id="nomeCampoRegistro">TIPO DE ATENDIMENTO</div></td>
      </tr>
      <tr>
        <?php
		while ($row = mysql_fetch_array($res)){			
	?>
        <td><input name="tipo" type="text" disabled="disabled" id="tipo" size="40" value="<?php echo $row["NUM_ID_OS"] ?>" maxlength="20" /></td>
        <td><input name="tipo_atendimento" type="text" disabled="disabled" id="tipo_atendimento" size="40" value="<?php echo $row["TXT_TIPO_ATENDIMENTO_OS"] ?>" maxlength="20" /></td>
      </tr>
      <tr>
        <td height="20" colspan="2"><div id="nomeCampoRegistro">IDENTIFICACAO DO CLIENTE*:</div></td>
      </tr>
      <tr>
        <td colspan="2"><input name="id_cliente" type="text" disabled="disabled" id="id_cliente" value="<?php echo $row["TBL_CLIENTE_CLI_NUM_ID_CLI"] ?>" size="10" maxlength="20" />
          <?php
			$cli = $row["TBL_CLIENTE_CLI_NUM_ID_CLI"];
			$sql_nome = "SELECT TXT_RAZAO_CLI  FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$cli'";
			$res_nome = mysql_query($sql_nome);
			while($row_nome = mysql_fetch_array($res_nome)){
		?>
          <input name="nomecliente" type="text" disabled="disabled" value="<?php echo $row_nome["TXT_RAZAO_CLI"] ?>" id="nomecliente" size="60" />
          <?php 
			}
        ?></td>
      </tr>
      <tr>
        <td height="20" colspan="2"><div id="nomeCampoRegistro">IDENTIFICACAO DO  EQUIPAMENTO*:</div></td>
      </tr>
      <tr>
        <td colspan="2"><input name="setor" type="text" disabled="disabled" id="setor" size="10" maxlength="50" value="<?php echo $row["TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP"] ?>" />
          <?php
			$equip = $row["TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP"];
			$sql_equip = "SELECT * FROM TBL_EQUIPAMENTO_EQUIP WHERE NUM_ID_EQUIP = '$equip'";
			$res_equip = mysql_query($sql_equip);
			while($row_equip = mysql_fetch_array($res_equip)){
		?>
          <input name="descricao" type="text" disabled="disabled" id="descricao" size="60" value="<?php echo $row_equip["TXT_DESCRICAO_EQUIP"] ?>" maxlength="50" /></td>
      </tr>
      <tr>
        <td height="20"><div id="nomeCampoRegistro">LOGIN</div></td>
        <td height="20"><div id="nomeCampoRegistro">SENHA</div></td>
      </tr>
      <tr>
        <td><input name="login" type="text" disabled="disabled" id="login" value="<?php echo $row_equip["TXT_LOGIN_EQUIP"] ?>" size="40" maxlength="20" /></td>
        <td><input name="senha" type="text" disabled="disabled" id="senha" size="40" value="<?php echo $row_equip["TXT_SENHA_EQUIP"] ?>" maxlength="20"/></td>
      </tr>
      <tr>
        <td colspan="2"><div id="nomeCampoRegistro">DADOS DE HD / PROCESSADOR / MEMORIA / PLACA MAE</div></td>
      </tr>
      <tr>
        <td colspan="2"><input name="hd" type="text" disabled="disabled" id="hd" value="<?php echo $row_equip["NUM_HD_EQUIP"] ?>" size="5" maxlength="20" />
          <input name="processador" type="text" disabled="disabled" id="processador" size="30" value="<?php echo $row_equip["TXT_PROCESSADOR_EQUIP"] ?>" maxlength="20" />
          <input name="memoria" type="text" disabled="disabled" id="memoria" value="<?php echo $row_equip["NUM_MEMORIA_EQUIP"] ?>" size="5" maxlength="20"/>
          <input name="placamae" type="text" disabled="disabled" id="placamae" value="<?php echo $row_equip["TXT_PLACAMAE_EQUIP"] ?>" size="20" maxlength="20" /></td>
      </tr>
      <tr>
        <td colspan="2"><div id="nomeCampoRegistro">APLICATIVOS:</div></td>
      </tr>
      <tr>
        <td colspan="2"><input name="aplicativos" type="text" disabled="disabled" id="aplicativos" value="<?php echo $row_equip["TXT_APLICATIVOS_EQUIP"] ?>" size="90" maxlength="50" /></td>
      </tr>
      <tr>
        <td colspan="2"><div id="nomeCampoRegistro">SISTEMA OPERACIONAL / DATA DE REGISTRO:</div></td>
      </tr>
      <tr>
        <td colspan="2"><input name="sistemaoperacional" type="text" disabled="disabled" id="sistemaoperacional" value="<?php echo $row_equip["TBL_SISTEMAOPERACIONAL_SO_NUM_ID_SO"] ?>" size="5" maxlength="20" />
          <?php
				$so = $row_equip["TBL_SISTEMAOPERACIONAL_SO_NUM_ID_SO"];
				$sql_so = "SELECT TXT_NOME_SO  FROM TBL_SISTEMAOPERACIONAL_SO WHERE NUM_ID_SO = '$so'";
				$res_so = mysql_query($sql_so);
				while($row_so = mysql_fetch_array($res_so)){
			?>
          <input name="nomeso" type="text" disabled="disabled" id="nomeso" value="<?php echo $row_so["TXT_NOME_SO"] ?>" size="30" />
          <input name="registro" type="text" disabled="disabled" id="registro" size="30" maxlength="50" value="<?php echo $row_equip["DTA_REGISTRO_EQUIP"] ?>" />
          <?php } ?></td>
        <?php 
				}
	   ?>
      </tr>
      <tr>
        <td width="272"><div id="nomeCampoRegistro">DADOS GERAIS EQUIPAMENTO:</div></td>
        <td width="354">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><input name="dadosgerais" type="text" disabled="disabled" id="dadosgerais" size="90" maxlength="50" value="<?php echo $row["TXT_DADOSGERAIS_OS"] ?>" /></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><div id="nomeCampoRegistro">RECLAMAÇÃO:</div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><label for="textarea"></label>
          <textarea name="textarea" cols="90" rows="3" disabled="disabled" id="textarea"><?php echo $row["TXT_RECLAMACAO_OS"] ?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><div id="nomeCampoRegistro">DEFEITO:</div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><label for="textarea"></label>
          <textarea name="textarea" cols="90" rows="3" disabled="disabled" id="textarea"><?php echo $row["TXT_DEFEITO_OS"] ?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><div id="nomeCampoRegistro">SOLUCAO:</div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><label for="textarea"></label>
          <textarea name="textarea" cols="90" rows="3" disabled="disabled" id="textarea"><?php echo $row["TXT_RESOLUCAO_OS"] ?></textarea></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><div id="nomeCampoRegistro">CANCELAMENTO:</div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><label for="textarea"></label>
          <textarea name="textarea" cols="90" rows="3" disabled="disabled" id="textarea"><?php echo $row["TXT_CANCELAMENTO_OS"] ?></textarea></td>
      </tr>
      <tr>
        <td><div id="nomeCampoRegistro">DATA DE REGISTRO OS:</div></td>
        <td><div id="nomeCampoRegistro">DATA PREVISAO OS:</div></td>
      </tr>
      <tr>
        <td><input name="registro_os3" type="text" disabled="disabled" id="registro_os3" size="40" maxlength="50" value="<?php echo $row["DTA_ABERTURA_OS"] ?>" /></td>
        <td><input name="registro_os" type="text" disabled="disabled" id="registro_os" size="40" maxlength="50" value="<?php echo $row["DTA_PREVISAO_OS"] ?>" /></td>
      </tr>
      <tr>
        <td><div id="nomeCampoRegistro">DATA TÉRMINO OS:</div></td>
        <td><div id="nomeCampoRegistro">STATUS DA OS:</div></td>
      </tr>
      <tr>
        <td><input name="registro_os4" type="text" disabled="disabled" id="registro_os4" size="40" maxlength="50" value="<?php echo $row["DTA_ENCERRAMENTO_OS"] ?>" /></td>
        <td><input name="registro_os2" type="text" disabled="disabled" id="registro_os2" size="40" maxlength="50" value="<?php echo $row["TXT_STATUS_OS"] ?>" /></td>
      </tr>
      <?php
		}
	 ?>
    </table></td>
  </tr>
  <tr>
    <td height="40" bgcolor="#990000">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
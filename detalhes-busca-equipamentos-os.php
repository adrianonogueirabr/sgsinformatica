<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/formularios.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalhe de Equipamentos</title>
</head>

<?php
include "conexao.php";

	$id = $_POST['id'];

	$sql = "SELECT * FROM TBL_EQUIPAMENTO_EQUIP WHERE NUM_ID_EQUIP = '$id'";
	$res = mysql_query($sql);
	
	if(mysql_num_rows($res)==""){
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=buscar-equipamento-os.php'>
			<script type=\"text/javascript\">
			alert(\"Dados nao encontrados!\");
			</script>";		
		
	}else{		

?>
<body>
<?php
		while ($row = mysql_fetch_array($res)){	
?>

<form name="equipamento" method="post">
<table width="700" border="1" align="left">
  <tr>
    <td bgcolor="#990000">    
    	<div id="imagemTitulo">
        	<a href="buscar-equipamento-os.php">
            	<img src="imagens/voltar.png" width="29" height="29" alt="voltar" />
            </a>
        </div>
    	<div id="imagemTitulo">
        	<a href="cadastro-os.php?id_equip=<?php echo $row["NUM_ID_EQUIP"] ?>&id_cliente_equip=<?php echo $row["TBL_CLIENTE_CLI_NUM_ID_CLI"] ?>"><img src="imagens/os.png" width="30" height="30" alt="cadastro" title="CONTINUAR INSERINDO DADOS DA OS" /></a>
        </div>    
        <div id="tituloFormulario">Detalhes do Equipamento Para Abertura de Ordem de Servico</div>
    
    </td>
  </tr>
  <tr>
    <td height="711">
    <table width="680" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td width="336" height="20"><div id="nomeCampoRegistro">TIPO EQUIPAMENTO:</div></td>
        <td width="327"><div id="nomeCampoRegistro">ID DO CLIENTE:</div></td>
      </tr>
      <tr>
        <td><input name="tipo" type="text" disabled="disabled" id="tipo" size="20" value="<?php echo $row["TXT_TIPO_EQUIP"] ?>" maxlength="20" /></td>
        <td><input name="id_cliente" type="text" disabled="disabled" id="id_cliente" value="<?php echo $row["TBL_CLIENTE_CLI_NUM_ID_CLI"] ?>" size="5" maxlength="20" />
          <?php
			$cli = $row["TBL_CLIENTE_CLI_NUM_ID_CLI"];
			$sql_nome = "SELECT TXT_RAZAO_CLI  FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$cli'";
			$res_nome = mysql_query($sql_nome);
			while($row_nome = mysql_fetch_array($res_nome)){
			?>
          <input name="nomecliente" type="text" disabled="disabled" value="<?php echo $row_nome["TXT_RAZAO_CLI"] ?>" id="nomecliente" size="35" />
          <?php 
			}
		  ?></td>
      </tr>
      <tr>
        <td height="20"><div id="nomeCampoRegistro">SETOR:</div></td>
        <td><div id="nomeCampoRegistro">NOME NA REDE:</div></td>
      </tr>
      <tr>
        <td><input name="setor" type="text" disabled="disabled" id="setor" size="45" maxlength="50" value="<?php echo $row["TXT_SETOR_EQUIP"] ?>" /></td>
        <td><input name="nomerede" type="text" disabled="disabled" id="nomerede" size="45" maxlength="50" value="<?php echo $row["TXT_NOMEREDE_EQUIP"] ?>" /></td>
      </tr>
      <tr>
        <td height="20"><div id="nomeCampoRegistro">UTILIZACAO DO EQUIPAMENTO:</div></td>
        <td><div id="nomeCampoRegistro">LOGIN*:</div></td>
      </tr>
      <tr>
        <td><input name="descricao" type="text" disabled="disabled" id="descricao" size="45" value="<?php echo $row["TXT_DESCRICAO_EQUIP"] ?>" maxlength="50" /></td>
        <td><input name="login" type="text" disabled="disabled" id="login" value="<?php echo $row["TXT_LOGIN_EQUIP"] ?>" size="20" maxlength="20" /></td>
      </tr>
      <tr>
        <td><div id="nomeCampoRegistro">SENHA:</div></td>
        <td><div id="nomeCampoRegistro">UTILIZADORES:</div></td>
      </tr>
      <tr>
        <td><input name="senha" type="text" disabled="disabled" id="senha" size="20" value="<?php echo $row["TXT_SENHA_EQUIP"] ?>" maxlength="20"/></td>
        <td><input name="utilizadores" type="text" disabled="disabled" id="utilizadores" size="20" value="<?php echo $row["TXT_UTILIZADORES_EQUIP"] ?>" maxlength="20" /></td>
      </tr>
      <tr>
        <td height="20"><div id="nomeCampoRegistro">HD:</div></td>
        <td><div id="nomeCampoRegistro">PROCESSADOR:</div></td>
      </tr>
      <tr>
        <td><input name="hd" type="text" disabled="disabled" id="hd" value="<?php echo $row["NUM_HD_EQUIP"] ?>" size="20" maxlength="20" /></td>
        <td><input name="processador" type="text" disabled="disabled" id="processador" size="45" value="<?php echo $row["TXT_PROCESSADOR_EQUIP"] ?>" maxlength="20" /></td>
      </tr>
      <tr>
        <td height="20"><div id="nomeCampoRegistro">MEMORIA:</div></td>
        <td><div id="nomeCampoRegistro">PLACA MAE:</div></td>
      </tr>
      <tr>
        <td><input name="memoria" type="text" disabled="disabled" id="memoria" value="<?php echo $row["NUM_MEMORIA_EQUIP"] ?>" size="20" maxlength="20"/></td>
        <td><input name="placamae" type="text" disabled="disabled" id="placamae" value="<?php echo $row["TXT_PLACAMAE_EQUIP"] ?>" size="20" maxlength="20" /></td>
      </tr>
      <tr>
        <td height="20"><div id="nomeCampoRegistro">MONITOR:</div></td>
        <td><div id="nomeCampoRegistro">APLICATIVOS:</div></td>
      </tr>
      <tr>
        <td><input name="monitor" type="text" disabled="disabled" id="monitor" size="20" value="<?php echo $row["TXT_MONITOR_EQUIP"] ?>" maxlength="20" /></td>
        <td><input name="aplicativos" type="text" disabled="disabled" id="aplicativos" value="<?php echo $row["TXT_APLICATIVOS_EQUIP"] ?>" size="45" maxlength="50" /></td>
      </tr>
      <tr>
        <td height="20"><div id="nomeCampoRegistro">NFE:</div></td>
        <td><div id="nomeCampoRegistro">SISTEMA OPERACIONAL:</div></td>
      </tr>
      <tr>
        <td width="336"><input name="nfe" type="text" disabled="disabled" id="nfe" size="20" maxlength="20" value="<?php echo $row["NUM_NFE_EQUIP"] ?>" /></td>
        <td><input name="sistemaoperacional" type="text" disabled="disabled" id="sistemaoperacional" value="<?php echo $row["TBL_SISTEMAOPERACIONAL_SO_NUM_ID_SO"] ?>" size="5" maxlength="20" />
          <?php
				$so = $row["TBL_SISTEMAOPERACIONAL_SO_NUM_ID_SO"];
				$sql_nome = "SELECT TXT_NOME_SO  FROM TBL_SISTEMAOPERACIONAL_SO WHERE NUM_ID_SO = '$so'";
				$res_nome = mysql_query($sql_nome);
				while($row_nome = mysql_fetch_array($res_nome)){
			?>
          <input name="nomeso" type="text" disabled="disabled" id="nomeso" value="<?php echo $row_nome["TXT_NOME_SO"] ?>" size="35" /></td>
			<?php 
				}
	   		?>
      </tr>
      <tr>
        <td height="20"><div id="nomeCampoRegistro">MARCA:</div></td>
        <td><div id="nomeCampoRegistro">MODELO:</div></td>
      </tr>
      <tr>
        <td><input name="marca" type="text" disabled="disabled" id="marca" size="45" value="<?php echo $row["TXT_MARCA_EQUIP"] ?>" maxlength="50" /></td>
        <td><input name="modelo" type="text" disabled="disabled" id="modelo" size="45" maxlength="50" value="<?php echo $row["TXT_MODELO_EQUIP"] ?>" /></td>
      </tr>
      <tr>
        <td height="20"><div id="nomeCampoRegistro">SERIAL DO EQUIPAMENTO:</div></td>
        <td><div id="nomeCampoRegistro">DATA DE REGISTRO:</div></td>
      </tr>
      <tr>
        <td><input name="serial" type="text" disabled="disabled" id="serial" size="45" maxlength="30" value="<?php echo $row["TXT_SERIAL_EQUIP"] ?>" /></td>
        <td><input name="registro" type="text" disabled="disabled" id="registro" size="45" maxlength="50" value="<?php echo $row["DTA_REGISTRO_EQUIP"] ?>" /></td>
      </tr>
      <tr>
        <td height="20"><div id="nomeCampoRegistro">ATIVO:</div></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><input name="modelo2" type="text" disabled="disabled" id="modelo2" size="45" maxlength="50" value="<?php echo $row["TXT_ATIVO_EQUIP"] ?>" /></td>
        <td>&nbsp;</td>
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
<?php }?>
</html>
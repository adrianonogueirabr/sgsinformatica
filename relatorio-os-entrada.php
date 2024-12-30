<?php include "verifica.php"; 
//LIBERACAO TECNICO PARA APROVAR E EXECUTAR SERVICO DAS OS
	
	include "conexao.php";
	
	$valor = base64_decode($_GET['id']);	
	
	$sql = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$valor'");		
	//caso a os esteja com status nao permitido
  $sql->execute();
	if($sql->rowCount()<=0){	
		echo "
			<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes ou OS com status nao permitido!\");
			</script>";		
	}else{
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<title>Impressão Comprovante de Entrada</title>
</head>
<body>

<form>

<table width="100%" >
  <tr>
    <td  align="center">     
      <?php	while ($row = $sql->fetch(PDO::FETCH_OBJ)){	?>
      
      <table width="100%"  align="center" >
        <tr>
          <td colspan="4">
            <table width="100%">
              <?php 
			  	    //selecao da empresa para cabecalho do relatorioS
					    $empresa = $row->TBL_EMPRESA_EMP_NUM_ID_EMP;
				     	$sql_empresa = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = $empresa");
				    	$sql_empresa->execute();
				    	while ($row_empresa = $sql_empresa->fetch(PDO::FETCH_OBJ)){?>
                <tr><td  rowspan="4"><img src="imagens/logo techfy.png" width="180" height="110" /></td>
                <td><label><?php echo $row_empresa->TXT_FANTASIA_EMP ?></label></td></tr>
              <tr><td><label><?php echo $row_empresa->TXT_LOGRADOURO_EMP ?> N<?php echo $row_empresa->NUM_NUMERO_EMP ?>, <?php echo $row_empresa->TXT_BAIRRO_EMP ?>,<?php echo $row_empresa->TXT_CIDADE_EMP ?>-<?php echo $row_empresa->TXT_ESTADO_EMP ?></label></td></tr>
              <tr><td><label><?php echo $row_empresa->TXT_EMAIL_EMP ?></label></td></tr>
              <tr><td><label><?php echo $row_empresa->TXT_TELEFONE_EMP ?></label></td></tr>
              <?php } ?>
              </table>
              <legend>Comprovante de Entrada de Equipamento</legend>
            </td>
          </tr>
        <tr>
          <td><label>NUMERO DA OS</label></td>
          <td><label>TIPO DE OS</label></td>
          <td><label>TIPO DE EQUIPAMENTO</label></td>
          <td><label>SERIAL EQUIPAMENTO</label></td>
          </tr>
        <tr>
          
          <td>            
            <p><?php echo $row->NUM_ID_OS ?></p>
            <input type="hidden" name="id_os" id="id_os" value="<?php echo $row->NUM_ID_OS ?>" />            
            <input type="hidden" name="tipo_os" id="tipo_os" value="<?php echo $row->TXT_TIPO_OS ?>" /></td>
          <td>
            <?php if($row->TXT_TIPO_OS=='P'){?> <p>PADRAO</p> <?php }else if($row->TXT_TIPO_OS=='C'){ ?>
            <p>CONTRATO</p> <?php }else if($row->TXT_TIPO_OS=='G'){ ?> <p>GARANTIA</p><?php }?>
          </td>

          <?php 
		$equipamento = $row->TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP;
		//select para pegar tipo de equipamento e serial
		$sql_equipamento = $con->prepare("SELECT * FROM TBL_EQUIPAMENTO_EQUIP WHERE NUM_ID_EQUIP = '$equipamento'");
		$sql_equipamento->execute();
		
		while($row_equipamento = $sql_equipamento->fetch(PDO::FETCH_OBJ)){
          $registro_equipamento = $row_equipamento->NUM_ID_EQUIP 		
		      ?>
          <td><p><?php echo $row_equipamento->TXT_TIPO_EQUIP ?> </p></td>
          <td><p><?php echo $row_equipamento->TXT_SERIAL_EQUIP ?></p></td>  
          <?php }//fim select pegar dados do equipamento ?>
          </tr>

        <tr>
          <td  colspan="2" ><label>IDENTIFICACAO DO CLIENTE</label></td>
          <td><label>TELEFONE</label></td>
          <td><label>ABERTURA DA OS</label></td>
          </tr>
        <tr>
          <td colspan="2">
            
            <?php	//seleciona nome e telefone do cliente da ordem de servico
					$cli = $row->TBL_CLIENTE_CLI_NUM_ID_CLI;
					$sql_nome = $con->prepare("SELECT TXT_RAZAO_CLI,TXT_TELEFONE_CLI  FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$cli'");
					$sql_nome->execute();
					while($row_nome = $sql_nome->fetch(PDO::FETCH_OBJ)){
				  ?>
            <p> <?php echo $cli ?> | <?php echo $row_nome->TXT_RAZAO_CLI; ?> </p></td>
          <td><p><?php echo $row_nome->TXT_TELEFONE_CLI; ?> </p></td><?php }//fim nome e telefone do cliente ?> <td>
		  
				<?php 	//selecionar o login do usuario que executou a ordem de servico
					$usu = $row->TBL_USUARIO_USU_NUM_ID_USU;
					$sql_login = $con->prepare("SELECT TXT_NOME_USU FROM TBL_USUARIO_USU WHERE NUM_ID_USU = '$usu'");
					$sql_login->execute();
					while($row_login = $sql_login->fetch(PDO::FETCH_OBJ)){
				?>
         <p><?php echo $row_login->TXT_NOME_USU ?></p>	</td><?php }//fim login do usuario ?></tr>
        <tr><td><label>DADOS GERAIS</label></td></tr>
        <tr>
          <td colspan="4"><p> <?php echo $registro_equipamento ?> | <?php echo $row->TXT_DADOSGERAIS_OS ?> </p></td>
        </tr>
        <tr><td><label>RECLAMAÇÃO DO CLIENTE</label></td></tr>
        <tr>
          <td colspan="4"><p><?php echo $row->TXT_RECLAMACAO_OS ?></p></td>
          <?php 
           //CAPTURA DATA INICIO E ENCERRAMENTO DA ORDEM DE SERVICO
           $data_inicio = $row->DTA_ABERTURA_OS; $data_final = $row->DTA_ENCERRAMENTO_OS;}?>
        </tr>
  </table>      
  </td>
  </tr>
  <tr>
  <td>
    <br>
  <label>**Em um prazo máximo de 48H entraremos em contato para seu diagnóstico.**</label></p>
  <label>**Os aparelhos nao retirados no prazo máximo de 30 dias contados apartir de (<?php echo date("d/m/Y",strtotime($data_inicio)) ?>), para sua retirada sofrerão acréscimo das despesas de armazenamento e seguro.**</label></p>
  <label>**O aparelho somente será devolvido mediante a apresentação desta, portanto guarde-a com cuidado.**</label></p>
  <label>**Ao ligar para a ADM Informática, informe o numero da Ordem de Serviço (N<?php echo $valor ?>) para melhor atende-lo.</label></p>
	<br>
  </td>
  </tr>
  <tr>
    <td>
      <label>Recebimento <?php echo date("d/m/Y",strtotime($data_inicio)) ?></label>
      <img src="imagens/assinaturas.png" width="685" height="67" />
    </td>
  </tr>
  <tr>
    <td>
      <br></br>
      <label>Devolução ___/___/_____</label>
      <img src="imagens/assinaturas.png" width="685" height="67" />
    </td>
  </tr>
  </table>
</form>

</body>
</html>

<?php
	}//fim status de os nao permitido//
?>
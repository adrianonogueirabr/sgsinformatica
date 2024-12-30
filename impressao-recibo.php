<?php include "verifica.php"; 
	  include "valor_extenso.php"; 
	  include "conexao.php";
		$id_recebimento = $_GET["id"];
	
		$sql_recebimento = $con->prepare("SELECT * FROM TBL_RECEBIMENTO_REC WHERE NUM_ID_REC = '$id_recebimento'");
		if(!$sql_recebimento->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}
		
		while($row_recebimento = $sql_recebimento->fetch(PDO::FETCH_OBJ)){
			
			$valor_extenso = $row_recebimento->VAL_RECEBIDO_REC;
      $idRecibo = $row_recebimento->NUM_ID_REC;
      $documento = $row_recebimento->NUM_DOCUMENTO_REC;
      $valorRec = $row_recebimento->VAL_RECEBIDO_REC;
      $dataRec = $row_recebimento->DTH_RECEBIMENTO_REC;
      $referente = $row_recebimento->TXT_REFERENTE_REC;
      $idCliente = $row_recebimento->TBL_CLIENTE_CLI_NUM_ID_CLI;
      $fp = $row_recebimento->TBL_FORMA_PAGAMENTO_FP_NUM_ID_FP;
      $id_empresa_recibo = $row_recebimento->TBL_EMPRESA_EMP_NUM_ID_EMP;

    }

            
    $sql_fp = $con->prepare("SELECT TXT_NOME_FP FROM TBL_FORMA_PAGAMENTO_FP WHERE NUM_ID_FP = '$fp'");
    if(!$sql_fp->execute()){die ('Houve um erro na transacao: ' . mysqli_error($con));}
    $descricaoFP = $sql_fp->fetchColumn();

    
    //selecao da empresa para cabecalho do relatorio
	
		$sql_empresa = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = $id_empresa_recibo");
		if(!$sql_empresa->execute()){die ('Houve um erro na transacao' . mysqli_error());}    
    while ($row_empresa = $sql_empresa->fetch(PDO::FETCH_OBJ)){

      $nomeEmpresa = $row_empresa->TXT_FANTASIA_EMP;
      $logradouro = $row_empresa->TXT_LOGRADOURO_EMP;
      $numero = $row_empresa->NUM_NUMERO_EMP;
      $bairro = $row_empresa->TXT_BAIRRO_EMP ;
      $cidade = $row_empresa->TXT_CIDADE_EMP;
      $estado = $row_empresa->TXT_ESTADO_EMP;
      $email = $row_empresa->TXT_EMAIL_EMP;
      $telefone = $row_empresa->TXT_TELEFONE_EMP;
    
    }

		//selecao dos dados do cliente
    $sql_nome = $con->prepare("SELECT *  FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$idCliente'");
    if(!$sql_nome->execute()){die ('Houve um erro na transacao' . mysqli_error());}

    while($row_nome = $sql_nome->fetch(PDO::FETCH_OBJ)){
    
      $nomeCli = $row_nome->TXT_RAZAO_CLI;
      $cpfCnpjCli = $row_nome->TXT_CPF_CNPJ_CLI;
      $telefoneCli = $row_nome->TXT_TELEFONE_CLI;
      $logradouroCli = $row_nome->TXT_LOGRADOURO_CLI;
      $numeroCli = $row_nome->NUM_NUMERO_CLI;
      $bairroCli = $row_nome->TXT_BAIRRO_CLI;
      $cidadeCli = $row_nome->TXT_CIDADE_CLI;
      $estadoCli = $row_nome->TXT_ESTADO_CLI;

    }

	
	
		
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Impressão de Recibo</title>
</head>
<body>

<form name="listagem" method="post">

<table width="100%">
  <tr>
    <td colspan="5">
    <table width="100%"  cellpadding="3" cellspacing="3">          
          
              <tr><td rowspan="4"><img src="imagens/logo techfy.png" width="250" height="110" /></td>
              <td ><label><?php echo $nomeEmpresa?></label></td> </tr>
              <tr><td><label><?php echo $logradouro?> N<?php echo $numero ?>, <?php echo $bairro ?>, <?php echo $cidade ?>-<?php echo $estado ?></label></td></tr>
              <tr><td><label><?php echo $email ?></label></td></tr>
              <tr><td><label><?php echo $telefone ?></label></td></tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>     
      <legend>Recibo de Pagamento</legend> 
       <table width="100%" border="0" align="left" cellpadding="3" cellspacing="3">
        <tr><td><label>NOME:</label>          

            <?php echo $nomeCli ?>
        
         </td>
          <td rowspan="6">
            <table border="0" align="right">
              <tr><td><label>RECIBO N: </label> <?php echo $idRecibo ?></td></tr>
              <tr><td><LABEL>DOCUMENTO: </LABEL> <?php echo $documento ?></td></tr>
              <tr><td><LABEL>EMISSAO: </LABEL> <?php echo date("d/m/Y H:i:s",strtotime($dataRec)) ?></td></tr>
              <tr><td><LABEL>VALOR: R$</LABEL> <?php echo number_format($valorRec,2) ?> </td></tr>
              <tr><td><LABEL>FORMA PAG: </LABEL> <?php echo $descricaoFP ?> </td></tr>
            </table>            
          </td>
        </tr>
        <tr><td><LABEL>CPF/CNPJ: </LABEL> <?php echo $cpfCnpjCli ?></td></tr>
        <tr><td><LABEL>TELEFONE: </LABEL> <?php echo $telefoneCli ?></td></tr>
        <tr><td><LABEL>ENDERECO: </LABEL> <?php echo $logradouroCli ?>, N<?php echo $numeroCli ?></td></tr>
        <tr><td><LABEL>BAIRRO: </LABEL> <?php echo $bairroCli ?></td></tr>
        <tr><td><LABEL>CIDADE/ESTADO: </LABEL> <?php echo $cidadeCli ?>/<?php echo $estadoCli ?></td></tr>
      </table> 

    </td>
  </tr>
  <tr>
    <td>

    <?php //incluir informacao se titulo ou ordem de servico
    if($referente == "OS"){
      $mensagem = "de pagamento da ORDEM DE SERVICO de numero: $documento";      
    
    }elseif($referente == "TR"){
      $mensagem = "de pagamento do TITULO A RECEBER de numero: $documento";
    }elseif($referente == "AD"){
      $mensagem = "de ADIANTAMENTO para a ORDEM DE SERVICO de numero: $documento";
    } //fim caso seja titulo ?> 

      <p>
      <p>Recebemos de: <LABEL><?php echo $nomeCli ?></LABEL> a importância Supra de <LABEL><?php echo escreverValorMoeda($valor_extenso) ?></LABEL>. no dia <label><?php echo date("d/m/Y",strtotime($dataRec)) ?></label>. Proveniente <?php echo $mensagem ?>. Para Clareza, firmo(amos) o presente recibo.</p>
      <p>Impresso em <LABEL><?php echo date("d/m/Y H:i:s") ?></LABEL></p>
      

    </div></td>
  </tr>
  <tr>
  <td colspan="5" align="left"><img src="imagens/assinaturas_financeiro.png" width="90%" height="100" /></td>
  </tr>
  </table>

</form>
<p><hr /></p>

<form name="listagem" method="post">

<table width="100%">
  <tr>
    <td colspan="5">
    <table width="100%">   
              
              <tr><td rowspan="4"><img src="imagens/logo techfy.png" width="250" height="110" /></td>
              <td ><label><?php echo $nomeEmpresa ?></label></td> </tr>
              <tr><td><label><?php echo $logradouro ?> N<?php echo $numero ?>, <?php echo $bairro ?>, <?php echo $cidade?>-<?php echo $estado ?></label></td></tr>
              <tr><td><label><?php echo $email ?></label></td></tr>
              <tr><td><label><?php echo $telefone ?></label></td></tr>
              </table></td>
  </tr>
  <tr>
    <td colspan="5"> 
    <legend>Recibo de Pagamento</legend>      
      
   <table width="100%">
        <tr><td><label>NOME:</label> 
            <?php echo $nomeCli ?>
         </td>
          <td rowspan="6">
            <table border="0" align="right">
              <tr><td><label>RECIBO N: </label> <?php echo $idRecibo ?></td></tr>
              <tr><td><LABEL>DOCUMENTO: </LABEL> <?php echo $documento ?></td></tr>
              <tr><td><LABEL>EMISSAO: </LABEL> <?php echo date("d/m/Y H:i:s",strtotime($dataRec)) ?></td></tr>
              <tr><td><LABEL>VALOR: R$</LABEL> <?php echo number_format($valorRec,2) ?> </td></tr>
              <tr><td><LABEL>FORMA PAG: </LABEL> <?php echo $descricaoFP ?> </td></tr>
            </table>            
          </td>
        </tr>
        <tr><td><LABEL>CPF/CNPJ: </LABEL> <?php echo $cpfCnpjCli ?></td></tr>
        <tr><td><LABEL>TELEFONE: </LABEL> <?php echo $telefoneCli ?></td></tr>
        <tr><td><LABEL>ENDERECO: </LABEL> <?php echo $logradouroCli ?>, N<?php echo $numeroCli ?></td></tr>
        <tr><td><LABEL>BAIRRO: </LABEL> <?php echo $bairroCli ?></td></tr>
        <tr><td><LABEL>CIDADE/ESTADO: </LABEL> <?php echo $cidadeCli ?>/<?php echo $estadoCli?></td></tr>
      </table> 
    </td>
  </tr>
  <tr>
    <td>
      
    <?php //incluir informacao se titulo ou ordem de servico
    if($referente == "OS"){
      $mensagem = "de pagamento da ORDEM DE SERVICO de numero: $documento";      
    
    }elseif($referente == "TR"){
      $mensagem = "de pagamento do TITULO A RECEBER de numero: $documento";
    }elseif($referente == "AD"){
      $mensagem = "de ADIANTAMENTO para a ORDEM DE SERVICO de numero: $documento";
    } //fim caso seja titulo ?> 

      <p>
      <p>Recebemos de: <LABEL><?php echo $nomeCli ?></LABEL> a importância Supra de <LABEL><?php echo escreverValorMoeda($valor_extenso) ?></LABEL>. no dia <label><?php echo date("d/m/Y",strtotime($dataRec)) ?></label>. Proveniente <?php echo $mensagem ?>. Para Clareza, firmo(amos) o presente recibo.</p>
      <p>Impresso em <LABEL><?php echo date("d/m/Y H:i:s") ?></LABEL></p>
    </div></td>
  </tr>
  <tr>
  <td colspan="5" align="left"><img src="imagens/assinaturas_financeiro.png" width="90%" height="100" /></td>
  </tr>
  </table>

</form>
</body>
</html>
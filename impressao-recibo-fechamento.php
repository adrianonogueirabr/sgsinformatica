<?php include "verifica.php"; 
	  include "valor_extenso.php"; 
	  include "conexao.php";
		$referente = $_GET["referente"];
	  $documento = $_GET["documento"];
		$sql_recebimento = $con->prepare("SELECT * FROM TBL_RECEBIMENTO_REC WHERE TXT_REFERENTE_REC = '$referente' and NUM_DOCUMENTO_REC='$documento'");
		if(!$sql_recebimento->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}
		
		while($row_recebimento = $sql_recebimento->fetch(PDO::FETCH_OBJ)){
			
			$valor_extenso = $row_recebimento->VAL_VALORRECEBIDO_REC;
	
	//selecao da empresa para cabecalho do relatorio
		$id_empresa_recibo = $row_recebimento->TBL_EMPRESA_EMP_NUM_ID_EMP;
		$sql_empresa = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = $id_empresa_recibo");
		if(!$sql_empresa->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}
		
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
    <table width="100%">              
          <?php 
          while ($row_empresa = $sql_empresa->fetch(PDO::FETCH_OBJ)){
          ?>
              <tr><td rowspan="4"><img src="imagens/logo techfy.png" width="190" height="110" /></td>
              <td ><label><?php echo $row_empresa->TXT_FANTASIA_EMP ?></label></td> </tr>
              <tr><td><label><?php echo $row_empresa->TXT_LOGRADOURO_EMP ?> N<?php echo $row_empresa->NUM_NUMERO_EMP ?>, <?php echo $row_empresa->TXT_BAIRRO_EMP ?>, <?php echo $row_empresa->TXT_CIDADE_EMP ?>-<?php echo $row_empresa->TXT_ESTADO_EMP ?></label></td></tr>
              <tr><td><label><?php echo $row_empresa->TXT_EMAIL_EMP ?></label></td></tr>
              <tr><td><label><?php echo $row_empresa->TXT_TELEFONE_EMP ?></label></td></tr>
          <?php } ?>
      </table>
    </td>
  </tr>
  <tr>
    <td>     
      <legend>Recibo de Pagamento</legend> 
       <table width="100%">
        <tr><td><label>NOME:</label>          
        <?php         
          $cli = $row_recebimento->TBL_CLIENTE_CLI_NUM_ID_CLI;
          $sql_nome = $con->prepare("SELECT *  FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$cli'");
          if(!$sql_nome->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}
          while($row_nome = $sql_nome->fetch(PDO::FETCH_OBJ)){
        ?>
            <?php echo $row_nome->NUM_ID_CLI ?>
            <?php echo $row_nome->TXT_RAZAO_CLI ?>
         </td>
          <td rowspan="6">
            <table border="0" align="left">
              <tr><td><label>RECIBO N: </label> <?php echo $row_recebimento->NUM_ID_REC ?></td></tr>
              <tr><td><LABEL>DOCUMENTO: </LABEL> <?php echo $row_recebimento->NUM_DOCUMENTO_REC ?></td></tr>
              <tr><td><LABEL>EMISSAO: </LABEL> <?php echo date("d/m/Y",strtotime($row_recebimento->DTA_RECEBIMENTO_REC)) ?></td></tr>
              <tr><td><LABEL>VALOR: R$</LABEL> <?php echo $row_recebimento->VAL_VALORRECEBIDO_REC ?> </td></tr>
              <?php         
                $fp = $row_recebimento->TBL_FORMA_PAGAMENTO_FP_NUM_ID_FP;
                $sql_fp = $con->prepare("SELECT TXT_NOME_FP FROM tbl_formapagamento_fp WHERE NUM_ID_FP = '$fp'");
                if(!$sql_fp->execute()){die ('Houve um erro na transacao: ' . mysqli_error($con));}
                $descricaoFP = $sql_fp->fetchColumn();
              ?>
                <tr><td><LABEL>FORMA PAG: </LABEL> <?php echo $descricaoFP ?> </td></tr>
            </table>            
          </td>
        </tr>
        <tr><td><LABEL>CPF/CNPJ: </LABEL> <?php echo $row_nome->TXT_CPF_CNPJ_CLI ?></td></tr>
        <tr><td><LABEL>TELEFONE: </LABEL> <?php echo $row_nome->TXT_TELEFONE_CLI ?></td></tr>
        <tr><td><LABEL>ENDERECO: </LABEL> <?php echo $row_nome->TXT_LOGRADOURO_CLI ?>, N<?php echo $row_nome->NUM_NUMERO_CLI ?></td></tr>
        <tr><td><LABEL>BAIRRO: </LABEL> <?php echo $row_nome->TXT_BAIRRO_CLI ?></td></tr>
        <tr><td><LABEL>CIDADE/ESTADO: </LABEL> <?php echo $row_nome->TXT_CIDADE_CLI ?>/<?php echo $row_nome->TXT_ESTADO_CLI ?></td></tr>
      </table> 
    </td>
  </tr>
  <tr>
    <td>
      <p>
      <p>Recebemos de: <LABEL><?php echo $row_nome->TXT_RAZAO_CLI ?></LABEL> a importância Supra de <LABEL><?php echo escreverValorMoeda($valor_extenso) ?></LABEL>. no dia <label><?php echo date("d/m/Y",strtotime($row_recebimento->DTA_RECEBIMENTO_REC)) ?></label></p>
      
      <?php //incluir informacao se titulo ou ordem de servico
    if($row_recebimento->TXT_REFERENTE_REC == "OS"){?>
      <p>Proveniente da <LABEL>ORDEM DE SERVICO numero <?php echo $row_recebimento->NUM_DOCUMENTO_REC ?></LABEL>. Para Clareza, firmo(amos) o presente recibo </p>
      <p>Impresso em <LABEL><?php echo date("d/m/Y") ?></LABEL></p>
      <?php //caso seja titulo
    }elseif($row_recebimento->TXT_REFERENTE_REC == "TR"){?>
      <p>Proveniente do <LABEL>TITULO A RECEBER de numero <?php echo $row_recebimento->NUM_DOCUMENTO_REC?></LABEL>. Para Clareza, firmo(amos) o presente recibo </p>
      <p>Impresso em <LABEL><?php echo date("d/m/Y") ?></LABEL></p>
      <?php } //fim caso seja titulo ?>
    </div></td>
  </tr>
  <tr>
    <td><img src="imagens/assinaturas_financeiro.png" width="650" height="80" /></td>
  </tr>
  </table>
<p>
  <?php } ?> 
</p>
</form>

<form name="listagem" method="post">

<table width="100%">
  <tr>
    <td colspan="5">
    <table width="100%">   
              
              <?php 
     //selecao da empresa para cabecalho do relatorio
    $id_empresa_recibo = $row_recebimento->TBL_EMPRESA_EMP_NUM_ID_EMP;
    $sql_empresa = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = $id_empresa_recibo");
    if(!$sql_empresa->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}
          
          while ($row_empresa = $sql_empresa->fetch(PDO::FETCH_OBJ)){
        ?>
              <tr><td rowspan="4"><img src="imagens/logo techfy.png" width="190" height="110" /></td>
              <td ><label><?php echo $row_empresa->TXT_FANTASIA_EMP ?></label></td> </tr>
              <tr><td><label><?php echo $row_empresa->TXT_LOGRADOURO_EMP ?> N<?php echo $row_empresa->NUM_NUMERO_EMP ?>, <?php echo $row_empresa->TXT_BAIRRO_EMP ?>, <?php echo $row_empresa->TXT_CIDADE_EMP ?>-<?php echo $row_empresa->TXT_ESTADO_EMP ?></label></td></tr>
              <tr><td><label><?php echo $row_empresa->TXT_EMAIL_EMP ?></label></td></tr>
              <tr><td><label><?php echo $row_empresa->TXT_TELEFONE_EMP ?></label></td></tr>
              <? } ?>
              </table></td>
  </tr>
  <tr>
    <td colspan="5"> 
    <legend>Recibo de Pagamento</legend>      
      
   <table width="100%">
        <tr><td><label>NOME:</label>          
          <?php         
          $cli = $row_recebimento->TBL_CLIENTE_CLI_NUM_ID_CLI;
          $sql_nome = $con->prepare("SELECT *  FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$cli'");
          if(!$sql_nome->execute()){die ('Houve um erro na transacao: ' . mysqli_error());}
          while($row_nome = $sql_nome->fetch(PDO::FETCH_OBJ)){
        ?>
            <?php echo $row_nome->NUM_ID_CLI ?>
            <?php echo $row_nome->TXT_RAZAO_CLI ?>
         </td>
          <td rowspan="6">
            <table border="0" align="left">
               <tr><td><label>RECIBO N: </label> <?php echo $row_recebimento->NUM_ID_REC ?></td></tr>
              <tr><td><LABEL>DOCUMENTO: </LABEL> <?php echo $row_recebimento->NUM_DOCUMENTO_REC ?></td></tr>
              <tr><td><LABEL>EMISSAO: </LABEL> <?php echo date("d/m/Y",strtotime($row_recebimento->DTA_RECEBIMENTO_REC)) ?></td></tr>
              <tr><td><LABEL>VALOR: R$</LABEL> <?php echo $row_recebimento->VAL_VALORRECEBIDO_REC ?> </td></tr>
              <?php         
                $fp = $row_recebimento->TBL_FORMA_PAGAMENTO_FP_NUM_ID_FP;
                $sql_fp = $con->prepare("SELECT TXT_NOME_FP FROM tbl_formapagamento_fp WHERE NUM_ID_FP = '$fp'");
                if(!$sql_fp->execute()){die ('Houve um erro na transacao: ' . mysqli_error($con));}
                $descricaoFP = $sql_fp->fetchColumn();
              ?>
                <tr><td><LABEL>FORMA PAG: </LABEL> <?php echo $descricaoFP ?> </td></tr>
            </table>            
          </td>
        </tr>
         <tr><td><LABEL>CPF/CNPJ: </LABEL> <?php echo $row_nome->TXT_CPF_CNPJ_CLI ?></td></tr>
        <tr><td><LABEL>TELEFONE: </LABEL> <?php echo $row_nome->TXT_TELEFONE_CLI ?></td></tr>
        <tr><td><LABEL>ENDERECO: </LABEL> <?php echo $row_nome->TXT_LOGRADOURO_CLI ?>, N<?php echo $row_nome->NUM_NUMERO_CLI ?></td></tr>
        <tr><td><LABEL>BAIRRO: </LABEL> <?php echo $row_nome->TXT_BAIRRO_CLI ?></td></tr>
        <tr><td><LABEL>CIDADE/ESTADO: </LABEL> <?php echo $row_nome->TXT_CIDADE_CLI ?>/<?php echo $row_nome->TXT_ESTADO_CLI ?></td></tr>
      </table> 
    </td>
  </tr>
  <tr>
    <td>
      <p>
      <p>Recebemos de: <LABEL><?php echo $row_nome->TXT_RAZAO_CLI ?></LABEL> a importância Supra de <LABEL><?php echo escreverValorMoeda($valor_extenso) ?></LABEL>. no dia <label><?php echo date("d/m/Y",strtotime($row_recebimento->DTA_RECEBIMENTO_REC)) ?></label></p>
      
      <?php //incluir informacao se titulo ou ordem de servico
    if($row_recebimento->TXT_REFERENTE_REC == "OS"){?>
      <p>Proveniente da <LABEL>ORDEM DE SERVICO numero <?php echo $row_recebimento->NUM_DOCUMENTO_REC ?></LABEL>. Para Clareza, firmo(amos) o presente recibo </p>
      <p>Impresso em <LABEL><?php echo date("d/m/Y") ?></LABEL></p>
      <?php //caso seja titulo
    }elseif($row_recebimento->TXT_REFERENTE_REC == "TR"){?>
      <p>Proveniente do <LABEL>TITULO A RECEBER de numero <?php echo $row_recebimento->NUM_DOCUMENTO_REC?></LABEL>. Para Clareza, firmo(amos) o presente recibo </p>
      <p>Impresso em <LABEL><?php echo date("d/m/Y") ?></LABEL></p>
      <?php } //fim caso seja titulo ?>
    </div></td>
  </tr>
  <tr>
    <td><img src="imagens/assinaturas_financeiro.png" width="650" height="80" /></td>
  </tr>
  </table>

<?php } ?> 
</form>


<?php } } //fim sql_tituloreceber?>

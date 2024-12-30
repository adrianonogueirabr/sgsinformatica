<?php include "verifica.php"; 
	
	include "conexao.php";
   include "valor_extenso.php"; 
		$id_titulo = $_GET["id"];
	
		$sql_tituloreceber = $con->prepare("SELECT * FROM TBL_TITULORECEBER_TR WHERE NUM_ID_TR = $id_titulo");
		if(!$sql_tituloreceber->execute()){echo "Houve um erro na transacao: " . mysqli_error();}
		
		while($row_tituloreceber = $sql_tituloreceber->fetch(PDO::FETCH_OBJ)){
      $idCli = $row_tituloreceber->TBL_CLIENTE_CLI_NUM_ID_CLI;
      $idTitulo =  $row_tituloreceber->NUM_ID_TR;
      $referente =  $row_tituloreceber->TXT_REFERENTE_TR;
      $documento = $referente =  $row_tituloreceber->NUM_DOCUMENTO_REC;
      $dataEmissao =  date("d/m/Y H:i:s",strtotime($row_tituloreceber->DTH_EMISSAO_TR));
      $valorTitulo = number_format($row_tituloreceber->VAL_VALOR_TR,2) ; 
      $diasAtraso = $row_tituloreceber->NUM_DIASABERTO_TR;
      $valorareceber = $row_tituloreceber->VAL_FINAL_TR ;
      $dataVencimento = date("d/m/Y",strtotime($row_tituloreceber->DTA_VENCIMENTO_TR));
      if($row_tituloreceber->DTA_RECEBIDO_TR<>""){
          $dataRecebimento = date("d/m/Y H:i:s",strtotime($row_tituloreceber->DTA_RECEBIDO_TR));
      }else{
        $dataRecebimento = "Em Aberto";
      }
      $id_empresa_titulo = $row_tituloreceber->TBL_EMPRESA_EMP_NUM_ID_EMP;
      $statusTitulo =  $row_tituloreceber->TXT_STATUS_TR;

    }
	
	//selecao da empresa para cabecalho do relatorio

		$sql_empresa = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = $id_empresa_titulo");
		if(!$sql_empresa->execute()){echo "Houve um erro na transacao: " . mysql_error();}

    while ($row_empresa = $sql_empresa->fetch(PDO::FETCH_OBJ)){
      $nomeEmpresa = $row_empresa->TXT_FANTASIA_EMP;
      $logradouroEmpresa = $row_empresa->TXT_LOGRADOURO_EMP;
      $numeroEmpresa = $row_empresa->NUM_NUMERO_EMP;
      $bairroEmpresa = $row_empresa->TXT_BAIRRO_EMP;
      $cidadeEmpresa = $row_empresa->TXT_CIDADE_EMP;
      $estadoEmpresa = $row_empresa->TXT_ESTADO_EMP;
      $emailEmpresa = $row_empresa->TXT_EMAIL_EMP;
      $telefoneEmpresa = $row_empresa->TXT_TELEFONE_EMP ;

    }
          

    $sql_nome = $con->prepare("SELECT *  FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$idCli'");
    if(!$sql_nome->execute()){echo "Houve um erro na transacao: " . mysqli_error();}

    while($row_nome = $sql_nome->fetch(PDO::FETCH_OBJ)){
      $nomeCli = $row_nome->TXT_RAZAO_CLI; 
      $cpfCnpjCli = $row_nome->TXT_CPF_CNPJ_CLI;
      $telefoneCli = $row_nome->TXT_TELEFONE_CLI ;
      $logradoudorCli = $row_nome->TXT_LOGRADOURO_CLI ;
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
<title>Impressão de Titulo a Receber</title>
</head>
<body>

<form name="listagem" method="post">

<table cellpadding="3" cellspacing="3">
  <tr>
    <td colspan="5">
    <table width="100%"  cellpadding="3" cellspacing="3">

     <tr><td rowspan="4"><img src="imagens/logo_ofc.png" width="250" height="110" /></td>
     <td ><label><?php echo $nomeEmpresa  ?></label></td> </tr>
     <tr><td><label><?php echo $logradouroEmpresa  ?> N<?php echo $numeroEmpresa  ?>, <?php echo $bairroEmpresa  ?>, <?php echo $cidadeEmpresa  ?>-<?php echo $estadoEmpresa  ?></label></td></tr>
     <tr><td><label><?php echo $emailEmpresa  ?></label></td></tr>
     <tr><td><label><?php echo $telefoneEmpresa ?></label></td></tr>
    </table>
    </td>
  </tr>
  <tr>
    <td colspan="5">     
   <legend>Titulo a Receber</legend>
   <table width="100%" border="0" align="left" cellpadding="3" cellspacing="3">
        <tr>
          <td><label>SACADO:</label>

          <?php echo $nomeCli ?>  
          </td>
          <td></td>
          <td rowspan="6">
            
            <table border="0" align="right">
              <tr><td><label>FATURA:</label> <?php echo $idTitulo?></td></tr>
              <tr><td><label>REFERENTE:</label> <?php echo $referente ?></td></tr>
              <tr><td><label>EMISSAO:</label> <?php echo $dataEmissao ?></td></tr>
              <tr><td><label>VALOR:</label> R$<?php echo $valorTitulo ?></td></tr>               
              <tr><td><label>VENCIMENTO:</label> <?php echo $dataVencimento ?></td></tr>

              <?php if ($dataVencimento < date("Y-m-d") AND ($statusTitulo =="AB")){ ?> 
                  <tr><td><label>DIAS ATRASO:</label> <?php echo $diasAtraso ?></td></tr>
                  <tr><td><label>VALOR COM JUROS:</label> <?php echo $valorareceber ?></td></tr>
              <?php }else{ ?>
                  <tr><td><label>RECEBIMENTO:</label> <?php echo $dataRecebimento ?></td></tr>
                  <tr><td><label>STATUS:</label> <?php echo $statusTitulo ?></td></tr>             
              <?php } ?>

              <?php $datavencimento = $dataVencimento ?>
              </table>            
          </td>
        </tr>
        <tr><td><label>CPF/CNPJ*:</label> <?php echo $cpfCnpjCli ?></td></tr>
        <tr><td><label>TELEFONE*:</label> <?php echo $telefoneCli ?></td></tr>
        <tr><td><label>ENDERECO:</label> <?php echo $logradoudorCli ?>, N<?php echo $numeroCli ?></td></tr>
        <tr><td><label>BAIRRO:</label> <?php echo $bairroCli ?></td></tr>
        <tr><td><label>CIDADE/ESTADO:</label> <?php echo $cidadeCli ?>/<?php echo $estadoCli ?></td>
        </tr>
        </table>  
      </td>
  </tr>
  <tr>
      <td>
        <br />
        <p>
          Reconheço(çemos) a exatidão deste documento pela realização de serviços prestados, e que pagare(emos) a ADM Informática, o valor de <label>R$<?php echo $valorareceber ?>, (<?php echo escreverValorMoeda($valorareceber) ?>)</label> até a seguinte data <label><?php echo $datavencimento ?></label>.
        </p>
      </td>
  </tr>
  <tr>
  <td colspan="5" align="left"><img src="imagens/assinaturas_financeiro.png" width="90%" height="100" /></td>
  </tr>
  </table>
<p><hr /></p>

</form>

<form name="listagem" method="post">
<hr>
<table  border="0" align="left" cellpadding="3" cellspacing="3">
  <tr>
    <td colspan="5">
    <table width="100%" border="0" cellpadding="3" cellspacing="3">
              
    <tr>
                <td rowspan="4"><img src="imagens/logo_ofc.png" width="250" height="110" /></td>
                <td ><label><?php echo $nomeEmpresa  ?></label></td>        
                </tr>
              <tr>
                <td><label><?php echo $logradouroEmpresa  ?> N<?php echo $numeroEmpresa  ?>, <?php echo $bairroEmpresa  ?>, <?php echo $cidadeEmpresa  ?>-<?php echo $estadoEmpresa  ?></label></td>
                </tr>
              <tr>
                <td><label><?php echo $emailEmpresa  ?></label></td>
                </tr>
              <tr>
                <td><label><?php echo $telefoneEmpresa ?></label></td>
                </tr>
              </table>
              </td>
  </tr>
  <tr>
    <td colspan="5">     
   <legend>Titulo a Receber</legend>   
   <table width="100%" border="0" align="left" cellpadding="3" cellspacing="3">
        <tr>
          <td><label>SACADO:</label>
            <?php echo $nomeCli?>  
          </td>
          <td></td>
          <td rowspan="6">
            
            <table border="0" align="right">
            <tr><td><label>FATURA:</label> <?php echo $idTitulo?></td></tr>
              <tr><td><label>REFERENTE:</label> <?php echo $referente ?></td></tr>
              <tr><td><label>EMISSAO:</label> <?php echo $dataEmissao ?></td></tr>
              <tr><td><label>VALOR:</label> R$<?php echo $valorTitulo ?></td></tr> 
              <tr><td><label>VENCIMENTO:</label> <?php echo $dataVencimento ?></td></tr>
              
              <?php if ($dataVencimento < date("Y-m-d") AND ($statusTitulo =="AB")){ ?>
                  <tr><td><label>DIAS ATRASO:</label> <?php echo $diasAtraso ?></td></tr>
                  <tr><td><label>VALOR COM JUROS:</label> <?php echo $valorareceber ?></td></tr>
              <?php }else{ ?>
                  <tr><td><label>RECEBIMENTO:</label> <?php echo $dataRecebimento ?></td></tr>
                  <tr><td><label>STATUS:</label> <?php echo $statusTitulo ?></td></tr>             
              <?php } ?>

              </table>            
          </td>
        </tr>
        <tr><td><label>CPF/CNPJ*:</label> <?php echo $cpfCnpjCli ?></td></tr>
        <tr><td><label>TELEFONE*:</label> <?php echo $telefoneCli ?></td></tr>
        <tr><td><label>ENDERECO:</label> <?php echo $logradoudorCli ?>, N<?php echo $numeroCli ?></td></tr>
        <tr><td><label>BAIRRO:</label> <?php echo $bairroCli ?></td></tr>
        <tr><td><label>CIDADE/ESTADO:</label> <?php echo $cidadeCli ?>/<?php echo $estadoCli ?></td>
        </tr>
        </table>   
      
     
      </td>
  </tr>
    <tr>
      <td>
        <br />
        <p>
          Reconheço(çemos) a exatidão deste documento pela realização de serviços prestados, e que pagare(emos) a ADM Informática, o valor de <label>R$<?php echo $valorareceber ?>, (<?php echo escreverValorMoeda($valorareceber) ?>)</label> até a seguinte data <label><?php echo $datavencimento ?></label>
        </p>
      </td>
  </tr>
  <tr>
    <td colspan="5" align="left"><img src="imagens/assinaturas_financeiro.png" width="90%" height="100" /></td>
  </tr>
  </table>
  
</form>
</body>
</html>



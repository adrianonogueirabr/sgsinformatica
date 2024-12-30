<?php include "verifica.php"; 
//LIBERACAO TECNICO PARA APROVAR E EXECUTAR SERVICO DAS OS
	
	include "conexao.php";
	$valor = base64_decode($_GET['id']);	
	
	$sql = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$valor' and TXT_STATUS_OS = 'AB'");		
	$sql->execute();
	//caso a os esteja com status nao permitido
	if($sql->rowCount()<=0){	
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"OS com status nao permitido!\");</script>";		
	}else{
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Impressão de Ordem de Servico - EXTERNA</title>
</head>
<body>

<form name="listagem">

<table width="100%">
  <tr>
    <td width="100%">     
      <?php	while ($row = $sql->fetch(PDO::FETCH_OBJ)){	?>
      <table width="100%" >
        <tr>
          <td>
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
               <legend>Relatório de Ordem de Servico Externa</legend>
               
            </td>
          </tr>
        <tr class='table-success'>
          <td><label>ORDEM DE SERVICO: </label>
           Numero: <?php echo $row->NUM_ID_OS ?> | Tipo: <?php if($row->TXT_TIPO_OS=='P'){?> PADRAO <?php }else if($row->TXT_TIPO_OS=='C'){ ?> CONTRATO <?php }else if($row->TXT_TIPO_OS=='G'){ ?>
            GARANTIA <?php }?> | 
            Tecnico: <?php   //selecionar o login do usuario que executou a ordem de servico
            $usu = $row->TBL_USUARIO_USU_NUM_ID_USU;
            $sql_login = $con->prepare("SELECT TXT_NOME_USU FROM TBL_USUARIO_USU WHERE NUM_ID_USU = '$usu'");
            $sql_login->execute();
            $nomeTecnico = $sql_login->fetchColumn();  echo $nomeTecnico ?>             
        </td>            
        </tr>
        <tr>
          <td><LABEL>CLIENTE: </LABEL>
            ID: <?php echo $row->TBL_CLIENTE_CLI_NUM_ID_CLI ?>
            <?php	//seleciona nome e telefone do cliente da ordem de servico
				    	$cli = $row->TBL_CLIENTE_CLI_NUM_ID_CLI;
				    	$sql_nome = $con->prepare("SELECT TXT_RAZAO_CLI,TXT_TELEFONE_CLI, TXT_EMAIL_CLI,TXT_BAIRRO_CLI, TXT_LOGRADOURO_CLI,NUM_NUMERO_CLI,TXT_COMPLEMENTO_CLI, TXT_REFERENCIA_CLI   FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$cli'");
				    	$sql_nome->execute();
					  while($row_nome = $sql_nome->fetch(PDO::FETCH_OBJ)){
				    ?>
            | Nome: <?php echo $row_nome->TXT_RAZAO_CLI ?>
            | Tel.: <?php echo $row_nome->TXT_TELEFONE_CLI ?>
            <?php $logradouro = $row_nome->TXT_LOGRADOURO_CLI; $numero = $row_nome->NUM_NUMERO_CLI;$bairro = $row_nome->TXT_BAIRRO_CLI;  $Compl = $row_nome->TXT_COMPLEMENTO_CLI; $Ponto = $row_nome->TXT_REFERENCIA_CLI; ?>   

          <?php }//fim nome e telefone do cliente ?> 
            </td>
          </tr>

          <tr>
          <td><LABEL>ENDERECO: </LABEL>
            <?php echo $logradouro ?> N<?php echo $numero ?>, Bairro: <?php echo $bairro ?>, Comp: <?php echo $Compl ?> | Ponto Ref.: <?php echo $Ponto ?>   
            </td>
          </tr>

        <tr><td><LABEL>EQUIPAMENTO: </LABEL>         
              <?php 
                $equipamento = $row->TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP;
                //select para pegar tipo de equipamento e serial
                 $sql_equipamento = $con->prepare("SELECT * FROM TBL_EQUIPAMENTO_EQUIP WHERE NUM_ID_EQUIP = '$equipamento'");
                 $sql_equipamento->execute();    
                 while($row_equipamento = $sql_equipamento->fetch(PDO::FETCH_OBJ)){?>
                <?php echo $row->TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP?> | Tipo: <?php echo $row_equipamento->TXT_TIPO_EQUIP ?>
                | Serial: <?php echo $row_equipamento->TXT_SERIAL_EQUIP ?>
          <?php }//fim select pegar dados do equipamento ?>

          </TD>
        </tr>
        <tr><td><label>ESTADO DO EQUIP.: </label> <?php echo $row->TXT_DADOSGERAIS_OS ?></td></tr>
        <tr><td><label>RECLAMAÇÃO/SOLICITACAO: </label> <?php echo $row->TXT_RECLAMACAO_OS ?></td></tr>
        <tr><td  class="table-bordered"><br><label>DEFEITO CONSTATADO: </Label></td></tr>
        <tr><td  class="table-bordered">#</td></tr>
        <tr><td  class="table-bordered"><label>SOLUCAO DO TECNICO: </label></td></tr>
        <tr><td  class="table-bordered">#</td></tr>
        <tr>		
          <?php			
        //CAPTURA DATA INICIO E ENCERRAMENTO DA ORDEM DE SERVICO
		    $data_inicio = $row->DTA_ABERTURA_OS;
		    }  		  
		    ?>
          </tr>  
          
        </table> 
     </p>
     <br>
      <table width="100%" class="table table-bordered"> 
      <tr>
          <th><label>VALOR</label></th>
          <th><label>DATA/HORA INICIO - FIM</label></th> 
          <th><label>DESCRICAO DO SERVICO (OBS.: LETRA DE FORMA)</label></th>        
        </tr>             
        <tr>
          <td>#</td>
          <td></td>
          <td></td>      
        </tr>
        <tr>
          <td>#</td>
          <td></td>
          <td></td>      
        </tr>
        <tr>
          <td>#</td>
          <td></td>
          <td></td>      
        </tr>
        <tr>
          <td>#</td>
          <td></td>
          <td></td>      
        </tr>
     </table>      
      
      </td>
  </tr>
  <tr>
    <td>
	<br>
    <label>**Confirmo realização dos servicos acima listados tendo inicio a ordem de servico no dia (<?php echo date("d/m/Y",strtotime($data_inicio)) ?>) e encerramento ao dia (____/____/_____).</label>
	<br>
  <LABEL>**Informo que no dia (____/____/_____) ocorrerá termino da garantia de servico.**</LABEL>
  <BR>
    <label>**Nossa garantia nao cobre mau uso, instalação de softwares ou configurações indevidas**</label>
	<br>
	<img src="imagens/assinaturas.png" width="700" height="75" /></td>
  </tr>
  </table>
</form>
</body>
</html>

<?php
	}//fim status de os nao permitido//
?>
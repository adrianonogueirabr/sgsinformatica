<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="javascript/cadastro_os.js"></script>
<title>Alterar Ordem de Serviço</title>
</head>

<body>
<?php 
	include "conexao.php";
  $id = $_GET['id'];
	$sql = $con->prepare("SELECT TXT_STATUS_OS FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$id'");
  if (!$sql->execute()) {
              echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }else{
	   	$status = $sql->fetchColumn();

  }
			switch($status){			
			case "AB":	
 ?>

<form name="os" action="processa-os.php?acao=salvar&id=<?php echo $id ?>" method="post" onSubmit="return validaForm()">
<table class="table">
  <tr>
	    <td> <?php include "inicial.php"?> </td>
	</tr>
  <tr><td class=" table-primary"><h4>Alterar Ordem de Serviço</h4></td></tr>
</table>
<table width="80%" align="center">
<tr>
<td>

    <div class="form-row">
    <div class="form-group col-md-4 col-sm-6">
        <p class="font-weight-bold">TIPO DA ORDEM DE SERVIÇO
        <select name="tipo_os" id="tipo_os" title="SELECIONE O TIPO DE OS" class="form-control">
            <option value="P">PADRAO</option>
            <option value="G">GARANTIA</option>
            <option value="C">CONTRATO</option>
          </select>
        </p>          
      </DIV>

      <div class="form-group col-md-4 col-sm-6"> 
        <p class="font-weight-bold">TIPO DE ATENDIMENTO
        <select name="tipo_atendimento" id="tipo_atendimento" class="form-control" title="SELECIONE O TIPO DE ATENDIMENTO">
            <option value="CLIENTE">CLIENTE</option>
            <option value="EMPRESA">EMPRESA</option>
            <option value="ACESSO REMOTO">REMOTO</option>
          </select>
        </p>          
      </DIV>

      <div class="form-group col-md-4 col-sm-12"> 
        <p class="font-weight-bold">PREVISÃO
        <input name="data_cadastro" class="form-control" type="date" required="true">
        </p>        
      </DIV>

      <?php 
 		   $sql1 = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$id'");
  	   $sql1->execute();  
		   while ($row = $sql1->fetch(PDO::FETCH_OBJ)){	
 		  ?>
      <div class="form-group col-md-12 col-sm-12"> 
        <p class="font-weight-bold">OBSERVAÇÕES DO EQUIPAMENTO
        <input class="form-control" disabled="disabled" type="text" title="DADOS GERAIS DO EQUIPAMENTO ESTADO E CONDIÇÕES" value="<?php echo $row->TXT_DADOSGERAIS_OS ?>" />
        </p>          
      </DIV>

      <div class="form-group col-md-12 col-sm-12"> 
        <p class="font-weight-bold">RECLAMAÇÃO DO CLIENTE
        <textarea name="reclamacao" class="form-control" id="reclamacao" disabled="disabled" rows="4" title="RECLAMACAO DO CLIENTE"><?php echo $row->TXT_RECLAMACAO_OS ?></textarea>
        </p>       
      </DIV>        

      <?php 
		  }
    	?>
    <div class="form-group col-md-2">
        <input type="submit" name="registrar"  value="Salvar Dados" class="btn btn-success btn-block" />        
	  </div>
    </td>
    </tr>    

  </table>
</form>
<?php 

	break;
	
	default:
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Ordem de Servico com status nao permitido!\");</script>";
				
	}
?>
</body>
</html>
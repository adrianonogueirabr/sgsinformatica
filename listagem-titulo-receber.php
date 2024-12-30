<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
	include "conexao.php";
  $valorAcumulado = 0;	
	
	$valor = $_POST['valor'];
  $data1 = $_POST['data1'];
  $data2 = $_POST['data2'];
	$criterio = $_POST['criterio'];
	
	if($criterio == "D"){
      $sqlTitulo = $con->prepare("SELECT * FROM `TBL_TITULORECEBER_TR` WHERE DTA_VENCIMENTO_TR BETWEEN ? AND ? order by NUM_ID_TR desc");
      $sqlTitulo->bindParam(1,$data1);
      $sqlTitulo->bindParam(2,$data2);
      if(!$sqlTitulo->execute()){ echo "Houve um erro no processamento da transacao " . mysqli_error();}

      if($sqlTitulo->rowCount()==0){
          echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-titulo-receber.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
      }
	}else if($criterio == "S"){
      $sqlTitulo = $con->prepare("SELECT * FROM `TBL_TITULORECEBER_TR` WHERE TXT_STATUS_TR = '$valor' order by NUM_ID_TR desc");
      if(!$sqlTitulo->execute()){echo 'Houve um erro no processamento da transacao ' . mysqli_error();}

      if($sqlTitulo->rowCount()==0){
          echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-titulo-receber.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
	    }	
	}else if($criterio == "I"){
      $sqlTitulo = $con->prepare("SELECT * FROM `TBL_TITULORECEBER_TR` WHERE `TBL_CLIENTE_CLI_NUM_ID_CLI` = '$valor' order by NUM_ID_TR desc");
      if(!$sqlTitulo->execute()){echo 'Houve um erro no processamento da transacao ' . mysqli_error();}

      if($sqlTitulo->rowCount()==0){
          echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-titulo-receber.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
	    }
	}else if($criterio = ""){	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-titulo-receber.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";		
	}	
?>

<form name="listagem" method="post">
<table width="100%" class="table responsive">
  <tr>
      <td><?php include "inicial.php" ?></td>
  </tr>
  <tr>
		  <td><legend class="p-4 table-primary">Listagem de Titulos<legend></td>
	</tr>
  <tr>
      <td>
          <table class="table-hover table  table-bordered responsive table-sm">
              <tr class="table-success" align="center">		
              <th>Fatura</th>
              <th>Status</th>
              <th>Emissao</th>
              <th>Vencimento</th>
              <th>Dias Atraso</th>          
              <th>Cliente</th>
              <th>Valor</th>
              <th>Juros/Multa</th>  
              <th>Total</th>        
              <th></th>
            </tr>
          
            <?php while ($row = $sqlTitulo->fetch(PDO::FETCH_OBJ)){			 ?>
            
            <?php if ($row->DTA_VENCIMENTO_TR < date("Y-m-d") AND ($row->TXT_STATUS_TR =="ABERTO")){ ?>          
              <tr class="table-warning" align="center"> 
            <?php }else{ ?>
              <tr align="center">
            <?php } ?>	

              <td text-align="center"><?php echo $row->NUM_ID_TR ?></td>
              <td><?php echo $row->TXT_STATUS_TR ?></td><?php $statustitulo = $row->TXT_STATUS_TR ?>
              <td><?php echo date("d/m/Y  H:i:s",strtotime($row->DTH_EMISSAO_TR ));?></td>
              <td><?php echo date("d/m/Y", strtotime($row->DTA_VENCIMENTO_TR ));	?></td>
              <?php //calcular dias em aberto
                  $diferenca =  strtotime(date("Y-m-d")) - strtotime($row->DTA_VENCIMENTO_TR);
                  $diasAtrasado = floor($diferenca / (60 * 60 * 24));
                  if($diasAtrasado <= 0){
                    $diasAtrasado = 0;
                  }
              ?>
              <td><?php echo $diasAtrasado	?></td>
              <!--<td><a title="Clique para detalhes do Cliente" href="detalhes-clientes.php?id=<?php echo $row->TBL_CLIENTE_CLI_NUM_ID_CLI ?>" target="_blank">
                <?php echo $row->TBL_CLIENTE_CLI_NUM_ID_CLI ?></a></td>         -->
              
              <?php //capturar nome do cliente
                $id_cliente_recibo = $row->TBL_CLIENTE_CLI_NUM_ID_CLI;
                $sql_nome_cliente = $con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = $id_cliente_recibo");
                if(!$sql_nome_cliente->execute()){echo 'Houve um erro ao realizar a transacao: ' . mysqli_error();}

                while ($row_nome_cliente = $sql_nome_cliente->fetch(PDO::FETCH_OBJ)){
                ?>
                <td align="left"><?php echo $row_nome_cliente->TXT_RAZAO_CLI ?></td>
                <?php } ?>        
              
              <td>R$ <?php echo number_format($row->VAL_VALOR_TR,2) ?></td>
              <?php //somando juros e multa 
                  $TotalJurosMulta = $row->VAL_JUROS_TR + $row->VAL_MULTA_TR;
              ?>
              <td>R$ <?php echo number_format($TotalJurosMulta,2) ?></td>
              <td>R$ <?php echo number_format($row->VAL_FINAL_TR,2) ; $valorAcumulado = $valorAcumulado + $row->VAL_FINAL_TR ?></td>
              <td align="left">          
                    <div class="form-group col-md-2 col-sm-12">
                        <div class="btn-group dropleft">
                          <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acoes</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <?php if($statustitulo!='ABERTO'){}else{ ?>                               
                                  <a class="dropdown-item" href="dados-recebimento.php?valor=<?php echo $row->NUM_ID_TR ?>&criterio=TR">Receber Titulo</a>
                                  <a class="dropdown-item" href="dados-recebimento.php?valor=<?php echo $row->NUM_ID_TR ?>&criterio=TRAD">Baixar C/ Saldo</a>  
                                  <a class="dropdown-item" href="alterar-vencimento-titulo.php?id=<?php echo base64_encode($row->NUM_ID_TR) ?>">Alterar Vencimento</a>
                              <?php } ?>
                                <a class="dropdown-item" href="impressao-titulo-re.php?id=<?php echo $row->NUM_ID_TR ?>" target="_blank">Imprimir Titulo</a>
                          
                            </div>
                        </div>  
                    </div>           
              </td>                
            </tr>
            <?php
            }
            ?>  
            <legend align="right">Total A Receber: R$<?php echo number_format($valorAcumulado, 2);?></legend>
          </table>
      </td>
    </tr>
</table>
</form>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<?php 
      include "conexao.php";
      
      $valor = $_POST['valor'];
      $criterio = $_POST['criterio'];
      
      if($criterio == "C"){
        $sqlServico = $con->prepare("SELECT * FROM TBL_PECA_PEC WHERE NUM_ID_PEC = '$valor'");

        if(!$sqlServico->execute()){ die ('Houve um erro na transacao: ' . mysqli_error($con));}

        if($sqlServico->rowCount()<=0){ echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-pecas.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";}
      
      }else if($criterio == "R"){
        $sqlServico = $con->prepare("SELECT * FROM TBL_PECA_PEC WHERE TXT_NOME_PEC LIKE '$valor'");
      
        if(!$sqlServico->execute()){ die ('Houve um erro na transacao: ' . mysqli_error($con));}

        if($sqlServico->rowCount()<=0){ echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-pecas.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";}	
      
      }else if($criterio = ""){
      
        echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-pecas.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";		
      }	
?>

<form name="listagem" method="post">
<table  class="table responsive">
      <tr>
          <td><?php include "inicial.php" ?></td>
      </tr>
      <tr>
          <td><legend class="p-4 table-primary">Listagem de Pecas<legend></td>		
      </td>
    </tr>
    <tr>
        <td>
          
    <table  class="table-hover table table-bordered table-striped table-sm">
        <tr class="table-success" align="center">	
          <th>ID</th>
          <th>ATIVO</th>
          <th>NOME</th>
          <th>CODIGO</th>
          <th>ULTIMA COMPRA</th>
          <th>VALOR VENDA</th>
          <th>CUSTO MEDIO</th>
          <th>ACUMULADO</th>          
          <th>OPCOES</th>
        </tr>
        <?php
		    while ($row = $sqlServico->fetch(PDO::FETCH_OBJ)){			
		    ?>        
        <tr align="center">
          <td><?php echo $row->NUM_ID_PEC?></td>
          <td><?php echo $row->TXT_ATIVO_PEC?></td>
          <td align="left"><?php echo $row->TXT_NOME_PEC?></td>
          <td><?php echo $row->TXT_CODIGO_PEC?></td>
          <td>R$<?php echo number_format($row->VAL_ULTIMA_COMPRA_PEC,2)?></td>
          <td>R$<?php echo number_format($row->VAL_VALOR_VENDA_PEC,2)?></td>
          <td>R$<?php echo number_format($row->VAL_CUSTO_MEDIO_PEC,2)?></td>
          <td>R$<?php echo number_format($row->VAL_TOTAL_ACUMULADO_PEC,2)?></td>
          <td><a href="detalhes-pecas.php?id=<?php echo base64_encode($row->NUM_ID_PEC) ?>"><img src="imagens/alterar.png" alt="Clique para Alterar" title="Clique para detalhes" width="26" height="25" /></a></td>
      <?php
		}
		?>
    </table>
    </td>
    </tr>
  </table>
</form>
</body>
</html>
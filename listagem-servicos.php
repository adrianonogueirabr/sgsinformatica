
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<?php 
      include "conexao.php";
      
      $valor = $_POST['valor'];
      $criterio = $_POST['criterio'];
      
      if($criterio == "C"){
        $sqlServico = $con->prepare("SELECT * FROM TBL_SERVICO_SER WHERE NUM_ID_SER = '$valor'");

        if(!$sqlServico->execute()){ die ('Houve um erro na transacao: ' . mysqli_error($con));}

        if($sqlServico->rowCount()<=0){ echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-servicos.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";}
      
      }else if($criterio == "R"){
        $sqlServico = $con->prepare("SELECT * FROM TBL_SERVICO_SER WHERE TXT_NOME_SER LIKE '$valor'");
      
        if(!$sqlServico->execute()){ die ('Houve um erro na transacao: ' . mysqli_error($con));}

        if($sqlServico->rowCount()<=0){ echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-servicos.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";}	
      
      }else if($criterio = ""){
      
        echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-servicos.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";		
      }	
?>

<form name="listagem" method="post">
<table  class="table responsive">
      <tr>
          <td><?php include "inicial.php" ?></td>
      </tr>
      <tr>
          <td><legend class="p-4 table-primary">Listagem de Servicos<legend></td>		
      </td>
    </tr>
    <tr>
        <td>
          
    <table  class="table-hover table table-bordered table-striped table-sm">
        <tr class="table-success" align="center">	
          <th>ID</th>
          <th>ATIVO</th>
          <th>NOME</th>
          <th>DESCRICAO</th>
          <th>TEMPO</th>
          <th>FISICA</th>
          <th>JURIDICA</th>
          <th>CONTRATO</th>
          <th>OPCOES</th>
        </tr>
        <?php
		    while ($row = $sqlServico->fetch(PDO::FETCH_OBJ)){			
		    ?>        
        <tr align="center">
          <td><?php echo $row->NUM_ID_SER?></td>
          <td><?php echo $row->TXT_ATIVO_SER?></td>
          <td align="left"><?php echo $row->TXT_NOME_SER?></td>
          <td align="left"><?php echo $row->TXT_DESCRICAO_SER?></td>
          <td><?php echo $row->NUM_DURACAO_SER?></td>
          <td>R$<?php echo number_format($row->VAL_FISICA_SER,2)?></td>
          <td>R$<?php echo number_format($row->VAL_JURIDICA_SER,2)?></td>
          <td>R$<?php echo number_format($row->VAL_CONTRATO_SER,2)?></td>
          <td><a href="detalhes-servicos.php?id=<?php echo base64_encode($row->NUM_ID_SER) ?>"><img src="imagens/alterar.png" alt="Clique para Alterar" title="Clique para detalhes" width="26" height="25" /></a></td>
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<body>
<?php 
	
      include "conexao.php";

        $valor = $_POST["valor"];
        $criterio = $_POST["criterio"];
      
      if($criterio == "C"){
          $res = $con->prepare("SELECT * FROM TBL_ORCAMENTO_ORC WHERE TBL_CLIENTE_CLI_NUM_ID_CLI = '$valor' ORDER BY NUM_ID_ORC DESC");
              $res->execute();
                  if($res->rowCount()<=0){
                      echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-orcamento.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
                  }
      }else if($criterio == "E"){
          $res = $con->prepare("SELECT * FROM TBL_ORCAMENTO_ORC WHERE TBL_FROTA_FR_NUM_ID_FR = '$valor' ORDER BY NUM_ID_ORC DESC");
              $res->execute();
                  if($res->rowCount()<=0){
                      echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-orcamento.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
                  }
      }else if($criterio == "O"){
            $res = $con->prepare("SELECT * FROM TBL_ORCAMENTO_ORC WHERE NUM_ID_ORC = '$valor'");
                $res->execute();
                    if($res->rowCount()<=0){
                        echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-orcamento.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
                    }
      }else if($criterio == "AB"){
          $dtaInicial = $_POST["dtaInicial"];
          $dtaFinal = $_POST["dtaFinal"];

          $res = $con->prepare("SELECT * FROM TBL_ORCAMENTO_ORC WHERE DATE(DTH_REGISTRO_ORC) BETWEEN '$dtaInicial' AND '$dtaFinal'  ORDER BY NUM_ID_ORC DESC");
              $res->execute();
                  if($res->rowCount()<=0){
                      echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-orcamento.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";            
                  }
     }else if($criterio == "S"){
          $res = $con->prepare("SELECT * FROM TBL_ORCAMENTO_ORC WHERE TXT_STATUS_ORC = '$valor' ORDER BY NUM_ID_ORC DESC");
          $res->execute();
              if($res->rowCount()<=0){
                  echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-orcamento.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
                  }
      }else if($criterio = ""){	
          echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-orcamento.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";		
      }
?>

<form name="listagem" method="post">
<table width="100%" class="table responsive">
  <tr>
      <td><?php include "inicial.php" ?>
  <tr>
		  <td><legend class="p-4 table-primary">Orcamentos encontrados: Total <?php echo $res->rowCount()?><legend></td>
	</tr>
  </tr>
  <tr>
      <td>
          <table class="table-hover table  table-bordered responsive table-sm">
          <tr class="table-success" align="center">	
            <th scope="col">Numero</th>            
            <th scope="col">Cliente</th>
            <th scope="col">Frota</th>
            <th scope="col">Total</th>
            <th scope="col">Desconto</th>
            <th scope="col">Final</th>
            <th scope="col">Data</th>
            <th scope="col">Opcoes</th>
          </tr>
          <?php
			while ($row = $res->fetch(PDO::FETCH_OBJ)){			
		  ?>
            <tr align="center">          
            <td><?php echo $row->NUM_ID_ORC ?></td>

            <?php
				      $id = $row->TBL_CLIENTE_CLI_NUM_ID_CLI;
				      $res_nome = $con->prepare("SELECT TXT_RAZAO_CLI FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$id'");
			       	$res_nome->execute();
				      $nome = $res_nome->fetchColumn();	
			      ?>
            <td  align="center"><?php echo $nome ?></td> 
            
            <!--identificacao da frota-->
            <?php 
                                        
                                        //select para pegar dados da frota e cliente
                                        $sql_frota = $con->prepare("SELECT C.TXT_RAZAO_CLI,F.TBL_CLIENTE_CLI_NUM_ID_CLI , F.NUM_ID_FR, F.TXT_ATIVO_FR, T.TXT_NOME_TIP, M.TXT_NOME_MAR, MO.TXT_NOME_MOD, 
                                    
                                        F.TXT_PLACA_FR, F.TXT_CHASSI_FR, F.DTH_REGISTRO_FR,F.DTH_ALTERACAO_FR, CO.TXT_NOME_COR 

                                        FROM tbl_frota_fr F 

                                        LEFT JOIN TBL_CLIENTE_CLI C ON C.NUM_ID_CLI = F.TBL_CLIENTE_CLI_NUM_ID_CLI 
                                        LEFT JOIN TBL_TIPO_TIP T ON T.NUM_ID_TIP = F.TBL_TIPO_TIP_NUM_ID_TIP 
                                        LEFT JOIN TBL_MARCA_MAR M ON M.NUM_ID_MAR = F.TBL_MARCA_MAR_NUM_ID_MAR
                                        LEFT JOIN TBL_MODELO_MOD MO ON MO.NUM_ID_MOD = F.TBL_MODELO_MOD_NUM_ID_MOD
                                        LEFT JOIN TBL_COR_COR CO ON CO.NUM_ID_COR = F.TBL_COR_COR_NUM_ID_COR
                                
                                        WHERE F.NUM_ID_FR = $row->TBL_FROTA_FR_NUM_ID_FR");

                                            $sql_frota->execute();
                                
                                            while($row_frota = $sql_frota->fetch(PDO::FETCH_OBJ)){?>
                                            
                                            <?php 
                                            $tipo = $row_frota->TXT_NOME_TIP;
                                            $placa = $row_frota->TXT_PLACA_FR;
                                            $modelo = $row_frota->TXT_NOME_MOD;
                                            }
                                            
                                            ?>
                                            <!--fim identificacao da frota-->
            <td><?php echo $tipo ?> - <?php echo $placa ?> - <?php echo $modelo ?></td> 
            <td>R$<?php echo number_format($row->VAL_TOTAL_ORC,2) ?></td>
            <td>R$<?php echo number_format($row->VAL_DESCONTO_ORC,2) ?></td>
            <td>R$<?php echo number_format($row->VAL_FINAL_ORC,2) ?></td>
            <td><?php echo date("d/m/Y  H:i:s",strtotime( $row->DTH_REGISTRO_ORC)) ?></td>
            <td>              
                    <div class="btn-group dropleft">
                          <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opcoes</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="relatorio-orcamento.php?id=<?php echo $row->NUM_ID_ORC?>" target="_blank">Imprimir</a>
                                <a class="dropdown-item" href="cadastro-orcamento.php?orcamento=<?php echo $row->NUM_ID_ORC?>">Alterar</a>
                            </div>
                    </div>
            </td>

          </TR>             
          <?php			   
       }//fim while
	  	?>
      </table>
      </td>
    </tr>

  </table>
</form>
<script>

</script>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<body>
<?php 
	
      include "conexao.php";

        if($valor = $_POST["criterio"]==""){
            $valor = base64_decode($_GET["id_e"]);
            $criterio = "2";
        }else{
             $valor = $_POST["valor"];
             $criterio = $_POST["criterio"];
             $dtaInicial = $_POST["dtaInicial"];
             $dtaFinal = $_POST["dtaFinal"];
        }

        switch($criterio){
            case 1:
                  $res = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE TBL_CLIENTE_CLI_NUM_ID_CLI = '$valor' ORDER BY NUM_ID_OS DESC");
                  $res->execute();
                      if($res->rowCount()<=0){
                          echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
                      }
            break;
            case 2:
                  $res = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP = '$valor' ORDER BY NUM_ID_OS DESC");
                  $res->execute();
                      if($res->rowCount()<=0){
                          echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
                      }
            break;
            case 3:
                  $res = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$valor'");
                  $res->execute();
                        if($res->rowCount()<=0){
                            echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
                        }
            break;
            case 4:
                  $res = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE DATE(DTH_ABERTURA_OS) BETWEEN '$dtaInicial' AND '$dtaFinal'  ORDER BY NUM_ID_OS DESC");
                  $res->execute();
                      if($res->rowCount()<=0){
                          echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";            
                      }
            break;
            case 5:
                  $res = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE DATE(DTH_ENCERRAMENTO_OS) BETWEEN '$dtaInicial' AND '$dtaFinal'  ORDER BY NUM_ID_OS DESC");
                  $res->execute();
                      if($res->rowCount()<=0){
                          echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";
                      }
            break;
            case 6:
                  $res = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE TXT_STATUS_OS = '$valor' ORDER BY NUM_ID_OS DESC");
                  $res->execute();
                      if($res->rowCount()<=0){
                          echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
                      }
            break;
            default:
                echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Erro no processamento das informacoes!\");</script>";
            break;
          }

?>

<form name="listagem" method="post">
<table width="100%" class="table responsive">
  <tr>
      <td><?php include "inicial.php" ?>
  </tr>
  <tr>
		  <td><legend class="p-4 table-primary">Ordem de Serviços encontradas: Total <?php echo $res->rowCount()?><legend></td>
	</tr>
  <tr>
      <td>
          <table class="table-hover table  table-bordered responsive table-sm">
          <tr class="table-success" align="center">	
            <th scope="col">NUMERO</th>
            <th scope="col">STATUS</th>
            <th scope="col">TIPO</th>
            <th scope="col">ATENDIMENTO</th>
            <th scope="col">CLIENTE</th>
            <th scope="col">RECLAMACAO</th>
            <th scope="col">TOTAL</th>
            <th scope="col">DESCONTOS</th>
            <th scope="col">FINAL</th>
            <th scope="col">DATAS</th>
            <th scope="col">OPCOES</th>
          </tr>
          <?php
			while ($row = $res->fetch(PDO::FETCH_OBJ)){			
		  ?>
          <?php $dataatual = date("Y-m-d"); if($row->DTA_FIMGARANTIA_OS>=$dataatual){ ?> <tr class="table-warning" title="<?php echo $row->TXT_RECLAMACAO_OS ?>" > <?php } else {?> <tr title="<?php echo $row->TXT_RECLAMACAO_OS ?>"  > <?php } ?>
          
            <td align="center"><?php echo $row->NUM_ID_OS ?></td>
            <td align="center"><?php echo $row->TXT_STATUS_OS ?></td>
            <td align="center"><?php echo $row->TXT_TIPO_OS ?></td>
            <td align="center"><?php echo $row->TXT_TIPO_ATENDIMENTO_OS ?></td>

            <input name="statusos" type="hidden" value="<?php echo $row->TXT_STATUS_OS ?>" />
            <!-- captura o status da ordem de servico para informar se troca ou nao de usuario-->
            <?php $statusos = $row->TXT_STATUS_OS ?><!--base64_encode(-->

            <?php
				      $id = $row->TBL_CLIENTE_CLI_NUM_ID_CLI;
				      $res_nome = $con->prepare("SELECT TXT_RAZAO_CLI FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$id'");
			       	$res_nome->execute();
				      $nome = $res_nome->fetchColumn();	
			      ?>
            <td><?php echo $nome ?></td>  

            <td><?php echo mb_substr( $row->TXT_RECLAMACAO_OS, 0, 40, 'ISO-8859-1'); ?>...</td>
            <td>R$<?php echo number_format($row->VAL_TOTAL_OS,2) ?></td>
            <td>R$<?php echo number_format($row->VAL_DESCONTO_OS,2) ?></td>
            <td>R$<?php echo number_format($row->VAL_FINAL_OS,2) ?></td>
            
            <td> 
            <?php $datainicio =  date("d/m/Y H:i:s",strtotime($row->DTH_ABERTURA_OS)); 
                //capturar data fim garantia
                if($row->DTA_FIMGARANTIA_OS<>""){ $dataFimGarantia = date("d/m/Y", strtotime($row->DTA_FIMGARANTIA_OS));}else{ $dataFimGarantia ="S/D";}

                //capturar data encerramento os
                if($row->DTH_ENCERRAMENTO_OS<>""){ $datafinal =  date("d/m/Y H:i:s",strtotime($row->DTH_ENCERRAMENTO_OS));}else{ $datafinal = "S/D";}

                $MensagemPopover = "Abertura: $datainicio | Término: $datafinal | Término Garantia: $dataFimGarantia";    
            ?>
                  
            <a href="#" data-toggle="popover" title="Cronologia da Ordem de Serviço" data-content="<?php echo $MensagemPopover ?>">DATAS</a>
              
            </td>
            <td>
            
            <div class="btn-group dropleft">
            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opcoes</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

              <?php if(($statusos<>'PAGO')&&($statusos<>'FATURADA') && ($perfil_usuario==00001)){?><!--verifica status da os para editar ou cancelar -->                 
                 <a class="dropdown-item" href="cancelamento-os.php?id=<?php echo base64_encode($row->NUM_ID_OS) ?>">Cancelar OS</a>
              <?php }else{} ?>

              <?php if ($statusos<>"AB"){ }else{?><!--verifica status da os para editar ou cancelar -->
                <a class="dropdown-item" href="alterar-os.php?id=<?php echo base64_encode($row->NUM_ID_OS) ?>">Alterar OS</a>                
              <?php } ?>

              <a class="dropdown-item" href="detalhes-os.php?id=<?php echo base64_encode($row->NUM_ID_OS) ?>" >Detalhes OS</a>             

              <a class="dropdown-item" href="relatorio-os.php?id=<?php echo base64_encode($row->NUM_ID_OS) ?>" target="_blank">Imprimir OS</a>

              <!--Inicio atribuir tecnico-->
              <?php if($_SESSION['perfil_usu']==00007 AND $statusos=="AB"){ ?>               
              <a class="dropdown-item" href="alterar-usuarios-os.php?id=<?php echo $row->NUM_ID_OS ?>">Alterar Tecnico OS</a>              
              <?php }else{
                  
              }?>
              <!--Fim atrobuir tecnico-->

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
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
});
</script>
</body>
</html>
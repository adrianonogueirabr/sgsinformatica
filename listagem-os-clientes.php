
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
    <title>Menu</title>
  </head>
<title>Listagem de Ordem de Serviço</title>
</head>
<body>
<?php 
	
	include "conexao.php";

		$valor = $_GET["valor"];
    $criterio = $_GET["criterio"];	

    $res = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE TBL_CLIENTE_CLI_NUM_ID_CLI = ? ORDER BY NUM_ID_OS DESC");
    $res->bindParam(1,$valor);
    $res->execute();

		  if($res->rowCount()<=0){
	   	echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-clientes1.php?valor=$valor'><script type=\"text/javascript\">alert(\"Cliente nao possui ordem de servico cadastrada!\");</script>";		
	    }
	
?>


  <table width="100%">
    <tr>
      <td>
      <?php include "inicial.php" ?>
      </td>
    </tr>
    <tr>
      <td><legend><h4>
        <a href="listagem-clientes1.php?valor=<?php echo $valor ?>&criterio=I"><img src="imagens/voltar.png" width="30" alt="" height="30" title="CLIQUE AQUI PARA VOLTAR" /></a>
        Total Encontrado: <?php echo $res->rowCount();?>
      </h4></legend>
    </td>      
    </tr>   
    <tr>
    <td> 
          
    <table width="100%" class="table-hover table table-condensed table-bordered table-striped table-sm">
        <tr  class="table-primary">	
            <th scope="col">OS</th>
            <th scope="col">STATUS</th>
            <th scope="col">EQUIP</th>
            <th scope="col">RECLAMACAO</th>
            <th scope="col">DATAS</th>
            <th  scope="col">AÇÕES</th>
          </tr>
          <?php
			while ($row = $res->fetch(PDO::FETCH_OBJ)){			
		  ?>
          <?php $dataatual = date("Y-m-d"); if($row->DTA_FIMGARANTIA_OS>=$dataatual){ ?> <tr class="table-warning" title="<?php echo $row->TXT_RECLAMACAO_OS;  ?>"> <?php } else {?> <tr title="<?php echo $row->TXT_RECLAMACAO_OS;  ?>"> <?php } ?>

          
           <td align="center"><?php echo $row->NUM_ID_OS ?></td>
            <td align="center"><?php echo $row->TXT_STATUS_OS ?></td>
            <input name="statusos" type="hidden" value="<?php echo $row->TXT_STATUS_OS ?>" />
            <!-- captura o status da ordem de servico para informar se troca ou nao de usuario-->
            <?php $statusos = $row->TXT_STATUS_OS ?><!--base64_encode(-->
            <td><a href="detalhes-equipamentos.php?id=<?php echo $row->TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP ?>" target="_new" title="Clique para detalhes do Equipamento"><?php echo $row->TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP ?></a></td>
             
            <td colspan="1"><?php echo mb_substr( $row->TXT_RECLAMACAO_OS, 0, 60, 'ISO-8859-1'); ?>...</td>
            
            <td colspan="1"> 
            <?php $datainicio =  date("d/m/Y",strtotime($row->DTA_ABERTURA_OS)); 
                //capturar data fim garantia
                if($row->DTA_FIMGARANTIA_OS<>""){ $dataFimGarantia = date("d/m/Y", strtotime($row->DTA_FIMGARANTIA_OS));}else{ $dataFimGarantia ="S/D";}

                //capturar data encerramento os
                if($row->DTA_ENCERRAMENTO_OS<>""){ $datafinal =  date("d/m/Y",strtotime($row->DTA_ENCERRAMENTO_OS));}else{ $datafinal = "S/D";}

                $MensagemPopover = "Abertura: $datainicio | Término: $datafinal | Término Garantia: $dataFimGarantia";    
            ?>
                  
            <a href="#" data-toggle="popover" title="Cronologia da Ordem de Serviço" data-content="<?php echo $MensagemPopover ?>">DATAS</a>
              
            </td>
            <td>

            <div class="btn-group dropleft">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="relatorio-os.php?id=<?php echo $row->NUM_ID_OS?>" target="_blank">Imprimir</a>
              <a class="dropdown-item" href="detalhes-os.php?id=<?php echo $row->NUM_ID_OS;?>" target="_blank">Detalhes</a>

                <!--Inicio atribuir tecnico-->
                    <?php if($_SESSION['perfil_usu']==00007 AND $statusos=="AB"){ ?> 
                        <a class="dropdown-item" href="alterar-usuarios-os.php?id=<?php echo $row->NUM_ID_OS ?>">Atribuir Técnico</a>
                    <?php } ?>
                <!--Fim atribuir tecnico--> 

                <!--Inicio Cancelar OS-->
                    <?php if ($statusos<>"AB"){ }else{?><!--verifica status da os para editar ou cancelar -->                        
                        <a class="dropdown-item" href="cancelamento-os.php?id=<?php echo $row->NUM_ID_OS ?>">Cancelar</a>
                    <?php } ?>
                <!--Fim Cancelar OS-->

                <!--Inicio Alterar OS-->
                    <?php if ($statusos<>"AB"){ }else{?><!--verifica status da os para editar ou cancelar -->                       
                        <a class="dropdown-item" href="alterar-os.php?id=<?php echo $row->NUM_ID_OS ?>">Alterar</a>                        
                    <?php } ?>
                <!-- Fim alterar OS-->

            </div>
            </div>
            </td>           
            
          </tr>
          <?php
			   
       }//fim while
		?>
      </table>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
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
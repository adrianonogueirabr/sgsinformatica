<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Historico de Ordem de Serviço</title>
</head>

<body>
<?php 
	
	include "conexao.php";

		$valor = $_GET["valor"];
        $id_cliente_equip =  base64_decode($_GET['id_cliente_equip']);
        $nome_cliente =  base64_decode($_GET['nome_cliente']);

	    $res = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP = '$valor' ORDER BY NUM_ID_OS DESC");
        $res->execute();
         if($res->rowCount()<=0){ 
		    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Dados nao encontrados!\");</script>";		
	     }
?>

<form name="listagem" method="post">
<table width="100%" class="table responsive">
  <tr>
      <td><?php include "inicial.php" ?>
  </tr>
  <tr>
		  <td><legend class="p-4 table-primary">Encontradas: Total <?php echo $res->rowCount()?><legend></td>
	</tr>    
  <tr>
      <td>          
          <table class="table-hover table  table-bordered responsive">
              <tr class="table-success" align="center">	
                  <th scope="col">OS</th>
                  <th scope="col">STATUS</th>
                  <th scope="col">CLIENTE</th>
                  <th scope="col">RECLAMACAO</th>
                  <th scope="col">DATAS</th>
                  <th scope="col">AÇÕES</th>
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

                  <?php
                    $id = $row->TBL_CLIENTE_CLI_NUM_ID_CLI;
                    $res_nome = $con->prepare("SELECT TXT_RAZAO_CLI FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$id'");
                    $res_nome->execute();
                    $nome = $res_nome->fetchColumn();	
                  ?>
                  <td><?php echo $nome ?></td>  

                  <td  title="<?php echo $row->TXT_RECLAMACAO_OS;  ?>"><?php echo mb_substr( $row->TXT_RECLAMACAO_OS, 0, 50, 'ISO-8859-1'); ?>...</td>
                  
                  <td> 
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
                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                  <?php if(($statusos=="AB") && ($perfil_usuario==00001)){?><!--verifica status da os para editar ou cancelar --> 
                                    <a href="cancelamento-os.php?id=<?php echo $row->NUM_ID_OS ?>">
                                    <a class="dropdown-item" href="cancelamento-os.php?id=<?php echo $row->NUM_ID_OS ?>">Cancelar OS</a>
                                  <?php }else{} ?>

                                  <?php if ($statusos<>"ABERTO"){ }else{?><!--verifica status da os para editar ou cancelar -->
                                    <a class="dropdown-item" href="alterar-os.php?id=<?php echo $row->NUM_ID_OS ?>">Alterar OS</a>                
                                  <?php } ?>

                                  <a class="dropdown-item" href="detalhes-os.php?id=<?php echo base64_encode($row->NUM_ID_OS) ?>" target="_blank">Detalhes OS</a>

                                  <!--<a class="dropdown-item" href="relatorio-os-entrada.php?id=<?php echo base64_encode($row->NUM_ID_OS) ?>" target="_blank">Comp. Entrada</a>-->

                                  <a class="dropdown-item" href="relatorio-os.php?id=<?php echo base64_encode($row->NUM_ID_OS)?>" target="_blank">Imprimir OS</a>

                                  <!--Inicio atribuir tecnico-->
                                  <?php if($_SESSION['perfil_usu']==00001 AND $statusos=="ABERTO"){ ?>               
                                  <a class="dropdown-item" href="alterar-usuarios-os.php?id=<?php echo base64_encode($row->NUM_ID_OS) ?>">Alterar Tecnico OS</a>              
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
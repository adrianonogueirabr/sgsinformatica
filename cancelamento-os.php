<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
	include "conexao.php";
      $id = base64_decode($_GET['id']);
      $sql = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$id' AND TXT_STATUS_OS <> 'PAGO' AND TXT_STATUS_OS <> 'FATURADA' AND $perfil_usuario = 1"); 
      $sql->execute();
    
    if(!$sql){ die('Houve um erro no processamento da transacao: '.mysql_error());	}

    if($sql->rowCount()== 0){        
        echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=consulta-os.php'><script type=\"text/javascript\">alert(\"Para cancelamento a Ordem de Servico tem que estar com Status Aberta e usuario Administrador!\");</script>";
    }else{    
    ?>
    <form name="os" action="processa-os.php?acao=cancelaros&os=<?php echo base64_encode($id) ?>" method="post">
    <table  class="table">
        <tr>
            <td> <?php include "inicial.php"?> </td>
        </tr>
        <tr>
            <td><h4 class="p-4 table-primary">Cancelamento de Ordem de Servico<h4></td>
        </tr>
        <tr>
            <td>            
                <?php while ($row = $sql->fetch(PDO::FETCH_OBJ)){	?>
                    <div class="form-row">
                        <div class="form-group col-sm-12 col-md-8"><label for="aplicativos">Dados Gerais</label>
                            <input name="aplicativos" type="text" id="aplicativos" class="form-control" title="DADOS GERAIS DO EQUIPAMENTO ESTADO E CONDIÇÕES" readonly="true" value="<?php echo $row->TXT_DADOSGERAIS_OS ?>" />
                        </div>  
                        
                        <div class="form-group col-sm-12 col-md-4"><label for="aplicativos">Previsao</label>
                            <input name="aplicativos" type="text" id="aplicativos" class="form-control" title="DATA DE PREVISAO DA ORDEM DE SERVIÇO" value="<?php echo date("d/m/Y",strtotime($row->DTA_PREVISAO_OS))?>" readonly="true" />
                        </div>

                        <div class="form-group col-sm-12 col-md-12"><label for="aplicativos">Reclamacao</label>
                            <textarea rows="2" readonly="true" class="form-control" title="RECLAMACAO DO CLIENTE"><?php echo $row->TXT_RECLAMACAO_OS ?></textarea>
                        </div>

                        <div class="form-group col-sm-12 col-md-12"><label for="aplicativos">Motivo Cancelamento</label>
                            <textarea name="cancelamento" class="form-control" id="cancelamento" rows="2" required title="INFORME O MOTIVO DO CANCELAMENTO"></textarea>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <input class=" btn btn-outline-success btn-block" type="submit"  value="Salvar Dados" title="CLIQUE PARA EFETUAR CANCELAMENTO" onclick="return confirm('Confirma os dados informados?')" /> 
                        </div>
                    </div>
                <?php 
		            }		
		  }
	    ?> 
      </td>
    </tr>
  </table>
</form>
</body>
</html>
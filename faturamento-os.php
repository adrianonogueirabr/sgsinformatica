
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<?php 

    $id_os = $_POST["id_os"]; 

    include "conexao.php";

		$sql = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$id_os' AND TXT_STATUS_OS = 'ENCERRADA' AND TXT_TIPO_OS = 'PADRAO'");	
		
		if(! $sql->execute() ){
			  die('Houve um erro no processamento da transação: ' . mysqli_error($con)); 
		}

		if($sql->rowCount() == 0){
			  echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=fechamento-os.php'><script type=\"text/javascript\">alert(\"Ordem de servico nao encontrada ou em andamento!\");</script>";
		}else{
			  while ($rowOs = $sql->fetch(PDO::FETCH_OBJ)){

?>

<form name="faturamento" action="processa-fechamento-os.php" method="post" onSubmit="return validaForm()">
<table class="table">
    <tr>
        <td> <?php include "inicial.php"?> </td>
    </tr>
 	<tr>
        <td><legend class="p-4 table-primary">Faturamento de Ordem de Servico<legend></td>
    </tr>
	<tr>
        <td>
            <div class="form-row">                 
                <input type="hidden" name="id_os" value="<?php echo $id_os ?>" />
                <input type="hidden" name="id_cliente" value="<?php echo $rowOs->TBL_CLIENTE_CLI_NUM_ID_CLI ?>" />
                <input type="hidden" name="valorfinal" value="<?php echo $rowOs->VAL_FINAL_OS ?>" />

                <!--inicio busca de dados do cliente-->
                <?php 
                    include_once "conexao.php";
                    $cli = $rowOs->TBL_CLIENTE_CLI_NUM_ID_CLI;
                    $sqlCliente = $con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$cli'");
                    $sqlCliente->execute();
                    while($rowCliente = $sqlCliente->fetch(PDO::FETCH_OBJ)){ 
                        $nomeCliente = $rowCliente->TXT_RAZAO_CLI;
                        $saldoCliente = $rowCliente->VAL_SALDO_CLI;
                    }   
                ?>

                <div class="form-group col-md-4 col-sm-6"><label>Cliente</label>
                <input title="CLIENTE DA ORDEM DE SERVICO" value="<?php echo $nomeCliente ?>" class="form-control" readonly /> </div>
                        
                <div class="form-group col-md-2 col-sm-6"><label>Saldo</label>
                <input title="SALDO DO CLIENTE" value="<?php echo number_format($saldoCliente,2) ?>" class="form-control" readonly /> </div> 

                <div class="form-group col-md-6 col-sm-6"><label>Valor Final</label>
                <input title="VALOR FINAL A SER COBRADO" name="valorfinal_formatado" id="valorfinal_formatado" value="<?php echo number_format($rowOs->VAL_FINAL_OS,2) ?>" readonly  class="form-control"  /> </div>


                <div class="form-group col-md-6 col-sm-6"><label>Condicao de Pagamento</label>
                <select name="condicaopagamento" id="condicaopagamento" class="form-control" onblur="aplicaDesconto()" title='SELECIONE A CONDICAO DE PAGAMENTO'">
                    <option value="VISTA">A VISTA</option>
                    <option value="TITULO">TITULO 1X</option>
                    <?php if ($perfil_usuario == 1){ ?> <option value="3">INTERNO</option> <?php } ?>                    
                </select>
                </div>
                
                <div class="form-group col-md-6 col-sm-6"><label>Data do Titulo</label>
                <input name="datavencimento1" type="date" name="datavencimento1" id="datavencimento1" title="DATA DA PRIMEIRA PARCELA, SOMENTE PREENCHER SE A PRAZO" class="form-control"  /> </div> 

                <div class="form-group col-md-2"><input type="submit"  class="btn-outline-primary btn btn-block" name="button" id="button" value="Salvar Dados"></div> 
        </td>
    </tr>
  </table>
</form>
<?php } } ?>
<script type="text/javascript" src="javascript/faturamento.js"></script>
</body>
</html>
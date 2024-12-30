<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<?php 
	include "conexao.php";
	
		$valor = $_POST['valor'];

		$sql = $con->prepare("SELECT * FROM TBL_ORDEMSERVICO_OS WHERE NUM_ID_OS = '$valor' AND TXT_STATUS_OS = 'ENCERRADA' AND TXT_TIPO_OS = 'PADRAO'");	
		
		if(! $sql->execute() ){
			die('Houve um erro no processamento da transação: ' . mysqli_error($con)); 
		}

		if($sql->rowCount() == 0){
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=fechamento-os.php'><script type=\"text/javascript\">alert(\"Ordem de servico nao encontrada ou em andamento!\");</script>";
		}else{
			while ($rowOs = $sql->fetch(PDO::FETCH_OBJ)){
							
?>

<table class="table">
  	<tr>
	    <td> <?php include "inicial.php"?> </td>
	</tr>
 	<tr>
		<td><legend class="p-4 table-primary">Resumo da Ordem de Serviço<legend></td>
	</tr>
</table>
<table class="table">
	<form name="fechamento" action="faturamento-os.php" method="post">	
		<tr>
			<td> 
				<div class="form-row"> 
					<input type="hidden" name="id_os" id="id_os" value="<?php echo $rowOs->NUM_ID_OS ?>" />					
					
					<div class="form-group col-md-3 col-sm-6"><label>Ordem de Servico</label>
						<input title="NUMERO DA ORDEM DE SERVICO" value="<?php echo $rowOs->NUM_ID_OS ?>" readonly="readonly" class="form-control" readonly /> </div> 

					<div class="form-group  col-md-3 col-sm-6"><label>Tipo</label>
						<input title="TIPO DA ORDEM DE SERVICO" value="<?php echo $rowOs->TXT_TIPO_OS ?>" readonly="readonly" class="form-control" readonly /></div> 
						
					<!--identificacao do cliente-->
					<?php
								include_once "conexao.php";
								$cli = $rowOs->TBL_CLIENTE_CLI_NUM_ID_CLI;
								$sql_nome = $con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$cli'");
								$sql_nome->execute();
								while($row_nome = $sql_nome->fetch(PDO::FETCH_OBJ)){						
							?>
								<!-- adcionado em 21/01/2019	codigo para capturar tpo de pessoa cliente-->
								<input type="hidden" name="pessoa_cliente" id="pessoa_cliente" value="<?php echo $row_nome->TXT_PESSOA_CLI ?>" />
								

								<div class="form-group  col-md-6 col-sm-6"><label>Cliente</label>
								<input title="CLIENTE DA ORDEM DE SERVICO" value="<?php echo $row_nome->TXT_RAZAO_CLI ?>" readonly="readonly" class="form-control" readonly /> </div>                    
					<?php } ?>                   
						<!--fim identificacao do cliente-->				   
						<!--identificacao da frota-->
							<?php 
						
								//select para pegar tipo de equipamento e serial
								$equipamento = $rowOs->TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP;

								//select para pegar tipo de equipamento e serial E.TXT_TIPO_EQUIP, E.TXT_MODELO_EQUIP,E.TXT_SERIAL_EQUIP,
								$sql_equipamento = $con->prepare("SELECT NUM_ID_EQUIP, TXT_TIPO_EQUIP, TXT_MODELO_EQUIP, TXT_MARCA_EQUIP, TXT_SERIAL_EQUIP

									FROM tbl_equipamento_equip 
						
									WHERE NUM_ID_EQUIP = $rowOs->TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP");

								$sql_equipamento->execute();
					
								while($row_equipamento = $sql_equipamento->fetch(PDO::FETCH_OBJ)){?>

									
										<div class="form-group  col-md-3 "><label for="Tipo">Tipo</label>
                                   		 	<input name="Tipo" value="<?php echo $row_equipamento->TXT_TIPO_EQUIP; ?>" readonly="readonly" class="form-control"  />   		      
										</div> 

										<div class="form-group  col-md-3 "><label for="Modelo">Marca</label>
											<input name="Modelo" value="<?php echo $row_equipamento->TXT_MARCA_EQUIP ?>" readonly="readonly" class="form-control"  />   		      
										</div> 

										<div class="form-group  col-md-3 "><label for="Marca">Modelo</label>
											<input name="Marca" value="<?php echo $row_equipamento->TXT_MODELO_EQUIP ?>" readonly="readonly" class="form-control"  />   		      
										</div>                        
															
										<div class="form-group  col-md-3 "><label for="Placa">Serial</label>
											<input name="Placa" value="<?php echo $row_equipamento->TXT_SERIAL_EQUIP; ?>" readonly="readonly" class="form-control"  />   		      
										</div>
									                    
							
							<?php }?>
							<!--fim identificacao da frota-->
						

							<div class="form-group col-md-12 col-sm-6"><label>Dados Gerais Equipamento</label>
							<input title="DADOS GERAIS DA FROTA DA ORDEM DE SERVICO" value="<?php echo $rowOs->TXT_DADOSGERAIS_OS ?>" readonly="readonly" class="form-control" readonly /></div> 

							<div class="form-group col-md-12 col-sm-6"><label>Solicitacoes</label>
							<textarea name="textarea" class="form-control"  disabled="disabled" id="textarea"><?php echo $rowOs->TXT_RECLAMACAO_OS ?></textarea></div>
							
							<div class="form-group col-md-4 col-sm-6"><label>Valor Total</label>
							<input title="VALOR TOTAL DE SERVICOS E PECAS" value="R$<?php echo number_format($rowOs->VAL_TOTAL_OS,2) ?>" readonly="readonly" class="form-control" readonly /> </div> 

							<div class="form-group col-md-4 col-sm-6"><label>Total Desconto</label>
							<input title="VALOR TOTAL DE DESCONTOS" value="R$<?php echo number_format($rowOs->VAL_DESCONTO_OS,2) ?>" readonly="readonly" class="form-control" readonly /> </div> 

							<div class="form-group col-md-4 col-sm-6"><label>Valor Final</label>
							<input title="VALOR FINAL A SER PAGO" value="R$<?php echo number_format($rowOs->VAL_FINAL_OS,2) ?>" readonly="readonly" class="form-control" readonly /> </div> 

							<div class="form-group col-md-2"><input type="submit"  class="btn-outline-success btn btn-block" name="button" id="button" value="Realizar Faturamento" onclick="return confirm('Confirma os dados informados?')"></div>					
			
		<?php
			}//fim row_ordem_servico	
		?>
			</td>
		</tr>
	</form>
</table>

</form>
</body>
</html>
<?php 												
}
?>


<?php include "verifica.php"; 

	include "conexao.php";
	
	$valor = $_POST['valor'];
	
	$res = $con->prepare("
		SELECT a.NUM_ID_OS,a.TXT_TIPO_ATENDIMENTO_OS,a.TXT_TIPO_OS,b.TXT_RAZAO_CLI,a.TBL_CLIENTE_CLI_NUM_ID_CLI,a.TBL_EQUIPAMENTO_EQUIP_NUM_ID_EQUIP,a.TXT_DADOSGERAIS_OS,
		a.TXT_RECLAMACAO_OS,a.TXT_DEFEITO_OS,a.TXT_RESOLUCAO_OS 
		FROM TBL_ORDEMSERVICO_OS a

		LEFT JOIN TBL_CLIENTE_CLI b ON b.NUM_ID_CLI = a.TBL_CLIENTE_CLI_NUM_ID_CLI

		WHERE TXT_STATUS_OS = 'ENCERRADA' AND NUM_ID_OS = '$valor'");		
	
	if(!$res->execute()){die ('Houve um erro no processamento da transação: ' . mysqli_error());}
	//caso a os esteja com status nao permitido

	if($res->rowCount() == 0){	
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=corrigir-apontamento.php'><script type=\"text/javascript\">alert(\"Ordem de Servico precisa estar em ENCERRADA!\");</script>";		
	}else{

?>	
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <body>
        <form action="" method="post">
        <table class="table">
            <tr>
                <td> <?php include "inicial.php"?> </td>
            </tr>
            <tr>
                <td><legend class="p-4 table-primary">Corrigir Dados de Apontamento<legend></td>
            </tr>
            <tr>
                <td>
                    <?php
                    while ($row = $res->fetch(PDO::FETCH_OBJ)){			
                    ?>
                    <div class="form-row"> 
                        <div class="form-group col-md-4 col-sm-6">
                            <label>Numero</label><input value="<?php echo $row->NUM_ID_OS  ?>" class="form-control" readonly />      
                        </DIV>

                        <div class="form-group col-md-4 col-sm-6">
                            <label>Atendimento</label><input value="<?php echo $row->TXT_TIPO_ATENDIMENTO_OS ?>" class="form-control" readonly />                     
                        </DIV>

                        <div class="form-group col-md-4 col-sm-6">
                            <label>Tipo Ordem de Servico</label><input value="<?php echo $row->TXT_TIPO_OS  ?>" class="form-control" readonly />                    
                        </DIV> 

                        <div class="form-group col-md-6 col-sm-12">
                            <label>Cliente</label><input value="<?php echo $row->TXT_RAZAO_CLI  ?>" class="form-control" readonly />
                        </DIV>

                        <div class="form-group col-md-6 col-sm-12">
                            <label>Dados Gerais</label><input value="<?php echo $row->TXT_DADOSGERAIS_OS  ?>" class="form-control" readonly />                    
                        </DIV>

                        <div class="form-group col-md-12 col-sm-12">
                            <label>Reclamacao</label><input value="<?php echo $row->TXT_RECLAMACAO_OS  ?>" class="form-control" readonly />	
                        </DIV>

                        <div class="form-group col-md-12 col-sm-12">
                            <label>Defeito</label><input value="<?php echo $row->TXT_DEFEITO_OS  ?>" class="form-control" readonly />
                        </DIV>  

                        <div class="form-group col-md-12 col-sm-12">
                            <label>Solucao</label><input value="<?php echo $row->TXT_RESOLUCAO_OS  ?>" class="form-control" readonly />
                        </div>
                    </div> 
                    <?php } ?> 
                            
                    </form>
                        
                        
                            <?php
                            include "conexao.php";

                            $sqlItem = $con->prepare("SELECT a.NUM_ID_SERVICO_OS,b.TXT_LOGIN_USU,c.TXT_NOME_SER,a.TBL_ORDEMSERVICO_OS_NUM_ID_OS,a.DTH_INICIO_SERVICO_OS, 
                            a.DTh_TERMINO_SERVICO_OS,a.VAL_VALOR_FINAL_SERVICO_OS,a.TXT_STATUS_SERVICO_OS FROM TBL_ITEM_SERVICO_OS a

                            LEFT JOIN TBL_USUARIO_USU b
                            ON b.NUM_ID_USU = a.TBL_USUARIO_USU_NUM_ID_USU

                            LEFT JOIN TBL_SERVICO_SER c
                            ON c.NUM_ID_SER = a.TBL_SERVICO_SER_NUM_ID_SER

                            WHERE `TBL_ORDEMSERVICO_OS_NUM_ID_OS` = '$valor'");

                            if(! $sqlItem->execute()){die ('Houve um erro no processamento da transacao: '.mysqli_error());}

                            while ($rowItem = $sqlItem->fetch(PDO::FETCH_OBJ)){			
                            ?>
                        <br>
                        <form method="post" action="processa-os.php?acao=corrigeapontamento">
                            
                            <input name="id_os_apontamento" type="hidden" value="<?php echo $valor ?>" />
                            <input name="id_servico_apontamento" type="hidden" value="<?php echo $rowItem->TBL_SERVICO_SER_NUM_ID_SER ?>" />
                            <input name="id_item_os" type="hidden" value="<?php echo $rowItem->NUM_ID_SERVICO_OS ?>">
                        
                            <div class="form-row border">                                          
                                <div class="form-group col-md-9 col-sm-10"><label>Servico</label>
                                    <input value="<?php echo $rowItem->TXT_NOME_SER ?>" class="form-control" readonly />
                                </DIV>

                                <div class="form-group col-md-3 col-sm-2"> <label>Valor</label>                   
                                    <input value="R$<?php echo number_format($rowItem->VAL_VALOR_FINAL_SERVICO_OS,2)  ?>" class="form-control" readonly />         
                                </DIV>
                                
                                <div class="form-group col-md-3 col-sm-6"><label>Data Inicio</label>
                                    <input name="data1"  class="form-control" type="date" id="data1"  value="<?php echo $rowItem->DTH_INICIO_SERVICO_OS ?>" />
                                </DIV>
                                
                                <div class="form-group col-md-3 col-sm-6"><label>Hora Inicio</label>
                                    <input name="hora1" class="form-control" type="time" id="hora1" step="2"  />
                                </DIV>
                                    
                                <div class="form-group col-md-3 col-sm-6"><label>Data Termino</label>
                                    <input name="data2" class="form-control" type="date" id="data2"  value="<?php echo $rowItem->DTH_TERMINO_SERVICO_OS ?> " />
                                </DIV>

                                <div class="form-group col-md-3 col-sm-6"><label>Hora Termino</label>
                                    <input name="hora2" id="hora2" class="form-control" type="time" step="2" id="hora2"  />
                                </DIV>
                                
                                <div class="form-group col-md-2"><label></label>
                                    <input type="submit" name="registrar"  value="Salvar Dados" class="btn btn-outline-primary btn-block" />        
                                </div>                     
                            </div>
                        </form>
                            <?php
                            }
                            ?>

                </td>
            </tr>
        </table>
        

        </body>
        </html>
<?php } ?> 

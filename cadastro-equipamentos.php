<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
//recebe o codigo do cliente para adcionar ao equipamento
$idcliente = base64_decode($_GET['id']);

?>
<body>
<form name="equipamento" action="processa-equipamentos.php?acao=cadastrar" method="post" onSubmit="return validaForm()">
<table width="100%" class="table responsive">
	<tr>
	    <td> <?php include "inicial.php"?></td>
	</tr>
	<tr>
		  <td><legend class="p-4 table-primary">Cadastro de Equipamentos</legend></td>
	</tr>
	<tr>
		  <td>
            <div class="form-row">
                <div class="form-group col-md-3 col-sm-6"><label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo" title="SELECIONE O TIPO DE EQUIPAMENTO" class="form-control">
                        <option>SELECIONE</option>
                        <option value="NOTEBOOK">NOTEBOOK</option>
                        <option value="ALLINONE">ALL IN ONE</option>
                        <option value="DESKTOP">DESKTOP</option>
                        <option value="SERVIDOR">SERVIDOR</option>
                    </select>                    
                </div>
                <input name="cliente" hidden="" type="text" id="cliente" value="<?php echo $idcliente ?>" />

                <div class="form-group col-sm-6 col-md-5"><label for="setor">Setor*</label>
                    <input name="setor" class="form-control" type="text" required="true" id="setor" maxlength="50" title="INFORME SETOR DO EQUIPAMENTO" /> 
                </div>

                <div class="form-group col-sm-6 col-md-4"><label for="nomerede">Nome na Rede</label>
                    <input name="nomerede" class="form-control" type="text" id="nomerede" maxlength="50" title="INFORME O NOME NA REDE" /> </p>
                </div>

                <div class="form-group col-sm-6 col-md-5"><label for="utilizadores">Utilizadores*</label>
                    <input name="utilizadores" type="text" id="utilizadores" class="form-control" required="required" maxlength="20" title="INFORME O NOME DOS UTILIZADORES" />
                </div>
                
                <div class="form-group col-sm-6 col-md-4"><label for="login">Login*</label>
                    <input name="login" type="text" id="login"  class="form-control" required="required" maxlength="20" title="INFORME LOGIN DO EQUIPAMENTO" />
                </div>

                <div class="form-group col-sm-6 col-md-3"><label for="senha">Senha</label>
                    <input name="senha" type="text" id="senha" class="form-control" required="required" maxlength="20" title="INFORME SENHA DO EQUIPAMENTO"/>
                </div>

                <div class="form-group col-sm-12 col-md-6"><label for="descricao">Utilizacao</label>
                    <input name="descricao" class="form-control" type="text" required="required" id="descricao" maxlength="50" title="DESCREVA AS FUNÇÕES DO EQUIPAMENTO" />   
                </div>

                <div class="form-group col-sm-12 col-md-6"><label for="processador">Processador</label>
                    <input name="processador" type="text" id="processador" class="form-control" maxlength="20" title="INFORME O TIPO E VELOCIDADE DO PROCESSADOR I3 - 3.2 GHZ" />
                </div>

                <div class="form-group col-sm-6 col-md-3"><label for="hd">HD</label>
                    <input name="hd" type="number" id="hd" title="INFORME A CAPACIDADE DO HD EM GB OU ZERO" class="form-control" value="0"  />
                </div>

                <div class="form-group col-sm-6 col-md-3"><label for="tipoarmazenamento">Tipo HD</label>
                    <input name="memoria" type="tipoarmazenamento" id="tipoarmazenamento" class="form-control" title="SELECIONE O TIPO DO ARMAZENAMENTO" placeholder="EX: IDE - SSD - NVME - CHIP">
                </div>
                
                <div class="form-group col-sm-6 col-md-3"><label for="memoria">Memoria em GB</label>
                    <input name="memoria" type="number" id="memoria" class="form-control" title="INFORME TOTAL DA MEMORIA EM GB" value="0">
                </div>

                <div class="form-group col-sm-6 col-md-3"><label for="tipomemoria">Tipo Memoria</label>
                    <input name="memoria" type="tipomemoria" id="tipomemoria" class="form-control" title="SELECIONE O TIPO DA MEMORIA" placeholder="EX: DDR3 - DDR4 - DDR2">
                </div>

                <div class="form-group col-sm-6 col-md-5"><label for="placamae">Placa Mae</label>
                    <input name="placamae" type="text" id="placamae" maxlength="20" class="form-control" title="INFORME A PLACA MAE DO EQUIPAMENTO" />
                </div>

                <div class="form-group col-sm-6 col-md-3"><label for="monitor">Monitor</label>
                    <input name="monitor" type="text" id="monitor" title="INFORME O TIPO E TAMANHO DO MONITOR" class="form-control" maxlength="20" />
                </div>

                <div class="form-group col-sm-6 col-md-4"><label for="nfe">Nota Fiscal</label>
                    <input name="nfe" type="number" id="nfe" class="form-control" title="INFORME NUMERO DA NFE DE COMPRA" value="0"  />
                </div>

                <div class="form-group col-sm-12 col-md-8"><label for="aplicativos">Aplicativos</label>
                  <input name="aplicativos" type="text" id="aplicativos" class="form-control" maxlength="50" title="INFORME OS APLICATIVOS EXTRAS DO EQUIPAMENTO" />
                </div>
                
                <div class="form-group col-sm-6 col-md-4"><label for="sistemaoperacional">Sistema Operacional</label>
                        <select name="sistemaoperacional" class="form-control">
                            <?php
                            include "conexao.php"; 
                                $res1=$con->prepare("SELECT NUM_ID_SO, TXT_NOME_SO FROM TBL_SISTEMAOPERACIONAL_SO WHERE TXT_ATIVO_SO = 'SIM'");
                                $res1->execute();

                                while($row1 = $res1->fetch(PDO::FETCH_OBJ)){?>
                                <option value="<?php echo $row1->NUM_ID_SO ?>">
                                  <?php echo $row1->TXT_NOME_SO?>
                              </option>
                            <?php } ?>
                        </select>
                </div>

                <div class="form-group col-sm-6 col-md-3"><label for="marca">Marca</label>
                    <input name="marca" type="text" id="marca" maxlength="50" class="form-control" title="INFORME A MARCA DO EQUIPAMENTO" />
                </div>

                <div class="form-group col-sm-6 col-md-3"><label for="modelo">Modelo</label>
                   <input name="modelo" type="text" id="modelo" class="form-control" maxlength="50" title="INFORME O MODELO DO EQUIPAMENTO" />
                </div>

                <div class="form-group col-sm-6 col-md-3"><label for="serial">Serial</label>
                    <input name="serial" type="text" id="serial" class="form-control" maxlength="30" title="INFORME O SERIAL DO EQUIPAMENTO" />
                </div>
                
                <div class="form-group col-sm-6 col-md-3"><label for="fimgarantia">Garantia</label>
                    <input name="fimgarantia" type="date" id="fimgarantia" class="form-control" title="INFORME A DATA DO FIM DE GARANTIA" />
                </div>

                <div class="form-group col-sm-12 col-md-12"><label for="observacao">Observacao</label>
                    <textarea name="observacao" id="observacao" class="form-control"  cols="120" rows="3" title="DESCREVA INFORMAÇÕES SOBRE O EQUIPAMENTO"></textarea>
                </div>
                
                <div class="form-group col-md-2">
                    <input type="submit" name="registrar"  value="Registrar Dados" class="btn btn-outline-primary" />
	              </div>
            </div>
      </td>
</tr>
</table>
</form>
</body>
<script type="text/javascript" src="javascript/cadastro_equipamento.js"></script>
</html>
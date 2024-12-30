
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
	include "conexao.php";
	$id = base64_decode($_GET['id']);
	$res = $con->prepare("SELECT * FROM TBL_EQUIPAMENTO_EQUIP WHERE NUM_ID_EQUIP = '$id'");
    $res->execute();
  
    while ($row = $res->fetch(PDO::FETCH_OBJ)){ 
?>

<body>
<form name="equipamento" method="post" action="processa-equipamentos.php?acao=salvar">
<table width="100%" class="table responsive">
<tr>
    <td> <?php include "inicial.php"?></td>
</tr>
<tr>
    <td><legend class="p-4 table-primary">Detalhes Equipamento</legend></td>
</tr>
<tr>
    <td>    
        <div class="form-row"> 
            <div class="form-group col-md-3 col-sm-4"><label for="tipo">Tipo de Equipamento</label>
                <input type="text" class="form-control" disabled="disabled" value="<?php echo $row->TXT_TIPO_EQUIP ?>" />
            </div>

            <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $id ?>">

            <div class="form-group col-md-6 col-sm-8"><label for="tipo">Cliente</label>
                <?php
                        $idcli = $row->TBL_CLIENTE_CLI_NUM_ID_CLI;
                        $cli = $con->prepare("SELECT TXT_RAZAO_CLI  FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = '$idcli'");
                        $cli->execute();
                        $nome = $cli->fetchColumn();
                ?>        
                <input class="form-control" type="text" disabled="disabled" value="<?php echo $nome ?>"  />   
            </div> 
            
            <div class="form-group col-md-3 col-sm-6"><label for="setor">Setor</label>
                <input type="text" name="setor" id="setor"  class="form-control" value="<?php echo $row->TXT_SETOR_EQUIP ?>" />
            </div>

            <div class="form-group col-md-4 col-sm-6"><label for="nomerede">Hostname</label>
                <input type="text" name="nomerede" id="nomerede"  class="form-control" value="<?php echo $row->TXT_NOMEREDE_EQUIP ?>" />
            </div>

            <div class="form-group col-md-4 col-sm-6"><label for="nomerede">Login</label>
                <input type="text" name="login" id="login"  class="form-control" value="<?php echo $row->TXT_LOGIN_EQUIP ?>" />
            </div>

            <div class="form-group col-md-4 col-sm-6"><label for="senha">Senha</label>
                <input type="text" name="senha" id="senha"  class="form-control" value="<?php echo $row->TXT_SENHA_EQUIP ?>" />
            </div>

            <div class="form-group col-md-10 col-sm-12"><label for="descricao">Descricao</label>
                <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $row->TXT_DESCRICAO_EQUIP ?>" />
            </div>

            <div class="form-group col-md-2 col-sm-6"><label for="monitor">Monitor</label> 
                <input type="text" name="monitor" id="monitor" class="form-control" value="<?php echo $row->TXT_MONITOR_EQUIP ?>"/>
            </div>

            <div class="form-group col-md-4 col-sm-6"><label for="utilizadores">Utilizador</label>
                <input type="text" name="utilizadores" id="utilizadores" class="form-control" value="<?php echo $row->TXT_UTILIZADORES_EQUIP ?>" />
            </div>

            <div class="form-group col-md-8 col-sm-12"><label for="aplicativos">Aplicativos</label>
                <input type="text" name="aplicativos" id="aplicativos" class="form-control" value="<?php echo $row->TXT_APLICATIVOS_EQUIP ?>" />
            </div>

            <div class="form-group col-md-3 col-sm-12"><label for="tipoarmazenamento">Tipo Armazenamento</label>
                <input type="text" class="form-control" name="tipoarmazenamento" id="tipoarmazenamento" value="<?php echo $row->TXT_TIPO_ARMAZENAMENTO_EQUIP ?>" placeholder="EX: IDE, SSD, NVME, CHIP"/>
            </div>

            <div class="form-group col-md-3 col-sm-12"><label for="hd">Capacidade</label>
                <input type="text" class="form-control" name="hd" id="hd"  value=" <?php echo $row->NUM_HD_EQUIP ?>"/>
            </div>

            <div class="form-group col-md-3 col-sm-12"><label for="tipomemoria">Tipo Memoria</label>
                <input type="text" class="form-control" name="tipomemoria" id="tipomemoria" value="<?php echo $row->TXT_TIPO_MEMORIA_EQUIP ?>" placeholder="EX: DDR3, DDR4, DDR2"/>
            </div>

            <div class="form-group col-md-3 col-sm-12"><label for="memoria">Memoria</label>
                <input type="text" class="form-control" name="memoria" id="memoria"  value="<?php echo $row->NUM_MEMORIA_EQUIP ?>"/>
            </div>

            <div class="form-group col-md-3 col-sm-12"><label for="Processador">Processador</label>
                <input type="text" class="form-control" name="processador" id="processador"  value="<?php echo $row->TXT_PROCESSADOR_EQUIP ?>"/>
            </div>

            <div class="form-group col-md-3 col-sm-12"><label for="placamae">Placa Mae</label>
                <input type="text" class="form-control" name="placamae" id="placamae"  value="<?php echo $row->TXT_PLACAMAE_EQUIP ?> "/>
            </div>    

            <div class="form-group col-md-2 col-sm-6"><label for="nfe">Nota Fiscal</label>
                <input type="text" name="nfe" id="nfe"   class="form-control" value="<?php echo $row->NUM_NFE_EQUIP ?>" />
            </div>

            <div class="form-group col-md-4 col-sm-6"><label for="hd">Sistema Operacional</label>
                        <?php
                        $so = $row->TBL_SISTEMAOPERACIONAL_SO_NUM_ID_SO;
                        $sql_nome = $con->prepare("SELECT TXT_NOME_SO FROM TBL_SISTEMAOPERACIONAL_SO WHERE NUM_ID_SO = '$so'");
                        $sql_nome->execute();
                        $nomeSO = $sql_nome->fetchColumn() 
                        ?>
                        <input type="text" disabled="disabled" class="form-control" value="<?php echo $nomeSO ?>" />
            </div>

            <div class="form-group col-md-4 col-sm-6"><label for="marca">Marca</label>
                <input type="text"  class="form-control" name="marca" id="marca" value="<?php echo $row->TXT_MARCA_EQUIP ?>" />
            </div>

            <div class="form-group col-md-4 col-sm-6"><label for="modelo">Modelo</label>
                <input type="text"name="modelo" id="modelo"  class="form-control" value="<?php echo $row->TXT_MODELO_EQUIP ?>" />
            </div>

            <div class="form-group col-md-4 col-sm-6"><label for="serial">Serial</label>
                <input type="text" name="serial" id="serial" class="form-control" value="<?php echo $row->TXT_SERIAL_EQUIP ?>" />
            </div>
            
            <div class="form-group col-md-12 col-sm-12"><label for="observacao">Observacao</label>
                <textarea class="form-control" rows="3" name="observacao" id="observacao" title="DESCREVA INFORMAÇÕES SOBRE O EQUIPAMENTO"><?php echo $row->TXT_OBSERVACAO_EQUIP ?></textarea>
            </div>

            <div class="form-group col-md-4 col-sm-6"><label for="modelo">Fim Garantia</label>
                <input type="text" disabled="disabled" class="form-control" value="<?php echo  date("d/m/Y",strtotime($row->DTA_GARANTIA_EQUIP)); ?>" />
            </div>    
            
            <div class="form-group col-md-4 col-sm-6"><label for="">Data Registro</label>
                <input type="text" disabled="disabled" class="form-control" value="<?php echo  date("d/m/Y H:m:s",strtotime($row->DTH_REGISTRO_EQUIP)); ?>" />
            </div>

            <div class="form-group col-md-4 col-sm-6"><label for="ativo">Equipamento Ativo</label>        
                <select name="ativo" id="ativo" class="form-control" required>		    
                    <option value="SIM">SIM</option>
                    <option value="NAO">NAO</option>
                </select>
            </div>

            <div class="form-group col-md-2 col-sm-12">
                <input type="submit" name="Alterar Dados"  value="Salvar Dados" class="btn btn-outline-danger btn-block"  />
            </div>

            <div class="form-group col-sm-12 col-md-2">
                <a href="cadastro-os.php?id_e=<?php echo base64_encode($row->NUM_ID_EQUIP) ?>&id_c=<?php echo base64_encode($row->TBL_CLIENTE_CLI_NUM_ID_CLI)?>&nc=<?php echo base64_encode($nome) ?>" class="btn btn-outline-primary btn-block" role="button" aria-pressed="true">Registrar OS</a>
            </div>
        </div>

        <?php
            }
        ?>

  </td>
</tr>
</table>
</form>
</body>
</html>
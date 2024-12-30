
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="javascript/cadastro_equipamento.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alterar Equipamentos</title>
</head>

<?php
	include "conexao.php";
	$id = $_GET['id'];
	$res = $con->prepare("SELECT * FROM TBL_EQUIPAMENTO_EQUIP WHERE NUM_ID_EQUIP = '$id'");
  $res->execute();
  
  while ($row = $res->fetch(PDO::FETCH_OBJ)){ 

?>

<body>
<form name="equipamento" method="post" action="processa-equipamentos.php?acao=salvar&id=<?php echo $id ?>" method="post" onSubmit="return validaForm()">
<table class="table">
  <tr>
	    <td><?php include "inicial.php"?></td>
  </tr>
     <tr><td class=" table-primary"><h4>Alterar Equipamento: <?php echo $row->NUM_ID_EQUIP?></h4></td></tr>
</table>
<table width="80%" align="center">  
<tr>
<td>     

    <div class="form-row">
    <div class="form-group col-md-3 col-sm-6">
        <p class="font-weight-bold">TIPO
          <select name="tipo" id="tipo" title="SELECIONE O TIPO DE EQUIPAMENTO" class="form-control">
          <option>SELECIONE</option>
          <option value="NOTEBOOK">NOTEBOOK</option>
    		  <option value="ALLINONE">ALL IN ONE</option>
          <option value="DESKTOP">DESKTOP</option>
          <option value="SERVIDOR">SERVIDOR</option>
          </select>
          </p>
    </div>

    <input name="cliente" type="hidden" id="cliente" value="<?php echo $row->TBL_CLIENTE_CLI_NUM_ID_CLI ?>">
    
    <div class="form-group col-md-5 col-sm-6">
      <p class="font-weight-bold">SETOR<input type="text" class="form-control" name="setor" id="setor" value="<?php echo $row->TXT_SETOR_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-4 col-sm-6">
        <p class="font-weight-bold">NOME NA REDE<input type="text" name="nomerede" id="nomerede"  class="form-control" value="<?php echo $row->TXT_NOMEREDE_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-3 col-sm-6">
       <p class="font-weight-bold">LOGIN<input type="text" name="login"  id="login" class="form-control" value="<?php echo $row->TXT_LOGIN_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-3 col-sm-6">
        <p class="font-weight-bold">SENHA<input type="text" name="senha"  id="senha"  class="form-control" value="<?php echo $row->TXT_SENHA_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-6 col-sm-12">
        <p class="font-weight-bold">DESC EQUIPAMENTO<input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $row->TXT_DESCRICAO_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-3 col-sm-6">
        <p class="font-weight-bold">UTILIZADORES<input type="text" name="utilizadores"   id="utilizadores" class="form-control" value="<?php echo $row->TXT_UTILIZADORES_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-2 col-sm-6">
        <p class="font-weight-bold">MONITOR <input type="text" name="monitor"  id="monitor" class="form-control" value="<?php echo $row->TXT_MONITOR_EQUIP ?>"/></p>
    </div>

    <div class="form-group col-md-7 col-sm-12">
        <p class="font-weight-bold">APLICATIVOS<input type="text" name="aplicativos"  id="aplicativos"  class="form-control" value="<?php echo $row->TXT_APLICATIVOS_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-4 col-sm-12">
        <p class="font-weight-bold">PROCESSADOR 
         <input type="text" class="form-control" name="processador"   id="processador" value="<?php echo $row->TXT_PROCESSADOR_EQUIP ?>"/></p>
    </div>

    <div class="form-group col-md-2 col-sm-12">
        <p class="font-weight-bold">HD
        <input name="hd"  type="number" id="hd"  class="form-control"  value="<?php echo $row->NUM_HD_EQUIP ?>"/></p>
    </div>

    <div class="form-group col-md-2 col-sm-6">
      <p class="font-weight-bold">TIPO HD*
      <select name="tipoarmazenamento" id="tipoarmazenamento" title="SELECIONE O TIPO DO ARMAZENAMENTO" class="form-control">
      	  <option value="IDE">IDE</option>
		      <option value="SSD">SSD</option>
              <option value="SSD NVME">SSD NVME</option>
          <option value="CHIP">CHIP</option>
      </select>
      </p>
  </div>

    <div class="form-group col-md-2 col-sm-12">
        <p class="font-weight-bold">MEMORIA
         <input name="memoria"  type="number" id="memoria"  class="form-control"  value="<?php echo $row->NUM_MEMORIA_EQUIP ?>"/></p>
    </div>

    <div class="form-group col-md-2 col-sm-6">
      <p class="font-weight-bold">TIPO MEMORIA*
      <select name="tipomemoria" id="tipomemoria" title="SELECIONE O TIPO DA MEMORIA" class="form-control">
      	  <option value="DDR2">DDR2</option>
		      <option value="DDR3">DDR3</option>
          <option value="DDR4">DDR4</option>
      </select>
      </p>
  </div>

    <div class="form-group col-md-4 col-sm-12">
        <p class="font-weight-bold">PLACA MAE
         <input type="text" class="form-control"  name="placamae"  id="placamae"  value="<?php echo $row->TXT_PLACAMAE_EQUIP ?> "/></p>
    </div>

    <div class="form-group col-md-2 col-sm-6">
        <p class="font-weight-bold">NFE<input name="nfe"  type="number" id="nfe"  class="form-control" value="<?php echo $row->NUM_NFE_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-6 col-sm-6">    
        <p class="font-weight-bold">SISTEMA OPERACIONAL
             <select name="sistemaoperacional" placeholder="Somente numeros" class="form-control" >
                <?php 
                 include "conexao.php"; 
                 $res1=$con->prepare("SELECT NUM_ID_SO, TXT_NOME_SO FROM TBL_SISTEMAOPERACIONAL_SO WHERE TXT_ATIVO_SO = 'S'");
                 $res1->execute();

                    while($row1 = $res1->fetch(PDO::FETCH_OBJ)){?>
                    <option value="<?php echo $row1->NUM_ID_SO ?>"><?php echo $row1->TXT_NOME_SO ?></option>
                    <?php } ?>
               </select>
               </p>
    </div>

    <div class="form-group col-md-4 col-sm-6">
        <p class="font-weight-bold">MARCA<input type="text" name="marca"   id="marca" class="form-control" value="<?php echo $row->TXT_MARCA_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-4 col-sm-6">
        <p class="font-weight-bold">MODELO<input type="text" name="modelo"   id="modelo"   class="form-control" value="<?php echo $row->TXT_MODELO_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-4 col-sm-6">
        <p class="font-weight-bold">SERIAL DO EQUIPAMENTO<input type="text" name="serial"   id="serial" class="form-control" value="<?php echo $row->TXT_SERIAL_EQUIP ?>" /></p>
    </div>
    
    <div class="form-group col-md-12 col-sm-12">
        <p class="font-weight-bold">OBSERVAÇÃO
        <textarea name="observacao" id="observacao"  class="form-control" cols="120" rows="3" title="DESCREVA INFORMAÇÕES SOBRE O EQUIPAMENTO"><?php echo $row->TXT_OBSERVACAO_EQUIP ?></textarea></p>
    </div>

    
    <div class="form-group col-md-4 col-sm-6">    
        <p class="font-weight-bold">DATA DE REGISTRO<input type="text" disabled="disabled" class="form-control" value="<?php echo  date("d/m/Y",strtotime($row->DTA_REGISTRO_EQUIP)); ?>" /></p>
    </div>

    <div class="form-group col-md-4 col-sm-6">    
        <p class="font-weight-bold">FIM GARANTIA<input type="date" class="form-control" name="fimgarantia"   id="fimgarantia"  value="<?php echo  $row->DTA_GARANTIA_EQUIP ?>" /></p>
    </div>

    <div class="form-group col-md-4 col-sm-6">
        <p class="font-weight-bold">ATIVO
          <select name="ativo" id="ativo" title="INFORME SE EQUIPAMENTO ESTA ATIVO OU NAO" class="form-control">
          <option value="S">SIM</option>
          <option value="N">NAO</option>
          </select>
          </p>
    </div>
      <?php
		}
	 ?>
    <div class="form-group col-md-2 col-sm-12">
        <input type="submit" name="registrar"  value="Salvar Dados" class="btn btn-success btn-block" />        
	</div>

  </td></tr>
</table>
</form>
</body>
</html>
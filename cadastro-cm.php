<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>

<form name="cliente"  method="post">
<table width="100%" class="table responsive">
	<tr>
	    <td> <?php include "inicial.php"?></td>
	</tr>
	<tr>
		<td><legend class="p-4 table-primary">Cadastro de Contrato</legend></td>
	</tr>
	<tr>
		<td>

  <?php

  if(isset($_POST['btnregistrar'])){
  require_once 'contratoManutencao.php';
  require_once 'contratoManutencaoDao.php';
  require_once 'conexao.php';
  include "verifica.php";

  $contrato = new contratoManutencao();
  $contratoDao = new contratoManutencaoDao();
  
  $contrato->setUsuario($id_usuario);
  $contrato->setCliente($_POST['cliente']);
  $contrato->setValor($_POST['valor']);
  $contrato->setDiapagamento($_POST['diapagamento']);

 if($contratoDao->RegistrarContrato($contrato)=="OK"){
   echo "Contrato registrado";
   
 }else{
   echo "Contrato nao registrado";
 }

}

?>
 <div class="form-row">
  <div class="form-group  col-md-4 col-sm-6"><label for="cliente">ID Cliente</label>
		    <input class="form-control input-lg" name="cliente" type="text" id="cliente" required="required"  maxlength="14" title="INFORME O ID DO CLIENTE" /></p>
	</div> 

  <div class="form-group  col-md-4 col-sm-6"><label for="valor">Valor</label>
		    <input class="form-control input-lg" name="valor" type="number" id="valor" required="required"  title="INFORME O VALOR COBRADO" placeholder="0.00" /></p>
	</div> 

	<div class="form-group form-group-lg col-md-4 col-sm-6"><label for="diapagamento">Dia Vencimento</label>
        <select name="diapagamento" id="diapagamento" title="INFORME DIA DO VENCIMENTO" class="form-control">
        <option value="1">1</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="25">25</option>
			</select>
		</p>
	</div>


  <div class="form-group col-md-2">
        <input type="submit" name="btnregistrar"  value="Registrar Dados" class="btn btn-outline-primary" />
	</div>


</table>
</form>
</body>
</html>
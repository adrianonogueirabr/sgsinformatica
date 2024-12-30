<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>

<form name="cliente"  method="post">
<table class="table">
          <tr>
              <td> <?php include "inicial.php"?> </td>
          </tr>
          <tr>
              <td><legend class="p-4 table-primary">Alterar Contrato de: <?php echo base64_decode($_GET['nc']) ?><legend></td>
          </tr>
          <tr>
              <td>

  <?php

  if(isset($_POST['btnatualizar'])){
  require_once 'contratoManutencao.php';
  require_once 'contratoManutencaoDao.php';
  require_once 'conexao.php';


  $contrato = new contratoManutencao();
  $contratoDao = new contratoManutencaoDao();
  
  $contrato->setDatatermino($_POST['datatermino']);
  $contrato->setAtivo($_POST['ativo']);
  $contrato->setValor($_POST['valor']);
  $contrato->setDiapagamento($_POST['diapagamento']);
  $contrato->setControle($_POST['idregistro']);

 if($contratoDao->AtualizarContrato($contrato)=="OK"){
    echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=listagem-cm.php'><script type=\"text/javascript\">alert(\"Contrato atualizado com sucesso!\");</script>";
   
 }else{
   echo "Problemas ao atualizar contrato de manutencao, tente mais tarde!";
 }

}

?>

  <input type="hidden" id="idregistro" name="idregistro" value="<?php echo base64_decode($_GET['id']) ?>">
  <div class="form-row">
  <div class="form-group  col-md-6 col-sm-6"><label for="ativo">Valor</label> 
		   <input class="form-control input-lg" name="valor" type="number" id="valor" required="required"  title="INFORME O VALOR COBRADO" placeholder="0.00" /></p>
	</div> 

  <div class="form-group col-md-6 col-sm-6"><label for="ativo">Data Termino</label> 
     	<input name="datatermino" id="datatermino" class="form-control"  type="date" required="true">
		 </p>
	</div>

	<div class="form-group form-group-lg col-md-6 col-sm-6"><label for="ativo">Dia Vencimento</label>  
        <select name="diapagamento" id="diapagamento" title="INFORME DIA DO VENCIMENTO" class="form-control">
        <option value="1">1</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="25">25</option>
      </select>
  </div> 

  <div class="form-group form-group-lg col-md-6 col-sm-6"><label for="ativo">Ativo</label>  
        <select name="ativo" id="ativo" title="INFORME SE ATIVO OU NAO" class="form-control">
        <option value="SIM">SIM</option>
        <option value="NAO">NAO</option>
			</select>
		</p>
	</div>
  <div class="form-group col-md-2 col-sm-12">
        <input type="submit" name="btnatualizar"  value="Salvar Dados" class="btn btn-outline-danger"  />
    </div>
</div>


    
</td></tr>
</table>
</form>
</body>
</html>
<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<form name="listagem" action="listagem-cm.php" method="post" onSubmit="return validaForm()">
<table  width="100%" class="table responsive">
    <tr>
	    <td><?php include "inicial.php"?> </td>
	</tr>
 	<tr>
		<td><legend class="p-4 table-primary">Pesquisar Contrato de Manutencao</Legend></td>
	</tr>
	<tr>
		<td>  
          <div class="form-check">
            <input class="form-check-input" type="radio" name="criterio" id="criterio" value="C" >
            <label class="form-check-label" for="criterio">Pesquisar pelo ID</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="criterio" id="criterio" value="R" checked>
            <label class="form-check-label" for="criterio">Pesquisar pelo Nome</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="criterio" id="criterio" value="C" checked>
            <label class="form-check-label" for="criterio">Pesquisar pelo CNPJ/CPF</label>
          </div>

          <div class="form-row"> 
              <div class="form-group col-md-4 ">
                <input class="form-control"  type="text"   name="valor" id="valor" required="required" placeholder="Informe Parametro se Nome incluir % no final"  />
              </div>

              <div class="form-group col-md-2 col-sm-12">	
                <button type="submit" class="btn btn-outline-primary btn-block">Buscar Dados</button>
              </div>

              <div class="form-group col-md-2 col-sm-12">
                <a href="cadastro-cm.php" class="btn btn-outline-success btn-block" role="button" aria-pressed="true">Registrar Contrato</a>
              </div>	
          </div>



    </td>

  </tr>
</table>
</form>
</body>
</html>
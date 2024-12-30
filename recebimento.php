<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<form name="listagem" action="dados-recebimento.php" method="post" onSubmit="return validaForm()">
<table width="100%" class="table responsive">
    <tr>
        <td><?php include "inicial.php" ?></td>
    </tr>
    <tr>
        <td><legend class="p-4 table-primary">Dados de Recebimentos<legend></td>		
    </tr>
	<tr>
		<td>
			<div class="form-row"> 
			<div class="form-group col-md-4 ">
				<input class="form-control"  type="text"   name="valor" id="valor" required="required" placeholder="Informar ID do cliente"  />
				<input type="hidden" name="criterio" value="AD">
			</div>

			<div class="form-group col-md-2 col-sm-12">	
			<button type="submit" class="btn btn-outline-primary">Buscar Dados</button>
			</div>
		</td>
  	</tr>
</table>
</form>
</body>
</html>
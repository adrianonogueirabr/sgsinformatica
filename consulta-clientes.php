
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>

<table  width="100%" class="table responsive">
    <tr>
	    <td><?php include "inicial.php"?> </td>
	</tr>
 	<tr>
		<td><legend class="p-4 table-primary">Pesquisar Clientes</Legend></td>
	</tr>
	<tr>
		<td>  
			<form name="listagem" action="listagem-clientes.php" method="post">

				<div class="form-check">
					<input class="form-check-input" type="radio" name="criterio" id="criterio" value="R" checked>
					<label class="form-check-label" for="criterio">Pesquisar por Nome</label>
				</div>

				<div class="form-check">
					<input class="form-check-input" type="radio" name="criterio" id="criterio" value="C">
					<label class="form-check-label" for="criterio">Pesquisar por CPF ou CPF</label>
				</div>

				<div class="form-check">
					<input class="form-check-input" type="radio" name="criterio" id="criterio" value="I">
					<label class="form-check-label" for="criterio">Pesquisar por ID</label>
				</div>

				<div class="form-row"> 
				<div class="form-group col-md-4 ">
					<input class="form-control"  type="text"   name="valor" id="valor" required="required" placeholder="Informe Parametro"  />
				</div>

				<div class="form-group col-md-2 col-sm-12">	
					<button type="submit" class="btn btn-outline-primary btn-block">Buscar Dados</button>
				</div>

				<div class="form-group col-md-2 col-sm-12">
					<a href="cadastro-clientes.php" class="btn btn-outline-success btn-block" role="button" aria-pressed="true">Registrar Cliente</a>
				</div>		
			</form>
		</td>
	</tr>
</table>
</body>
</html>
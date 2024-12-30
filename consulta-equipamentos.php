
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<form name="listagem" action="listagem-equipamentos.php" method="post">

<table  width="100%" class="table responsive">
    <tr>
	    <td><?php include "inicial.php"?> </td>
	</tr>
 	<tr>
		<td><legend class="p-4 table-primary">Consulta Equipamento</Legend></td>
	</tr>
	<tr>
		<td> 
			<div class="form-check">
				<input class="form-check-input" type="radio" name="criterio" id="criterio" value="I" checked>
				<label class="form-check-label" for="criterio">Pesquisar pelo ID</label>
			</div>

			<div class="form-check">
				<input class="form-check-input" type="radio" name="criterio" id="criterio" value="S">
				<label class="form-check-label" for="criterio">Pesquisar pelo Serial</label>
			</div>

			<div class="form-row"> 
			<div class="form-group col-md-4 ">
				<input class="form-control"  type="text"   name="valor" id="valor" required="required" placeholder="Informe Parametro"  />
			</div>

			<div class="form-group col-md-2 col-sm-12">	
				<button type="submit" class="btn btn-outline-primary btn-block">Buscar Dados</button>
			</div>
		</td>
	</tr>
</form>
</table>
</body>
</html>
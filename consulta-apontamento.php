<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
 <title>SGOFIC - Sistema de Gestão de Oficina 🚚🚕</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <meta name="author" content="Adriano Nogueira - Desenvolvedor">
   <meta content= "SGOFIC - SISTEMA DE GESTÃO DE OFICINAS" name="description">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 </head>
<body>
<form name="listagem" action="listagem-apontamento.php" method="post">
<table  width="100%" class="table responsive">
    <tr>
	    <td><?php include "inicial.php"?> </td>
	</tr>
 	<tr>
		<td><legend class="p-4 table-primary">Realizar Apontamento</legend></td>
	</tr>
	<tr>
		<td>  
				<div class="form-row"> 
					<div class="form-group col-md-4 ">
					<input class="form-control"  type="number"   name="valor" id="valor" required="required" title="INFORME O NUMERO DA ORDEM DE SERVICO"  placeholder="INFORME NUMERO DA ORDEM DE SERVICO"  />
				</div>

				<div class="form-group col-md-2 col-sm-12">	
					<button type="submit" class="btn btn-outline-primary btn-block">Buscar Dados</button>
				</div>

</form>
</td>
</tr>
</table>
</body>
</html>
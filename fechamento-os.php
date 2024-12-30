<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<form name="listagem" action="detalhes-os-fechamento.php" method="post" >
<table  width="100%" class="table responsive">
    <tr>
	    <td><?php include "inicial.php"?> </td>
	</tr>
 	<tr>
	    <td><legend class="p-4 table-primary">Faturar Ordem de Servico</legend></td>
	</tr>
	<tr>
	    <td>
            <div class="form-row">       
                <div class="form-group col-md-4">
                    <input name="valor" type="number" class="form-control"  id="valor" required="required" placeholder="INFORME O NUMERO DA ORDEM DE SERVICO" title="INFORME O NUMERO DA ORDEM DE SERVICO"  />
                </div>

                <div class="form-group col-md-2">
                    <input type="submit" class="btn btn-outline-primary btn-block"  name="buscar"  value="Buscar" />
                </div>
            </div>
        </td>
    </tr>
</table>

</form>
</body>
</html>
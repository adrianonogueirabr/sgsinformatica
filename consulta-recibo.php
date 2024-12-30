<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Consulta de Recibos</title>
</head>

<body>
<form name="listagem" action="listagem-recibo.php" method="post" onSubmit="return validaForm()">
<table class="table responsive">
    <tr>
        <td><?php include "inicial.php" ?></td>
    </tr>
    <tr>
        <td><legend class="p-4 table-primary">Consultar Recibo<legend></td>		
    </tr>
    <tr>
		    <td>

       <form name="listagem2" action="listagem-recibo.php" method="post"> 
       <div class="form-row">
          <div class="form-group col-md-2">
            <input name="data1" type="date" class="form-control" required="TRUE" id="data1" />
          </div>

          <div class="form-group col-md-2">
            <input name="data2" type="date" class="form-control" required="TRUE" id="data2" />
          </div>

          <input type="hidden" name="criterio" value="D">
          <div class="form-group col-md-2">
              <input type="submit" class="btn btn-outline-warning btn-block"  name="buscar"  value="Buscar" />
          </div>
        </DIV>
      </form> 

    </td>
  </tr>
</table>
</form>
</body>
</html>
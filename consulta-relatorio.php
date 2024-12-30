<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>

<table class="table responsive">
    <tr>
        <td><?php include "inicial.php" ?></td>
    </tr>
    <tr>
        <td><legend class="p-4 table-primary">Consultar Valores Recebidos<legend></td>		
    </tr>
    <tr>
		    <td>
            <form name="listagem2" action="listagem-recebimentos.php" method="post"> 
                <div class="form-row">                                               
                    <input name="criterio" type="hidden" value="P" id="criterio" />                  

                    <div class="form-group col-md-2">
                      <input name="dtInicial" type="date" class="form-control" required="TRUE" id="dtInicial" />
                    </div>

                    <div class="form-group col-md-2">
                      <input name="dtFinal" type="date" class="form-control" required="TRUE" id="dtFinal" />
                    </div>         

                    <div class="form-group col-md-2">
                        <input type="submit" class="btn btn-outline-warning btn-block"  name="buscar"  value="Buscar" />
                    </div>
                </div>
            </form>
        </td>
    </tr>
</table>
</body>
</html>
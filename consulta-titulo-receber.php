<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<form name="listagem" action="listagem-titulo-receber.php" method="post">
<table class="table responsive">
	<tr>
	    <td> <?php include "inicial.php"?></td>
	</tr>
	<tr>
		  <td><legend class="p-4 table-primary">Pesquisar Titulo a Receber<legend></td>
	</tr>
</table>
<table class="table">
	  <tr>
	     <td>

            <form name="listagem3" action="listagem-titulo-receber.php" method="post">
                
                    <label>Titulo por Status</label>
                    <input type="hidden" name="criterio" value="I" />
                
                <div class="form-row">    
                    <div class="form-group col-md-4">
                    <input name="valor" type="text" class="form-control"  id="valor" required="required" placeholder="Informe o ID do Cliente"  /></div>

                    <div class="form-group col-md-2">
                    <input type="submit" class="btn btn-outline-danger btn-block"  name="buscar"  value="Buscar" /></div>
                </div>
            </form>

            <hr>
            <form name="listagem1" action="listagem-titulo-receber.php" method="post">      
                
                <label>Titulo por Vencimento</label>
                <input name="criterio" type="hidden" value="S" id="criterio" /> 
                <input type="hidden" name="criterio" value="D">               
                
                <div class="form-row">
                    <div class="form-group col-md-2">
                    <input name="data1" type="date" class="form-control" required="TRUE"  id="data1" /></div>
                
                    <div class="form-group col-md-2">
                    <input name="data2" type="date" class="form-control" required="TRUE"  id="data2" /></div>                    

                    <div class="form-group col-md-2">
                    <input type="submit" class="btn btn-outline-primary btn-block"  name="buscar"  value="Buscar" /></div>
                </div>
            </form> 
            <hr>
            <form name="listagem" action="listagem-titulo-receber.php" method="post" >
                
                <label>Titulo por Status</label>
                <input name="criterio" type="hidden" value="S" id="criterio" />   
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                      <select name="valor" id="valor" title="SELECIONE O STATUS DA OS" class="form-control">          
                          <option value="ABERTO"> TITULO EM ABERTO</option>              
                          <option value="CANCELADO"> TITULO CANCELADO</option>
                      </select>
                    </div>

                    <div class="form-group col-md-2">
                    <input type="submit" class="btn btn-outline-warning btn-block"  name="buscar"  value="Buscar" /></div>
                </div>
            </form>
            <hr>           
  
        </td>
    </tr> 
</table>
</form>
</body>
</html>
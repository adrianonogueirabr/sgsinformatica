<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<table  class="table">
    <tr>
	      <td><?php include "inicial.php"?> </td>
	  </tr>
 	  <tr>
		    <td><legend class="p-4 table-primary">Pesquisar Orcamentos</legend></td>
	  </tr>
	  <tr>
		    <td>
                <form name="listagem" action="listagem-orcamentos.php" method="post">                

                    <div class="form-check col-md-2">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="O" checked>
                        <label class="form-check-label" for="criterio">Pelo ID do Orcamento </label>
                    </div>

                    <div class="form-check col-md-2">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="C" checked>
                        <label class="form-check-label" for="criterio">Pelo ID Cliente </label>
                    </div> 
                    
                    <div class="form-check col-md-2">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="E" checked>
                        <label class="form-check-label" for="criterio">Pelo ID Frota </label>
                    </div> 

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input name="valor" type="text" class="form-control"  id="valor" required="required" title="INFORME O PARAMETRO PARA PESQUISA"  />
                        </div>

                        <div class="form-group col-md-2">
                            <input type="submit" class="btn btn-outline-primary btn-block"  name="buscar"  value="Buscar" />
                        </div>
                    </div>
                </form>
            <hr>
            <form name="listagem" action="listagem-orcamentos.php" method="post" >
                    <div class="form-check col-md-2">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="AB" title="PESQUISAR PELA DATA DE ABERTURA" checked>
                        <label class="form-check-label" for="criterio">Pela Data Registro</label>
                    </div>


                    <div class="form-row">                                  
                        <div class="form-group col-md-2">
                            <input name="dtaInicial" type="date" class="form-control" title="INFORME O PARAMETRO PARA PESQUISA"  id="dtaInicial" title="Data Inicial"/>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <input name="dtaFinal" type="date" class="form-control" title="INFORME O PARAMETRO PARA PESQUISA"  id="dtaFinal" title="Data Final"/>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <input type="submit" class="btn btn-outline-warning btn-block"  name="buscar"  value="Buscar" />
                        </div>
                    </div>
            </form>
            <hr>
            <form name="listagem" action="listagem-orcamentos.php" method="post" >

                    <div class="form-check col-md-4">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="S" title="PESQUISAR PELO STATUS DA ORDEM DE SERVICO" checked>
                        <label class="form-check-label" for="criterio">Listar Orcamentos em Aberto</label>
                    </div>

                    <div class="form-row">
                    <div class="form-group  col-md-4">
                        <select name="valor" id="valor" class="form-control" required title="INFORME O PARAMETRO PARA PESQUISA">
                            <option value="ABERTO">ABERTO</option>

                        </select>
                    </div> 

                    <div class="form-group col-md-2">
                      <input type="submit" class="btn btn-outline-danger btn-block"  name="buscar"  value="Buscar" />
                    </div>

                </div>              
            </form>
            <hr>
        </td>
    </tr>
</table>

</body>
</html>
<?php include "verifica.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<table  class="table">
    <tr>
	        <td><?php include "inicial.php"?> </td>
	  </tr>
 	  <tr>
		    <td><legend class="p-4 table-primary">Pesquisar Ordem de Servicos</legend></td>
	  </tr>
	  <tr>
		    <td>
                <form name="listagem" action="listagem-os.php" method="post">                
                    <div class="form-check col-md-2">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="1" checked>
                        <label class="form-check-label" for="criterio">Pelo ID Cliente </label>
                    </div> 
                    
                    <div class="form-check col-md-2">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="2" checked>
                        <label class="form-check-label" for="criterio">Pelo ID Equipamento </label>
                    </div> 

                    <div class="form-check col-md-2">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="3" checked>
                        <label class="form-check-label" for="criterio">Pelo ID Ordem de Servico </label>
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
            <form name="listagem" action="listagem-os.php" method="post" >
                    <div class="form-check col-md-2">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="4" title="PESQUISAR PELA DATA DE ABERTURA" checked>
                        <label class="form-check-label" for="criterio">Pela Data Abertura</label>
                    </div>

                    <div class="form-check col-md-2">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="5" title="PESQUISAR PELA DATA DE ENCERRAMENTO">
                        <label class="form-check-label" for="criterio">Pela Data Encerramento</label>
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
            <form name="listagem" action="listagem-os.php" method="post" >

                    <div class="form-check col-md-4">
                        <input class="form-check-input" type="radio" name="criterio" id="criterio" value="6" title="PESQUISAR PELO STATUS DA ORDEM DE SERVICO" checked>
                        <label class="form-check-label" for="criterio">Pelo Status da Ordem de Servico</label>
                    </div>

                    <div class="form-row">
                    <div class="form-group  col-md-4">
                        <select name="valor" id="valor" class="form-control" required title="INFORME O PARAMETRO PARA PESQUISA">
                            <option value="ABERTA">ABERTA</option>
                            <option value="ANDAMENTO">ANDAMENTO</option>
                            <option value="ENCERRADA">ENCERRADA</option>
                            <option value="FATURADA">FATURADA</option>
                            <option value="CANCELADA">CANCELADA</option>
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
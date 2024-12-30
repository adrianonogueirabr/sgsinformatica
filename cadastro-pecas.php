<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<form name="servico" action="processa-pecas.php?acao=cadastrar" method="post">
<table class="table responsive">
	<tr>
	    <td> <?php include "inicial.php"?></td>
	</tr>
	<tr>
		<td><legend class="p-4 table-primary">Cadastro de Pecas</legend></td>
	</tr>
	<tr>
		<td>
      <div class="form-row">
          <div class="form-group  col-md-5 col-sm-6"><label for="nome">Nome</label>
              <input class="form-control" name="nome" type="text"  required="required" maxlength="50"  title="INFORME O NOME DA PECA" />
          </div>

          <div class="form-group  col-md-5 col-sm-6"><label for="codigo">Codigo</label>
              <input class="form-control" name="codigo" type="text" required="required" maxlength="50"  title="INFORME O CODIGO DA PECA" />
          </div>

          <div class="form-group  col-md-2 col-sm-6"><label for="valor">Valor Venda</label>
              <input class="form-control" name="valor" type="text" required="required"  title="INFORME O VALOR DE VENDA" />
          </div>

          <div class="form-group col-md-2 col-sm-12">
              <input type="submit" name="registrar"  value="Registrar Dados" class="btn btn-outline-primary" />
          </div>
      </div>

  </td>
  </tr>
</table>
</form>
</body>
</html>
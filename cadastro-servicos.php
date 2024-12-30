<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<form name="servico" action="processa-servicos.php?acao=cadastrar" method="post">
<table class="table responsive">
	<tr>
	    <td> <?php include "inicial.php"?></td>
	</tr>
	<tr>
		<td><legend class="p-4 table-primary">Cadastro de Servicos</legend></td>
	</tr>
	<tr>
		<td>
      <div class="form-row">
          <div class="form-group  col-md-5 col-sm-6"><label for="nome">Nome</label>
              <input class="form-control" name="nome" type="text"  required="required" maxlength="50"  title="INFORME O NOME DO SERVICO" />
          </div>

          <div class="form-group  col-md-5 col-sm-6"><label for="descricao">Descricao</label>
              <input class="form-control" name="descricao" type="text" required="required" maxlength="50"  title="INFORME A DESCRICAO DO SERVICO" />
          </div>

          <div class="form-group  col-md-2 col-sm-6"><label for="duracao">Tempo</label>
              <input class="form-control" name="duracao" type="number" required="required"  title="INFORME O TEMPO DO SERVICO EM HORAS" />
          </div>

          <div class="form-group  col-md-4 col-sm-6"><label for="fisica">Valor Pessoa Fisica</label>
              <input class="form-control" name="fisica" type="DOUBLE" required="required"  title="INFORME O VALOR PARA PESSOA FISICA" />
          </div>

          <div class="form-group  col-md-4 col-sm-6"><label for="juridica">Valor Pessoa Juridica</label>
          <input class="form-control" name="juridica" type="DOUBLE" required="required"  title="INFORME O VALOR PARA PESSOA JURIDICA" />
          </div>

          <div class="form-group  col-md-4 col-sm-6"><label for="contrato">Valor Contrato</label>
              <input class="form-control " name="contrato" type="DOUBLE" required="required"  title="INFORME O VALOR PARA CONTRATOS" />
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
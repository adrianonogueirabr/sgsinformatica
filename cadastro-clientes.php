
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>

<form name="cliente" action="processa-clientes.php?acao=cadastrar" method="post">
<table width="100%" class="table responsive">
	<tr>
	    <td> <?php include "inicial.php"?></td>
	</tr>
	<tr>
		<td><legend class="p-4 table-primary">Cadastro de Clientes</legend></td>
	</tr>
	<tr>
		<td>

<div class="form-row g-3">
	<div class="form-group form-group-lg col-md-3 col-sm-6"><label for="pessoa">Tipo  </label>
       	<select name="pessoa" id="pessoa" class="form-control" required>
		    <option value="E">Selecione..</option>
		    <option value="FISICA">PESSOA FÍSICA</option>
		    <option value="JURIDICA">PESSOA JURÍDICA</option>
		</select>
	</div>

	<div class="form-group  col-md-3 col-sm-6"><label for="cpfcnpj">CPF ou CNPJ*</label>
		<input class="form-control" name="cpfcnpj" type="number" id="cpfcnpj" required="required" onblur="validarCPFeCNPJ(this.value)"  maxlength="14" title="INFORME O CPF OU CNPJ DO CLIENTE" />
	</div>

	<div class="form-group col-md-6 col-sm-12"><label for="razao">Razão Social*</label>
    	<input name="razao" type="text" class="form-control" id="razao" maxlength="100" title="INFORME NOME/RAZAO SOCIAL DO CLIENTE" onblur="adcionaRazaoFantasia()" required="required" />
	</div>

	<div class="form-group col-md-6 col-sm-12"><label for="fantasia">Nome Fantasia*</label>
		<input name="fantasia" type="text" class="form-control" id="fantasia"  maxlength="100" title="INFORME NOME FANTASIA" />
	</div>

    <div class="form-group col-md-3 col-sm-6"><label for="data_cadastro">Data Nascimento/Fundação*</label>
     	<input name="data_cadastro" class="form-control" type="date" required="true">
	</div>

    <div class="form-group col-md-3 col-sm-6"><label for="telefone">Telefone*</label>
  		<input name="telefone" type="number" id="telefone" class="form-control"  maxlength="20" required="required" title="INFORME TELEFONE SEJA CELULAR OU FIXO" placeholder="92991490000" />
	</div>
	
    <div class="form-group col-md-12 col-sm-6"><label for="email">Email*</label>
		<input name="email" required="required" type="email" class="form-control" id="email"  maxlength="100" title="INFORME EMAIL DO CLIENTE" />
	</div>
	
	<div class="form-group col-md-3 col-sm-6"><label for="cep">Cep</label>
		<span id="msgAlertaCepNaoEncontrado"></span>
    	<input name="cep" class="form-control" type="number" id="cep" title="INFORME O CEP DO CLIENTE" value="0" size="8" onblur="pesquisacep(this.value);" maxlength="10" />
	</div>

	<div class="form-group col-md-6 col-sm-10"><label for="logradouro">Logradouro</label>
    	<input name="logradouro" type="text" class="form-control" id="logradouro"  maxlength="100" title="INFORME LOGRADOURO SEM NUMERO"/>
	</div>
	

	<div class="form-group col-md-3 col-sm-2"><label for="numero">Numero</label>
    	<input name="numero" type="number" class="form-control" id="numero" title="INFORME NUMERO DA RESIDENCIA" value="0"/>
	</div>

    <div class="form-group col-md-4 col-sm-6"><label for="bairro">Bairro</label>
    	<input name="bairro" type="text" class="form-control" id="bairro"  title="INFORME O BAIRRO DO CLIENTE" />
	</div>

	<div class="form-group col-md-4 col-sm-6"><label for="cidade">Cidade</label>
     	<input name="cidade" type="text" id="cidade"  class="form-control"  title="INFORME A CIDADE DO CLIENTE" />
	</div>

	<div class="form-group col-md-4 col-sm-6"><label for="estado">Estado</label>
     	<input name="estado" type="text" id="estado"  class="form-control" title="INFORME A CIDADE DO CLIENTE" />
	</div>

    <div class="form-group col-md-6 col-sm-6"><label for="complemento">Complemento</label>
   		<input name="complemento" type="text" id="complemento" class="form-control" title="INFORME COMPLEMENTO DO ENDERECO" />
	</div>

    <div class="form-group col-md-6 col-sm-6"><label for="referencia">Referencia</label>
   		<input name="referencia" type="text" id="referencia"  class="form-control" maxlength="40" title="INFORME REFERENCIA DO ENDERECO" />
	</div>

	<div class="form-group col-md-3 col-sm-6"><label for="im">inscrição Municipal</label>
    	<input name="im" type="text" id="im"  class="form-control" maxlength="20" title="INFORME INSCRICAO MUNICIPAL CASO POSSUA" />
	</div>

	<div class="form-group col-md-3 col-sm-6">	<label for="ie">Inscrição Estadual</label>
    	<input name="ie" type="text" id="ie" maxlength="20" class="form-control" title="INFORME INSCRICAO ESTADUAL CASO POSSUA"/>
	</div>

	<div class="form-group col-md-3 col-sm-6"><label for="rg">Registro Geral</label>
    	<input name="rg" type="text" id="rg" class="form-control"  maxlength="20" title="INFORME RG DO CLIENTE"/>
	</div>

	<div class="form-group col-md-3 col-sm-6"><label for="contato">Contato</label>
    	<input name="contato" type="text" class="form-control" id="contato"  maxlength="40" title="INFORME DADOS DO CONTATO NOME - TELEFONE"/>
	</div>

    <div class="form-group col-md-12 col-sm-12"><label for="observacao">Observações</label>
    	<textarea name="observacao" id="observacao" class="form-control" cols="60" rows="3" title="INFORMACOES GERAIS DO CLIENTE"></textarea>
	</div>

	<div class="form-group col-md-2">
        <input type="submit" name="registrar"  value="Registrar Dados" class="btn btn-outline-primary" />
	</div>
</div>

</form>

</td></tr>
</table>
	<script type="text/javascript" src="javascript/cadastro_cliente.js"></script>
</body>
</html>
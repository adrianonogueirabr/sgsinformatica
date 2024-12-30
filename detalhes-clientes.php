
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <?php

        include_once "conexao.php";

        $id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_STRING);

        $res = $con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = ?");
        $res->bindParam(1,$id);
        if (!$res->execute()) { echo "Error: " . $sql . "<br>" . mysqli_error($con);}
            
            while ($row = $res->fetch(PDO::FETCH_OBJ)){     
        
    ?>

<body>
<form name="cliente" action="processa-clientes.php?acao=salvar"  method="post">    
    <table width="100%" class="table responsive">
        <tr>
            <td> <?php include "inicial.php"?></td>
        </tr>
        <tr>
		    <td><legend class="p-4 table-primary">Detalhes: <?php echo $row->TXT_RAZAO_CLI ?></legend></td>
	    </tr>

<tr>
<td>  

<div class="form-row"> 
    <div class="form-group col-md-3 col-sm-6"><label for="tipo">Tipo de Cadastro*</label>
        <input name="tipo" type="text" title="TIPO DE CADASTRO" value="<?php echo $row->TXT_PESSOA_CLI; ?>" readonly="readonly" class="form-control"  />        
    </div>
               
    <div class="form-group col-md-3 col-sm-6"><label for="cpfcnpj">CPF ou CNPJ*</label>
        <input name="cpfcnpj" id="cpfcnpj"  type="text" title="CPF OU CNPJ DO CLIENTE" value="<?php echo $row->TXT_CPF_CNPJ_CLI; ?>" readonly="readonly" class="form-control"  />
    </div>

    <div class="form-group col-md-6 col-sm-12"><label for="razao">Razão Social*</label>
        <input name="razao" id="razao"  type="text" value="<?php echo $row->TXT_RAZAO_CLI; ?>" title="NOME/RAZAO SOCIAL DO CLIENTE" onblur="adcionaRazaoFantasia()" required class="form-control"  />
    </div>

    <div class="form-group col-md-6 col-sm-12"><label for="fantasia">Nome Fantasia</label>
        <input name="fantasia" id="fantasia" type="text" required id="fantasia" value="<?php echo $row->TXT_FANTASIA_CLI; ?>" title="NOME FANTASIA" class="form-control"  />
    </div>

    <div class="form-group col-md-3 col-sm-6"><label for="id_">Data Nascimento/Fundação</label>
        <input name="id_" type="text" class="form-control" title="DATA DE NASCIMENTO" value="<?php echo date("d/m/Y", strtotime($row->DTA_NASCIMENTO_CLI)); ?>" readonly="readonly" />
    </div>

    <div class="form-group col-md-3 col-sm-6"><label for="telefone">Telefone*</label>
        <input name="telefone" id="telefone" type="text" class="form-control" required value="<?php echo $row->TXT_TELEFONE_CLI; ?>" title="TELEFONE CELULAR OU FIXO" />
    </div>

    <div class="form-group col-md-6 col-sm-6"><label for="email">Email*</label>
        <input name="email" id="email" class="form-control" type="email" required value="<?php echo $row->TXT_EMAIL_CLI; ?>" title="EMAIL DO CLIENTE" />
    </div>

    <div class="form-group col-md-6 col-sm-6"><label for="numero">CEP</label>
        <span id="msgAlertaCepNaoEncontrado"></span>
        <input name="cep" id="cep" class="form-control" type="text" size="8" onblur="pesquisacep(this.value);"  value="<?php echo $row->NUM_CEP_CLI; ?>" title="CEP DO CLIENTE" />
    </div>

    <div class="form-group col-md-6 col-sm-10"><label for="logradouro">Logradouro</label>
        <input name="logradouro" id="logradouro" class="form-control" type="text"  value="<?php echo $row->TXT_LOGRADOURO_CLI; ?>" title="LOGRADOURO"/>
    </div>

    <div class="form-group col-md-3 col-sm-2"><label for="id_">Numero</label>
        <input name="numero" id="numero" class="form-control" type="text"  value="<?php echo $row->NUM_NUMERO_CLI; ?>" title="NUMERO DA RESIDENCIA"/>
    </div>

    <div class="form-group col-md-3 col-sm-6"><label for="bairro">Bairro</label>
        <input name="bairro" id="bairro" class="form-control" type="text"   value="<?php echo $row->TXT_BAIRRO_CLI; ?>" title="BAIRRO DO CLIENTE" />
    </div>

    <div class="form-group col-md-3 col-sm-6"><label for="complemento">Complemento</label>
        <input name="complemento" id="complemento"  class="form-control" type="text"  value="<?php echo $row->TXT_COMPLEMENTO_CLI; ?>" title="COMPLEMENTO DO ENDERECO" />
    </div>

    <div class="form-group col-md-6 col-sm-6"><label for="referencia">Ponto de Referencia</label>
        <input name="referencia" id="referencia" class="form-control" type="text"  value="<?php echo $row->TXT_REFERENCIA_CLI; ?>" title="PONTO DE REFERENCIA DO CLIENTE" />
    </div>

    <div class="form-group col-md-3 col-sm-6"><label for="cidade">Cidade</label>
        <input name="cidade" id="cidade" type="text" class="form-control"  value="<?php echo $row->TXT_CIDADE_CLI; ?>" title="CIDADE DO CLIENTE" />
    </div>

    <div class="form-group col-md-3 col-sm-6"><label for="estado">Estado</label>
        <input name="estado" id="estado" type="text" title="ESTADO DO CLIENTE NO SISTEMA" value="<?php echo $row->TXT_ESTADO_CLI; ?>" class="form-control" />
    </div>

    <div class="form-group col-md-3 col-sm-6"><label for="im">Inscricao Municipal</label>
        <input name="im" id="im" type="text" class="form-control"  value="<?php echo $row->TXT_IM_CLI; ?>" title="INSCRICAO MUNICIPAL CASO POSSUA" />
    </div>

    <div class="form-group col-md-3 col-sm-6"><label for="ie">Inscricao Estadual</label>
        <input name="ie" id="ie" type="text" class="form-control" value="<?php echo $row->TXT_IE_CLI; ?>" title="INSCRICAO ESTADUAL CASO POSSUA"/>
    </div>

    <div class="form-group col-md-3 col-sm-6"><label for="rg">Registro Geral</label>
        <input name="rg" id="rg" type="text"  class="form-control"  value="<?php echo $row->TXT_RG_CLI; ?>" title="RG DO CLIENTE"/>
    </div>

    <div class="form-group col-md-12 col-sm-6"><label for="contato">Contato</label>
        <input name="contato" id="contato" type="text" class="form-control"  value="<?php echo $row->TXT_CONTATO_CLI; ?>" title="DADOS DO CONTATO"/>
    </div>

    <div class="form-group col-md-12 col-sm-12"><label for="observacao">Observacoes</label>
        <textarea class="form-control" rows="3" name="observacao" id="observacao" title="INFORMACOES GERAIS DO CLIENTE"><?php echo $row->TXT_OBSERVACAO_CLI; ?></textarea>
    </div>

    <div class="form-group col-md-4 col-sm-6"><label for="saldo_">Saldo</label>
        <input name="saldo_" class="form-control" type="text" readonly="readonly" value="R$<?php echo number_format($row->VAL_SALDO_CLI,2) ?>" title="SALDO EM ADIANTAMENTO DO CLIENTE" disabled="disabled" />
    </div>

    <div class="form-group col-md-4 col-sm-6"><label for="id_">Titulo Aberto</label>
        <input name="tituloaberto_" class="form-control" type="text" id="tituloaberto_" readonly="readonly" value="<?php echo $row->TXT_TITULOABERTO_CLI; ?>" title="INFORMA SE CLIENTE TEM TITULO EM ABERTO" disabled="disabled" />
    </div>

    <div class="form-group col-md-4 col-sm-6"><label for="alteracao_">Data Ultima Alteracao</label>
        <input name="alteracao_" class="form-control" type="text" readonly="readonly" title="DATA DA ULTIMA ALTERACAO DO CLIENTE" value="<?php echo date("d/m/Y H:i:s",strtotime($row->DTH_ALTERACAO_CLI)); ?>"/>
    </div>

    <div class="form-group col-md-6 col-sm-6"><label for="registro_">Cliente Desde</label>
         <input name="registro_" class="form-control" type="text" readonly="readonly" title="DATA DE REGISTRO DO CLIENTE" value="<?php echo date("d/m/Y H:i:s", strtotime($row->DTH_REGISTRO_CLI)); ?>" />
    </div>

    <div class="form-group col-md-6 col-sm-6"><label for="ativo">Cliente Ativo</label>        
        <select name="ativo" id="ativo" class="form-control" required>		    
		    <option value="SIM">SIM</option>
		    <option value="NAO">NAO</option>
		</select>
    </div>
    
      <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $row->NUM_ID_CLI; ?>">
      <INPUT TYPE="hidden" NAME="saldo" VALUE="<?php echo $row->VAL_SALDO_CLI; ?>">
      <INPUT TYPE="hidden" NAME="registro" VALUE="<?php echo $row->DTA_REGISTRO_CLI; ?>">
      <INPUT TYPE="hidden" NAME="alteracao" VALUE="<?php echo $row->DTA_ALTERACAO_CLI; ?>">
      <INPUT TYPE="hidden" NAME="tituloaberto" VALUE="<?php echo $row->TXT_TITULOABERTO_CLI; ?>">
        
    <?php
		}
    ?>
    <div class="form-group col-md-2 col-sm-12">
        <input type="submit" name="Alterar Dados"  value="Salvar Dados" class="btn btn-outline-danger"  />
    </div>
</form>
</td>
</tr>
</table>
<script type="text/javascript" src="javascript/cadastro_cliente.js"></script>
</body>
</html>
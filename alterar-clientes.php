
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="javascript/cadastro_cliente.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alteracao de Clientes</title>
</head>

<?php

include "conexao.php";

$id = $_GET['id'];

$res = $con->prepare("SELECT * FROM TBL_CLIENTE_CLI WHERE NUM_ID_CLI = ?");
$res->bindParam(1,$id);
$res->execute();

while ($row = $res->fetch(PDO::FETCH_OBJ)){			

?>

<body>
<table class="table">
    <tr>
	    <td> <?php include "inicial.php"?> </td>
	</tr>
     <tr><td class=" table-primary"><h4>Alterar Cliente: <?php echo $row->NUM_ID_CLI?></h4></td></tr>
</table>
<table width="80%" align="center">
<tr>
<td>      	

<form name="cliente" action="processa-clientes.php?acao=salvar" method="post">

<div class="form-row">
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">TIPO
		<?php if($row->TXT_PESSOA_CLI=='J'){ ?>
		    <input name="id_" type="text" value="PESSOA JURIDICA" readonly="readonly" class="form-control" title="PESSOA FISICA OU JURIDICA" /></p>
				<?php }else{ ?>
			    	<input name="id_" type="text" value="PESSOA FISICA" readonly="readonly"  class="form-control" title="PESSOA FISICA OU JURIDICA"/></p>
				<?php } ?>  
    </div>		

    <div class="form-group col-md-3 col-sm-6">
        <p class="font-weight-bold">CPF OU CNPJ
        <input name="cpfcnpj" type="text" id="cpfcnpj" title="INFORME O CPF OU CNPJ DO CLIENTE" value="<?php echo $row->TXT_CPF_CNPJ_CLI; ?>" maxlength="20" readonly="readonly" class="form-control"  /></p>
    </div>

    <div class="form-group col-md-6 col-sm-12">
        <p class="font-weight-bold">RAZÃO SOCIAL*
        <input name="razao" type="text" id="razao" maxlength="100" value="<?php echo $row->TXT_RAZAO_CLI; ?>" title="INFORME NOME/RAZAO SOCIAL DO CLIENTE" onblur="adcionaRazaoFantasia()" class="form-control"  /></p>
    </div>

    <div class="form-group col-md-6 col-sm-12">
        <p class="font-weight-bold">NOME FANTASIA*
        <input name="fantasia" type="text" id="fantasia"  maxlength="100" value="<?php echo $row->TXT_FANTASIA_CLI; ?>" title="INFORME NOME FANTASIA" class="form-control"  /></p>
    </div>

    <div class="form-group col-md-3 col-sm-6">    
        <p class="font-weight-bold">DATA DE NASCIMENTO*
        <input name="data_cadastro" class="form-control" type="date" id="data2"  value="<?php echo $row->DTA_NASCIMENTO_CLI ;?>" />	</p>
    </div>
  
    <div class="form-group col-md-3 col-sm-6">
        <p class="font-weight-bold">SEXO*
        <select name="sexo" id="sexo" title="INFORME O SEXO DO CLIENTE" class="form-control">
            <option value="F" selected="true">FEMININO</option>
            <option value="M">MASCULINO</option>
        </select>   
        </p> 
    </div>

    <div class="form-group col-md-3 col-sm-6">
        <p class="font-weight-bold">TELEFONE*
        <input name="telefone" type="text" class="form-control"  id="telefone"  value="<?php echo $row->TXT_TELEFONE_CLI; ?>" title="INFORME TELEFONE SEJA CELULAR OU FIXO" placeholder="92991490000" /></p>
    </div>

    <div class="form-group col-md-5 col-sm-6">
        <p class="font-weight-bold">EMAIL*
        <input name="email" class="form-control" type="text" id="email"  maxlength="100" value="<?php echo $row->TXT_EMAIL_CLI; ?>" title="INFORME EMAIL DO CLIENTE" /></p>
    </div>

    <div class="form-group col-md-4 col-sm-12">
        <p class="font-weight-bold">SITE
        <input name="site" class="form-control" type="text" id="site"  maxlength="100" value="<?php echo $row->TXT_SITE_CLI; ?>" title="INFORME SITE CASO CLIENTE POSSUA" /></p>
    </div>

    <div class="form-group col-md-6 col-sm-10">
        <p class="font-weight-bold">LOGRADOURO
        <input name="logradouro" class="form-control" type="text" id="logradouro"  maxlength="100" value="<?php echo $row->TXT_LOGRADOURO_CLI; ?>" title="INFORME LOGRADOURO SEM NUMERO" placeholder="RUA / AVENIDA / BECO"/></p>
    </div>

    <div class="form-group col-md-3 col-sm-2">
        <p class="font-weight-bold"> NUMERO 
        <input name="numero" class="form-control" type="text" id="numero"  maxlength="20" value="<?php echo $row->NUM_NUMERO_CLI; ?>" title="INFORME NUMERO DA RESIDENCIA"/></p>
    </div>

    <div class="form-group col-md-3 col-sm-6">
        <p class="font-weight-bold">CEP 
        <input name="cep" class="form-control" type="text" id="cep"  maxlength="10" value="<?php echo $row->NUM_CEP_CLI; ?>" title="INFORME O CEP DO CLIENTE" /></p>
    </div>

<div class="form-group col-md-3 col-sm-6">
    <p class="font-weight-bold">BAIRRO:
    <input name="bairro" class="form-control" type="text" id="bairro"  maxlength="40" value="<?php echo $row->TXT_BAIRRO_CLI; ?>" title="INFORME O BAIRRO DO CLIENTE" /></p> 
</div>

<div class="form-group col-md-3 col-sm-6">
    <p class="font-weight-bold">COMPLEMENTO:
    <input name="complemento" class="form-control" type="text" id="complemento"  maxlength="40" value="<?php echo $row->TXT_COMPLEMENTO_CLI; ?>" title="INFORME COMPLEMENTO DO ENDERECO" /> </p>
</div>

<div class="form-group col-md-6 col-sm-6">

    <p class="font-weight-bold">PONTO DE REF.: 
    <input name="referencia" class="form-control" type="text" id="referencia" maxlength="40" value="<?php echo $row->TXT_REFERENCIA_CLI; ?>" title="INFORME PONTO DE REFERENCIA DO CLIENTE" /> </p>
</div>

<div class="form-group col-md-4 col-sm-6">
    <p class="font-weight-bold">CIDADE:
    <input name="cidade" type="text" class="form-control" id="cidade"  maxlength="40" value="<?php echo $row->TXT_CIDADE_CLI; ?>" title="INFORME A CIDADE DO CLIENTE" /> </p>
</div>

<div class="form-group col-md-4 col-sm-6">
    <p class="font-weight-bold">ESTADO: 
    <select name="estado" id="estado" title="SELECIONE O ESTADO DO CLIENTE" class="form-control">      
      <option value="S">S</option>      
      <option value="AC">AC</option>      
      <option value="AL">AL</option>      
      <option value="AP">AP</option>      
      <option value="AM">AM</option>      
      <option value="BA">BA</option>      
      <option value="CE">CE</option>      
      <option value="ES">ES</option>      
      <option value="DF">DF</option>      
      <option value="MA">MA</option>      
      <option value="MT">MT</option>      
      <option value="MS">MS</option>      
      <option value="MG">MG</option>      
      <option value="PA">PA</option>      
      <option value="PB">PB</option>      
      <option value="PR">PR</option>      
      <option value="PE">PE</option>      
      <option value="PI">PI</option>      
      <option value="RJ">RJ</option>      
      <option value="RN">RN</option>      
      <option value="RS">RS</option>      
      <option value="RO">RO</option>      
      <option value="RR">RR</option>      
      <option value="SC">SC</option>      
      <option value="SP">SP</option>      
      <option value="SE">SE</option>      
      <option value="TO">TO</option>      
    </select>
    </p>      
</div>

<div class="form-group col-md-4 col-sm-6">
    <p class="font-weight-bold">INSC. MUNICIPAL:
    <input name="im" type="text" class="form-control" id="im"  maxlength="20" value="<?php echo $row->TXT_IM_CLI; ?>" title="INFORME INSCRICAO MUNICIPAL CASO POSSUA" /> </p>
</div>

<div class="form-group col-md-4 col-sm-6">
    <p class="font-weight-bold">INSC. ESTADUAL: 
    <input name="ie" type="text" class="form-control" id="ie"  maxlength="20" value="<?php echo $row->TXT_IE_CLI; ?>" title="INFORME INSCRICAO ESTADUAL CASO POSSUA"/></p>
</div>

<div class="form-group col-md-4 col-sm-6">
      <p class="font-weight-bold">REGISTRO GERAL: 
      <input name="rg" type="text" id="rg"  maxlength="20" class="form-control"  value="<?php echo $row->TXT_RG_CLI; ?>" title="INFORME RG DO CLIENTE"/></p> 
</div>

<div class="form-group col-md-4 col-sm-6">
      <p class="font-weight-bold">CONTATO:
      <input name="contato" type="text" class="form-control" id="contato"  maxlength="40" value="<?php echo $row->TXT_CONTATO_CLI; ?>" title="INFORME DADOS DO CONTATO CASO EMPRESA NOME - TELEFONE"/> </p>
</div>

<div class="form-group col-md-12 col-sm-12">
      <p class="font-weight-bold">OBSERVAÇÃO:
      <textarea class="form-control" rows="3" name="observacao" id="observacao"  title="INFORMACOES GERAIS DO CLIENTE"><?php echo $row->TXT_OBSERVACAO_CLI; ?></textarea></p>
</div>

<div class="form-group col-md-4 col-sm-6">
      <p class="font-weight-bold">SALDO ADIANTAMENTO: 
      <input name="saldo_" class="form-control" type="text" id="saldo_"  maxlength="20" value="<?php echo $row->VAL_SALDO_CLI; ?>" title="SALDO EM ADIANTAMENTO DO CLIENTE" disabled="disabled" /> </p>
</div>

    <div class="form-group col-md-4">
        <p class="font-weight-bold">TITULO EM ABERTO: 
        <input name="tituloaberto_" class="form-control" type="text" id="tituloaberto_" maxlength="20" value="<?php echo $row->TXT_TITULOABERTO_CLI; ?>" title="INFORMA SE CLIENTE TEM TITULO EM ABERTO" disabled="disabled" /> </p>
    </div>

    <div class="form-group col-md-4">
        <p class="font-weight-bold">ULTIMA ALTERACAO:
        <input name="alteracao_" class="form-control" type="text" disabled="disabled" id="alteracao_" title="DATA DA ULTIMA ALTERACAO DO CLIENTE" value="<?php echo date("d/m/Y", strtotime($row->DTA_ALTERACAO_CLI)); ?>" size="20" maxlength="20"/> </p>
    </div>

    <div class="form-group col-md-6 col-sm-6">
        <p class="font-weight-bold">CLIENTE DESDE: 
        <input name="registro_" class="form-control" type="text" disabled="disabled" id="registro_" title="DATA DE REGISTRO DO CLIENTE" value="<?php echo date("d/m/Y", strtotime($row->DTA_REGISTRO_CLI)); ?>" size="20" maxlength="20"/></p>
    </div>

    <div class="form-group col-md-6 col-sm-6">
      <p class="font-weight-bold">ATIVO: 
       <select name="ativo" id="ativo" title="INFORME SE CLIENTE ESTA ATIVO OU NAO" class="form-control">
          <option value="S" selected="true">SIM</option>
          <option value="N">NAO</option>
        </select> 
        </p> 
    </div>    
    
    <div class="form-group col-md-2 col-sm-12">
        <input type="submit" name="registrar"  value="Salvar Dados" class="btn btn-success btn-block" />        
	</div>

      <INPUT TYPE="hidden" NAME="id" VALUE="<?php echo $row->NUM_ID_CLI; ?>">
      <INPUT TYPE="hidden" NAME="saldo" VALUE="<?php echo $row->VAL_SALDO_CLI; ?>">
      <INPUT TYPE="hidden" NAME="registro" VALUE="<?php echo $row->DTA_REGISTRO_CLI; ?>">
      <INPUT TYPE="hidden" NAME="alteracao" VALUE="<?php echo $row->DTA_ALTERACAO_CLI; ?>">
      <INPUT TYPE="hidden" NAME="tituloaberto" VALUE="<?php echo $row->TXT_TITULOABERTO_CLI; ?>">
        
    <?php
		}
	?>
</div>       

</td>
</tr>
</table>
</form>
</body>
</html>
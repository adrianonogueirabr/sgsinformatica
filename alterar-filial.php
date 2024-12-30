<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alterar Filial</title>
</head>

<?php

include "conexao.php";

$id = $_GET['id'];

$res = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = ?");
$res->bindParam(1,$id);
if (!$res->execute()) { echo "Error: " . $sql . "<br>" . mysqli_error($con);}
    
    while ($row = $res->fetch(PDO::FETCH_OBJ)){     
    
?>

<body>
<form name="EMPRESA" action="processa-filial.php?acao=salvar" method="post" onSubmit="return validaForm()">
<table class="table">
    <tr>
	    <td> <?php include "inicial.php"?> </td>
	</tr>
     <tr><td class=" table-primary"><h4>Alterar Loja: <?php echo $row->NUM_ID_EMP?> - <?php echo $row->TXT_RAZAO_EMP?></h4></td></tr>
</table>

<table width="80%" align="center">
<tr>
<td>  
		
<div class="form-row">
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">ID DA LOJA: </label>
        <input name="id" type="text" readonly="true"  title="ID DO EMPRESA NO SISTEMA" value="<?php echo $row->NUM_ID_EMP; ?>" class="form-control"  />
    </div>

    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">TIPO PESSOA </label>
			  <select name="pessoa" id="pessoa" title="INFORME O TIPO DE FILIAL JURÍDICA OU FÍSICA" class="form-control">
          <option value="F">PESSOA FÍSICA</option>
          <option value="J">PESSOA JURÍDICA</option>
       </select> 
		</div>

    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">DATA DE FUNDACAO </label>
        <input name="data_fundacao" value="<?php echo $row->DTA_FUNDACAO_EMP; ?>" class="form-control" type="date" required="true">
    </div>	
                
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">CPF OU CNPJ : </label>
        <input name="cpfcnpj" type="text" readonly="true" title="CPF OU CNPJ DO EMPRESA" value="<?php echo $row->TXT_CPFCNPJ_EMP; ?>"  class="form-control"  />
    </div>
    
    <div class="form-group col-md-6 col-sm-5"> 
        <p class="font-weight-bold">RAZÃO SOCIAL : </label>
        <input name="razao" type="text" value="<?php echo $row->TXT_RAZAO_EMP; ?>" title="NOME/RAZAO SOCIAL DO EMPRESA"   class="form-control"  />
    </div>
    
    <div class="form-group col-md-6 col-sm-5"> 
        <p class="font-weight-bold">NOME FANTASIA: </label>
        <input name="fantasia" type="text"  id="fantasia" value="<?php echo $row->TXT_FANTASIA_EMP; ?>" title="NOME FANTASIA" class="form-control"  />
    </div>
        
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">SITE: </label>
        <input name="site" class="form-control" type="text"  value="<?php echo $row->TXT_SITE_EMP; ?>" title="SITE CASO POSSUA" />
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">TELEFONE </label>
        <input name="telefone" type="text" class="form-control"  value="<?php echo $row->TXT_TELEFONE_EMP; ?>" title="TELEFONE CELULAR OU FIXO" />
    </div>

    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">RAMAL </label>
        <input name="ramal" type="text" class="form-control"  value="<?php echo $row->TXT_RAMAL_EMP; ?>" title="RAMAL" />
    </div>

    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">FAX: </label>
        <input name="fax" class="form-control" type="text" value="<?php echo $row->TXT_FAX_EMP; ?>" title="FAX CASO POSSUA" />
    </div>
    
    <div class="form-group col-md-4 col-sm-6"> 
        <p class="font-weight-bold">EMAIL: </label>
        <input name="email" class="form-control" type="text"  value="<?php echo $row->TXT_EMAIL_EMP; ?>" title="EMAIL DO EMPRESA" />
    </div>

    <div class="form-group col-md-6 col-sm-6"> 
        <p class="font-weight-bold">LOGRADOURO: </label>
        <input name="logradouro" class="form-control" type="text"  value="<?php echo $row->TXT_LOGRADOURO_EMP; ?>" title="LOGRADOURO"/>
   </div>
    
    <div class="form-group col-md-2 col-sm-6"> 
        <p class="font-weight-bold">NUMERO: </label>
        <input name="numero" class="form-control" type="text"  value="<?php echo $row->NUM_NUMERO_EMP; ?>" title="NUMERO DA RESIDENCIA"/>
    </div>

    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">CEP </label>
        <input name="cep" class="form-control" type="text"  value="<?php echo $row->NUM_CEP_EMP; ?>" title="CEP DO EMPRESA" />
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">BAIRRO:</label> 
        <input name="bairro" class="form-control" type="text"   value="<?php echo $row->TXT_BAIRRO_EMP; ?>" title="BAIRRO DO EMPRESA" />
    </div>

    <div class="form-group col-md-6 col-sm-6"> 
        <p class="font-weight-bold">COMPLEMENTO: </label>
        <input name="complemento" class="form-control" type="text"  value="<?php echo $row->TXT_COMPLEMENTO_EMP; ?>" title="COMPLEMENTO DO ENDERECO" />
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">CIDADE: </label>
        <input name="cidade" type="text" class="form-control"  value="<?php echo $row->TXT_CIDADE_EMP; ?>" title="CIDADE DO EMPRESA" />
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">ESTADO: </label>
    <select name="estado" value="<?php echo $row->TXT_ESTADO_EMP; ?>" id="estado" title="SELECIONE O ESTADO" class="form-control">
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
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">INSC. MUNICIPAL: </label>
        <input name="im" type="text" class="form-control"  value="<?php echo $row->TXT_IM_EMP; ?>" title="INSCRICAO MUNICIPAL CASO POSSUA" />
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">INSC. ESTADUAL: </label>
        <input name="ie" type="text" class="form-control"  value="<?php echo $row->TXT_IE_EMP; ?>" title="INSCRICAO ESTADUAL CASO POSSUA"/>
    </div>
    
    <div class="form-group col-md-6 col-sm-6"> 
        <p class="font-weight-bold">REGISTRO GERAL: </label> 
        <input name="rg" type="text"  class="form-control"  value="<?php echo $row->TXT_RG_EMP; ?>" title="RG DO EMPRESA"/>
    </div>

    <div class="form-group col-md-6 col-sm-6"> 
        <p class="font-weight-bold">ATIVO: </label>
           <select name="ativo" id="ativo" title="INFORME A FILIAL ESTA ATIVO OU NAO" class="form-control">
          <option value="S">SIM</option>
          <option value="N">NAO</option>
        </select>  
    </div>
    <div class="form-group col-md-2 col-sm-12"> 
        <input type="submit" name="registrar"  value="Salvar Dados" class="btn btn-success btn-block" />        
	</div>
</div>
       
<?php
	}
?>

</td></tr>
</table>
</form>
</body>
</html><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/bootstrap.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alterar Filial</title>
</head>

<?php

include "conexao.php";

$id = $_GET['id'];

$res = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = ?");
$res->bindParam(1,$id);
if (!$res->execute()) { echo "Error: " . $sql . "<br>" . mysqli_error($con);}
    
    while ($row = $res->fetch(PDO::FETCH_OBJ)){     
    
?>

<body>
<form name="EMPRESA" action="processa-filial.php?acao=salvar" method="post" onSubmit="return validaForm()">
<table class="table">
    <tr>
	    <td> <?php include "inicial.php"?> </td>
	</tr>
     <tr><td class=" table-primary"><h4>Alterar Loja: <?php echo $row->NUM_ID_EMP?> - <?php echo $row->TXT_RAZAO_EMP?></h4></td></tr>
</table>

<table width="80%" align="center">
<tr>
<td>  
		
<div class="form-row">
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">ID DA LOJA: </label>
        <input name="id" type="text" readonly="true"  title="ID DO EMPRESA NO SISTEMA" value="<?php echo $row->NUM_ID_EMP; ?>" class="form-control"  />
    </div>

    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">TIPO PESSOA </label>
			  <select name="pessoa" id="pessoa" title="INFORME O TIPO DE FILIAL JURÍDICA OU FÍSICA" class="form-control">
          <option value="F">PESSOA FÍSICA</option>
          <option value="J">PESSOA JURÍDICA</option>
       </select> 
		</div>

    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">DATA DE FUNDACAO </label>
        <input name="data_fundacao" value="<?php echo $row->DTA_FUNDACAO_EMP; ?>" class="form-control" type="date" required="true">
    </div>	
                
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">CPF OU CNPJ : </label>
        <input name="cpfcnpj" type="text" readonly="true" title="CPF OU CNPJ DO EMPRESA" value="<?php echo $row->TXT_CPFCNPJ_EMP; ?>"  class="form-control"  />
    </div>
    
    <div class="form-group col-md-6 col-sm-5"> 
        <p class="font-weight-bold">RAZÃO SOCIAL : </label>
        <input name="razao" type="text" value="<?php echo $row->TXT_RAZAO_EMP; ?>" title="NOME/RAZAO SOCIAL DO EMPRESA"   class="form-control"  />
    </div>
    
    <div class="form-group col-md-6 col-sm-5"> 
        <p class="font-weight-bold">NOME FANTASIA: </label>
        <input name="fantasia" type="text"  id="fantasia" value="<?php echo $row->TXT_FANTASIA_EMP; ?>" title="NOME FANTASIA" class="form-control"  />
    </div>
        
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">SITE: </label>
        <input name="site" class="form-control" type="text"  value="<?php echo $row->TXT_SITE_EMP; ?>" title="SITE CASO POSSUA" />
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">TELEFONE </label>
        <input name="telefone" type="text" class="form-control"  value="<?php echo $row->TXT_TELEFONE_EMP; ?>" title="TELEFONE CELULAR OU FIXO" />
    </div>

    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">RAMAL </label>
        <input name="ramal" type="text" class="form-control"  value="<?php echo $row->TXT_RAMAL_EMP; ?>" title="RAMAL" />
    </div>

    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">FAX: </label>
        <input name="fax" class="form-control" type="text" value="<?php echo $row->TXT_FAX_EMP; ?>" title="FAX CASO POSSUA" />
    </div>
    
    <div class="form-group col-md-4 col-sm-6"> 
        <p class="font-weight-bold">EMAIL: </label>
        <input name="email" class="form-control" type="text"  value="<?php echo $row->TXT_EMAIL_EMP; ?>" title="EMAIL DO EMPRESA" />
    </div>

    <div class="form-group col-md-6 col-sm-6"> 
        <p class="font-weight-bold">LOGRADOURO: </label>
        <input name="logradouro" class="form-control" type="text"  value="<?php echo $row->TXT_LOGRADOURO_EMP; ?>" title="LOGRADOURO"/>
   </div>
    
    <div class="form-group col-md-2 col-sm-6"> 
        <p class="font-weight-bold">NUMERO: </label>
        <input name="numero" class="form-control" type="text"  value="<?php echo $row->NUM_NUMERO_EMP; ?>" title="NUMERO DA RESIDENCIA"/>
    </div>

    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">CEP </label>
        <input name="cep" class="form-control" type="text"  value="<?php echo $row->NUM_CEP_EMP; ?>" title="CEP DO EMPRESA" />
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">BAIRRO:</label> 
        <input name="bairro" class="form-control" type="text"   value="<?php echo $row->TXT_BAIRRO_EMP; ?>" title="BAIRRO DO EMPRESA" />
    </div>

    <div class="form-group col-md-6 col-sm-6"> 
        <p class="font-weight-bold">COMPLEMENTO: </label>
        <input name="complemento" class="form-control" type="text"  value="<?php echo $row->TXT_COMPLEMENTO_EMP; ?>" title="COMPLEMENTO DO ENDERECO" />
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">CIDADE: </label>
        <input name="cidade" type="text" class="form-control"  value="<?php echo $row->TXT_CIDADE_EMP; ?>" title="CIDADE DO EMPRESA" />
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">ESTADO: </label>
    <select name="estado" value="<?php echo $row->TXT_ESTADO_EMP; ?>" id="estado" title="SELECIONE O ESTADO" class="form-control">
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
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">INSC. MUNICIPAL: </label>
        <input name="im" type="text" class="form-control"  value="<?php echo $row->TXT_IM_EMP; ?>" title="INSCRICAO MUNICIPAL CASO POSSUA" />
    </div>
    
    <div class="form-group col-md-3 col-sm-6"> 
        <p class="font-weight-bold">INSC. ESTADUAL: </label>
        <input name="ie" type="text" class="form-control"  value="<?php echo $row->TXT_IE_EMP; ?>" title="INSCRICAO ESTADUAL CASO POSSUA"/>
    </div>
    
    <div class="form-group col-md-6 col-sm-6"> 
        <p class="font-weight-bold">REGISTRO GERAL: </label> 
        <input name="rg" type="text"  class="form-control"  value="<?php echo $row->TXT_RG_EMP; ?>" title="RG DO EMPRESA"/>
    </div>

    <div class="form-group col-md-6 col-sm-6"> 
        <p class="font-weight-bold">ATIVO: </label>
           <select name="ativo" id="ativo" title="INFORME A FILIAL ESTA ATIVO OU NAO" class="form-control">
          <option value="S">SIM</option>
          <option value="N">NAO</option>
        </select>  
    </div>
    <div class="form-group col-md-2 col-sm-12"> 
        <input type="submit" name="registrar"  value="Salvar Dados" class="btn btn-success btn-block" />        
	</div>
</div>
       
<?php
	}
?>

</td></tr>
</table>
</form>
</body>
</html>
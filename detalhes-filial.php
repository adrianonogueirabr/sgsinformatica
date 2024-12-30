<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php

include "conexao.php";

$id = base64_decode($_GET['id']);

$res = $con->prepare("SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = ?");
$res->bindParam(1,$id);
if (!$res->execute()) { echo "Error: " . $sql . "<br>" . mysqli_error($con);}
    
    while ($row = $res->fetch(PDO::FETCH_OBJ)){     
    
?>

<body>
<form name="cliente" action="processa-filial.php?acao=salvar" method="post">
<table width="100%" class="table responsive">
    <tr>
        <td> <?php include "inicial.php"?></td>
    </tr>
    <tr>
	    <td><legend class="p-4 table-primary">Detalhes: <?php echo $row->TXT_RAZAO_EMP ?></legend></td>
	</tr>
    <tr>
        <td> 
            <div class="form-row"> 
                <div class="form-group col-md-4 col-sm-6"><label>ID</label>
                    <input type="text" name="id" id="id" readonly="readonly" title="ID DO CLIENTE NO SISTEMA" value="<?php echo $row->NUM_ID_EMP; ?>" class="form-control"  />
                </div>

                <div class="form-group col-md-4 col-sm-6"><label>Pessoa</label>	
                    <input  type="text" title="PESSOA DO CLIENTE" value="<?php echo $row->TXT_PESSOA_EMP; ?>" readonly="readonly" class="form-control"  /> 
                </div>
                
                <div class="form-group col-md-4 col-sm-6"><label>CPF/CNPJ</label>	   
                    <input  type="text" title="CPF OU CNPJ DO CLIENTE" value="<?php echo $row->TXT_CPFCNPJ_EMP; ?>" readonly="readonly" class="form-control"  />
                </div>
                    
                <div class="form-group col-md-6 col-sm-6"><label for="razao">Razao Social</label>
                    <input name="razao" id="razao"  type="text" value="<?php echo $row->TXT_RAZAO_EMP; ?>" title="NOME/RAZAO SOCIAL DO CLIENTE"   class="form-control"  />
                </div>

                <div class="form-group col-md-6 col-sm-6"><label for="fantasia">Nome Fantasia</label>
                    <input name="fantasia" id="fantasia"  type="text"   value="<?php echo $row->TXT_FANTASIA_EMP; ?>" title="NOME FANTASIA NOME QUE APARECE NOS RELATORIOS" class="form-control"  />
                </div>
                
                <div class="form-group col-md-3 col-sm-6"><label>Fundacao</label>
                    <input type="text" class="form-control" title="DATA DE NASCIMENTO" value="<?php echo date("d/m/Y", strtotime($row->DTA_FUNDACAO_EMP)); ?>" readonly="readonly" />
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="site">Site</label>
                    <input class="form-control" name="site" id="site" type="text"  value="<?php echo $row->TXT_SITE_EMP; ?>" title="SITE CASO POSSUA" />
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="telefone">Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="telefone" value="<?php echo $row->TXT_TELEFONE_EMP ?>" title="TELEFONE CELULAR OU FIXO" />
                </div>
                
                <div class="form-group col-md-3 col-sm-6"><label for="logo">Caminho da Logo</label>
                    <input  class="form-control" type="text" name="logo" id="logo" value="<?php echo $row->TXT_LOGO_EMP; ?>" title="CAMINHO DA LOGO CUIDADO AO ALTERAR" />
                </div>

                <div class="form-group col-md-4 col-sm-6"><label for="email">Email</label>
                    <input  class="form-control" type="email" name="email" id="email" value="<?php echo $row->TXT_EMAIL_EMP; ?>" title="EMAIL DA EMPRESA" />
                </div>

                <div class="form-group col-md-6 col-sm-6"><label for="logradouro">Logradouro</label>
                    <input  class="form-control" type="text" name="logradouro" id="logradouro" value="<?php echo $row->TXT_LOGRADOURO_EMP; ?>" title="LOGRADOURO"/>
                </div>

                <div class="form-group col-md-2 col-sm-6"><label for="numero">Numero</label>
                    <input class="form-control" type="text" name="numero" id="numero" value="<?php echo $row->NUM_NUMERO_EMP; ?>" title="NUMERO"/>
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="cep">Cep</label>
                    <input class="form-control" type="text" name="cep" id="cep" value="<?php echo $row->NUM_CEP_EMP; ?>" title="CEP DO ENDERECO" />
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="bairro">Bairro</label>
                    <input  class="form-control" type="text"  name="bairro" id="bairro" value="<?php echo $row->TXT_BAIRRO_EMP; ?>" title="BAIRRO DO ENDERECO" />
                </div>

                <div class="form-group col-md-6 col-sm-6"><label for="complemento">Complemento</label>
                    <input name="complemento" class="form-control" type="text" id="complemento" value="<?php echo $row->TXT_COMPLEMENTO_EMP; ?>" title="COMPLEMENTO DO ENDERECO" />
                </div>
                
                <div class="form-group col-md-3 col-sm-6"><label for="cidade">Cidade</label>
                    <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo $row->TXT_CIDADE_EMP; ?>" title="CIDADE DO CLIENTE" />
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="estado">Estado</label>
                    <input name="estado" id="estado" type="text" title="ESTADO DO CLIENTE NO SISTEMA" value="<?php echo $row->TXT_ESTADO_EMP; ?>"  class="form-control" />    
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="im">Inscricao Municipal</label>
                    <input name="im" id="im" type="text" class="form-control" value="<?php echo $row->TXT_IM_EMP; ?>" title="INSCRICAO MUNICIPAL CASO POSSUA" />
                </div>
                
                <div class="form-group col-md-3 col-sm-6"><label for="ie">Inscricao Estadual</label>
                    <input  type="text" class="form-control" name="ie" id="ie" value="<?php echo $row->TXT_IE_EMP; ?>" title="INSCRICAO ESTADUAL CASO POSSUA"/>
                </div>
                
                <div class="form-group col-md-3 col-sm-6"><label for="rg">Registro Geral</label>
                    <input name="rg" id="rg" type="text" class="form-control"  value="<?php echo $row->TXT_RG_EMP; ?>" title="RG"/>
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="multa">Multa</label>
                    <input name="multa" id="multa" type="int" class="form-control"  value="<?php echo $row->VAL_MULTA_EMP ?>" title="VALOR DE MULTA EX: 5.50"/>
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="juros">Juros</label>
                    <input name="juros" id="juros" type="text" class="form-control"  value="<?php echo $row->VAL_JUROS_EMP; ?>" title="VALOR DE JUROS EX: 1.52"/>
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="ativo">Ativo</label>        
                    <select name="ativo" id="ativo" class="form-control" required>		    
                        <option value="SIM">SIM</option>
                        <option value="NAO">NAO</option>
                    </select>
                </div> 
                
                <div class="form-group col-md-6 col-sm-6"><label>Data de Registro</label>
                    <input name="registro_" class="form-control" type="text" readonly="readonly" title="DATA DE REGISTRO" value="<?php echo date("d/m/Y", strtotime($row->DTA_REGISTRO_EMP)); ?>" />
                </div>
                
                <div class="form-group col-md-6 col-sm-6"><label>Ultima Alteracao</label>
                    <input  class="form-control" type="text" readonly="readonly" title="DATA DA ULTIMA ALTERACAO " value="<?php echo date("d/m/Y",strtotime($row->DTA_ALTERACAO_EMP)); ?>"/>
                </div>                            

                <div class="form-group col-md-2 col-sm-12">
                    <input type="submit" name="Alterar Dados"  value="Salvar Dados" class="btn btn-outline-danger"  />
                </div> 
                    
                <?php
                    }
                ?>
            </div>
        </form>
        </td>
    </tr>
</table>
</body>
</html>
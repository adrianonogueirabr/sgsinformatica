<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<form name="cliente" action="processa-filial.php?acao=cadastrar" method="post">
<table width="100%" class="table responsive">
    <tr>
        <td> <?php include "inicial.php"?></td>
    </tr>
    <tr>
	    <td><legend class="p-4 table-primary">Cadastro de Loja</legend></td>
	</tr>
    <tr>
        <td> 
            <div class="form-row"> 
                <div class="form-group col-md-4 col-sm-6"><label>Pessoa</label>	
                    <select name="pessoa" id="pessoa" title="INFORME O TIPO DE FILIAL JURÍDICA OU FÍSICA" class="form-control">
                        <option value="FISICA">PESSOA FÍSICA</option>
                        <option value="JURIDICA">PESSOA JURÍDICA</option>
                    </select>
                </div>
                
                <div class="form-group col-md-4 col-sm-6"><label>CPF/CNPJ</label>	   
                    <input  type="text" title="CPF OU CNPJ DA EMPRESA" value="" name="cpfcnpj" id="cpfcnpj" class="form-control"  />
                </div>

                <div class="form-group col-md-4 col-sm-6"><label>Fundacao</label>
                    <input name="data_fundacao" id="data_fundacao"  class="form-control" type="date" title="DATA DE FUNDACAO/NASCIMENTO" required="true" />
                </div>
                    
                <div class="form-group col-md-6 col-sm-6"><label for="razao">Razao Social</label>
                    <input name="razao" id="razao"  type="text" value="" title="NOME/RAZAO SOCIAL DO CLIENTE" onblur="adcionaRazaoFantasia()"   class="form-control"  />
                </div>

                <div class="form-group col-md-6 col-sm-6"><label for="fantasia">Nome Fantasia</label>
                    <input name="fantasia" id="fantasia"  type="text"   value="" title="NOME FANTASIA NOME QUE APARECE NOS RELATORIOS" class="form-control"  />
                </div>               
                

                <div class="form-group col-md-3 col-sm-6"><label for="site">Site</label>
                    <input class="form-control" name="site" id="site" type="text"  value="" title="SITE CASO POSSUA" />
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="telefone">Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="telefone" value="" title="TELEFONE CELULAR OU FIXO" />
                </div>
                
                <div class="form-group col-md-6 col-sm-6"><label for="logo">Caminho da Logo</label>
                    <input  class="form-control" type="text" name="logo" id="logo" value="" title="CAMINHO DA LOGO CUIDADO AO ALTERAR" />
                </div>

                <div class="form-group col-md-4 col-sm-6"><label for="email">Email</label>
                    <input  class="form-control" type="email" name="email" id="email" value="" title="EMAIL DA EMPRESA" />
                </div>

                <div class="form-group col-md-6 col-sm-6"><label for="logradouro">Logradouro</label>
                    <input  class="form-control" type="text" name="logradouro" id="logradouro" value="" title="LOGRADOURO"/>
                </div>

                <div class="form-group col-md-2 col-sm-6"><label for="numero">Numero</label>
                    <input class="form-control" type="text" name="numero" id="numero" value="" title="NUMERO"/>
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="cep">Cep</label>
                    <input class="form-control" type="text" name="cep" id="cep" value="" title="CEP DO ENDERECO" />
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="bairro">Bairro</label>
                    <input  class="form-control" type="text"  name="bairro" id="bairro" value="" title="BAIRRO DO ENDERECO" />
                </div>

                <div class="form-group col-md-6 col-sm-6"><label for="complemento">Complemento</label>
                    <input name="complemento" class="form-control" type="text" id="complemento" value="" title="COMPLEMENTO DO ENDERECO" />
                </div>
                
                <div class="form-group col-md-3 col-sm-6"><label for="cidade">Cidade</label>
                    <input type="text" class="form-control" name="cidade" id="cidade" value="" title="CIDADE DO CLIENTE" />
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="estado">Estado</label>
                    <input name="estado" id="estado" type="text" title="ESTADO DO CLIENTE NO SISTEMA" value=""  class="form-control" />    
                </div>

                <div class="form-group col-md-3 col-sm-6"><label for="im">Inscricao Municipal</label>
                    <input name="im" id="im" type="text" class="form-control" value="" title="INSCRICAO MUNICIPAL CASO POSSUA" />
                </div>
                
                <div class="form-group col-md-3 col-sm-6"><label for="ie">Inscricao Estadual</label>
                    <input  type="text" class="form-control" name="ie" id="ie" value="" title="INSCRICAO ESTADUAL CASO POSSUA"/>
                </div>
                
                <div class="form-group col-md-4 col-sm-6"><label for="rg">Registro Geral</label>
                    <input name="rg" id="rg" type="text" class="form-control"  value="" title="RG"/>
                </div>

                <div class="form-group col-md-4 col-sm-6"><label for="multa">Multa</label>
                    <input name="multa" id="multa" type="int" class="form-control"  value="" title="VALOR DE MULTA EX: 5.50"/>
                </div>

                <div class="form-group col-md-4 col-sm-6"><label for="juros">Juros</label>
                    <input name="juros" id="juros" type="text" class="form-control"  value="" title="VALOR DE JUROS EX: 1.52"/>
                </div>

                <div class="form-group col-md-2 col-sm-12">
                    <input type="submit" class="btn btn-outline-primary"  name="registrar"  value="Registrar Dados" />
                </div>                    
            </div>
        </form>
        </td>
    </tr>
</table>
</body>
<script type="text/javascript" src="javascript/cadastro_cliente.js"></script>
</html>
<?php include "verifica.php"; 
//LIBERACAO TECNICO PARA APROVAR E EXECUTAR SERVICO DAS OS
	
	include "conexao.php";
	
	//selecao da empresa para cabecalho do relatorio
		$sql_empresa = "SELECT * FROM TBL_EMPRESA_EMP WHERE NUM_ID_EMP = $empresa_usuario";
		$res_empresa = mysql_query($sql_empresa);	
	//fim selecao
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/formularios.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Impressão de Ordem de Servico</title>
</head>
<body>

<form name="listagem" method="post" action="processa-apontamento.php?acao=adcionar">

<table width="684" border="1" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td width="2001" height="460" colspan="5" align="center" valign="top">     
      
      <table width="700" border="0" align="center" cellpadding="1" cellspacing="1">
        <tr>
          <td height="108" colspan="4" valign="middle">
            <table width="681" border="0">
              <?php 
	  				while ($row_empresa = mysql_fetch_array($res_empresa)){
	  			?>
              <tr>
                <td width="214" rowspan="4"><div id="imagemRelatorio"><img src="imagens/logo_ofc.png" width="210" height="89" /></div></td>
                <td width="457" height="10"><div id="tituloRelatorio"><?php echo $row_empresa["TXT_FANTASIA_EMP"] ?></div></td>        
                </tr>
              <tr>
                <td height="10"><div id="textoRelatorio"><?php echo $row_empresa["TXT_LOGRADOURO_EMP"] ?> N<?php echo $row_empresa["NUM_NUMERO_EMP"] ?>, <?php echo $row_empresa["TXT_BAIRRO_EMP"] ?>,<?php echo $row_empresa["TXT_CIDADE_EMP"] ?>-<?php echo $row_empresa["TXT_ESTADO_EMP"] ?></div></td>
                </tr>
              <tr>
                <td height="10"><div id="textoRelatorio"><?php echo $row_empresa["TXT_EMAIL_EMP"] ?></div></td>
                </tr>
              <tr>
                <td height="10"><div id="textoRelatorio"><?php echo $row_empresa["TXT_TELEFONE_EMP"] ?></div></td>
                </tr>
              <? } ?>
              </table>
            </td>
          </tr>
        <tr>
          <td width="152" height="20" valign="bottom"><div id="ImportanteRelatorio">NUMERO DA OS*:</div></td>
          <td width="169" height="20" valign="bottom"><div id="ImportanteRelatorio">TIPO DE OS*:</div></td>
          <td width="177" valign="bottom"><div id="ImportanteRelatorio">TIPO DE EQUIPAMENTO*:</div></td>
          <td width="189" valign="bottom"><div id="ImportanteRelatorio">SERIAL EQUIPAMENTO*:</div></td>
          </tr>
        <tr>
         
          <td>
            <input name="id" type="text" disabled="disabled" id="id" size="20" maxlength="20" />
            <input type="hidden" name="id_os" id="id_os" value="" />            
            <input type="hidden" name="tipo_os" id="tipo_os" value="" /></td>
          <td>            
            <input name="tipo2" type="text" disabled="disabled" id="tipo2" size="20" maxlength="20" />

          </td>
         
          <td>
            <input name="tipo2" type="text" disabled="disabled" id="tipo2" size="20" maxlength="20" />		  		</td>  
          <td>
            <input name="tipo2" type="text" disabled="disabled" id="tipo2" size="20" maxlength="20" />		  		</td>  

          </tr>  
        <tr>
          <td height="20" colspan="2" valign="bottom"><div id="ImportanteRelatorio">IDENTIFICACAO DO CLIENTE*:</div></td>
          <td valign="bottom"><div id="ImportanteRelatorio">TELEFONE*:</div></td>
          <td valign="bottom"><div id="ImportanteRelatorio">TECNICO RESPONSÁVEL*:</div></td>
          </tr>
        <tr>
          <td colspan="2">
            <input name="id_cliente2" type="text" disabled="disabled" id="id_cliente2" size="5" maxlength="20" />

            <input name="nomecliente2" type="text" disabled="disabled" id="nomecliente2" size="35" />
            </td>
          <td>
            <input name="setor2" type="text" disabled="disabled" id="setor2" size="20" maxlength="50" />	  </td>
          <td>
            <input name="setor2" type="text" disabled="disabled" id="setor2" size="20" maxlength="50" />	  </td> 

          </tr>
        <tr>
          <td valign="bottom"><div id="ImportanteRelatorio">DADOS GERAIS:</div></td>
          <td height="20" colspan="3">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="4"><input name="dadosferais" type="text" disabled="disabled" id="dadosferais2" size="110" maxlength="50" />	  </td>
          </tr>
        <tr>
          <td valign="bottom"><div id="ImportanteRelatorio">RECLAMAÇÃO*:</div></td>
          <td height="20" colspan="3">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="4"><textarea name="textarea2" cols="110" rows="3" disabled="disabled" id="textarea2"></textarea>    </td>
          </tr>
        <tr>
          <td valign="bottom"><div id="ImportanteRelatorio">DEFEITO*:</div></td>
          <td height="20" colspan="3">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="4"><textarea name="textarea3" cols="110" rows="3" disabled="disabled" id="textarea3"></textarea>    </td>
          </tr>
        <tr>
          <td valign="bottom"><div id="ImportanteRelatorio">SOLUCAO*:</div></td>
          <td height="20" colspan="3">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="4" valign="top"><textarea name="textarea4" cols="110" rows="3" disabled="disabled" id="textarea4"></textarea>		  </td>
          </tr>
        <tr>
          </tr>  
        </table>
      </p>
      <table width="697" height="89" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <th width="82" height="15" scope="col"><div id="tituloCampoListagem">VALOR</div></th>
          <th colspan="3" scope="col"><div id="tituloCampoListagem">SERVICO</div></th>        
          </tr>
        <tr>
          <td height="15"><div id="nomeCampoListagem"></div></td>

          <td colspan="3" align="left"><div id="nomeCampoListagem"></div></td>
      
          </tr>
        <tr>
          <td width="82" height="15" scope="col"><div id="tituloCampoListagem">STATUS</div></td>
          <td width="305" scope="col"><div id="tituloCampoListagem">DATA/HORA INICIO</div></td>
          <td width="302" scope="col"><div id="tituloCampoListagem">DATA/HORA FIM</div></td>        
          </tr>
        <tr>
          <td height="15"><div id="nomeCampoListagem"></div></td>
          <td height="15"><div id="nomeCampoListagem"> | </div></td>
          <td height="15"><div id="nomeCampoListagem"> | </div></td>       
          </tr>
        </table>
        <table width="697" height="89" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <th width="82" height="15" scope="col"><div id="tituloCampoListagem">VALOR</div></th>
          <th colspan="3" scope="col"><div id="tituloCampoListagem">SERVICO</div></th>        
          </tr>
        <tr>
          <td height="15"><div id="nomeCampoListagem"></div></td>

          <td colspan="3" align="left"><div id="nomeCampoListagem"></div></td>
      
          </tr>
        <tr>
          <td width="82" height="15" scope="col"><div id="tituloCampoListagem">STATUS</div></td>
          <td width="305" scope="col"><div id="tituloCampoListagem">DATA/HORA INICIO</div></td>
          <td width="302" scope="col"><div id="tituloCampoListagem">DATA/HORA FIM</div></td>        
          </tr>
        <tr>
          <td height="15"><div id="nomeCampoListagem"></div></td>
          <td height="15"><div id="nomeCampoListagem"> | </div></td>
          <td height="15"><div id="nomeCampoListagem"> | </div></td>       
          </tr>
        </table>
        <table width="697" height="89" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <th width="82" height="15" scope="col"><div id="tituloCampoListagem">VALOR</div></th>
          <th colspan="3" scope="col"><div id="tituloCampoListagem">SERVICO</div></th>        
          </tr>
        <tr>
          <td height="15"><div id="nomeCampoListagem"></div></td>

          <td colspan="3" align="left"><div id="nomeCampoListagem"></div></td>
      
          </tr>
        <tr>
          <td width="82" height="15" scope="col"><div id="tituloCampoListagem">STATUS</div></td>
          <td width="305" scope="col"><div id="tituloCampoListagem">DATA/HORA INICIO</div></td>
          <td width="302" scope="col"><div id="tituloCampoListagem">DATA/HORA FIM</div></td>        
          </tr>
        <tr>
          <td height="15"><div id="nomeCampoListagem"></div></td>
          <td height="15"><div id="nomeCampoListagem"> | </div></td>
          <td height="15"><div id="nomeCampoListagem"> | </div></td>       
          </tr>
        </table>
        <table width="697" height="89" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <th width="82" height="15" scope="col"><div id="tituloCampoListagem">VALOR</div></th>
          <th colspan="3" scope="col"><div id="tituloCampoListagem">SERVICO</div></th>        
          </tr>
        <tr>
          <td height="15"><div id="nomeCampoListagem"></div></td>

          <td colspan="3" align="left"><div id="nomeCampoListagem"></div></td>
      
          </tr>
        <tr>
          <td width="82" height="15" scope="col"><div id="tituloCampoListagem">STATUS</div></td>
          <td width="305" scope="col"><div id="tituloCampoListagem">DATA/HORA INICIO</div></td>
          <td width="302" scope="col"><div id="tituloCampoListagem">DATA/HORA FIM</div></td>        
          </tr>
        <tr>
          <td height="15"><div id="nomeCampoListagem"></div></td>
          <td height="15"><div id="nomeCampoListagem"> | </div></td>
          <td height="15"><div id="nomeCampoListagem"> | </div></td>       
          </tr>
        </table>
        <table width="697" height="89" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <th width="82" height="15" scope="col"><div id="tituloCampoListagem">VALOR</div></th>
          <th colspan="3" scope="col"><div id="tituloCampoListagem">SERVICO</div></th>        
          </tr>
        <tr>
          <td height="15"><div id="nomeCampoListagem"></div></td>

          <td colspan="3" align="left"><div id="nomeCampoListagem"></div></td>
      
          </tr>
        <tr>
          <td width="82" height="15" scope="col"><div id="tituloCampoListagem">STATUS</div></td>
          <td width="305" scope="col"><div id="tituloCampoListagem">DATA/HORA INICIO</div></td>
          <td width="302" scope="col"><div id="tituloCampoListagem">DATA/HORA FIM</div></td>        
          </tr>
        <tr>
          <td height="15"><div id="nomeCampoListagem"></div></td>
          <td height="15"><div id="nomeCampoListagem"> | </div></td>
          <td height="15"><div id="nomeCampoListagem"> | </div></td>       
          </tr>
        </table>
        
        </td>
  </tr>
  <tr>
    <td height="75" colspan="5" align="center" valign="top"><img src="imagens/assinaturas.png" width="685" height="67" /></td>
  </tr>
  </table>
</form>
</body>
</html>
